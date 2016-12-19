<?php
  class UserFactory extends AbstractFactory{
    function __construct(){
    }
    public function newUser($db){
      return new User($db);
    }
  }
?>