<?php


namespace App\Http\Libraries\Authentication;


use App\Http\Functions\BladeEngine;
use App\Http\Models\User;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class Auth
{

    public static $id;
    public static $ValidateEmail;
    public static $errmessage;
    public static $ResetApproved;
    public static $redirect;
    protected static $withuser;
    protected static $withemail;
    protected static $withpassword;
    protected static $username;

//Get post requests
    protected static $email;
    protected static $password;
    protected $remmeber;


    public static function id()
    {
        if (isset($_COOKIE['id']))
        {
            return $_COOKIE['id'];
        }
        elseif(isset($_SESSION['id']))
        {
            return $_SESSION['id'];
        }
        else{
            return self::$id;
        }
}

    public static function Auth()
    {
//    Set all the values to
        self::$withuser = false;
        self::$withemail = false;
        self::$withpassword = false;
        return new static();
    }

    public static function getusername()
{
   $user = User::find(self::Auth()::id());
   return $user->username;
}



    public function SendEmail($email, $name, $subject, $page, $array)
    {
//        Must have page and name otherwise nothing
        if (!empty($page) || !empty($array)) {
            $mail = new PHPMailer(true);

            try {
                //Server settings
                $mail->SMTPDebug = SMTP::DEBUG_OFF;         //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host = $_ENV['SMTP_HOST'];                     //Set the SMTP server to send through
                $mail->SMTPAuth = true;                                   //Enable SMTP authentication
                $mail->Username = $_ENV['SMTP_USERNAME'];                     //SMTP username
                $mail->Password = $_ENV['SMTP_PASSWORD'];                               //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                $mail->Port = $_ENV['SMTP_PORT'];                             //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

                //Recipients
                $mail->setFrom('No-reply@skallywagsmcc.club', "no Reply");
                $mail->addAddress($email, $name);     //Add a recipient

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = $subject;
                $mail->Body = BladeEngine::View($page, $array);

                $mail->send();
                echo 'Message has been sent';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }
    }
    public function WithUser($username)
    {
        self::$withuser = true;
        self::$username = $username;
        return $this;
    }
//    end registration script

//    Login section

    public function WithEmail($email)
    {
        self::$withemail = true;
        self::$email = $email;
        return $this;
    }

    public function WithPassword($password)
    {
        self::$withpassword = true;
        self::$password = password_hash($password, PASSWORD_DEFAULT);
        return $this;
    }

    public function Redirect($value)
    {
        if(self::$redirect == true)
        {
            header("location:$value");
        }
    }
}