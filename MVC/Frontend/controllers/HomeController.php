<?php
require_once 'controllers/Controller.php';
require_once 'models/Product.php';
require_once 'models/Category.php';
class HomeController extends Controller {
    public function index() {
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
        //lay cac san pham de hien thi ra view
        $product_model = new Product();

        $products_mobile = $product_model->getNewProduct(20,$params);

        $products_laptop = $product_model->getNewProduct(21,$params);

        $products_tivi = $product_model->getNewProduct(22,$params);

//        echo '<pre>';
//        print_r($products_mobile);
//        echo '</pre>';

        $this->content = $this->render('views/homes/index.php', [
            'products_mobile' => $products_mobile,
            'products_tivi' => $products_tivi,
            'products_laptop' => $products_laptop
        ]);
        require_once 'views/layouts/main.php';
    }

    public function contact(){
        //goi view contact
        $this->content = $this->render('views/homes/contact.php');
        require_once 'views/layouts/main.php';
    }

    public function aboutus(){
        //goi view contact
        $this->content = $this->render('views/homes/aboutus.php');
        require_once 'views/layouts/main.php';
    }

    public function faqs(){
        //goi view contact
        $this->content = $this->render('views/homes/faqs.php');
        require_once 'views/layouts/main.php';
    }

    public function help(){
        //goi view contact
        $this->content = $this->render('views/homes/help.php');
        require_once 'views/layouts/main.php';
    }

    public function terms(){
        //goi view contact
        $this->content = $this->render('views/homes/terms.php');
        require_once 'views/layouts/main.php';
    }

    public function privacy()
    {
        //goi view contact
        $this->content = $this->render('views/homes/privacy.php');
        require_once 'views/layouts/main.php';
    }

}