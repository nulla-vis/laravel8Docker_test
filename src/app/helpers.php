<?php

if (!function_exists('success_response')) {
    function success_response ($data) {
        return [
            "status" => "success",
            "data" => $data
        ];
    }
}

if (!function_exists('error_response')) {
    function error_response ($errMsg) {
        return [
            "status" => "error",
            "error_message" => $errMsg,
            "data" => null
        ];
    }
}