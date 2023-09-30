<?php
    namespace App\Models;

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\PHPMailer_exception;
    use Dotenv\Dotenv;
    use App\Connection;
    use \PDO;
    use \PDOException;
    use Firebase\JWT\JWT;


    class IndexModel{
       private $mail;
       private $connection;
        public function __construct(){
            $conn = new Connection;
            
            $this -> InitMailerConfig();
            $this -> connection = $conn -> getDatabase();
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
            $mail -> setFrom($_ENV['SMTP_EMAIL'], $_ENV['SMTP_USERNAME']);

            // content 

            $mail -> isHTML(true);
            
            $this -> mail = $mail;

            }
            catch(PHPMailer_exception $exception){
                echo 'an  error has ocurred';
            }
        }
        public function showCaptcha(){
          include_once "../App/Views/index/recaptcha.php";
        }
        private function genConfirmationEmailToken($email){
            define("ONE_DAY_IN_SECONDS", 86.400);
            $jwt_secret = $_ENV['JWT_SECRET'];
            $payload = [
                "email" => $email ,
                "exp" => ONE_DAY_IN_SECONDS
            ];
            $token = JWT::encode($payload, $jwt_secret, 'HS256');
            return $token;
        }
        public function sendConfirmationMail($email){

           try{
            $mail = $this -> mail;
           $mail -> Subject = "Ativação de formulário";

          
          $confirmation_token  = $this -> genConfirmationEmailToken($email);
          $domain = $_ENV['DOMAIN'];
          $confirmation_link = $domain . '/confirmation-email&token=' . $confirmation_token;
          ob_start();
          include_once "confirmationEmail.php";
         $html = ob_get_clean();
       
         $mail -> addAddress($email);
         $mail -> Body = $html;
         $mail -> send();
            header("Location: /mail-sent");
           }
           catch(PHPMailer_exception $error){
            echo "ocorreu um erro no envio do e-mail de confirmação, tente novamente mais tarde";
           }
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

            $formIsActive = $this -> checkFormStatus($target);

            if(!$formIsActive){
                $this -> sendConfirmationMail($target);
                exit;
            }
            $mail = $this -> mail;
            $mail -> Subject = "Novo envio de formulário";
            $mail -> addAddress($target);
            
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

        private function checkFormStatus($email){

           try{
            $query = '
            SELECT active FROM forms where email = :email
            ';

            $statement = $this -> connection -> prepare($query);

            $statement -> bindParam(":email", $email);

            $statement -> execute();

            $status =  $statement -> fetch(PDO::FETCH_ASSOC);

            if($status){
                return true;
            }
            return false;
           }
           catch(PDOException){
            echo "Ocorreu um erro em nosso servidor, tente novamente mais tarde.";
           }

        
        }
    }