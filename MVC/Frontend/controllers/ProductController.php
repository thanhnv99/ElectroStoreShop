<?php
//controllers/ProductController.php
require_once 'controllers/Controller.php';
require_once 'models/Product.php';
require_once 'models/Category.php';
class ProductController extends Controller
{
    public function detail()
    {
//        echo "<pre>";
//        print_r($_GET);
//        echo "</pre>";
        //khong can validate id vi khi rewrite url da bat case nay roi
        $id = $_GET['id'];
        //goi model de lay product tuong ung dua vao id vua lay duoc
        $product_model = new Product();
        $product = $product_model->getById($id);
//            echo "<pre>";
//            print_r($product);
//            echo "</pre>";
        //lay nd view chi tiet tuong ung
        $this->content = $this->render('views/products/detail.php', ['product' => $product]);
        //goi layouts de hien thi ra nd view
        require_once 'views/layouts/main.php';
    }
    //show all mobile
    public function showAllMobile(){
        $params = [];
        if(isset($_POST['filter'])){
            $str_price = '';
            //xu ly price
            if (isset($_POST['price'])) {
                foreach ($_POST['price'] as $price) {
                    switch ($price) {
                        //tich vao checkbox <10000000
                        case 1:
                            $str_price .= " or products.price < 1000000";
                            break;
                        // prcie tu 1 -> 2 tr
                        case 2:
                            $str_price .= " or (products.price between 1000000 AND 2000000)";
                            break;
                        case 3:
                            $str_price .= " or (products.price between 2000000 AND 3000000)";
                            break;
                        case 4:
                            $str_price .= " or products.price > 3000000";
                            break;
                    }
                }
                //cat bo tu OR o dau chuoi de tranh loi cua phap SQL, su dung ham substr, lay tu ky tu thu 3 -> het chuoi
                $str_price = substr($str_price, 3);
                $str_price = "($str_price)";
                $params['str_price'] = $str_price;
                //var_dump($str_price);
            }
        }
        $product_model = new Product();
        $products_mobile = $product_model->getAllMobile(20,$params);

        //lay nd view chi tiet tuong ung
        $this->content = $this->render('views/products/show_mobile.php', ['products_mobile' => $products_mobile]);
        //goi layouts de hien thi ra nd view
        require_once 'views/layouts/main.php';
    }

    //show all laptop
    public function showAllLaptop(){
        $params = [];
        if(isset($_POST['filter'])){
            $str_price = '';
            //xu ly price
            if (isset($_POST['price'])) {
                foreach ($_POST['price'] as $price) {
                    switch ($price) {
                        //tich vao checkbox <10000000
                        case 1:
                            $str_price .= " or products.price < 1000000";
                            break;
                        // prcie tu 1 -> 2 tr
                        case 2:
                            $str_price .= " or (products.price between 1000000 AND 2000000)";
                            break;
                        case 3:
                            $str_price .= " or (products.price between 2000000 AND 3000000)";
                            break;
                        case 4:
                            $str_price .= " or products.price > 3000000";
                            break;
                    }
                }
                //cat bo tu OR o dau chuoi de tranh loi cua phap SQL, su dung ham substr, lay tu ky tu thu 3 -> het chuoi
                $str_price = substr($str_price, 3);
                $str_price = "($str_price)";
                $params['str_price'] = $str_price;
                //var_dump($str_price);
            }
        }
        $product_model = new Product();
        $products_laptop = $product_model->getAllLaptop(21,$params);

        //lay nd view chi tiet tuong ung
        $this->content = $this->render('views/products/show_laptop.php', ['products_laptop' => $products_laptop]);
        //goi layouts de hien thi ra nd view
        require_once 'views/layouts/main.php';
    }

    //show all televisions
    public function showAllTivi(){
        $params = [];
        if(isset($_POST['filter'])){
            $str_price = '';
            //xu ly price
            if (isset($_POST['price'])) {
                foreach ($_POST['price'] as $price) {
                    switch ($price) {
                        //tich vao checkbox <10000000
                        case 1:
                            $str_price .= " or products.price < 1000000";
                            break;
                        // prcie tu 1 -> 2 tr
                        case 2:
                            $str_price .= " or (products.price between 1000000 AND 2000000)";
                            break;
                        case 3:
                            $str_price .= " or (products.price between 2000000 AND 3000000)";
                            break;
                        case 4:
                            $str_price .= " or products.price > 3000000";
                            break;
                    }
                }
                //cat bo tu OR o dau chuoi de tranh loi cua phap SQL, su dung ham substr, lay tu ky tu thu 3 -> het chuoi
                $str_price = substr($str_price, 3);
                $str_price = "($str_price)";
                $params['str_price'] = $str_price;
                //var_dump($str_price);
            }
        }
        $product_model = new Product();
        $products_tivi = $product_model->getAllTivi(22,$params);

        //lay nd view chi tiet tuong ung
        $this->content = $this->render('views/products/show_tivi.php', ['products_tivi' => $products_tivi]);
        //goi layouts de hien thi ra nd view
        require_once 'views/layouts/main.php';
    }

}