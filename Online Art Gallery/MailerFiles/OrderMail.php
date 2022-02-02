<?php
namespace OrderMail\sent;

require 'autoload.php';
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class OrderMail
{
    private $email_id;
    private $otp;
    public  $gmailusername='mitalibharambe4434@gmail.com';//Enter Mail ID
    public  $gmailpassword='mit@00#ali_16';//Enter Password

   public function sentMail($email_id,$subject,$body)
    {
        
        $this->$email_id = $email_id;
        $header = "From:".$this->gmailusername."\r\n"; 
        $header .= "CC: ".$this->gmailusername."\r\n"; 
        $header .= "Content-Type: text/html; charset=ISO-8859-1\r\n"; 
        $mail = new PHPMailer(true);
        $mail->SMTPDebug = 0;                                       
        $mail->isSMTP();                                            
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;    
        $mail->SMTPAuth   = true;                             
        $mail->Username   = $this->gmailusername;                 
        $mail->Password   = $this->gmailpassword;                        
        $mail->SMTPSecure = 'tls';                              
		
        $mail->addAddress($this->$email_id);
            
        $mail->isHTML(true);                                  
        $mail->Subject = $subject;
        $mail->Header = $header;
		$mail->Body = $body;
		$mail->AltBody = strip_tags($body);
		$return = $mail->send();
		return $return;
    }
}
