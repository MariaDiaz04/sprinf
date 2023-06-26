<?php
namespace App\request;

 class Request {

    public static function Object(array $array) {
        return json_decode(json_encode($array));
    }

}
