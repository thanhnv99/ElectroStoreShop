<?php

require_once 'controllers/Controller.php';
require_once 'models/Order.php';
require_once 'models/OrderDetail.php';
//nhung cac file lien quan den thu vien PHPmailer de gui mail
require_once 'configs/PHPMailer/src/PHPMailer.php';
require_once 'configs/PHPMailer/src/SMTP.php';
require_once 'configs/PHPMailer/src/Exception.php';

//use ~ require_once
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class PaymentController extends Controller
{
    public function index()
    {
        //xu ly submit form khi user click thanh toan
        //debug thong tin mang $_POST
//        echo "<pre>";
//        print_r($_POST);
//        echo "</pre>";

        //neu user click nut thanh toan/submit form thi moi xu ly form
        if (isset($_POST['submit'])) {
            //gan bien trung gian
            $fullname = $_POST['fullname'];
            $address = $_POST['address'];
            $mobile = $_POST['mobile'];
            $email = $_POST['email'];
            $note = $_POST['note'];
            // phuong thuc thanh toan neu bang - thi thanh toan truc tuyen/ =1 thi thanh toan COOD
            $method = $_POST['method'];
            //check validate: fullname, addtess, mobile khong dc de trong
            if (empty($fullname) || empty($address) || empty($mobile)) {
                $this->error = "fullname, address va mobile khong dc de trong";
            }
            //chi xu ly logic submit form khi khong co loi xay ra
            if (empty($this->error)) {
                //khong quan tam den hinh thuc dang la truc tuyen hay COD ma se luu don hang luon
                $order_model = new Order();
                $order_model->fullname = $fullname;
                $order_model->address = $address;
                $order_model->mobile = $mobile;
                $order_model->note = $note;
                $order_model->email = $email;

                //tinh tong gia tri don hang cho truowng price_total
                //trong bang orders
                $price_total = 0;
                //lap gio hang, cong don bien $price_total nay voi gia thanh tien cua cac san pham tuong ung trong gio

                foreach ($_SESSION['cart'] as $cart) {
                    $price_item = $cart['price'] * $cart['quality'];
                    $price_total += $price_item;
                }
                $order_model->price_total = $price_total;
                //trang thai thanh toan don hang, mac dinh ban dau trang thai la chua thanh toan, truong payment_status trong bang order dang co kieu du lieu la TINYINT
                $order_model->payment_status = 0;
                //thuc te se co bo phan sales se quan ly cac don hang, lien he voi user da dat hang, sau do khi nhan dc tien tu KH thi se cap nhat lai truong oayment_status nay thanh da thanh toan


                $order_id = $order_model->insert();
                //neu order_id >0 thi chac chan da luu dc vao bang orders roi

                if ($order_id > 0) {
                    //luu cac thong tin vao bang order_details
                    //lap gio hang de luu thong tin tung phan tu vao bang order_details

                    $order_detail_model = new OrderDetail();
                    $order_detail_model->order_id = $order_id;
                    foreach ($_SESSION['cart'] as $product_id => $cart) {
                        $order_detail_model->product_id = $product_id;
                        $order_detail_model->quality = $cart['quality'];
                        $is_insert = $order_detail_model->insert();
                        var_dump($is_insert);
                    }

                    //dua vao phuong thuc thanh toan de quyet dinh se lam gi
                    //neu la thanh toan truc tuyen thi chuyen huong ve trang tich hop ngan luong
                    if ($method == 0) {
                        //tao session, luu cac thong tin lien quan den don hang,de hien thi ra tai trang thanh toan
                        //phuong phap:
                        //lay thong tin order vua luu, tao session de luu cac thong tin do
                        $_SESSION['order'] = [
                            'price_total' => $price_total,
                            'fullname' => $fullname,
                            'email' => $email,
                            'mobile' => $mobile
                        ];
                        $url_redirect = $_SERVER['SCRIPT_NAME'] . '/thanh-toan-truc-tuyen';
                        header(("Location: $url_redirect"));
                        exit();
                    } //neu la thanh toan COD
                    else {
                        //thuc hien gui mail xac nhan don hang
                        $this->sendMail($email);
                        //xoa session gio hang
                        unset($_SESSION['cart']);
                        //chuyen huong ve trang cam on
                        $url_redirect = $_SERVER['SCRIPT_NAME'] . '/cam-on';
                        header("Location: $url_redirect");
                        exit();
                        //thuc hien gui mail xac nhan don hang roi chuyen huong ve trang camr on
                    }
                }
            }
        }
        //lay noi dung view index tuong ung
        $this->content = $this->render('views/payments/index.php');
        //goi layout de hien thi noi dung view vua lay dc
        require_once 'views/layouts/main.php';
    }

    public function thank()
    {
        //goi view thank
        $this->content = $this->render('views/payments/thank.php');
        require_once 'views/layouts/main.php';
    }

    public function online()
    {
        //goi trang nganluong
        $this->content = $this->render('configs/nganluong/index.php');
        echo $this->content;
    }

    public function sendMail($email)
    {
        // Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer(true);
        try {
            //them dong sau de hien thi dc ky tu co dau
            $mail->CharSet = 'UTF-8';
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_OFF;                      // Enable verbose debug output/DEBUG_SERVER
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
            $mail->setFrom('abc@gmail.com', 'Electro Store');
            //gui toi ai
            $mail->addAddress($email);               // Name is optional

//            $mail->addReplyTo('info@example.com', 'Information');
//            $mail->addCC('cc@example.com');
//            $mail->addBCC('bcc@example.com');

            // Attachments
            //$mail->addAttachment('image.png');         // Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Order Confirmation!';
            $mail->Body = 'Click on the following link to confirm your order';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}

