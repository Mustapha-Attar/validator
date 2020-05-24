<?php
session_start();
require_once 'validator.php';
use rules\validator;
if(isset($_POST['reg'])):
    $validator = new validator($_POST);
    $validator->validate([
        "email" => ['required', 'email', 'max: 50'],
        "phoneNumber" => ['required', 'digits', 'max: 11', 'min: 6'],
        "username" => ['required', 'username', 'min: 2', 'max: 50'],
        "dob" => ['required', 'date'],
        "gender" => ['required', 'letter: m|f'],
        "link" => ['link']
    ]);
    if($validator->failed){
        $validator->dataToSession();
        header("Location: /index.php");
        exit;
    }else{
        echo 'passed';
    }
endif;