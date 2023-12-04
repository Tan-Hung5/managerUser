<?php
(!defined('_CODE'))? die('Truy cap khong hop le'):false;

require_once('functions.php');
require_once('phpmailer/SMTP.php');
require_once 'phpmailer/bodymail.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


class MyMailer {
    private $mail;

    public function __construct() {
        // Tạo một đối tượng PHPMailer
        $this->mail = new PHPMailer(true); // Pass true để bật chế độ lỗi chi tiết
    }

    private function setSMTPConfig() {
        $this->mail->isHTML(true);
        $this->mail->isSMTP();
        $this->mail->Host = 'smtp.gmail.com';
        $this->mail->SMTPAuth = true;
        $this->mail->Username = 'siwkp15@gmail.com';
        $this->mail->Password = 'loza kkae tijh pqds';
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $this->mail->Port = 465; // Hoặc 465 nếu sử
        $this->mail->setFrom('siwkp15@gmail.com', 'UserManagers');
        $this->mail->Subject = 'Authentify Code';
        
    }

    
    private function addRecipient($email) {
        // Thêm người nhận
        $this->mail->addAddress($email);
    }


    private function setBody($code) {
        $body = bodyMail($code);
        $this->mail->Body = $body; 
    }

    private function send() {
        try {
            // Gửi email
            $this->mail->send();
        } catch (Exception $e) {
            
        }

    }

    public function sendActiveCode($code,$email){
        $this->setSMTPConfig();
        $this->setBody($code);
        $this->addRecipient($email);
        $this->send();
    }
}

?>