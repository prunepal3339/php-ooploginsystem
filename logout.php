<?php
require_once "core/init.php";
require "core/restrict_access.php";
Session::destroy('user');
Cookie::destroy('user_hash');
Redirect::to('index');
?>
