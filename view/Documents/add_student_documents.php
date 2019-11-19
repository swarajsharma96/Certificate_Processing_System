<?php
require_once ("../../vendor/autoload.php");

if (!isset($_SESSION))
    session_start();

use \App\Message\Message;
use \App\Model\Database;

$db = new Database();
$dbInstance = $db->getDbInstance();
$studentID = $_GET['id'];

$profilePicture = null;
$courseName = null;
$studentName = null;

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
    <link rel="stylesheet" href="../../resources/css/apply-for-certificate.css" />
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


    <section id="apply-certificate">
        <div class="container">
            <div class="row">
                <p class="color-1 lead text-capitalize text-center">
                    <?php
                    echo Message::message();
                    ?>
                </p>
                <div class="col-md-8 col-sm-12 col-xs-12">
                        <div class="form-div">
                                <form method="post" action="storeDocuments.php?id=<?php echo $studentID; ?>" enctype="multipart/form-data">
                                    <div class="form">
                                        <p class="color-1 text-uppercase p">* Edit Courses *</p>
                                        <div class="form-group">
                                                <label for="project-name">Project/Thesis Title <span>&ast;</span></label>
                                                <input type="text" class="form-control" id="project-name" placeholder="Enter project/thesis title" name="projectTitle" required>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label for="supervisor-name">Supervisor <span>&ast;</span></label>
                                                    <input type="text" class="form-control" id="supervisor-name" placeholder="Enter your project supervisor name" name="supervisorName" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label for="supervisor-mobile">Designation <span>&ast;</span></label>
                                                    <input type="text" class="form-control" id="supervisor-mobile" placeholder="Enter your project supervisor designation" name="designation" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive inside-table">
                                        <p class="p color-1 text-uppercase">* Important Documents * <br> <span class="margin-5">[ Scanned Documents and upload it as IMAGE ]</span></p>
                                        <table class="table table-condensed table-bordered">
                                            <tr>
                                                <th>Name</th>
                                                <th>Documents</th>
                                            </tr>
                                            <tr>
                                                <td>S.S.C <span>&ast;</span></td>
                                                <td>
                                                    <input type="file" id="SSC" name="SSC" accept="image/x-png,image/jpeg" required>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>S.S.C Transcript<span>&ast;</span></td>
                                                <td>
                                                    <input type="file" id="SSC" name="SSC-Transcript" accept="image/x-png,image/jpeg" required>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>H.S.C</td>
                                                <td>
                                                    <input type="file" name="HSC" id="HSC" accept="image/x-png,image/jpeg">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>H.S.C Transcript</td>
                                                <td>
                                                    <input type="file" name="HSC-Transcript" id="HSC" accept="image/x-png,image/jpeg">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>B.S.C</td>
                                                <td>
                                                    <input type="file" name="BSC" id="BSC" accept="image/x-png,image/jpeg">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>B.S.C Transcript <span>&ast;</span></td>
                                                <td>
                                                    <input type="file" name="BSC-Transcript" id="BSC" accept="image/x-png,image/jpeg" required>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>NID / Birth Certificate <span>&ast;</span></td>
                                                <td>
                                                    <input type="file" name="NID" id="NID" accept="image/x-png,image/jpeg" required>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Certificate Fee <span>&ast;</span></td>
                                                <td>
                                                    <input type="file" name="Fee" id="Fee" accept="image/x-png,image/jpeg" required>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <button type="submit" class="btn btn-success" name="Submit">NEXT</button>
                                    
                                </form>
                            </div>
                </div>
                <div class="col-md-4 col-sm-12 col-xs-12">
                    <div class="row std-info-corner">
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <div class="img-thumbnail">
                                <img src="../Student/Uploads/<?php echo $profilePicture;?>" alt="..." class="img-responsive">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6 profile">
                            <div>
                                <div class="col-md-12 col-sm-12 col-xs-12 profile-info">
                                    <p class="data"><?php echo $studentName;?></p>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12 profile-info">
                                    <p class="data"><?php echo $courseName;?></p>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12 profile-info">
                                    <p class="data">ID &rarr; <?php echo $studentID;?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row scroll-div">

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
