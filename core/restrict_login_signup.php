<?php
require_once "init.php";
if(Session::check()||Cookie::check()){
  Redirect::to('profile');
}
 ?>
