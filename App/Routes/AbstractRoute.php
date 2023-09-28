<?php

    namespace App\Routes;

    use MF\Init\Bootstrap;

    abstract class AbstractRoute{
        function __construct(){
            $this -> setRoutes();
        }

        public function setRoutes(){}
        public function getRoutes(){}
    }