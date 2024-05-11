<?php

        //get Base url
        if (!function_exists('getBaseURL')) {
            function getBaseURL($url = '')
            {
                if ($url == '') {
                    return BASE_URL;
                } else {
                    return BASE_URL . $url;
                }
            }
        }

        // Get Row Data  : Json 
        if(!function_exists('getRawData')){
            function getRawData($typeArray= true){
                $JSonObject=file_get_contents("php://input");
                if($typeArray){
                    $formData=json_decode($JSonObject,$typeArray);
                    return $formData;
                }else{
                    $formData=json_decode($JSonObject,$typeArray);
                    return $formData;
                }
            }
        }

