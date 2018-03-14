<?php
require_once "init.php";
if(!Session::check() && !Cookie::check())
{
  Redirect::to('login');
}
else if(!Session::check() && Cookie::check())
{
  Cookie::destroy();
  Redirect::to('login');
}
?>
