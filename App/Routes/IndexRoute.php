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
            $routes['reCaptchaView'] = [
                'route' => '/recaptcha-challenge',
                'controller' => 'indexController',
                'action' => 'recaptcha'
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
            $routes['confirmMail'] = [
                'route' => '/confirm-email',
                'controller' => 'indexController',
                'action' => 'activateForm'
            ];
            $routes['debug'] = [
                'route' => '/debug',
                'controller' => 'indexController',
                'action' => 'debug'
            ];


            $this -> routes = $routes;
        }

        public function getRoutes(){
            return $this -> routes;
        }
    }