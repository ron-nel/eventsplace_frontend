<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Session;


class RegisterController extends Controller
{

    public function registerform(){

        return view('auth.register');
    }

    public function submitregister(Request $request){
        // dd($request);
        $client = new Client;
        $response = $client->post("localhost:4000/admin/register",[

            "json" => [
                "name" => $request->name,
                "email" => $request->email,
                "password" => $request->password,
                "role" => $request->role
            ]

        ]
        );
        $result=json_decode($response->getBody());
        Session::put('user', $result->data);
        Session::put('token', $result->token);

        // dd($result);
        return redirect('/');
    }

    // public function showUser(){
    //     $client = new Client;
    //     $response = $client->get("localhost:4000/admin/user");
    //     $result=json_decode($response->getBody());
    //     $posts = $result->result;

        
    //     $resp = $client->get("localhost:4000/admin/showComments");
    //     $results=json_decode($resp->getBody());
    //     $comments = $results->result;
    
    //     return view("/posts.showPosts", compact("posts", "comments"));
    // }

    public function loginpage(){

        return view('auth.login');
    }

    public function login(Request $request){
        $client = new Client;

        $response = $client->post("localhost:4000/admin/login",[
            "json" => [
                "email" => $request->email,
                "password" => $request->password
            ]
        ]);
        $result = json_decode($response->getBody());

        Session::put('user',$result->data->user);

        return redirect('/');
    }

    public function logout(){
        Session::flush();

        //---------continue here-----------

        return redirect('/');

        // --------------------------
    }

}


