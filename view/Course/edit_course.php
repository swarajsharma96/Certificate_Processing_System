
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

$id = $_GET["update"];
$query = "SELECT * FROM `course` WHERE course_id = $id";
try {
    $statement = $dbInstance->prepare($query);
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
    <title>Course</title>

    <link rel="stylesheet" href="../../resources/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../../resources/css/font-awesome.min.css" />
    <link rel="stylesheet" href="../../resources/css/normalize.css" />
    <link rel="stylesheet" href="../../resources/css/dashboard.css" />
    <link rel="stylesheet" href="../../resources/css/add-course.css" />
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
                    <img src="../../resources/images/icons/add-course.png" alt="..." width="50">
                    <a href="#" class="h3">Courses</a>
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



    <section id="add-course">
        <div class="container">
            <div class="row">
            <div class="col-md-offset-3 col-sm-offset-3 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-div">
                        <p class="color-1 lead text-uppercase top">Edit Courses</p>
                        <form method="post" action="storeCourse.php">
                            <div class="form-group">
                                <label for="course-name">Course Name</label>
                                <input type="text" class="form-control" id="course-name" placeholder="Enter your course Name" name="courseName" value="<?php echo $courseName; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="course-credit">Course Credit</label>
                                <input type="number" class="form-control" id="course-credit" placeholder="Enter your course Credit" name="courseCredit" value="<?php echo $courseCredit; ?>" required>
                            </div>
                            <div hidden class="form-group">
                                <input type="number" class="form-control" name="courseID" value="<?php echo $id; ?>" required>
                            </div>
                            <div class="row last-row">
                                <p>
<!--                                    <a href="storeCourse.php?process=0&id=--><?php //echo $courseCredit ?><!--" class="btn btn-success back-btn">UPDATE</a>-->
                                    <input type="submit" class="btn btn-success" value="UPDATE" name="Submit">
                                </p>
                            </div>

                        </form>
                    </div>
                </div>
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
