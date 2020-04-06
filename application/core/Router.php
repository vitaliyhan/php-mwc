<?php

namespace application\core;

class Router
{
    protected $routes = [];
    protected $params = [];

    function __construct()
    {
        $arr = require 'application/config/routes.php';
        var_dump($arr);
        foreach ($arr as $key => $val) {

            $this->add($key, $val);
        }
    }

    public function add($route, $params)
    {
        $route = '#^'.$route.'$#';
        $this->routes[$route] = $params;
    }

    public function match()
    {
        $url='';
        var_dump($_SERVER['REQUEST_URI']);
        $url = trim($_SERVER['REQUEST_URI'], '/');

        var_dump($url);
        foreach ($this->routes as $route => $params) {
            echo ('route'.$route.'params');
            if (preg_match($route, $url, $matches)) {
                echo ('yes');
               $this->params=$params;
                var_dump($params);
                return true;
            } else {
                echo 'no';
                return false;
            }
        }
    }

    public function run()
    {
        if ($this->match()){
            $controller='application\controllers\\'.ucfirst($this->params['controller']).'Controller.php';
            echo $controller;
            echo ("Маршрут найден");
        } else {
            echo ("Маршрут не
            найден");
        };
    }


}