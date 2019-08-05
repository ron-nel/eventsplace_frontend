<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">

  <link href="https://fonts.googleapis.com/css?family=Lalezar|Monoton|Passion+One|Squada+One&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Carter+One|Playball&display=swap" rel="stylesheet">

  <title>@yield('title')</title>

  <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>
<body>
  <div class="">
    <nav class="navbar navbar-expand-lg navbar-light content-holder navBar">
      <a class="navbar-brand px-3 logo rounded" href="#"><img src="{{asset('images/pageImages/sitelogo.png')}}" alt="" class="site-logo"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link" href="/">Home<span class="sr-only">(current)</span></a>
          </li>
          
          
          
        </ul>
        <ul class="navbar-nav ml-auto">

      @if(Session()->has('user'))
        <li class="nav-item">
          <a class="nav-link" href="#">Welcome, {{Session::get('user')->name}}!</a>
        </li>
        @if(Session('user')->role == 1)
        <li class="nav-item">
            <a class="nav-link" href="/admin/showAllRooms">All Rooms</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/admin/addRoomForm">Add Room</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/admin/showAllReservations">Reservations</a>
        </li>
        @else
        <li class="nav-item">
            <a class="nav-link" href="/showMyReservations">My Reservations</a>
        </li>
        @endif
        <li class="nav-item">
          <a class="nav-link" href="/logout">Logout</a>
        </li>
      @else
        <li class="nav-item">
          <a class="nav-link" href="/auth/loginpage">Login</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="/auth/register">Register<span class="sr-only">(current)</span></a>
        </li>
      @endif
      
    </ul>
      </div>
    </nav>
  </div>
  <main>
    @if(count($errors)>0)
    @foreach($errors->all() as $error)
    <strong><p class="error text-center">{{$error}}</p></strong>
    @endforeach
    @endif

    @if(Session::has("message"))
    <strong><p class="message text-center">{{Session::get("message")}}</p></strong>
    @endif
    
  @yield('content')
  </main>
  <footer class=" d-flex justify-content-center align-items-center align-content-center content-holder footer">
    <p>Copyright 2019</p>
  </footer>

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>