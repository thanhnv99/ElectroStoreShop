<?php
//models/Product.php
require_once 'models/Model.php';
class Product extends Model{
    //lay tat ca cac san pham dang co tren he thong
    public function getNewProduct($category_id,$params = []){
        $str_price = '';

        if (isset($params['str_price'])) {
            $str_price = " AND " . $params['str_price'];
        }
        //voi cau truy van ma co join bang,thu luon can su dung ten bang truoc ten truong,vd : products.price
        $sql_select_new = "SELECT products.*, categories.name AS category_name FROM products INNER JOIN  categories ON products.category_id = categories.id WHERE products.category_id = $category_id $str_price ORDER BY products.id DESC LIMIT 3";
        $obj_select_new = $this->connection->prepare($sql_select_new);
        $obj_select_new->execute();
        $products = $obj_select_new->FETCHALL(PDO::FETCH_ASSOC);
        return $products;
    }

    public function getById($id)
    {
        $sql_select_one = "select products.*, categories.name as category_name from products inner join categories on products.category_id = categories.id where products.id =$id";

        $obj_select_one = $this->connection->prepare($sql_select_one);
        $obj_select_one->execute();
        $product = $obj_select_one->fetch(PDO::FETCH_ASSOC);
        return $product;
    }

    public function getAllMobile($category_id,$params = []){
        $str_price = '';

        if (isset($params['str_price'])) {
            $str_price = " AND " . $params['str_price'];
        }

        //voi cau truy van ma co join bang,thu luon can su dung ten bang truoc ten truong,vd : products.price
        $sql_select_new = "SELECT products.*, categories.name AS category_name FROM products INNER JOIN  categories ON products.category_id = categories.id WHERE products.category_id = $category_id $str_price ORDER BY products.id DESC";
        $obj_select_new = $this->connection->prepare($sql_select_new);
        $obj_select_new->execute();
        $products = $obj_select_new->FETCHALL(PDO::FETCH_ASSOC);
        return $products;
    }

    public function getAllTivi($category_id,$params = []){
        $str_price = '';

        if (isset($params['str_price'])) {
            $str_price = " AND " . $params['str_price'];
        }

        //voi cau truy van ma co join bang,thu luon can su dung ten bang truoc ten truong,vd : products.price
        $sql_select_new = "SELECT products.*, categories.name AS category_name FROM products INNER JOIN  categories ON products.category_id = categories.id WHERE products.category_id = $category_id $str_price ORDER BY products.id DESC";
        $obj_select_new = $this->connection->prepare($sql_select_new);
        $obj_select_new->execute();
        $products = $obj_select_new->FETCHALL(PDO::FETCH_ASSOC);
        return $products;
    }

    public function getAllLaptop($category_id,$params = []){
        $str_price = '';

        if (isset($params['str_price'])) {
            $str_price = " AND " . $params['str_price'];
        }

        //voi cau truy van ma co join bang,thu luon can su dung ten bang truoc ten truong,vd : products.price
        $sql_select_new = "SELECT products.*, categories.name AS category_name FROM products INNER JOIN  categories ON products.category_id = categories.id WHERE products.category_id = $category_id $str_price ORDER BY products.id DESC";
        $obj_select_new = $this->connection->prepare($sql_select_new);
        $obj_select_new->execute();
        $products = $obj_select_new->FETCHALL(PDO::FETCH_ASSOC);
        return $products;
    }
}
