<?php

require_once ("../../vendor/autoload.php");

$creditDetails = new \App\CreditDetails\Credits();

echo "Controller:".'<br>';
if (isset($_POST['Submit'])) {
    print_r($_POST);
    $creditDetails->initVar($_POST);
    if ($creditDetails->storeCreditInfo(1)) {
        $applyID = $_POST['applyID'];
        $updateQuery = "UPDATE `administrator` SET `ec_status` = '-1', `dept_status` = '0' WHERE `administrator`.`apply_id` = $applyID";
        try {
            $creditDetails->delete_Update_Store($updateQuery);
            header("Location: ec_dashboard.php");
        } catch (PDOException $e) {
            $e->getMessage();
        }
    } else {
        echo "Failed";
    }

}

if (isset($_POST['Ec-Final_Stage'])) {
    print_r($_POST);
    $applyID = $_POST['applyID'];
    $updateQueryFinalStage = "UPDATE `administrator` SET `register_status` = '1', `ec_status` = '-1' WHERE `administrator`.`apply_id` = $applyID";
    try {
        $creditDetails->delete_Update_Store($updateQueryFinalStage);
        header("Location: ec_dashboard.php");
    } catch (PDOException $e) {
        $e->getMessage();
    }
} else {
    echo "failed";
}
