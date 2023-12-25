<?php

if(! function_exists('arr_result')) {
    function arr_result($message = null, $success = false, $data = []){
        return ['message' => $message, 'success' => $success, 'data' => $data];
    }
}
