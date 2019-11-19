<?php
/**
 * Created by PhpStorm.
 * User: Shuva
 * Date: 8/2/2019
 * Time: 1:24 PM
 */

namespace App\ProjectThesis;


use App\Message\Message;
use App\Model\Database;
use Exception;

class Project extends Database
{
    private $projectTitle, $supervisorName, $supervisorMobileNo, $studentID;

    public function __construct()
    {
        parent::__construct();
    }


    private function initVar($postArray)
    {
        if (array_key_exists("projectTitle", $postArray))
            $this->projectTitle = $postArray["projectTitle"];

        if (array_key_exists("supervisorName", $postArray))
            $this->supervisorName = $postArray["supervisorName"];

        if (array_key_exists("designation", $postArray))
            $this->designation = $postArray["designation"];

        if (array_key_exists("studentID", $postArray))
            $this->studentID = $postArray["studentID"];
    }


    public function storeProject($postArray)
    {
        $this->initVar($postArray);

        $query = "INSERT INTO `project_thesis` (`student_id`, `project_thesis_name`, `supervisor_name`, `designation`) VALUES (?,?,?,?)";
        $dataArray = [$this->studentID, $this->projectTitle, $this->supervisorName, $this->designation];

        try {
            $statement = $this->dbconnection->prepare($query); // return a boolean value
            $status = $statement->execute($dataArray); // return a boolean value

            if ($status) {
                Message::message("Success! Data has been inserted successfully.<br>");
                return true;
            } else {
                Message::message("Failed! Data doesn't not insert.<br>");
                return false;
            }

        } catch (Exception $e) {
            echo $e->getMessage();
        }


    }


    public function isIdUnique($studentID) {
        $decision = false;

        $query = "SELECT * FROM `project_thesis` WHERE student_id = '$studentID'";
        $statement = $this->dbconnection->prepare($query);
        $statement->execute();
        while ($statement->fetch()) {
            $decision = true;
            break;
        }
        if ($decision) {
            Message::message("Failed! Duplicate ID can't be insert.<br>");
        }

        return $decision;
    }


    public function updateProject()
    {

    }

}
