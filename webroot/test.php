<?php

class DB{

    protected $db;

    public function  __construct(){
        try{
           $this->db = new PDO("mysql:host=127.0.0.1;dbname=3blog","mysql","mysql");
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public function query($sql){
        if(!$this->db){
            return false;
        }

        $data = $this->db->prepare($sql);
        $data->execute();

        if(is_bool($data)){
            return array();
        }else{
            return $data->fetchALL(PDO::FETCH_ASSOC);
        }
    }
}

$connect = new DB;

$result = $connect->query("SELECT * FROM `users` WHERE `login` = 'admin';");

print_r($result);

