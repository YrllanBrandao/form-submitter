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

            $jwt_secret = $_ENV['JWT_SECRET'];
            $payload = [
                "email" => $email ,
                "exp" => time() + 60 * 60 * 24 * 10,
                "nbf" => time()
            ];
            $token = JWT::encode($payload, $jwt_secret, 'HS256');
            return $token;
        }
        public function activateForm($email){
           try{
            $query = '
            UPDATE forms SET active=true WHERE email = :email
            ';
            $statement = $this -> connection -> prepare($query);

            $statement  -> bindParam(":email", $email);
            $statement -> execute();

            echo "O formulário vinculado ao e-mail {$email} está ativo"; 
           }
           catch(PDOException $error){
            echo 'falha ao ativar formulário, tente novamente mais tarde!';
           }


        }
        public function sendConfirmationMail($email){

           try{
            $mail = $this -> mail;
           $mail -> Subject = "Ativação de formulário";

          
          $confirmation_token  = $this -> genConfirmationEmailToken($email);
          $domain = $_ENV['DOMAIN'];
          $confirmation_link = $domain . '/confirm-email?token=' . $confirmation_token;
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
        public function registerForm($email){
           try{
            $query ='
            INSERT INTO forms(email) VALUES (:email)
            ';

            $statement = $this -> connection -> prepare($query);

           $statement-> bindParam(":email", $email);
            $statement -> execute();

            ?>  
          

            <?php
           }
           catch(PDOException $error){
            echo 'Ocorreu um erro no registro do e-mail de ativação, tente novamente mais tarde';
           }

        }
        public function formSubmit($target){

           try{

    
            $mail = $this -> mail;
            $mail -> Subject = "Novo envio de formulário";
            $mail -> addAddress($target);
        
            // capture the field values and template
            ob_start();
            include_once('emailTemplate.php');
           $html = ob_get_clean();

           $mail -> Body =  $html;
           $mail -> send();
            header("Location: /thanks");
           }
           catch(PHPMailer_exception $exception){
            echo 'um erro, tente novamente mais tarde';
           }

        }

        public function checkFormStatus($email){

           try{
            $query = '
            SELECT active FROM forms where email = :email
            ';

            $statement = $this -> connection -> prepare($query);

            $statement -> bindParam(":email", $email);

            $statement -> execute();

            $status =  $statement -> fetch(PDO::FETCH_ASSOC);

            if($status['active']){
                return true;
            }
            return false;
           }
           catch(PDOException){
            echo "Ocorreu um erro em nosso servidor, tente novamente mais tarde.";
           }

        
        }
    }