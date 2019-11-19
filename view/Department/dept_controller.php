<?php

require_once ("../../vendor/autoload.php");

$creditDetails = new \App\CreditDetails\Credits();

echo "Controller:".'<br>';
if (isset($_POST['Submit'])) {
    print_r($_POST);
    $creditDetails->initVar($_POST);
    if ($creditDetails->storeCreditInfo(0)) {
        $applyID = $_POST['applyID'];
        $updateQuery = "UPDATE `administrator` SET `dept_status` = '-1', `account_status` = '0' WHERE `administrator`.`apply_id` = $applyID";
        try {
            $creditDetails->delete_Update_Store($updateQuery);
            header("Location: dept_dashboard.php");
        } catch (PDOException $e) {
            $e->getMessage();
        }
    } else {
        echo "Failed";
    }

}
