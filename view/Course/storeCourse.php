<?php

require_once ("../../vendor/autoload.php");

$course = new \App\Course\Course();

// Storing ...
if (!isset($_REQUEST['courseID'])) {
    $course->store($_POST);
    header("Location: course.php");
}
// Updating ...
elseif (isset($_REQUEST['courseName']) && isset($_REQUEST['courseCredit']) && isset($_REQUEST['courseID'])) {
    $course->update($_POST);
    header("Location: course.php");
}
// Deleting ...
elseif (isset($_REQUEST['courseID'])) {
    $course->delete_Update_Store($_REQUEST['courseID']);
    header("Location: course.php");
}












