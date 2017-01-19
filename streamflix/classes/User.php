<?php

/**
 * Created by PhpStorm.
 * User: vignatjevs
 * Date: 15/01/2017
 * Time: 17:53
 */

class User
{

    public $username = false;
    public $email = false;
    public $fullname = false;
    public $avatar = false;
    public $id = false;

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

    function checkIfUserLoggedIn($username, $id)
    {
        if ($_SESSION['username'] = $username && $_SESSION['userid'] = $id) {
            return true;
        }


    }

    function checkLogin()
    {

        if (!empty($_SESSION['username'] && !empty($_SESSION['userid']))) {
            //$this->checkAuthenticationToken();
            return true;
        } else {
            return false;
        }
    }

    function loginUser($username, $id, $remember = false)
    {
        session_start();
        $_SESSION['username'] = $username;
        $_SESSION['userid'] = $id;
        $_SESSION['remember'] = $remember;
        if ($remember) {
            $this->generateAuthenticationToken($id);
        }
    }

    function logoutUser()
    {
        session_destroy();
        if (isset($_COOKIE['key'])) {
            unset($_COOKIE['key']);
            setcookie('key', '', time() - 3600, '/'); // empty value and old timestamp
        }
    }


    function generateAuthenticationToken($user_id) {
        $selector = base64_encode(openssl_random_pseudo_bytes(9));
        $authenticator = openssl_random_pseudo_bytes(33);

        setcookie(
            'remember',
            $selector . ':' . base64_encode($authenticator),
            time() + 864000,
            '/',
            'localhost:8082',
            true, // TLS-only
            true  // http-only
        );

        $db = new DB();

        $sql = "INSERT INTO `auth_tokens` (`selector`, `token`, `userid`, `expires`) VALUES (:selector, :token, :userid, :expires)";

        $params = [
            'selector' => $selector,
            'token' => hash('sha256', $authenticator),
            'userid' => $user_id,
            'expires' => date('Y-m-d\TH:i:s', time() + 864000),
        ];
        $db->query($sql, $params);
    }

    function checkAuthenticationToken() {
        if (empty($_SESSION['userid']) && !empty($_COOKIE['remember'])) {
            list($selector, $authenticator) = explode(':', $_COOKIE['remember']);

            $db = new DB();

            $sql = "SELECT * FROM `auth_tokens` WHERE `selector` = :selector";
            $params = [
                'selector' => $selector,
            ];

            $row = $db->row($sql,$params);

            if (hash_equals($row['token'], hash('sha256', base64_decode($authenticator)))) {
                $_SESSION['userid'] = $row['userid'];
                header('Location: /videos_main.php');
            } else {
                header('Location: /index.php');
            }
        }
    }



}