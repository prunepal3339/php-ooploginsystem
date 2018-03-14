<?php
session_start();
class Session{
  public static function set($sess_name,$content){
    $_SESSION[$sess_name] = $content;
  }
  public static function get($sess_name){
    if(!self::isEmpty($sess_name)){
      return $_SESSION[$sess_name];
    }
  }
  public static function isset($sess_name){
    return isset($_SESSION[$sess_name])?True:False;
  }
  public static function check(){
    if(self::isset('user')){
      return empty($_SESSION['user'])?False:True;
    }
  }
  public static function destroy($data){
    if(self::isset($data)){
      session_destroy();
    }
  }
  public static function isEmpty($data){
    return empty($_SESSION[$data])?True:False;
  }
}
 ?>
