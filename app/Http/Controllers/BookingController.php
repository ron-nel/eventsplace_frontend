<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Session;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class BookingController extends Controller
{

    //admin cruds


    public function showAllRooms(){
    	$client = new Client;
   		$response = $client->get("https://frozen-island-10337.herokuapp.com/admin/showRooms");
   		$resultPost = json_decode($response->getBody());
   		$rooms = $resultPost->result;
   		// $post = $rooms->get();
   		// dd($rooms); 
    	return view('booking.showAllRooms', compact('rooms'));
    }

    public function addRoomForm() {
    	return view('booking.addRoomForm');
    }

    public function addRoom(Request $request){
    	$image = $request->file("roomImage");
    	$image_name = time().".".$image->getClientOriginalExtension();
    	$destination = "images/";
    	$image->move($destination, $image_name);
    	$image_path = $destination.$image_name;

    	$client = new Client;

    	$response = $client->post("https://frozen-island-10337.herokuapp.com/admin/addRoom",
    		[
    		"json" => [
    			"roomName"=>$request->roomName,
    			"roomLocation"=>$request->roomLocation,
                "roomCapacity"=>$request->roomCapacity,
                "roomArea"=>$request->roomArea,
                "roomCeiling"=>$request->roomCeiling,
                "roomPrice"=>$request->roomPrice,
    			"roomImage"=>$image_path
    			]
    		]
    	);

    	return redirect()->back();
    }

    public function deleteRoom($id){
        $client = new Client;
        $response = $client->delete("https://frozen-island-10337.herokuapp.com/admin/deleteRoom/$id");
        $result = json_decode($response->getBody());
        return redirect()->back();
    }

    public function updateRoomForm($id){
        $client = new Client;
        $response = $client->get("https://frozen-island-10337.herokuapp.com/admin/showRoomById/$id");
        $rooms = json_decode($response->getBody());
        $room = $rooms->result[0];
        return view('booking.showRoom', compact('room'));
    }

    public function updateRoom($id, Request $request){
        $image = $request->file("roomImage");
        if($image !== null){
        $image_name = time().".".$image->getClientOriginalExtension();
        $destination = "images/";
        $image->move($destination, $image_name);
        $image_path = $destination.$image_name;
        $client = new Client;
        $response = $client->put("https://frozen-island-10337.herokuapp.com/admin/updateRoom/$id", [
            "json" => [
                "roomName"=>$request->roomName,
                "roomPrice"=>$request->roomPrice,
                "roomLocation"=>$request->roomLocation,
                "roomImage"=>$image_path
            ]
        ]);
        } else {
        $client = new Client;
        $response = $client->put("https://frozen-island-10337.herokuapp.com/admin/updateRoom/$id", [
            "json" => [
                "roomName"=>$request->roomName,
                "roomPrice"=>$request->roomPrice,
                "roomLocation"=>$request->roomLocation
            ]
        ]);
        }
        return redirect('/admin/showAllRooms');
    }

    public function showAllReservations() {
        $client = new Client;
        $response = $client->get("https://frozen-island-10337.herokuapp.com/admin/availableRooms");
        $result = json_decode($response->getBody());
        $reservations = $result->result;
        // dd($reservations);
        return view('booking.reservations', compact('reservations'));
    }




    //user cruds


    public function showSearchResult(Request $request){
        // dd($request);
        $startDate = $request->startDate;
        $endDate = $request->endDate;
        $client = new Client;

        //shows rooms already booked
        $responseSchedule = $client->get("https://frozen-island-10337.herokuapp.com/admin/availableRooms");
        $bookedRooms = collect(json_decode($responseSchedule->getBody())->result);

        //shows all rooms in the area
        $responseRoom = $client->get("https://frozen-island-10337.herokuapp.com/admin/showRooms");
        if ($request->location === "all") {
        $allRooms = collect(json_decode($responseRoom->getBody())->result);
        } else {
        $allRoom = collect(json_decode($responseRoom->getBody())->result);
        $allRooms = collect($allRoom->where("roomLocation", $request->location)->all());
            // dd($allRoomsInArea);

        }
        // $bookedRoomss = collect($bookedRooms);
        // $bookedRoomsss = $bookedRoomss->toArray();

        //shows available rooms in a given date
        $availableRoom1 = collect($bookedRooms->whereBetween("startDate", [$startDate, $endDate])->all());
        $availableRoom2 = $bookedRooms->whereNotBetween("endDate", [$startDate, $endDate])->all();

        // $bookedRoom = $bookedRooms->whereNotBetween("startDate", [$startDate, $endDate]);
        // $unavailRoom = $bookedRoom->first();
        // $unavailableRoom = $unavailRoom->roomId;

        //gives an array of all the id's from all rooms
        $availableRooms = $availableRoom1->pluck('roomId');
        // dd($availableRooms);     
        //converts object to array
        $availableRoomss = $availableRooms->toArray();

        //instantiate/initializes a new array
        $newRooms=[];

        //gets all the items in the collection from 
        foreach ($allRooms as $room) {
            if (in_array($room->_id, $availableRoomss)) {
            } else {
                array_push($newRooms, $room);
                // return $newRooms[] = $room;
            }
        }
                // dd($newRooms);

        // $availableRooms = $allRooms->whereNotIn("_id", $unavailableRoom);



        // $allRooms = $rooms->;
        // dd($newRooms);

    	return view('booking.searchResult', compact('newRooms', 'request'));
    }

    public function reserveRoom(Request $request) {
        $client = new Client;
        $response = $client->post("https://frozen-island-10337.herokuapp.com/admin/reserveRoom",[
            "json" => [
                "roomId"=>$request->roomId,
                "roomPrice"=>$request->roomPrice,
                "startDate"=>$request->startDate,
                "endDate"=>$request->endDate
            ]
        ]);
        // dd($response);

        return redirect('/');
    }

    public function showMyReservations(){
        $email = Session('user')->email;
        $client = new Client;

        //show all rooms
        $response1 = $client->get("https://frozen-island-10337.herokuapp.com/admin/showRooms");
        $allRoom = collect(json_decode($response1->getBody())->result);

        //show my reservations
        $response = $client->get("https://frozen-island-10337.herokuapp.com/admin/availableRooms");
        $bookedRooms = collect(json_decode($response->getBody())->result);
        $reservations = collect($bookedRooms->where("userEmail", $email)->all());
        $reserveRooms = $reservations->pluck('roomId');
        $reserveRoomss = $reserveRooms->toArray();
        // dd($reserveRoomss);

        $newRooms = [];

        foreach($allRoom as $room){
            if (in_array($room->_id, $reserveRoomss)) {
                array_push($newRooms, $room);
            }
        }

        return view('booking.myReservations', compact('newRooms', 'reservations'));

    }

    public function viewReservationDetails($id) {
        $client = new Client;
        $response = $client->get("https://frozen-island-10337.herokuapp.com/admin/showRoomById/$id");
        $rooms = json_decode($response->getBody());
        $room = $rooms->result[0];
        return view('booking.reservationDetails', compact('room'));
    }

    public function cancelReservation($id) {
        $client = new Client;
        $response = $client->delete("https://frozen-island-10337.herokuapp.com/admin/cancelReservation/$id");
        return redirect()->back();
    }


    public function stripe($id, Request $request) {
        $client = new Client;
        $response = $client->get("https://frozen-island-10337.herokuapp.com/admin/showRoomById/$id");
        $resultPost = json_decode($response->getBody());
        $posts = $resultPost->result[0];
        return view('booking.stripe', compact('request', 'posts'));
    }

     public function chargeMember($id, Request $request){
        $client = new Client;
        $response = $client->post("https://frozen-island-10337.herokuapp.com/admin/reserveRoom", [
            "headers" => [
                "Authorization" => Session::get("token")
            ],
            "json" => [
                "roomId"=>$request->roomId,
                "startDate"=>$request->startDate,
                "endDate"=>$request->endDate,
                "roomPrice"=>$request->price,
                "userEmail"=>$request->userEmail,
                "clientName"=>$request->clientName
            ]
        ]);

        $response2 = $client->get("https://frozen-island-10337.herokuapp.com/admin/showRoomById/$id");
        $result2 = json_decode($response2->getBody());
        $room = $result2->result[0];

        // $response3 = $client->get("https://frozen-island-10337.herokuapp.com/admin/showBookedRoom");
        // $result3 = json_decode($response3->getBody());
        // dd($result3);

        $email = Session::get("user")->email;
        $userName = Session::get("user")->name;
        $mail = new PHPMailer(true);

        $sender_email = "event.space279@gmail.com";
        $receiver_email = $email;
        $subject = "RESERVATION CONFIRMATION";
        $body = "<h3>Your reservation has been confirmed.</h3> <div>These are the details of your transaction:</div>
                <div>
                <table>
                                        <tbody>
                                            <tr>
                                                <td>Name</td>
                                                <td>{$room->roomName}</td>
                                            </tr>
                                            <tr>
                                                <td>Location</td>
                                                <td>{$room->roomLocation}</td>
                                            </tr>
                                            <tr>
                                                <td>Capacity</td>
                                                <td>{$room->roomCapacity}</td>
                                            </tr>
                                            <tr>
                                                <td>Dimension</td>
                                                <td>{$room->roomArea}</td>
                                            </tr>
                                            <tr>
                                                <td>Ceiling</td>
                                                <td>{$room->roomCeiling}</td>
                                            </tr>
                                            <tr>
                                                <td>Price (Php)</td>
                                                <td>{$room->roomPrice}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                </div>
        ";

        try{
            $mail->isSMTP();
            //use SMTP

            $mail->Host="smtp.gmail.com";
            //specify the smtp server to use

            $mail->SMTPAuth=true;
            //allow authentication

            $mail->Username=$sender_email;
            $mail->Password="event.space2019";
            $mail->SMTPSecure="tls";
            //Enables TLS Encryption, ssl is also accepted
            $mail->Port=587;
            //tcp port to connect to

            //for recipients
            $mail->setFrom($sender_email, "Event Space");
            $mail->addAddress($receiver_email);


            //email content
            $mail->isHTML(true);

            //formatting
            $mail->Subject = $subject;
            $mail->Body=$body;

            $mail->send();
            Session::flash("message", "Reservation is successful. A confirmation message has been sent to your email. Thank you!");
            return redirect("/");
        }catch(Exception $e){
            Session::flash("message", "Message could not be sent " . $mail->ErrorInfo);
            return redirect("/allposts");
        }

        return redirect("/");
    }

}
