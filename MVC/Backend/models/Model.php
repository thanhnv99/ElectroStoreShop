<?php
//models/Model.php
//dong vai tro la 1 model cha,chua 1 thuoc tinh connection va 1 phuong thuc de khoi tao ket noi
//loi dung ham khoi tao de khoi tao gia tri cho connection
require_once "configs/Database.php";
class Model{
    //thuoc tinh ket noi dung chung cho model con
    public $connection;

    //ham khoi tao de khoi tao gia tri mac dinh cho thuoc tinh connection
    public function __construct()
    {
        $this->connection = $this->getConnection();
    }

    //phuong thuc ket noi csdl
    public function getConnection(){
        $connection = new PDO(Database::DB_DSN,Database::DB_USERNAME,Database::DB_PASSWORD);
        return $connection;
    }
}
