<?php
require_once ("../../vendor/autoload.php");
require_once ("../../mailer.php");

if (isset($_POST['REJECT'])) {

//    associative array
    $dept = ['Library'=>'lib_status', 'Department'=>'dept_status', 'Account'=>'account_status', 'GED'=>'ged_status', 'EC'=>'ec_status', 'Register'=>'register_status'];
    print_r($_POST);

    $_POST['applyID'] = $_GET['aid'];
    $_POST['date'] = date("Y-m-d");

    $remarks = new \App\Remarks\Remarks();

    $remarks->initVar($_POST);

    if ($remarks->storeRemarks()) {
        $applyID = $_POST['applyID'];
        $status = $dept[$_POST['REJECT']];
        $updateQuery = "UPDATE `administrator` SET `$status` = '-1' WHERE `administrator`.`apply_id` = $applyID";
        changeProgress($applyID, $remarks);
        try {
            $remarks->delete_Update_Store($updateQuery);

            $studentInfoQuery = "SELECT s.email, s.student_name from `student` s WHERE s.student_id = (SELECT a.student_id FROM `apply` a WHERE a.apply_id = $applyID)";

            $dataRow = $remarks->retrieve($studentInfoQuery);
            $receiver_email = $dataRow['email'];
            $receiver_name = $dataRow['student_name'];
            $subject = $_POST['REJECT'];
            $message = $_POST['Remarks'];

            if (sendMail($subject, $message, $receiver_email, $receiver_name)) {
                $path = $_POST['path'];
                header("Location: ../$path");
            }

        } catch (PDOException $e) {
            $e->getMessage();
        }
    } else {
        "Failed on line 14 on remarksController file...";
    }

}

// change progress query
function changeProgress($applyId, $db) {
    $progressQuery = "UPDATE `apply` SET `progress` = '-1' WHERE `apply`.`apply_id` = $applyId";
    try {
        if ($db->delete_Update_Store($progressQuery)) {
            echo "Progress value change Success!";
        }

    } catch(PDOException $exception) {
        $exception->getMessage();
    }




}