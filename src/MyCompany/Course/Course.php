<?php
/**
 * Created by PhpStorm.
 * User: Shuva
 * Date: 8/2/2019
 * Time: 11:57 AM
 */

namespace App\Course;

use App\Message\Message;
use App\Model\Database;
use Exception;

class Course extends Database
{
    private $courseName, $courseCredit, $serialNo;

    public function __construct()
    {
        parent::__construct();
    }

    public function initVariable($postArray) {
        if (array_key_exists("courseName", $postArray)) {
            $this->courseName = $postArray["courseName"];
        }

        if (array_key_exists("courseCredit", $postArray)) {
            $this->courseCredit = $postArray["courseCredit"];
        }

    }

    public function store($postArray) {

        $this->initVariable($postArray);

        $query = "INSERT INTO `course` (`course_name`, `course_credit`) VALUES (?,?)";
        $dataArray = [$this->courseName, $this->courseCredit];
        try {
            $statement = $this->dbconnection->prepare($query); // return a boolean value
            $status = $statement->execute($dataArray); // return a boolean value

            if ($status)
                Message::message("Success! Data has been inserted successfully.<br>");
            else
                Message::message("Failed! Data doesn't not insert.<br>");
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function update($postArray) {

        $this->initVariable($postArray);
        $id = $postArray['courseID'];

        $query = "UPDATE `course` SET `course_name` =?, `course_credit` =? WHERE `course`.`course_id` = $id";
        $dataArray = [$this->courseName, $this->courseCredit];
        try {
            $statement = $this->dbconnection->prepare($query); // return a boolean value
            $status = $statement->execute($dataArray); // return a boolean value

            if ($status)
                Message::message("Success! Data has been updated.<br>");
            else
                Message::message("Failed! Data didn't updated.<br>");
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function delete_Update_Store($id) {
        $query = "DELETE FROM `course` WHERE `course`.`course_id` = $id";
        $dataArray = [$id];
        try {
            $statement = $this->dbconnection->prepare($query); // return a boolean value
            $status = $statement->execute($dataArray); // return a boolean value

            if ($status)
                Message::message("Success! Data has been deleted.<br>");
            else
                Message::message("Failed! Data didn't deleted.<br>");
        } catch (Exception $e) {
            echo $e->getMessage();
        }

    }
}