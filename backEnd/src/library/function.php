<?php
include_once "database.php";
require_once __DIR__ . '/../../vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
function check($data){
    $data = htmlspecialchars($data);
    $data = strip_tags($data);
    return $data;
}

function dbExec($sql, $param_array){
    $database = new Database();
    $database->getConnection();
    $myCon = $database->conn;
    $stmt = $myCon->prepare($sql);
    $stmt->execute($param_array);
    return $stmt;
}

function sendVerificationEmail($name,$email,$verification_code){
    $mail = new PHPMailer(true);
    try{
        $mail->isSMTP();
        $mail->Host = "sandbox.smtp.mailtrap.io";
        $mail->Port = 2525;
        $mail->Username = "bf7b47daa779a7";
        $mail->Password = "1a0f41a606596c";
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        //===
        $mail->setFrom("m.algamei2025@gmail.com","Algamei");
        $mail->addAddress($email,$name);
        $mail->isHTML(true);
        $mail->CharSet = "UTF-8";
        $mail->Subject = "تحقق من بريدك الالكتروني";
        $template = file_get_contents(__DIR__ .'/../Verify/verfiy.html');
        $mail->Body = str_replace('{variable}',$verification_code,$template);
        $mail->send();

    }catch(Exception $exp){
        echo "error ".$mail->ErrorInfo;
    }
}

function newToken($email,$token){
    $new_token = md5($email . $token . time());
    return $new_token;
}
?>