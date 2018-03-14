<!DOCTYPE html>
<html lang="en">
<head>
  <title>Tutorials,Discussions,Chats-All In One</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <link rel ="stylesheet" href="public/css/style.css">
</head>
<body>

<nav class="navbar navbar-expand-md bg-dark navbar-dark">
  <a class="navbar-brand" href="#">Messer</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="tutorials.php">Tutorials</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="profile.php">Profile</a>
      </li>
    </ul>
    <?php
    require_once "core/init.php";
    if(Session::check()){
     ?>
     <ul class="navbar-nav">
       <li class="nav-item">
       <a class="nav-link" href="logout.php">Logout</a>
     </li>
   </ul>
   <?php } else{?>
     <ul class="navbar-nav">
      <li class="nav-item">
       <a class="nav-link" href="login.php">Login</a>
     </li></ul>
   <?php } ?>
  </div>
</nav>
<br/>
