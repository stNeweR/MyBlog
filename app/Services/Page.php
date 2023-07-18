<?php

namespace App\Services;

class Page
{
    public static function part($fileName){
        require_once 'views/components/' . $fileName . '.php';
    }
}