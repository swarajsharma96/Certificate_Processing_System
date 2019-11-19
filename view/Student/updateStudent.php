<?php

require_once ("../../vendor/autoload.php");

if (!isset($_SESSION))
    session_start();

if (!isset($_SESSION['user_name'])) {
    header("Location: ../Login/login.php");
}

// check if a file uploaded or not
if ($_FILES["profilePicture"]["size"] > 0) {

    // Check if its an image
    $check_if_image = getimagesize($_FILES["profilePicture"]["tmp_name"]);

    // check weather uploaded an image or another file
    if ($check_if_image !== false) {

        // Start of physically moving file to its destination
        $fileName = time().$_FILES["profilePicture"]["name"];

        // rename the picture
        $image_name = $_POST['studentID'];

        // destination path
        $destination = "Uploads/".basename($image_name.'.jpg');

        // move and upload
        move_uploaded_file($_FILES['profilePicture']['tmp_name'], $destination);

        // Start of the process to store file name to the table
        $_POST["profilePicture"] = $image_name.'.jpg';

    } else {
        // Uploaded an file which is not an image

    }
}

$student = new \App\Student\Student();

$previous_id = (int)$_REQUEST['id'];

$new_id = (int)$_POST['studentID'];


if ($previous_id == $new_id) {
    $student->updateAndStore($_POST, strval($previous_id));
    $new_id = strval($new_id);
    header("Location: view_student.php?id=$new_id");
} else {
    if ($student->isIdUnique(strval($new_id))) {
        header("Location: edit_student.php?id=$previous_id");
    } else {
        $student->updateAndStore($_POST, strval($previous_id));
        $new_id = strval($new_id);
        if (isset($_REQUEST['q'])) {
            if ($_REQUEST['q'] == 1) {
                header("Location: view_student.php?id=$new_id&q=1");
            }
        } else {
            header("Location: view_student.php?id=$new_id");
        }
    }
}




