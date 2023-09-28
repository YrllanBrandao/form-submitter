<?php

    namespace App\Controllers;


    use MF\Controller\Action;
    use App\Models\IndexModel;

    class IndexController extends Action{
        public function Index(){
            $this -> render('index');
        }
        public function Submit(){
            $indexModel = new IndexModel;

            $indexModel -> formSubmit();

        }
    }