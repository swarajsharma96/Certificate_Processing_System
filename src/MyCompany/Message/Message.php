<?php
/**
 * Created by PhpStorm.
 * User: Shuva
 * Date: 8/2/2019
 * Time: 12:11 PM
 */

namespace App\Message;

if (!isset($_SESSION))
    session_start();


class Message
{
    public static function message($msg = null)
    {
        if (is_null($msg)) {
            if (isset($_SESSION['Message'])) {
                $temp = $_SESSION["Message"];
                $_SESSION["Message"] = null;
                return $temp;
            }
        } else {
            $_SESSION['Message'] = $msg;
        }

    }

}