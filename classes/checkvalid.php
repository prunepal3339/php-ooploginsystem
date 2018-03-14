<?php
class CheckValid{
  public function __construct(){
  }
  public function emptyCheck($data){
    if(isset($data)){
      if(empty(trim($data))){
        return True;
      }
   }
  }
  public function match($one,$two){
    return $one===$two;
  }
  public function userSatisfiedF($data){

    return (strlen($data)<4)?True:False;
  }
  public function passSatisfiedF($data){
    return (strlen($data)<8)?True:False;
  }
}
