<?php

/**
 * Created by PhpStorm.
 * User: vignatjevs
 * Date: 15/01/2017
 * Time: 17:53
 */

class User
{
    function __construct() {
        $username = false;
        $email = false;
        $fullname = false;
        $avatar = false;
        $id = false;
    }
    function isUser($username)
    {
        $db = new DB();
        $sql = 'SELECT `username` FROM `users` WHERE `username` = :username LIMIT 1';
        $params = [
            'username' => $username,
        ];
        if ($db->query($sql, $params)) {
            return true;
        } else {
            return false;
        }



    }

    function passwordsMatch($password1, $password2)
    {
        if ($password1 == $password2) {
            return true;
        } else {
            return false;
        }

    }

    function passwordStrong($password)
    {
        if (preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,50}$/', $password)) {
            return true;
        } else {
            return false;
        }
    }


    public function encryptPassword($password)
    {
        $salt = sha1(rand());
        $salt = substr($salt, 0, 10);
        $encrypted = base64_encode(sha1($password . $salt, true) . $salt);
        $hash = array("salt" => $salt, "encrypted" => $encrypted);
        return $hash;
    }


    public function decryptPassword($salt, $password)
    {
        $hash = base64_encode(sha1($password . $salt, true) . $salt);
        return $hash;
    }

    function registerUser($username, $email, $unsafe_password)
    {
        $db = new DB();


        $hash = $this->encryptPassword($unsafe_password);
        $password = $hash["encrypted"];
        $salt = $hash["salt"];

        $sql = 'INSERT INTO `users` (username, email, password, salt) VALUES (:username, :email, :password, :salt)';
        $params = [
            'username' => $username,
            'password' => $password,
            'email' => $email,
            'salt' => $salt,
        ];
        if ($db->query($sql, $params)) {
            return true;
        } else {
            return false;
        }


    }

    function validateUser($username, $password)
    {
        $db = new DB();
        $sql = 'SELECT `username`,`salt`,`password` FROM `users` WHERE `username` = :username';
        $params = [
            'username' => $username
        ];

        $data = $db->row($sql,$params);
        if ($data['password'] == $this->decryptPassword($data['salt'],$password)) {
            return true;
        } else {
            return false;
        }


    }

    function getUser($username = false, $id = false)
    {
        $db = new DB();

        if (!empty($id)) {
            $sql = 'SELECT * FROM `users` WHERE `id` = :id';
            $params = [
                'id' => $id
            ];

        } elseif (!empty($username)) {
            $sql = 'SELECT * FROM `users` WHERE `username` = :username';
            $params = [
                'username' => $username
            ];

        }

        if (!empty($sql)) {
            $userdata = $db->row($sql,$params);

            $this->username = $userdata['username'];
            $this->fullname = $userdata['fullname'];
            $this->avatar = $userdata['avatar'];
            $this->id = $userdata['id'];
        }


    }

}