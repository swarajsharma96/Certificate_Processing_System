<?php

namespace App\Accounts;

use App\Message\Message;
use App\Model\Database;

class Account extends Database
{
    private $applyID, $discount, $clearance;

    public function __construct()
    {
        parent::__construct();
    }

    public function initVar($postArray)
    {
        if (array_key_exists('applyID', $postArray))
            $this->applyID = $postArray['applyID'];
        if (array_key_exists('discount', $postArray))
            $this->discount = $postArray['discount'];
        if (array_key_exists('clearance', $postArray))
            $this->clearance = $postArray['clearance'];
    }

    public function storeAccountInfo()
    {
        $query = "INSERT INTO `accounts` (`apply_id`, `discount`, `clearance`) VALUES (?,?,?)";
        $dataArray = [$this->applyID, $this->discount, $this->clearance];

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