<?php
require_once ("../../vendor/autoload.php");

if (!isset($_SESSION))
    session_start();

use \App\Message\Message;
use \App\Model\Database;

$db = new Database();
$dbInstance = $db->getDbInstance();
$studentID = $_GET['id'];

$query = "SELECT s.student_id, s.student_name, s.profile_picture, c.course_name FROM student s JOIN course c ON c.course_id= s.course_id WHERE s.student_id = '$studentID'";

try {
    $statement = $dbInstance->prepare($query);
    $statement->execute();
    $data = $statement->fetch();

    $studentName = $data['student_name'];
    $courseName = $data['course_name'];
    $profilePicture = $data['profile_picture'];

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
    <link rel="stylesheet" href="../../resources/css/applyFor.css" />
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
                    <img src="../../resources/images/icons/send.png" alt="..." width="50">
                    <a href="#" class="h3">Applying For</a>
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

    <section id="apply-for">
        <div class="container">
            <div class="row">
                <p class="color-1 lead text-capitalize text-center message">
                    <?php
                    echo Message::message();
                    ?>
                </p>

                <div class="col-md-5 col-sm-7 col-xs-12">
                    <div class="img-thumbnail">
                        <img src="../../resources/images/icons/smile.gif" alt="" class="img-responsive">
                    </div>
<!--                    <p class="h1 red greetings-1">Congratulations!</p>-->
                    <p class="greetings-2">You have successfully filled up your information.</p>
                </div>
                <div class="col-md-4 col-sm-12 col-xs-12">
                    <table class="table-responsive table table-condensed table-bordered">
                        <tr>
                            <td class="property_name">Name</td>
                            <td class="property_body"><?php echo $studentName; ?></td>
                        </tr>
                        <tr class="">
                            <td class="property_name">ID</td>
                            <td class="property_body"><?php echo $studentID; ?></td>
                        </tr>
                        <tr class="">
                            <td class="property_name">Course</td>
                            <td class="property_body"><?php echo $courseName; ?></td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-3">
                    <div class="img-thumbnail">
                        <img src="../Student/Uploads/<?php echo $profilePicture; ?>" alt="..." class="img-responsive" width="200">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="confirmation color-1">
                        <p class="greeting-text">Hi <span class="text-uppercase strong"><?php echo $studentName?>!</span></p>
                        <p>Please, Hit the <span class="text-uppercase strong">Apply</span> button if you want to apply for certificate now!</p>
                        <p class="confirmation-font-size">
                            <span class="declaimer">Declaimer 1:</span>
                            <span class="declaimer-body">
                            Generally it will takes <span class="number strong">20</span> Working Days (approx.) to complete the whole process for getting certificate and transcript.
                        </span>
                        </p>
                        <p class="confirmation-font-size"><span class="declaimer">Declaimer 2:</span>
                            <span class="declaimer-body">
                            If you provide any wrong information then your application will reject that will notified you by <span class="strong">Email</span>.
                        </span></p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <form action="storeApply.php?id=<?php echo $studentID?>" method="post">
                        <button type="submit" name="Submit" class="text-uppercase lead btn btn-success">Apply</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <p class="text-center text-capitalize h5">Copyright &copy; Developed by Department of CSE</p>
    </footer>




    <script src="../../resources/js/jquery.min.js"></script>
    <script src="../../resources/js/bootstrap.min.js"></script>
    <!-- custom script -->
    <script>

        // for fade out the session message
        $(function ($) {
            $(".message").fadeOut(3000)
        });


    </script>

  </body>
</html>
