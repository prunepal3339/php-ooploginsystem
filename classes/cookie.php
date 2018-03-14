<?php
class Cookie{
  public static function set($cookie_name,$content,$expiry=86400*30){
    setcookie($cookie_name,$content,$expiry);
  }
  public static function isset($cookie_name){
      return isset($_COOKIE[$cookie_name])?True:False;
  }
  public static function check(){
    if(self::isset('user_hash')){
      return empty($_COOKIE['user_hash'])?False:True;
    }
  }
  public static function destroy($data){
    if(self::isset($data)){
      setcookie($data,"",time()-8000);
    }
  }
}
