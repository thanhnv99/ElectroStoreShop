<?php
require_once 'models/Model.php';

class Order extends Model
{
    public $fullname;
    public $address;
    public $mobile;
    public $email;
    public $note;
    public $price_total;
    public $payment_status;

    public function insert()
    {
        //xu ly luu vao bang don hang
        //tao cau truy van
        $sql_insert = "INSERT INTO orders(`fullname`,`address`,`mobile`,`email`,`note`,`price_total`,`payment_status`) VALUES (:fullname,:address,:mobile,:email,:note,:price_total,:payment_status)";
        $obj_insert = $this->connection->prepare($sql_insert);
        //tao mang de chuyen gia tri that cho placeholder
        $arr_insert = [
            ':fullname' => $this->fullname,
            ':address' => $this->address,
            ':mobile' => $this->mobile,
            ':email' => $this->email,
            ':note' => $this->note,
            ':price_total' => $this->price_total,
            ':payment_status' => $this->payment_status,
        ];
        //thu thi truy van
        //thong thuong khi goi phuong thuc execute trn cac truy van insert,update,delete se tra ve true/false
        //tuy nhien voi dacj thu cua csdl hien tai,thi se can tra ve id cua chinh order vua insert
        //ngay sau khi luu vao orders thanh cong,va bang order_details can biet id cua order vua insert
        $obj_insert->execute($arr_insert);
        $order_id = $this->connection->lastInsertId();
        return $order_id;
    }
}