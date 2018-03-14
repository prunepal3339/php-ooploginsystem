<?php
class Redirect{
  public static function to($loc){
    header("location:".$loc.".php");
    exit();
  }
}
 ?>
