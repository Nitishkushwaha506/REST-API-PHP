<?php
define('TABLE_NAME', 'student');

//function createstudent : POST
if (!function_exists('studentPost')) {
    function studentPost()
    {
        $fillable = ['name', 'email', 'password', 'mobile', 'dept', 'salary'];
        $optional = [];
        $headers = ['Content-Type' => 'application/json', 'hasToken' => false];
        $response = ['json'];


    }
}

//function selectstudent : GET
if (!function_exists('studentGet')) {
    function studentGet()
    {
        
        $headers = ['Content-Type' => 'application/json', 'hasToken' => false];
        $response = ['json'];
      

    }
}


//function studentPut : PUT
if (!function_exists('studentPut')) {
    function studentPut()
    {
        $fillable = ['name', 'email', 'mobile', 'dept', 'salary'];
        $headers = ['Content-Type' => 'application/json', 'hasToken' => false];
        $response = ['json'];

    }
}

//function studentDelete : DELETE
if (!function_exists('studentDelete')) {
    function studentDelete()
    {

        $headers = ['Content-Type' => 'application/json', 'hasToken' => false];
        $response = ['json'];

    }
}




?>