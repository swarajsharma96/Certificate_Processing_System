<?php

namespace App\Remarks;


use App\Message\Message;
use App\Model\Database;
use Exception;

class Remarks extends Database
{
    private $studentID, $applyID, $comments, $date, $dept;
    public function __construct()
    {
        parent::__construct();
    }

    public function initVar($postArray) {
        if (array_key_exists('studentID', $postArray))
            $this->studentID = $postArray['studentID'];
        if (array_key_exists('applyID', $postArray))
            $this->applyID = $postArray['applyID'];
        if (array_key_exists('Remarks', $postArray))
            $this->comments = $postArray['Remarks'];
        if (array_key_exists('date', $postArray))
            $this->date = $postArray['date'];
        if (array_key_exists('REJECT', $postArray))
            $this->dept = $postArray['REJECT'];
    }

    public function storeRemarks()
    {
        $query = "INSERT INTO `remarks` (`apply_id`, `comments`, `date`, `dept`) VALUES (?,?,?,?)";
        $dataArray = [$this->applyID, $this->comments, $this->date, $this->dept];
        try {
            $statement = $this->dbconnection->prepare($query); // return a boolean value
            $status = $statement->execute($dataArray); // return a boolean value

            if ($status) {
                Message::message("Rejection successful & an email has been send <br>");
                return true;
            } else {
                Message::message("Failed! Can't reject.<br>");
                return false;
            }

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

}