<?php

    namespace App\Controllers;


    use MF\Controller\Action;
    use App\Models\IndexModel;
    use Dotenv\Dotenv;
    use Firebase\JWT\JWT;
    use Firebase\JWT\Key;
    class IndexController extends Action{

        private function disableCaptcha(){
            
            $hasRecaptchaField = isset($_POST['_recaptcha']);
            if($hasRecaptchaField){
                $recaptcha = (bool) $_POST['_recaptcha'];

                if($recaptcha == false){
                    return false;
                }
                return true;
            }
            return false;
        }
        public function Index(){
            $this -> render('index');
        }
        public function renderThanks(){
            $this -> render("thanks");
        }
        public function confirmedForm(){
            $this -> render("confirmedForm");
        }
    
        private function hasAValidTarget($target){
 
            if(is_null($target) || $target === '') {
                return false;
            }
            // email regex
            $pattern = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
            if(!preg_match($pattern, $target)){
                header("location: /error-regex");
               return false;
            }
            return true;
        }
        private function saveFieldsAndValues(){
            $data = [];

            foreach($_POST as $field => $value){
                $data[] = [$field => $value];
            }


            $_SESSION['form_submitter_data'] = $data;

        }
        private function saveFormSourceAddress(){
            $address = $_SERVER['HTTP_HOST'];

            $_SESSION['form_source_address'] = $address;

        }
        public function Submit(){
               
            $target = $_GET['target'];

            $this -> saveFormSourceAddress();
            $targetIsValid = $this -> hasAValidTarget($target);
            // check if the e-mail is valid
            if($targetIsValid){
               
                $indexModel = new IndexModel;

                $formStatusIsActive = $this -> formIsActive($target);

                if($formStatusIsActive){
                
                    $this -> saveFieldsAndValues();
                $disableRecaptcha = $this -> disableCaptcha();
                   
               
                if($disableRecaptcha){
                    $indexModel -> formSubmit($target);
                    exit;
                }
               
                $_SESSION['form_submitter_target'] = $target;
                $this -> recaptcha();

                }

                if(!$formStatusIsActive){
                    $indexModel -> sendConfirmationMail($target);
                    $indexModel -> registerForm($target);
                    exit;
                }

            }
           

        }
        public function activateForm(){
            $dotenv_path = dirname(__DIR__);
            $dotenv = Dotenv::createImmutable($dotenv_path);
            $dotenv ->load();
            if(isset($_GET['token'])){
                $token = $_GET['token'];
                $jwt_secret = $_ENV['JWT_SECRET'];
                $decodedToken =  JWT::decode($token, new Key($jwt_secret, 'HS256'));

                $email = $decodedToken -> email;
                $exp = $decodedToken -> exp;
                $currentTimestamp = time();
                if($exp > $currentTimestamp){

                    $indexModel = new IndexModel;

                    $indexModel -> activateForm($email);

                }
                else{
                    echo "Token inválido ou expirado!";
                }

            }
        }
        public function formIsActive($email){
            $indexModel = new IndexModel;
            $isActive = $indexModel -> checkFormStatus($email);
            return $isActive;
        }

        public function mailSent(){
            $this -> render("mailSent");
        }
        public function recaptcha(){

            $this -> render("recaptcha");
        }
        public function debug(){
            $this -> render("debug");
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
                    $isCorrect = $responseData['success'];


                    if($isCorrect == 1){
                        echo "Captcha resolvido";
                        echo "</hr>";
                        print_r($_SESSION['form_submitter_data']);
                        $email = $_SESSION['form_submitter_target'];
                        $indexModel = new IndexModel;
                        $indexModel -> formSubmit($email);
                        exit;
                    }
                   echo "Catpcha não resolvido";
                } else {
                    echo 'Erro ao decodificar a resposta JSON do reCAPTCHA';
                }
            }
        }
    }