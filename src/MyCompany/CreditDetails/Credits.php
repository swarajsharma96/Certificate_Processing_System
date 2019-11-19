<?php

namespace App\CreditDetails;

use App\Message\Message;
use App\Model\Database;
use PDOException;

class Credits extends Database
{
    private $applyID, $totalCredit, $earnedCredit, $creditWaiver, $result;

    public function __construct()
    {
        parent::__construct();
    }

    public function initVar($postArray)
    {
        if (array_key_exists('applyID', $postArray))
            $this->applyID = $postArray['applyID'];

        if (array_key_exists('totalCredit', $postArray))
            $this->totalCredit = $postArray['totalCredit'];

        if (array_key_exists('earnedCredit', $postArray))
            $this->earnedCredit = $postArray['earnedCredit'];

        if (array_key_exists('creditWaiver', $postArray))
            $this->creditWaiver = $postArray['creditWaiver'];

        if (array_key_exists('result', $postArray))
            $this->result = $postArray['result'];
    }


    public function storeCreditInfo($value)
    {
        $query = null;
        $dataArray = null;

        if ($value == 1) {
            $query = "INSERT INTO `credit_details` 
                    (`apply_id`, `total_credit`, `earned_credit`, `credit_waiver`, `result`) 
                    VALUES (?,?,?,?,?)";

            $dataArray = [$this->applyID, $this->totalCredit, $this->earnedCredit, $this->creditWaiver, $this->result];
        }
        else {
            $query = "UPDATE `credit_details` SET `earned_credit` = ?, `credit_waiver` = ?, `result` = ? WHERE `credit_details`.`apply_id` = $this->applyID";
            echo "Query = $query";
            $dataArray = [$this->earnedCredit, $this->creditWaiver, $this->result];
        }

        $statement = $this->dbconnection->prepare($query); // return a boolean value

        $status = $statement->execute($dataArray); // return a boolean value

        if ($status) {
            Message::message("Successful!<br>");
            return true;
        }
        else {
            Message::message("Failed! Data doesn't not insert.<br>");
            return false;
        }

    }


}