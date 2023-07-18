<?php

namespace App\Controllers;

class SessionShell
{
    public function __construct(){
        if(!isset($_SESSION)){
            session_start();
        }
    }

    public function set(string $name, $value){
        $_SESSION[$name] = $value;
    }

    public function get(string $name){
        return $_SESSION[$name];
    }
    public function getAll(){
        var_dump($_SESSION);
    }
    public function del(string $name) {
        unset($_SESSION[$name]);
    }

    public function check(string $name){
        var_dump(isset($_SESSION[$name]));
    }

    public function destroy(){
        session_destroy();
    }
}