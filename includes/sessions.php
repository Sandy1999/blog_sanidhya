<?php
  if(!isset($_SESSION)){
      session_start();
  }// this will start session if not set in the script 
  // We are going to create a function in order to print session message 
  function msg_session(){
      if(isset($_SESSION['message'])){
          echo $_SESSION['message'];
          $_SESSION['message'] = null;
      }else return null;
  }// msg session function ends here
  function submit_errors(){
      if(isset($_SESSION['errors'])){
          $errors =  $_SESSION['errors'];
          $_SESSION['errors'] = null;
          return $errors;
      }else return null;
  }
  ?>