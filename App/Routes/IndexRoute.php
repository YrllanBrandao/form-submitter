<?php

    namespace App\Routes;

    use App\Routes\AbstractRoute;

    class IndexRoute extends AbstractRoute{

        public function setRoutes(){
            $routes['index'] = [
                'route' => '/',
                'controller' => 'indexController',
                'action' => 'index'
            ];
            $routes['formSubmit'] = [
                'route' => '/submit',
                'controller' => 'indexController',
                'action' => 'submit'
            ];

            $this -> routes = $routes;
        }

        public function getRoutes(){
            return $this -> routes;
        }
    }