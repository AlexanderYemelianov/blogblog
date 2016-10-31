<?php

class User extends Model {

    /*Get user by login*/

    public function getByLogin($login){
        $login = $this->db->escape($login);
        $sql = "select * from users where login = '{$login}' limit 1";
        $result = $this->db->query($sql);
        if(isset($result[0])){
            return $result[0];
        }
        return false;
    }

    /*Register new user*/

    public function register($login, $email, $password){
        $login = $this->db->escape($login);
        $password = $this->db->escape($password);
        $email = $this->db->escape($email);

        $sql = "select * from users where login = '{$login}' or email = '{$email}' limit 2";
        $result = $this->db->query($sql);
        if(isset($result[0])){
            return $result[0];
        }

        if (isset($result['login']) == $login  || isset($result['email']) == $email ){
            return false;
        } else {
            $sql = "insert into `users`(`login`, `email`, `password`) values ('{$login}', '{$email}', '{$password}');";
            $result = $this->db->query($sql);
            if(isset($result[0])){
                return $result[0];
            }
            return false;
         }
    }

    /*Password recovery*/

    public function recovery ($login, $temp_password)
    {
        $new_password = md5(Config::get('salt') . $temp_password);

        $login = $this->db->escape($login);
        $sql = "select * from users where login = '{$login}' limit 1";
        $result = $this->db->query($sql);

        if ($result[0]['login'] == $login) {
            $sql = "update users set password ='{$new_password}' where login ='{$login}'";
            $result = $this->db->query($sql);
            return $result;
        }
    }

    /*Change password*/

        public function setNewPassword($login, $old_password, $new_password){

            $login = $this->db->escape($login);
            $old_password = $this->db->escape($old_password);
            $new_password = $this->db->escape($new_password);

            $user = $this->getByLogin($login);
            $login = $user['login'];

            $hash = md5(Config::get('salt') . $old_password);
            $new_hash = md5(Config::get('salt') . $new_password);

            if ($hash == $user['password']){
                $sql = "update `users` set `password` = '{$new_hash}' where login = '{$login}' limit 1";
                $result = $this->db->query($sql);
                return $result;
            }
        }
}
/**
 * Created by PhpStorm.
 * User: Alexander
 * Date: 24.01.2016
 * Time: 14:00
 */ 