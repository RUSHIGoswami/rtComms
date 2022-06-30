<?php

namespace MyApp;

use PDO;

class Account
{
    public $pdo, $errorArray = array();
    public function __construct()
    {
        $db = new \Myapp\Database();
        $this->pdo = $db->connect();
    }

    public function login($un, $pass)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM `users` WHERE uname=:un OR email=:un AND pass=:pass");
        $stmt->bindParam(":un", $un, PDO::PARAM_STR);
        $stmt->bindParam(":pass", $pass, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_OBJ);
        if ($stmt->rowCount() != 0) {
            return $user->uid;
        } else {
            array_push($this->errorArray, Constant::$loginerror);
            return false;
        }
    }

    public function register($fname, $lname, $uname, $email, $pass, $cpass)
    {
        $this->validatefn($fname);
        $this->validateln($lname);
        $this->validateun($uname);
        $this->validateEm($email);
        $this->validatepass($pass, $cpass);

        if (empty($this->errorArray)) {
            return $this->insertDetails($fname, $lname, $uname, $email, $pass);
        } else
            return false;
    }

    private function validatefn($fn)
    {
        if ($this->length($fn, 2, 25)) {
            return array_push($this->errorArray, Constant::$fnameChar);
        }
    }
    private function validateln($ln)
    {
        if ($this->length($ln, 2, 25)) {
            return array_push($this->errorArray, Constant::$lnameChar);
        }
    }

    private function validateun($un)
    {
        if ($this->length($un, 2, 25)) {
            return array_push($this->errorArray, Constant::$unameChar);
        }

        $stmt = $this->pdo->prepare("SELECT `uname` FROM `users` WHERE uname=:un");
        $stmt->bindValue(":un", $un, PDO::PARAM_STR);
        $stmt->execute();
        if ($stmt->rowCount() != 0) {
            return array_push($this->errorArray, Constant::$unameTkn);
        }
    }

    private function validatepass($pass, $cpass)
    {
        if ($this->length($pass, 6, 24)) {
            return array_push($this->errorArray, Constant::$passerr);
        } else if ($pass != $cpass) {
            return array_push($this->errorArray, Constant::$CpassErr);
        }
    }

    private function validateEm($em)
    {
        $stmt = $this->pdo->prepare("SELECT `email` FROM `users` WHERE email=:em");
        $stmt->bindValue(":em", $em, PDO::PARAM_STR);
        $stmt->execute();
        if (!filter_var($em, FILTER_VALIDATE_EMAIL)) {
            return array_push($this->errorArray, Constant::$Invemail);
        }
        if ($stmt->rowCount() != 0) {
            return array_push($this->errorArray, Constant::$emailTkn);
        }
    }

    private function length($input, $min, $max)
    {
        if (strlen($input) < $min) {
            return true;
        } else if (strlen($input) > $max) {
            return true;
        }
    }


    private function insertDetails($fname, $lname, $uname, $email, $pass)
    {
        $rand = rand(0, 5);
        if ($rand === 0) {
            $profilepic = "assets/images/avatar.png";
        } else if ($rand === 1) {
            $profilepic = "assets/images/defaultPic.svg";
        } else if ($rand === 2) {
            $profilepic = "assets/images/other.jpg";
        } else if ($rand === 3) {
            $profilepic = "assets/images/defaultProfilePic.png";
        } else if ($rand === 4) {
            $profilepic = "assets/images/profilePic.jpeg";
        } else if ($rand === 5) {
            $profilepic = "assets/images/user_profile.png";
        }

        $stmt = $this->pdo->prepare("INSERT INTO users (fname, lname, uname, email, pass, profile_img) VALUES (:fname, :lname, :uname, :email, :pass, :profilepic)");
        $stmt->bindParam(":fname", $fname, PDO::PARAM_STR);
        $stmt->bindParam(":lname", $lname, PDO::PARAM_STR);
        $stmt->bindParam(":uname", $uname, PDO::PARAM_STR);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->bindParam(":pass", $pass, PDO::PARAM_STR);
        $stmt->bindParam(":profilepic", $profilepic, PDO::PARAM_STR);
        $stmt->execute();
        return $this->pdo->lastInsertId();
    }


    public function getError($errMessage)
    {
        if (in_array($errMessage, $this->errorArray)) {
            return "<span class='error'>$errMessage</span>";
        }
    }
}
