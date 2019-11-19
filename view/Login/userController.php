<?php

require_once ("../../vendor/autoload.php");

use App\Login\User;
use App\Message\Message;

$section = ['admin'=>'admin.php', 'register'=>'register_dashboard.php', 'department'=>'dept_dashboard.php', 'account'=>'accounts_dashboard.php', 'lib'=>'lib_dashboard.php', 'ged'=>'ged_dashboard.php', 'ec'=>'ec_dashboard.php'];
$sectionFolder = ['admin'=>'Home', 'register'=>'Register', 'department'=>'Department', 'account'=>'Accounts', 'lib'=>'Library', 'ged'=>'Ged', 'ec'=>'ExamController'];


if (isset($_POST['Submit'])) {
    print_r($_POST);
    if (empty(str_replace(' ', '', $_POST['userName'])) && empty(str_replace(' ', '', $_POST['password']))) {
        Message::message('error.log::Input field can\'t be empty!');
        header("Location: login.php?q=1");
    } else {

        $user = new User();
        $user->initVar($_POST);
        if ($user->isUserNameAndPasswordMatch()) {
            session_start();
            $_SESSION['user_name'] = $_POST['userName'];
            $_SESSION['password'] = $_POST['password'];
            $_SESSION['LoginAs'] = $_POST['LoginAs'];

            $folder = $sectionFolder[$_POST['LoginAs']];
            $fileName = $section[$_POST['LoginAs']];
            header("Location: ../$folder/$fileName");

        } else {
            echo "username and password doesn't match <br>";
            Message::message("error.log::username and password doesn't match");
            header("Location: login.php?q=1");
        }
    }
}

if (isset($_POST['SignUp'])) {

    if (!isset($_POST['userName']) || trim($_POST['userName']) == '' || !isset($_POST['password']) || trim($_POST['password']) == '') {
        Message::message("error.log::please, fill out all fields...");
        header("Location: signup.php?q=1");
    } else {
        $user = new User();
        $user->initVar($_POST);
        if ($user->isUsernameUnique($_POST['userName'])) {
            $user->storeUserInfo();
            Message::message("Signup Complete!");
            header("Location: login.php");
        } else {
            Message::message("error.log:: This user name has already taken. Try another one ... ");
            header("Location: signup.php?q=1");
        }
    }
}

if (isset($_POST['Delete'])) {
    $userName = $_GET['q'];
    $query = "DELETE FROM `user` WHERE `user`.`user_name` = '$userName'";
    $user = new User();
    try {
        if ($user->delete_Update_Store($query)) {
            Message::message("Delete Successful");
            header("Location: login.php?s=1");
        }
    } catch (PDOException $e) {
        $e->getMessage();
    }
}

if (isset($_POST['Update'])) {
    $userName = $_POST['userName'];
    if (!isset($_POST['password']) || trim($_POST['password']) == '') {
        Message::message("error.log::please, fill out password ...");
        header("Location: edit.php?q=$userName");
    } else {
        $user = new User();
        $email = $_POST['email'];
        $password = $_POST['password'];
        $query = "UPDATE `user` SET `password` = '$password', `email` = '$email' WHERE `user`.`user_name` = '$userName'";
        if ($user->delete_Update_Store($query)) {
            Message::message("Update Successful");
            header("Location: login.php?s=1");
        }
    }
}
