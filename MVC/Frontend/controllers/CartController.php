<?php
//controllers/cartcontroller.php
require_once 'controllers/Controller.php';
require_once 'models/Product.php';

//xu ly them/sua/xoa/liet ke gio hang
class CartController extends Controller
{
    //xu ly them vao gio hang
    public function add()
    {
//        echo '<pre>';
//        print_r($_GET);
//        echo '</pre>';
        //gio hang kieu nhu gio di cho,luu cac thong tin san pham ma user chon
        //tuy muc dich ma co the luu gio hang trong csdl,dung cookie,dung session
        //thong thuong se dung session de luu gio hang,ve mat lap trinh,can xac dinh truoc cau truc gio hang
        //day la buoc quan trong nhat
        //Se xay dung 1 cau truc gio hang nhu sau,de co the thao tac don gian nhat,vi du mang gio hang
//        $cart = [
//            1 => [
//                'name' => 'Samsung Note 9',
//                'price' => 12000,
//                'avatar' => 'dien-thoai.jpg',
//                'quality' => 4
//            ],
//            5 => [
//
//            ]
//        ];
        //xu ly logic them gio hang
        //lay ra thong tin san pham dua vao id bat duoc tu url
        //do dung rewrite da bat duoc validate id r nen khong can bat lai bang code
        $id = $_GET['id'];
        $product_model = new Product();
        $product = $product_model->getById($id);
//        echo '<pre>';
//        print_r($product);
//        echo '</pre>';
        //tao 1 mang chua cac thong tin can thiet de them vao gio
        $cart = [
            'name' => $product['title'],
            'price' => $product['price'],
            'avatar' => $product['avatar'],
            //mac dinh moi lan them 1 san pham
            'quality' => 1
        ];

        //1-neu tai thoi diem them san pham vao gio hang ma gio hang chua tung ton tai, thi tao moi gio hang va them san pham hien tai vao gio hang
        //2-Neu gio hang da ton tai roi,thi lai co 2 truong hop
        //+sp chua ton tai trong gio hang -> them moi(giong buoc 1)
        //+neu sp ton tai trong gio hang r -> tang so luong len 1
        //dat ten gio hang = cart
        if (!isset($_SESSION['cart'])) {
            //khoi tao gio hang them moi san pham vao gio
            //cau truc cac phan tu cua gio hang:
            //key chinh la id cua san pham
            //value chinh la mang cac thong tin cua san pham do
            $_SESSION['cart'][$id] = $cart;
        } else {
            //neu san pham them vao chua ton tai trong gio hang,thi thuc hien them moi
            //tuong ung id cua sp khi them khong ton tai trong danh sach cua cac key cua gio hang
            if (!array_key_exists($id, $_SESSION['cart'])) {
                $_SESSION['cart'][$id] = $cart;
            } else {
                //truong hop id sp da ton tai trong danh sach cac key cua mang gio hang,thi chi cap nhat so luong cho phan tu do trong gio hang
                $_SESSION['cart'][$id]['quality']++;
            }
//            echo '<pre>';
//            print_r($_SESSION);
//            echo '<pre>';
            //chuyen huong ve trang gio hang cua ban
            //chu y khi chuyen huong voi url da rewrite,thi chi can su dung cach sau de set lai url goc cho trang
            $url_redirect = $_SERVER['SCRIPT_NAME'] . '/gio-hang-cua-ban';
            header('Location: gio-hang-cua-ban');
            exit();
        }
    }

    //liet ke gio hang
    public function index()
    {
        //xu ly submit form,cap nhat lai gio hang
        //debug thong ti mang $_POST de xem du lieu gui tu form
//        echo '<pre>';
//        print_r($_POST);
//        echo '</pre>';
        //neu user submit form, click nut cap nhat gio hang
        if (isset($_POST['submit'])) {
            //lap gio hang, va gan so luong tuong ung voi san pham
            //trong gio hang duoc gui tu form len cho gio hang tuong ung
            foreach ($_SESSION['cart'] as $product_id => $cart) {
                $_SESSION['cart'][$product_id]['quality'] = $_POST[$product_id];
            }
            $_SESSION['success'] = 'Cập nhật giỏ hàng thành công!';
        }

        $this->content = $this->render('views/carts/index.php');
        require_once 'views/layouts/main.php';
    }

    //xoa san pham trong gio hang
    public function delete()
    {
        //do da dung rewrite url de validate id r, nen khogn can code validate nua
        $product_id = $_GET['id'];
        //xoa phan tu cua gio hang voi key chinh la id cua san pham bat duoc tu url
        unset($_SESSION['cart'][$product_id]);
        //neu nhu xoa het toan bo san pham trong gio hang thi se xoa luon gio hang do
        if (empty($_SESSION['cart'])) {
            unset($_SESSION['cart']);
        }
        $_SESSION['success'] = 'Đã xoá thành công sản phẩm khỏi giỏ hàng của bạn!';
        //chuyen huong ve trang gio hang cua ban
        //khi chuyen huong ve link url dang rewrite, thi can lay duoc url goc cua ung dung,$_SERVER['SCRIPT_NAME'];
        $url_redireact = $_SERVER['SCRIPT_NAME'] . '/gio-hang-cua-ban';
        header("Location:$url_redireact");
        exit();
    }
}
