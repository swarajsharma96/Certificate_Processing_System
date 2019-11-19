<?php

require_once ("../../vendor/autoload.php");

use App\Model\Database;

$id = $_REQUEST['id'];

$db = new Database();

if ($_REQUEST['q'] == 1) {
    $delete_student_query = "DELETE FROM `student` WHERE `student`.`student_id` = '$id'";
    try {
        if ($db->delete_Update_Store($delete_student_query)) {
         header("Location: ../Home/admin.php");
        }
    } catch (PDOException $e) {
        $e->getMessage();
    }

} else {
    $delete_docs_query = "DELETE d.*, p.*, a.* FROM documents d LEFT JOIN project_thesis p ON 
                            d.student_id = p.student_id LEFT JOIN apply a ON d.student_id = a.student_id 
                            WHERE d.student_id = '$id'";
    try {
        if ($db->delete_Update_Store($delete_docs_query)) {
            header("Location: search.php?id=$id");
        }
    } catch (PDOException $e) {
        $e->getMessage();
    }
}
