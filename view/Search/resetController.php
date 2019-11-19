
<?php

use App\Model\Database;

require_once('../../vendor/autoload.php');

if (!isset($_SESSION))
    session_start();

if (!isset($_SESSION['user_name'])) {
    header("Location: ../Login/login.php");
}

if (isset($_POST['Reset'])) {
    $id = $_REQUEST['id'];
    $reset_query = "DELETE FROM `apply` WHERE `apply`.`student_id` = '$id'";
    $db = new Database();
    try {
        if ($db->delete_Update_Store($reset_query)) {
            header("Location: reset-confirmation.php");
        }
    } catch (PDOException $e) {
        $e->getMessage();
    }
}


?>