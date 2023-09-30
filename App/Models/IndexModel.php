<?php
    namespace App\Models;

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\PHPMailer_exception;
    use Dotenv\Dotenv;
    
    class IndexModel{
       private $mail;
        public function __construct(){
            $this -> InitMailerConfig();
        }

        public function InitMailerConfig(){
            try{
                $dotenv_path = dirname(__DIR__);
                $dotenv = Dotenv::createImmutable($dotenv_path);
            $dotenv -> load();

            $mail = new PHPMailer(true);
            $mail->CharSet = 'UTF-8';
            $mail -> isSMTP();
            $mail -> Host = $_ENV['SMTP_HOST'];
            $mail -> SMTPAuth = true;
            $mail -> Username = $_ENV['SMTP_EMAIL'];
            $mail -> Password = $_ENV['SMTP_PASSWORD'];
            // $mail -> SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail -> Port = $_ENV['SMTP_PORT'];
            $this -> mail = $mail;

            }
            catch(PHPMailer_exception $exception){
                echo 'an  error has ocurred';
            }
        }
        public function showCaptcha(){
          include_once "../App/Views/index/recaptcha.php";
        }
        public function formSubmit(){

           try{

            
            $target = $_GET['target'];

            if(is_null($target) || $target === '') {
                header("location: /error");
                exit();
            }
            // email regex
            $pattern = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';

            if(!preg_match($pattern, $target)){
                header("location: /error-regex");
                exit();
            }
            $mail = $this -> mail;

            $mail -> setFrom($_ENV['SMTP_EMAIL'], $_ENV['SMTP_USERNAME']);
            $mail -> addAddress($target);

            // content 

            $mail -> isHTML(true);
            $mail -> Subject = "Novo envio de formulário";
            
            $structure = [];


            // capture the field values and template
            ob_start();
            include_once('emailTemplate.php');
           $html = ob_get_clean();

           $mail -> Body =  $html;
           $mail -> send();
        echo  'enviado';
           }
           catch(PHPMailer_exception $exception){
            echo 'um erro, tente novamente mais tarde';
           }

        }
    }