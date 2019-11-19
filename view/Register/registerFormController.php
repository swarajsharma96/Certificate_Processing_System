<?php

require_once ("../../vendor/autoload.php");
require_once ("../../mailer.php");

use App\Message\Message;

$register = new \App\Register\Register();

if (isset($_POST['Submit']))
{
    if (isset($_POST['ssc-hsc-certificate']) && isset($_POST['ssc-hsc-bsc-transcript']) && isset($_POST['fee'])) {
        $apply_id = $_POST['applyID'];
        $updateQuery = "UPDATE `administrator` SET `register_status` = '-1', `ec_status` = '0' WHERE `administrator`.`apply_id` = $apply_id";
        echo $updateQuery;
        if ($register->delete_Update_Store($updateQuery)) {
            header("Location: register_dashboard.php");
        }

    }

}


if (isset($_POST['Register-Final_Stage']) || isset($_POST['approve'])) {
    $apply_id = $_GET['aid'];
    $updateQuery = "UPDATE `administrator` SET `register_status` = '-1' WHERE `administrator`.`apply_id` = $apply_id";
    try {
        if ($register->delete_Update_Store($updateQuery)) {

            $message = "Your certificate and transcript is ready now! Please collect it from register office.";
            $retrieve_query = "SELECT s.email, s.student_name FROM `student` s WHERE s.student_id = (SELECT a.student_id FROM apply a WHERE a.apply_id = $apply_id)";
            $email_name_row = null;
            try {
                $email_name_row = $register->retrieve($retrieve_query);
            } catch (PDOException $exception) {
                $exception->getMessage();
            }
            $receiver_name = $email_name_row['student_name'];
            $receiver_email = $email_name_row['email'];

            $updateProgressQuery = "UPDATE `apply` SET `progress` = '0' WHERE `apply`.`apply_id` = $apply_id";
            try {
                if ($register->delete_Update_Store($updateProgressQuery)) {
                    echo "Success";
                }
            } catch (PDOException $exception) {
                $exception->getMessage();
            }

            if (sendMail("Register", $message, $receiver_email, $receiver_name)) {
                $path = $_POST['path'];
                Message::message("Certificate Issued! An email has been send to student");
                echo "success";
            }

            header("Location: register_dashboard.php");
        }
    } catch (PDOException $e) {
        $e->getMessage();
    }
}
