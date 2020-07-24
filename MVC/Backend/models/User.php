<?php
//models/User.php
require_once 'models/Model.php';
class User extends Model{
    //khai bao cac thuoc tinh cua class dua vao truong trong bang user
    public $username;
    public $password;

    //kiem tra xem co username nao trung username trong csdl hay khong
    public function getUser($username){
        $sql_select_one = "SELECT * FROM users WHERE `username` = :username";
        $obj_select_one = $this->connection->prepare($sql_select_one);
        $arr_select = [
            ':username' => $username
        ];
        $obj_select_one->execute($arr_select);
        $user = $obj_select_one->FETCH(PDO::FETCH_ASSOC);
        return $user;
    }

    //dang ky user
    public function register(){
        //voi cac gia tri la text thi can dat placeholder de tranh loi SQLInjection
        $sql_insert = "INSERT INTO users(`username`, `password`) VALUES (:username, :password)";
        $obj_insert = $this->connection->prepare($sql_insert);
        $arr_insert =[
            ':username' => $this->username,
            ':password' => $this->password
        ];
        return $obj_insert->execute($arr_insert);
    }

    //dang nhap user
    public function getUserLogin($username, $password){
        $sql_select_one = "SELECT * FROM users WHERE `username` = :username AND `password` = :password";
        $obj_select_one = $this->connection->prepare($sql_select_one);
        //truyen gia tri that cho cac placeholdder trong cau truy van
        $arr_select = [
            ':username' => $username,
            ':password' => $password
        ];
        //thuc thi truy van
        $obj_select_one->execute($arr_select);
        $user = $obj_select_one->FETCH(PDO::FETCH_ASSOC);
        return $user;
    }
}