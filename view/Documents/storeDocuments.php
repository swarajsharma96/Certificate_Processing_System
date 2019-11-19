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
use \App\Documents\Documents;
use \App\ProjectThesis\Project;

$path = "../Documents/Uploads/";
$studentID = $_GET['id'];
$documentArray = [1=>'SSC', 2=>'HSC', 3=>'BSC', 4=>'Fee', 5=>'NID', 6=>'SSC-Transcript', 7=>'HSC-Transcript', 8=>'BSC-Transcript'];

$document = new Documents();
$project = new Project();

if (isset($_POST['Submit'])) {

    if ($project->isIdUnique($studentID)) {
        header("Location: add_student_documents.php?id=$studentID");

    } else {

        if (isEmptyField($_POST)) {
            Message::message("Error! Please, Fill out all star marked field!");
            header("Location: add_student_documents.php?id=$studentID");
        }
        else {

            for ($i = 1; $i<=8; $i++) {
                $imageFile = $documentArray[$i];

                if (isUpload($_FILES, $imageFile)) {
                    // uploaded

                    // checking is it an image or not
                    if (isImage($_FILES, $imageFile)) {

                        // Store image and renamed
                        $savedImageName = store($_FILES, $path, $studentID, $imageFile);

                        // store the image file name into post super global variable
                        $_POST[$imageFile] = $savedImageName;

                    } else {
                        // If not image then send a message to user
                        Message::message("Please, Upload an image file..");
                        header("Location: add_student_documents.php?id=$studentID");
                    }

                } else {
                    // not uploaded
                }
            }

            // store the student id into super global variable
            $_POST['studentID'] = $studentID;

            if ($document->storeDocuments($_POST) && $project->storeProject($_POST)) {
                $location = '../Apply/apply.php';
                header("Location: $location?id=$studentID");
            }

        }
    }

}

function isEmptyField($post) {
    if (strlen(trim($post['projectTitle'])) <= 2 && strlen(trim($post['supervisorName'])) <= 2) {
        return true;
    } else {
        return false;
    }
}




