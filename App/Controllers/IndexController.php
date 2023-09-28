<?php

    namespace App\Controllers;


    use MF\Controller\Action;


    class IndexController extends Action{
        public function Index(){
            $this -> render('index');
        }
    }