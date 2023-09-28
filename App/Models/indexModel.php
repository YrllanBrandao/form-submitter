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
                $dotenv = Dotenv::create_immutable(__DIR__);
            $dotenv -> load();

            $mail = new PHPMailer(true);
            $mail -> isSMTP();
            $mail -> Host = $_ENV['SMTP_HOST'];
            $mail -> SMTPAuth = true;
            $mail -> Username = $_ENV['SMTP_EMAIL'];
            $mail -> Password = $_ENV['SMTP_PASSWORD'];
            $mail -> SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail -> Port = $_ENV['SMTP_PORT'];
            $this -> mail = $mail;

            }
            catch(PHPMailer_exception $exception){
                echo 'an  error has ocurred';
            }
        }
        public function formSubmit(){

            $mail = $this -> mail;

            $mail -> setFrom($_ENV['SMTP_EMAIL'], $_ENV['SMTP_USERNAME']);
            $mail -> addAddress('yrllanflamengp@gmail.com');

            // content 

            $mail -> isHTML(true);
            $mail -> Subject = "Nova submissão de formulário";
            
            $structure = [];

            ob_start();
            include_once('./emailTemplate.php');
           $html = ob_get_clean();

           $mail -> Body =  $html;
        }
    }