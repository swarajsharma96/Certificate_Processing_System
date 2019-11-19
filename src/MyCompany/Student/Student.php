<?php
/**
 * Created by PhpStorm.
 * User: Shuva
 * Date: 8/2/2019
 * Time: 11:41 AM
 */

namespace App\Student;
use App\Model\Database;
use App\Message\Message;
use http\Header;

class Student extends Database
{
    private $studentName, $studentId, $dob, $mobileNo, $email,
            $courseId, $yearStart, $yearEnd, $profilePicture, $fatherName, $motherName;

    public function __construct()
    {
        parent::__construct();
    }

    private function initVar($postArray)
    {
        if (array_key_exists("studentName", $postArray))
            $this->studentName = $postArray["studentName"];

        if (array_key_exists("studentID", $postArray))
            $this->studentId = $postArray["studentID"];

        if (array_key_exists("DOB", $postArray))
            $this->dob = $postArray["DOB"];

        if (array_key_exists("mobileNo", $postArray))
            $this->mobileNo = $postArray["mobileNo"];

        if (array_key_exists("Email", $postArray))
            $this->email = $postArray["Email"];

        if (array_key_exists("Course", $postArray))
            $this->courseId = $postArray["Course"];

        if (array_key_exists("yearStart", $postArray))
            $this->yearStart = $postArray["yearStart"];

        if (array_key_exists("yearEnd", $postArray))
            $this->yearEnd = $postArray["yearEnd"];

        if (array_key_exists("profilePicture", $postArray))
            $this->profilePicture = $postArray["profilePicture"];

        if (array_key_exists("F-Name", $postArray))
            $this->fatherName = $postArray["F-Name"];

        if (array_key_exists("M-Name", $postArray))
            $this->motherName = $postArray["M-Name"];
    }


    public function storeStudent($postArray)
    {
        $this->initVar($postArray);

        $query = "INSERT INTO `student` (`student_id`, `student_name`, `dob`, `mobile_no`, `email`, 
              `course_id`, `year_start`, `year_end`, `profile_picture`, `father_name`, `mother_name`) VALUES (?,?,?,?,?,?,?,?,?,?,?)";

        $dataArray = [$this->studentId, $this->studentName, $this->dob, $this->mobileNo, $this->email,
            $this->courseId, $this->yearStart, $this->yearEnd, $this->profilePicture, $this->fatherName, $this->motherName];

        $statement = $this->dbconnection->prepare($query); // return a boolean value

        $status = $statement->execute($dataArray); // return a boolean value

        if ($status) {
            return true;
        }
        else {
            Message::message("Failed! Data doesn't not insert.<br>");
            return false;
        }

    }

    public function isIdUnique($id) {
        $decision = false;

        $query = "SELECT student_id FROM `student` WHERE student_id= '$id' ";
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


    public function updateAndStore($postArray, $id) {

        $this->initVar($postArray);

        $updateQuery = null;

        if ($this->profilePicture !== null) {

            $updateQuery = "UPDATE `student` SET `student_id` = ?, `student_name` = ?, `dob` = ?, `mobile_no` = ?, `email` = ?, 
                        `course_id` = ?, `year_start` = ?, `year_end` = ?, `profile_picture` = ?, `father_name` = ?, `mother_name` = ? WHERE `student`.`student_id` = '$id'";

            $dataArray = [$this->studentId, $this->studentName, $this->dob, $this->mobileNo, $this->email,
                $this->courseId, $this->yearStart, $this->yearEnd, $this->profilePicture, $this->fatherName, $this->motherName];
        } else {

            $updateQuery = "UPDATE `student` SET `student_id` = ?, `student_name` = ?, `dob` = ?, `mobile_no` = ?, `email` = ?, 
                        `course_id` = ?, `year_start` = ?, `year_end` = ?, `father_name` = ?, `mother_name` = ? WHERE `student`.`student_id` = '$id'";
            $dataArray = [$this->studentId, $this->studentName, $this->dob, $this->mobileNo, $this->email,
                $this->courseId, $this->yearStart, $this->yearEnd, $this->fatherName, $this->motherName];
        }
        $statement = $this->dbconnection->prepare($updateQuery);

        $status = $statement->execute($dataArray);

        if ($status)
            Message::message("Success! Data has been updated.<br>");
        else
            Message::message("Failed! Data doesn't not Updated.<br>");
    }

}