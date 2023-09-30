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
            $routes['reCaptcha'] = [
                'route' => '/recaptcha',
                'controller' => 'indexController',
                'action' => 'validateRecaptcha'
            ];
            $routes['formSubmit'] = [
                'route' => '/submit',
                'controller' => 'indexController',
                'action' => 'submit'
            ];
            $routes['mailSent'] = [
                'route' => '/mail-sent',
                'controller' => 'indexController',
                'action' => 'mailSent'
            ];

            $this -> routes = $routes;
        }

        public function getRoutes(){
            return $this -> routes;
        }
    }