<?php

class DB{

    protected $connection;

    public function __construct($host, $user, $password, $db_name) {
        $this->connection = new mysqli($host, $user, $password, $db_name);

        if (mysqli_connect_error()) {
            throw new Exception('Could not connect to DB');
        }
    }

    public function query($sql){
        if (!$this->connection){
            return false;
        }

        $result = $this->connection->query($sql);

        if (mysqli_error($this->connection)) {
            throw new Exception();
        }

        if (is_bool($result)) {
            return $result;
        }

        $data = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    }

    public function escape($str) {
        return mysqli_escape_string($this->connection, $str);
    }


    /*private static $instance;
    private static $connection;

    public static function obj(){
        $class = get_called_class();

        if (is_null(self::$connection)){
            self::$instance = new $class;
            try{
                self::$connection = new PDO(Config::get('db.host'),Config::get('db.user'), Config::get('db.password)'));
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
        return self::$instance;
    }

    public function connect(){
        return self::$connection;
    }
    public function query($sql){
        $query = $this->connect()->prepare($sql);
        $query->execute();
        if(is_null($query)) {
            return array();
        }
        return $query->fetch(PDO::FETCH_ASSOC);
    }*/
}