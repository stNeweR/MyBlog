<?php

namespace App\Services;

use App\Controllers\Auth;

class Router
{
    private static $list = [];

    public static function addPage($uri, $page){
        self::$list[] = [
            "uri" => $uri,
            "page" => $page
        ];
    }

    public static function action($uri, $class, $method){
        self::$list[] = [
            "uri" => $uri,
            "class" => $class,
            "method" => $method,
            "post" => true
        ];
    }

    public static function enable(){
        $uri = $_SERVER['REQUEST_URI'];
        foreach (self::$list as $route){
            if($route['uri'] === $uri){
                if ( isset($route['post'])){
                    $action = new $route['class'];
                    $method = $route['method'];
                    $action->$method(); 
                    die();
                } else {
                    require_once("views/pages/" . $route['page'] . '.php');
                    die();    
                }
            }
        }
        self::errorPage();
    }

    private static function errorPage(){
        require_once 'views/Error/error.php';
    }

    public static function redirect($page){
        require_once 'views/pages/' . $page . '.php';
    }
}