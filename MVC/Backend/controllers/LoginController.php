<?php
require_once 'controllers/Controller.php';
require_once 'models/User.php';
class LoginController extends Controller{
    public function signup(){
        //test bien $_POST
//        echo "<pre>";
//        print_r($_POST);
//        echo "</pre>";

        //xu ly submit form
        if(isset($_POST['submit'])){
            //tao bien ba gan cac gia tri tu form cho bien
            $username = $_POST['username'];
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];
            //validate form
            //khong duoc de tron username va password
            //truong password va password confirm phai giong nhau
            if(empty($username) || empty($password)){
                $this->error = "Username hoặc Password không được để trống";
            }
            elseif ($password != $confirm_password){
                $this->error = "Password nhập lại không chính xác";
            }
            //xu ly dang ky user trong truong hop khong co loi validate
            if(empty($this->error)){
                //can kiem tra truong hop username da ton tai trong csdl roi thi bao loi
                $user_model = new User();
                //lay thong tin user dua vao username
                $user = $user_model->getUser($username);
                //truong hop user da ton tai
                if(!empty($user)){
                    $this->error = 'Username đã tồn tại';
                }
                else{
                    //gan cac gia tri cho thuoc tinh tuong ung cua model
                    $user_model->username = $username;
                    //khong bh duoc luu password kieu plain text bat buoc phai ma hoa password khi luu
                    //co rat nhieu co che ma hoa,vs muc dich demo thi se sd co che ma hoa md5
                    //$user_model->password = $password;
                    $user_model->password = md5($password);
                    $is_register = $user_model->register();
                    $_SESSION['success'] = 'Đăng ký thành công';
                    header('Location:index.php?controller=login&action=login');
                    exit();
                }
            }
        }
        //lay nd view tuong ung
        $this->content = $this->render('views/users/signup.php');
        //goi layout tuong ung
        require_once 'views/layouts/main_login.php';
    }

    //xu ly login
    public function login(){
        //xu ly submit form
        //debug thong tin mang
//        echo "<pre>";
//        print_r($_POST);
//        echo "</pre>";
        if(isset($_POST['submit'])){
            //gan bien
            $username = $_POST['username'];
            $password = $_POST['password'];
            //check validate
            //khong duoc de trong ca 2 truong
            if(empty($username) || empty($password)){
                $this->error = 'Username hoặc Password không được để trống';
            }
            //xu ly logic sumit form chi khi nao khong co loi validate
            if(empty($this->error)){
                //xu ly login thuong se tao ra 1 session chua thong tin cua user tim duoc
                $user_model = new User();
                //do password luu trong csdl dang duco ma hoa theo co che md5
                $password = md5($password);
                //goi phuong thuc lay user tu csdl dua vao username va password da ma hoa
                $user = $user_model->getUserLogin($username, $password);
                print_r($user);
                if(empty($user)){
                    $_SESSION['error'] = 'Sai Username hoặc Password';
                    header('Location:index.php?controller=login&action=login');
                    exit();
                }
                else{
                    $_SESSION['success'] = 'Đăng nhập thành công';
                    //khi login thanh cong can tao session voi gia tri chinh la mang user vua tim duoc
                    $_SESSION['user'] = $user;
                    //chuyen huong trang admin
                    header('Location:index.php?controller=category&action=index');
                    exit();
                }
            }
        }
        //lay nd view tuong ung
        $this->content = $this->render('views/users/login.php');
        //goi layout tuong ung
        require_once 'views/layouts/main_login.php';
    }

    //dang xuat nguoi dung khoi he thong
    public function logout(){

        //xoa tat ca cac session lien quan den user da dang nhap
        unset($_SESSION['user']);
        //xoa tat ca cac session khac tren he thong
        $_SESSION['success'] = 'Đăng xuất thành công';
//        session_destroy();
        //chuyen huong ve trang login
        header('Location:index.php?controller=login&action=login');
        exit();
    }
}

