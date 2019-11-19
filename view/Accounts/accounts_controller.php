<?php

require_once ("../../vendor/autoload.php");

$account = new \App\Accounts\Account();

echo "Accounts:".'<br>';

if (isset($_POST['Submit'])) {
    print_r($_POST);
    $account->initVar($_POST);
    if ($account->storeAccountInfo()) {
        $applyID = $_POST['applyID'];
        $updateQuery = "UPDATE `administrator` SET `account_status` = '-1', `lib_status` = '0' WHERE `administrator`.`apply_id` = $applyID";
        try {
            $account->delete_Update_Store($updateQuery);
            header("Location: accounts_dashboard.php");
        } catch (PDOException $e) {
            $e->getMessage();
        }
    } else {
        echo "Failed";
    }

}
