<?php

require_once ("../../vendor/autoload.php");

$ged = new \App\GED\GED();

echo "GED:".'<br>';

if (isset($_POST['Submit'])) {
    print_r($_POST);
    $ged->initVar($_POST);
    if (!$ged->storeGED()) {
        $applyID = $_POST['applyID'];
        $updateQuery = "UPDATE `administrator` SET `ged_status` = '-1', `ec_status` = '1' WHERE `administrator`.`apply_id` = $applyID";
        try {
            $ged->delete_Update_Store($updateQuery);
            header("Location: ged_dashboard.php");
        } catch (PDOException $e) {
            $e->getMessage();
        }
    } else {
        echo "Failed";
    }

}
