<?php
//models/Category
require_once 'models/Model.php';
class Category extends Model {
    //khai báo các thuộc tính cho model trùng với các trường của bảng categories
    public $id;
    public $name;
    public $avatar;
    public $description;
    public $status;
    public $created_at;
    public $updated_at;

    //insert dữ liệu vào bảng categories
    public function insert() {
        $sql_insert = "INSERT INTO categories(`name`, `avatar`, `description`, `status`) VALUES (:name, :avatar, :description, :status)";
        //cbi đối tượng truy vấn
        $obj_insert = $this->connection
            ->prepare($sql_insert);
        //gán giá trị thật cho các placeholder
        $arr_insert = [
            ':name' => $this->name,
            ':avatar' => $this->avatar,
            ':description' => $this->description,
            ':status' => $this->status
        ];
        return $obj_insert->execute($arr_insert);
    }

    //lấy ra tất cả danh mục
    /**
     * Lay thong tin danh muc tren he thong
     * @param $params Mang cac tham so search
     * @return array
     */
    public function getAll($params=[]) {
//        echo '<pre>';
//        print_r($params);
//        echo '</pre>';
        //tao 1 chuoi truy van de them cac dieu kien search dua vao mang params truyen vao
        $str_search = 'WHERE TRUE';
        //check mang param truyen vao de thay doi lai chuoi search
        if (isset($params['name']) && !empty($params['name'])){
            $name = $params['name'];
            // nho phai co dau cach o dau chuoi
            $str_search .= " AND `name` LIKE '%$name%'";
        }
        if (isset($params['status'])){
            $status = $params['status'];
            $str_search .= " AND `status` = $status";
        }

        //tạo biến gán cho các key start và limit của mảng params
        $start = isset($params['start']) ? $params['start'] : 0;
        $limit = isset($params['limit']) ? $params['limit'] : 1000;

        //tạo câu truy vấn
        //gan chuoi search neu co vao truy van ban dau
        $sql_select_all = "SELECT * FROM categories $str_search LIMIT $start,$limit ";
        //cbi đối tượng truy vấn
        $obj_select_all = $this->connection->prepare($sql_select_all);
        $obj_select_all->execute();
        $categories = $obj_select_all->fetchAll(PDO::FETCH_ASSOC);
        return $categories;
    }

    public function getById($id) {
        $sql_select_one = "SELECT * FROM categories WHERE id = $id";
        $obj_select_one = $this->connection
            ->prepare($sql_select_one);
        $obj_select_one->execute();
        $category = $obj_select_one->fetch(PDO::FETCH_ASSOC);
        return $category;
    }

    /**
     * Lấy category theo id truyền vào
     * @param $id
     * @return array
     */
    public function getCategoryById($id)
    {
        $obj_select = $this->connection->prepare("SELECT * FROM categories WHERE id = $id");
        $obj_select->execute();
        $category = $obj_select->fetch(PDO::FETCH_ASSOC);

        return $category;
    }

    /**
     * Update bản ghi theo id truyền vào
     * @param $id
     * @return bool
     */
    public function update($id)
    {
        $obj_update = $this->connection->prepare("UPDATE categories SET `name` = :name, `avatar` = :avatar, `description` = :description, `status` = :status, `updated_at` = :updated_at 
         WHERE id = $id");
        $arr_update = [
            ':name' => $this->name,
            ':avatar' => $this->avatar,
            ':description' => $this->description,
            ':status' => $this->status,
            ':updated_at' => $this->updated_at,
        ];

        return $obj_update->execute($arr_update);
    }

    /**
     * Xóa bản ghi theo id truyền vào
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        $obj_delete = $this->connection->prepare("DELETE FROM categories WHERE id = $id");
        $is_delete = $obj_delete->execute();;
        //để đảm bảo toàn vẹn dữ liệu, sau khi xóa category thì cần xóa cả các product nào đang thuộc về category này
        $obj_delete_product = $this->connection->prepare("DELETE FROM products WHERE category_id = $id");
        $obj_delete_product->execute();

        return $is_delete;
    }

    //tra ve tong so ban ghi cua bang categories
    public function getTotal(){
        //dem tong so ban ghi thi se dem dua tren khoa chinh(id)
        $sql_select_count = "SELECT COUNT(id) AS count_id FROM categories";
        $obj_select_count = $this->connection->prepare($sql_select_count);
        $obj_select_count->execute();
        //vi muc dich la tra ve 1 so la tong so cac ban ghi nen se goi phuong thuc fetchColumn de tra ve gia tri cua cot trong cau truy van select luon
        $count = $obj_select_count->fetchColumn();
        var_dump($count);

        return $count;

    }
}