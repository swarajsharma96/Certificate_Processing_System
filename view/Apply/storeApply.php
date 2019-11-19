<?php

require_once ("../../vendor/autoload.php");

use \App\Apply\Apply;
use \App\Message\Message;

$id =  $_GET['id'];

$apply = new Apply();

if (isset($_POST['Submit'])) {

    $_POST['studentID'] =$id;
    $_POST['applyDate'] = date("Y-m-d");
    $apply->initVar($_POST);


    if ($apply->ifOnWay()) {
        Message::message("You have applied before. Your application process on the way");
        header("Location: apply.php?id=$id");

    } else {
        if ($apply->store()) {
            header("Location: confirmationMessage.php");
        } else {
            header("Location: apply.php?id=$id");
        }
    }
}
