<?php
require_once ("../../vendor/autoload.php");

if (!isset($_SESSION))
    session_start();

if (!isset($_SESSION['user_name'])) {
    header("Location: ../Login/login.php");
}

use \App\Message\Message;
use \App\Model\Database;


$db = new Database();
$dbInstance = $db->getDbInstance();

$id = $_REQUEST['id'];
$hidden = null;
if (isset($_REQUEST['q'])) {
    $hidden = "hidden";
}

$query = "SELECT * FROM `student` WHERE student_id = '$id'";

try {
    $statement = $dbInstance->prepare($query);
    $statement->execute();
    $data = $statement->fetch();
    $studentName = $data['student_name'];
    $dob = $data['dob'];
    $mobileNo = $data['mobile_no'];
    $email = $data['email'];
    $yearStart = $data['year_start'];
    $yearEnd = $data['year_end'];
    $courseId = $data['course_id'];
    $profilePicture = $data['profile_picture'];
    $fatherName = $data['father_name'];
    $motherName = $data['mother_name'];

    $courseQuery = "SELECT * FROM `course` WHERE course_id = $courseId";
    $statement = $dbInstance->prepare($courseQuery);
    $statement->execute();
    $data = $statement->fetch();

    $courseName = $data['course_name'];
    $courseCredit = $data['course_credit'];

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
    <link rel="stylesheet" href="../../resources/css/view-student.css" />
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



    <section id="student-creation">
        <div class="container">
            <div class="row">
                <p class="color-1 lead text-capitalize text-center">
                    <?php
                    echo Message::message();
                    ?>
                </p>
                <form class="form-horizontal" method="post">
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <p class="student-info-text">Student Details</p>
                        <div class="form-group">
                        <label for="student-name" class="col-sm-2 control-label">Student Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="student-name" value="<?php echo $studentName; ?>" readonly>
                        </div>
                        </div>
                        <div class="form-group">
                        <label for="student-id" class="col-sm-2 control-label">Student ID</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="student-id" value="<?php echo $id; ?>" readonly>
                        </div>
                        </div>
                        <div class="form-group">
                                <label for="course" class="col-sm-2 control-label">Course</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="course" value="<?php echo $courseName; ?>"  readonly>
                                </div>
                                </div>
                        <div class="form-group">
                            <label for="credit" class="col-sm-2 control-label">Credit</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="credit" value="<?php echo $courseCredit; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="dob" class="col-sm-2 control-label">Date of Birth</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control datepicker-calendar-container" id="dob" value="<?php echo $dob; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="mobile-no" class="col-sm-2 control-label">Mobile No</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="mobile-no" value="<?php echo $mobileNo; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="email" value="<?php echo $email; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="yearstart" class="col-sm-2 control-label">Year Start</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" id="yearstart" name="yearStart" value="<?php echo $yearStart; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="yearEnd" class="col-sm-2 control-label">Year End</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" id="yearEnd" name="yearEnd" value="<?php echo $yearEnd; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="f_name" class="col-sm-2 control-label">Father Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="f_name" name="F-Name" value="<?php echo $fatherName; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="m_name" class="col-sm-2 control-label">Mother Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="m_name" name="M-Name" value="<?php echo $motherName; ?>" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <p class="student-info-text">Profile Picture</p>
                            <div class="img-responsive">
                                <div class="thumbnail">
                                    <img src="Uploads/<?php echo $profilePicture; ?>" alt="..." class="img-responsive" width="250px" >
                                </div>
                            </div>

                            <div class="row last-row">
                                <div class="col-md-0 col-xs-0"></div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <a href="create_student.php" class="btn btn-success back-btn" <?php echo $hidden; ?> >REGISTRATION</a>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <a href="edit_student.php?id=<?php
                                            if (isset($_REQUEST['q']))
                                                echo $id.'&q=1';
                                            else
                                                echo $id;
                                            ?>" class="btn btn-warning back-btn">EDIT</a>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <a href="../Documents/add_student_documents.php?id=<?php echo $id; ?>" class="btn btn-danger back-btn">NEXT</a>
                                        </div>
                                    </div>
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
  </body>
</html>
