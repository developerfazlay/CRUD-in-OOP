<?php

  require 'commonCrudController.php';

  $crudObj =  new CommonCrudController;

  
  $formData = [];
 
  $formData = [
    'name'       => "Fazlay Rabbi",
    'email'      => "fazlayam@gmail.com",
    'password'   => "FR160500",
  ];

   // $crudObj-> create("users", $formData);
  // print_r($crudObj->resultDisplay()) ;

  // $crudObj -> update("users", $formData, "email='fazlayam@gmail.com'");
  // print_r($crudObj->resultDisplay()) ;

  //  $crudObj-> delete("users", 1);
  // print_r($crudObj->resultDisplay()) ;

 $crudObj-> select("users",  " name, email") ;
 echo "<pre>";
 print_r($crudObj->resultDisplay()) ;
 echo "<pre>";


 

  