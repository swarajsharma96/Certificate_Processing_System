<?php

namespace App\Login;

use App\Message\Message;
use App\Model\Database;

class User extends Database
{
    private $userID, $userName, $email, $password, $loginAs;

    public function __construct()
    {
        parent::__construct();
    }


    public function initVar($postArray)
    {
        if (array_key_exists('userName', $postArray))
            $this->userName = $postArray['userName'];
        if (array_key_exists('email', $postArray))
            $this->email = $postArray['email'];
        if (array_key_exists('password', $postArray))
            $this->password = $postArray['password'];
        if (array_key_exists('LoginAs', $postArray))
            $this->loginAs = $postArray['LoginAs'];
    }


    public function isUserNameAndPasswordMatch()
    {
        $query = "SELECT COUNT(user_name) as match_user FROM `user` WHERE user_name = '$this->userName' and password = '$this->password' and login_as = '$this->loginAs'";

        echo "query: $query <br>";

        $statement = $this->dbconnection->prepare($query);
        $statement->execute();
        if ($data = $statement->fetch())
        {
             $count = $data['match_user'];

             echo "Count value  = $count <br>";

             if ($count == 1) {
                 return true;
             } else {
                 return false;
             }
        }
    }

    public function isUsernameUnique($userName)
    {
        $query = "SELECT COUNT(user_name) AS user_name FROM `user` WHERE user_name = '$userName'";

        $statement = $this->dbconnection->prepare($query);
        $statement->execute();
        if ($data = $statement->fetch())
        {
            $count = $data['user_name'];
            if ($count > 0) {
                return false;
            } else {
                return true;
            }
        }
    }


    public function storeUserInfo()
    {
        $query = "INSERT INTO `user` (`user_name`, `password`, `email`, `login_as`) VALUES (?, ?, ?, ?);";

        $dataArray = [$this->userName, $this->password, $this->email, $this->loginAs];

        $statement = $this->dbconnection->prepare($query);
        $status = $statement->execute($dataArray);

        if ($status) {
            Message::message("SignUp Successful! <br>");
            return true;
        } else {
            Message::message("Registration is failed!<br>");
            return false;
        }


    }


}