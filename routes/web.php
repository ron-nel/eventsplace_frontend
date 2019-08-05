<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('booking.home');
});




//admin
Route::get('/admin/showAllRooms', 'BookingController@showAllRooms');
Route::get('/admin/addRoomForm', 'BookingController@addRoomForm');
Route::post('/admin/addRoom', 'BookingController@addRoom');
Route::get('/admin/deleteRoom/{id}', 'BookingController@deleteRoom');
Route::get('/admin/updateRoomForm/{id}', 'BookingController@updateRoomForm');
Route::put('/admin/updateRoom/{id}', 'BookingController@updateRoom');
Route::get('/admin/showAllReservations', 'BookingController@showAllReservations');


Route::get('/book', 'BookingController@showBook');
Route::get('/sendEmail', 'BookingController@sendEmail');
Route::post('/search', 'BookingController@showSearchResult');
Route::post('/reserveRoom', 'BookingController@reserveRoom');
Route::get('/showMyReservations', 'BookingController@showMyReservations');
Route::get('/viewReservationDetails/{id}', 'BookingController@viewReservationDetails');
Route::get('/cancelReservation/{id}', 'BookingController@cancelReservation');

//stripe
Route::post('/stripe/{id}', 'BookingController@stripe');
Route::post('/charge/{id}', "BookingController@chargeMember");


//reg
Route::get('/auth/register', 'RegisterController@registerform');
Route::post('/auth/submitregister', 'RegisterController@submitregister');

//login
Route::get('/auth/loginpage', 'RegisterController@loginpage');
Route::post('/auth/login', 'RegisterController@login');

//logout
Route::get('/logout', 'RegisterController@logout');





// URL::forceScheme('https');
