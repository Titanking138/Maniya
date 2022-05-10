<?php

class Account
{
    private $conn;
    private $errorArray = array();
    public function __construct($conn)
    {
        $this->conn = $conn;
    }
    public function registration($fn,$ln,$un,$email,$email2,$pw,$pw2)
    {
        $this->checkFirstName($fn);
        $this->checkLastName($ln);
        $this->checkUserName($un);
        $this->checkEmail($email,$email2);
        $this->checkPassword($pw,$pw2);

        if(empty($this->errorArray))
        {
            return $this->insertUser($fn, $ln, $un, $email, $pw);
        }
        return  false;
    }

    public function login($un,$pw)
    {
        $pw = hash("sha512", $pw);
        $query = $this->conn->prepare("SELECT * FROM users WHERE username=:un AND password=:pw");
        $query->bindValue(":un", $un);
        $query->bindValue(":pw", $pw);

        $query->execute();

        if($query->rowCount() == 1)
        {
            return true;
        }
        array_push($this->errorArray,Constant::$loginError);
        return false;
    }
    private function insertUser($fn, $ln, $un, $em, $pw)
    {
        $pw = hash("sha512", $pw);

        $query = $this->conn->prepare("INSERT INTO users (firstName,lastName,username,email,password) VALUES (:fn,:ln,:un,:em,:pw)");
        $query->bindValue(":fn", $fn);
        $query->bindValue(":ln", $ln);
        $query->bindValue(":un", $un);
        $query->bindValue(":em", $em);
        $query->bindValue(":pw", $pw);

        //  $query->execute();
        //  var_dump($query->errorInfo());
        return $query->execute();
    }

    private function checkFirstName($fn)
    {
        if (strlen($fn) < 2 || strlen($fn) > 25) {
            array_push($this->errorArray, Constant::$firstNameError);
        }
    }
    private function checkLastName($ln)
    {
        if (strlen($ln) < 2 || strlen($ln) > 25) {
            array_push($this->errorArray, Constant::$lastNameError);
        }
    }
    private function checkUserName($un)
    {
        if (strlen($un) < 2 || strlen($un) > 25) {
            array_push($this->errorArray, Constant::$userNameError);
            return;
        }

        $query = $this->conn->prepare("SELECT * FROM users  WHERE username=:un");
        $query->bindValue(":un",$un);
        $query->execute();

        if($query->rowCount() != 0)
        {
            array_push($this->errorArray,Constant::$userNameCheckError);
        }
    }

    private function checkEmail($em,$em2)
    {
        if($em != $em2)
        {
            array_push($this->errorArray,Constant::$emailNotMatch);
            return;
        }
        if(!filter_var($em,FILTER_VALIDATE_EMAIL))
        {
            array_push($this->errorArray, Constant::$emailNotValid);
            return;
        }
        $query = $this->conn->prepare("SELECT * FROM users WHERE email=:em");
        $query->bindValue(":em", $em);
        $query->execute();

        if ($query->rowCount() != 0) {
            array_push($this->errorArray, Constant::$emailTakenError);
        }
    }

    private function checkPassword($pw,$pw2)
    {
        if ($pw != $pw2) {
            array_push($this->errorArray, Constant::$passwordNotMatchError);
            return;
        }
        if (strlen($pw) < 5 || strlen($pw) > 250) {
            array_push($this->errorArray, Constant::$passwordLenError);
            return;
        }
        $uppercase = preg_match('@[A-Z]@', $pw);
        $lowercase = preg_match('@[a-z]@', $pw);
        $number    = preg_match('@[0-9]@', $pw);
        $specialChars = preg_match('@[^\w]@', $pw);
        
        if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($pw) < 8) {
            array_push($this->errorArray, Constant::$passwordIncludeError);
        } 


    }

    public function getError($error)
    {
        if (in_array($error, $this->errorArray)) {
            return "<span class='errorMessage'>$error</span>";
        }
    }

    
}
