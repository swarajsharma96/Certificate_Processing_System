<?php
require_once ("../../vendor/autoload.php");

if (!isset($_SESSION))
    session_start();

if (!isset($_SESSION['user_name'])) {
    header("Location: ../Login/login.php");
}

use \App\Message\Message;
use \App\Model\Database;

$id = $_REQUEST['id'];

$db = new Database();
$dbInstance = $db->getDbInstance();

$studentQuery = "SELECT * FROM `student` WHERE student_id = '$id'";
$statement = $dbInstance->prepare($studentQuery);

$statement->execute();
$data = $statement->fetch();

$studentName =$data['student_name'];
$dob = $data['dob'];
$mobile_no = $data['mobile_no'];
$email = $data['email'];
$selected_course_id = $data['course_id'];
$yearStart = $data['year_start'];
$yearEnd = $data['year_end'];
$picture = $data['profile_picture'];
$fatherName = $data['father_name'];
$motherName = $data['mother_name'];

$query = "SELECT * FROM `course`";
$courseCredit = array();

try {
    $statement = $dbInstance->prepare($query);
    $statement->execute();
} catch (PDOException $e) {
    echo $e->getMessage();
}


?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Registration</title>

    <link rel="stylesheet" href="../../resources/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../../resources/css/font-awesome.min.css" />
    <link rel="stylesheet" href="../../resources/css/normalize.css" />
    <link rel="stylesheet" href="../../resources/css/dashboard.css" />
    <link rel="stylesheet" href="../../resources/css/student.css" />
    <script src="../../resources/js/scrollreveal.js"></script>
  </head>
  <body>
    <section class="navigation-bar">
        <nav class="navbar navbar-default">
            <div class="container">
                <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="brand navbar-brand">
                    <img src="../../resources/images/icons/registration.png" alt="..." width="50">
                    <a href="#" class="h3">Registration</a>
                </div>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right menu">
                    <li class="active"><a href="#">Admin <span class="sr-only">(current)</span></a></li>
                    <li><a href="../Login/logout.php?q=1" class="logout">Log out</a></li>
                    <li><a href="../Home/admin.php" class="logout">Dashboard</a></li>
                </ul>
                </div>
            </div>
        </nav>
    </section>



    <section id="student-edit">
        <div class="container">
            <div class="row">
                <div class="message">
                    <p class="color-1 lead text-capitalize text-center">
                        <?php
                        echo Message::message();
                        ?>
                    </p>
                </div>

                <form class="form-horizontal" method="post" action="updateStudent.php?id=<?php echo $id; ?>&q=1" enctype="multipart/form-data">

                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <p class="student-info-text">Student Details</p>

                        <div class="form-group">
                        <label for="student-name" class="col-sm-2 control-label">Student Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="student-name" name="studentName" placeholder="Enter your name"  value="<?php echo $studentName;?>" required>
                        </div>
                        </div>

                        <div class="form-group">
                        <label for="student-id" class="col-sm-2 control-label">Student ID</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="student-id" name="studentID" placeholder="Enter your ID" value="<?php echo $id;?>" required>
                        </div>
                        </div>

                        <div class="form-group">
                        <label for="course" class="col-sm-2 control-label">Course</label>
                        <div class="col-sm-10">
                            <select name="Course" id="course" class="form-control" onchange="showCredit()" required>
                                <option value="none">Select your Course</option>

                                <?php

                                    while ($courses = $statement->fetch()) {
                                        $courseName = $courses["course_name"];
                                        $courseID = $courses['course_id'];
                                        $courseCredit[$courseID] = $courses["course_credit"];

                                        if ($selected_course_id == $courseID) {
                                            echo <<<Tag
                                                <option value="$courseID" selected>$courseName</option>
Tag;
                                        } else {
                                            echo <<<Tag
                                            <option value="$courseID">$courseName</option>
Tag;
                                        }
                                    }

                                ?>

                            </select>
                        </div>
                        </div>

                        <div class="form-group">
                            <label for="credit" class="col-sm-2 control-label">Credit</label>
                            <div class="col-sm-4 readOnlyField">
                                <input type="text" class="form-control" id="credit" name="Credit" placeholder="Course credit" value="<?php echo $courseCredit[$selected_course_id];?>" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="dob" class="col-sm-2 control-label">Date of Birth</label>
                            <div class="col-sm-4">
                                <input type="date" class="form-control datepicker-calendar-container" id="dob" name="DOB" value="<?php echo $dob ; ?>" placeholder="Enter your date of birth" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="mobile-no" class="col-sm-2 control-label">Mobile No</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="mobile-no" name="mobileNo" value="<?php echo $mobile_no ; ?>" placeholder="Enter your mobile number" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="email" name="Email" value="<?php echo $email ; ?>" placeholder="Enter your email" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="yearstart" class="col-sm-4 control-label">Year Start</label>
                                    <div class="col-sm-8">
                                        <input type="date" class="form-control" id="yearstart" value="<?php echo $yearStart ; ?>" name="yearStart" required>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="yearEnd" class="col-sm-4 control-label">Year End</label>
                                    <div class="col-sm-8">
                                        <input type="date" class="form-control" id="yearEnd" value="<?php echo $yearEnd ; ?>" name="yearEnd" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="f_name" class="col-sm-4 control-label">Father Name</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="f_namae" value="<?php echo $fatherName ; ?>" name="F-Name" required>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="m_name" class="col-sm-4 control-label">Mother Name</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="m_name" value="<?php echo $motherName ; ?>" name="M-Name" required>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>

                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <p class="student-info-text">Profile Picture</p>
                            <div class="img-responsive">
                                <div class="thumbnail">
                                    <img src="Uploads/<?php echo $picture?>" alt="<?php echo $picture?>" class="img-responsive" id="profilePicture" width="250">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="img-input-file">
                                    <input type="file" id="img-input" name="profilePicture" class="form-control-static">
                                </div>
                            </div>

                            <div class="row last-row">
                                <div class="col-md-0 col-xs-0"></div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <button class="btn btn-success" type="submit" name="Submit" value="store">UPDATE</button>
                                </div>
                            </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <footer>
        <p class="text-center text-capitalize h5">Copyright &copy; Developed by Department of CSE</p>
    </footer>


    
    <script src="../../resources/js/jquery.min.js"></script>
    <script src="../../resources/js/bootstrap.min.js"></script>


    <script>

        // for fade out the session message
        $(function ($) {
            $(".message").fadeOut(3000)
        });



        //  change the credit  value dynamically
        function showCredit() {
            var selectComboBox = document.getElementById("course");
            var userInput = selectComboBox.options[selectComboBox.selectedIndex].value;
            console.log(userInput);

            var credit = <?php echo json_encode($courseCredit); ?>;
            document.getElementById("credit").value = credit[userInput];
            console.log(credit[userInput]);
        }

        // view profile picture
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#profilePicture').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#img-input").change(function() {
            readURL(this);
        });

    </script>


  </body>
</html>
