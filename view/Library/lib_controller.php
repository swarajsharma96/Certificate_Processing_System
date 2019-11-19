<?php

require_once ("../../vendor/autoload.php");

$library = new \App\Library\Library();

echo "Library:".'<br>';

if (isset($_POST['Submit'])) {
    print_r($_POST);
    $library->initVar($_POST);
    if (!$library->storeLib()) {
        $applyID = $_POST['applyID'];
        $updateQuery = "UPDATE `administrator` SET `lib_status` = '-1', `ged_status` = '0' WHERE `administrator`.`apply_id` = $applyID";
        try {
            $library->delete_Update_Store($updateQuery);
            header("Location: lib_dashboard.php");
        } catch (PDOException $e) {
            $e->getMessage();
        }
    } else {
        echo "Failed";
    }

}

if (isset($_POST['Reject']))
{
    print_r($_POST);
}
