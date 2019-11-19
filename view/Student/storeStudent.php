<?php
/**
 * Created by PhpStorm.
 * User: Shuva
 * Date: 8/2/2019
 * Time: 10:42 PM
 */

require_once ("../../vendor/autoload.php");

require_once ("../Others/ImageHandler.php");

use App\Message\Message;

$student = new \App\Student\Student();


if (isset($_POST['Submit'])) {

    if (isEmptyField($_POST)) {
        Message::message("Error! Please, Fill out all star marked field!");
        header("Location: create_student.php");

    } else {

        if ($student->isIdUnique($_POST['studentID'])) {
            header("Location: create_student.php");
        }

        else {

            if (isUpload($_FILES, 'profilePicture')) {
                // uploaded

                // checking is it an image or not
                if (isImage($_FILES, 'profilePicture')) {

                    $path = "Uploads/";

                    // Store image and renamed
                    $savedImageName = store($_FILES, $path, $_POST['studentID'], 'profilePicture');

                    // store the image file name into post super global variable
                    $_POST['profilePicture'] = $savedImageName;

                } else {
                    // If not image then send a message to user
                    Message::message("Please, Upload an image file..");
                    header("Location: create_student.php");
                }

            } else {
                // not uploaded
            }

            if ($student->storeStudent($_POST)) {
                $id = $_POST['studentID'];
                header("Location: view_student.php?id=$id");
            } else {
                header("Location: create_student.php");
            }

        }
    }

}



function isEmptyField($post) {
    if (strlen(trim($post['studentID'])) <= 2 && strlen(trim($post["studentName"])) <= 2 && isEmpty($post['Course']) && isEmpty($post['yearStart']) && isEmpty($post['yearEnd']) && strlen(trim($post['mobileNo'])) <= 10 ) {
        return true;
    } else {
        return false;
    }
}

