<?php
//PHPMailer/test_send_mail.php
//Tets chuc nang gui mail su dung thu vien PHpMailer
//Thuc te neu muon gui mail, nen dung cac thu vien ben ngoai,thay vi dung ham mail() cua php.Vi viec mail phu thuoc vao nhieu yeu to khac nhau nhu cau hinh...
?>
<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//comment lai doan nay, vi doan nay dung cho framework
// Load Composer's autoloader
//require 'vendor/autoload.php';

//nhung 3 file sau day
require_once 'src/Exception.php';
require_once 'src/PHPMailer.php';
require_once 'src/SMTP.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //them dong sau de hien thi dc ky tu co dau
    $mail->CharSet = 'UTF-8';
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    //su dung server mail de gui mail
    $mail->Host = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth = true;                                   // Enable SMTP authentication
    //nhap tai khoan gmail cho username
    $mail->Username = 'vanthanh23799@gmail.com';                     // SMTP username
    //password kp la pass gmail cua cac ban,ma gmail co 1 co che tao pw c ho cac ung dung,pw nay se doc lap voi pass gmail cua ban
    $mail->Password = 'kueikgbmvnepnetu';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    //gui tu ai
    $mail->setFrom('abc@gmail.com', 'Gui tu Thanh');
    //gui toi ai
    $mail->addAddress('vanthanh23799@gmail.com');               // Name is optional

    $mail->addReplyTo('info@example.com', 'Information');
    $mail->addCC('cc@example.com');
    $mail->addBCC('bcc@example.com');

    // Attachments
    $mail->addAttachment('image.png');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Tieu de gui mail';
    $mail->Body = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

