<?php
//controllers/Controler.php
//đóng vai trò là controller cha
//chứa thuộc tính content và error
//chứa phương thức render
//là các thuộc tính/phương thức dùng chung bởi các class con
//kế thừa từ class cha này
class Controller {
    //do tat ca cac controller ben backend deu ke thua tu class Controller cha
    //nen se check biec user da dang nhap thi moi sd duoc chuc nang ben backend tai phuong thuc khoi tao cua class cha nay
    public function __construct()
    {
        if (!isset($_SESSION['user']) && $_GET['controller'] != 'login') {
            $_SESSION['error'] = 'Bạn chưa đăng nhập';
            header('Location: index.php?controller=login&action=login');
            exit();
        }
    }

    //chứa thông tin về lỗi validate của form
    public $error;
    //chứa thông tin của nội dung view theo từng chức năng
    public $content;

    //phương thức dùng để lấy nội dung view động
    //$file: đường dẫn tới file view
    //$variales: mảng các phần tử, chính là các biến sẽ
    //sử dụng ở trong view
    public function render($file, $variables = []) {
        //giải nén mảng $variables -> dùng tên biến dựa theo key của mảng -> categories
        extract($variables);
        //mở vùng đệm để ghi nhớ nội dung view
        ob_start();
        //nhúng đường dẫn file view
        require_once $file;
        //kết thúc việc ghi nội dung file
        $view = ob_get_clean();
        return $view;
    }
}