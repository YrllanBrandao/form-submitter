<?php

    namespace App\Controllers;


    use MF\Controller\Action;
    use App\Models\IndexModel;
    use Dotenv\Dotenv;
    class IndexController extends Action{
        public function Index(){
            $this -> render('index');
        }
        public function Submit(){
            $indexModel = new IndexModel;

            $indexModel -> formSubmit();

        }

        public function mailSent(){
            $this -> render("mailSent");
        }
        public function recaptcha(){
            
            $this -> render("recaptcha");
        }
        public function validateRecaptcha(){

            $dotenv_path = dirname(__DIR__);
            $dotenv = Dotenv::createImmutable($dotenv_path);
            $dotenv ->load();


            if($_POST){
                $response_token  = $_POST['g-recaptcha-response'];
                $captcha_verify_url = 'https://www.google.com/recaptcha/api/siteverify';
                $server_token = $_ENV['RECAPTCHA_SERVER_TOKEN'];

                $curl = curl_init();
                curl_setopt_array($curl, [
                    CURLOPT_URL => $captcha_verify_url,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => [
                        'secret' => $server_token,
                        'response' => $response_token ?? ''
                    ]
                ]);
                
                // request execute
                $response = curl_exec($curl);
                
                curl_close($curl);

                $responseData = json_decode($response, true);

                if ($responseData && isset($responseData['success'])) {
                    $isValid = $responseData['success'];
                    print_r($responseData);
                    if (!$isValid) {
                        echo 'recaptcha inválido';
                    } else {
                        echo 'recaptcha válido, prosseguindo com o envio';
                    }
                } else {
                    echo 'Erro ao decodificar a resposta JSON do reCAPTCHA';
                }
            }
        }
    }