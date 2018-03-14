<?php
 require_once "core/init.php";
 $user = new User();
 if($user->isLoggedIn()){
  Redirect::to("profile");
 }
 else{
  Redirect::to("tutorials");
 }
