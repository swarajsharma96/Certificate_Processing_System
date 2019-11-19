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
$instance = $db->getDbInstance();

$query = "SELECT s.student_name, a.student_id, a.apply_date, a.apply_id FROM student s RIGHT JOIN apply a ON s.student_id = a.student_id RIGHT JOIN administrator ad ON ad.apply_id = a.apply_id WHERE ad.register_status=0";
$statement = null;

$finalAppearedQuery = "SELECT s.student_name, a.student_id, a.apply_date, a.apply_id FROM student s RIGHT JOIN apply a ON s.student_id = a.student_id RIGHT JOIN administrator ad ON ad.apply_id = a.apply_id WHERE ad.register_status=1";
$finalStatement = null;

try {
    $statement = $instance->query($query);
    $statement->execute();

    $finalStatement = $instance->query($finalAppearedQuery);
    $finalStatement->execute();

} catch (\Exception $e) {
    echo $e->getMessage();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Register</title>

    <link rel="stylesheet" href="../../resources/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="../../resources/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="../../resources/css/normalize.css"/>
    <link rel="stylesheet" href="../../resources/css/dashboard.css"/>
    <link rel="stylesheet" href="../../resources/css/register.css"/>
</head>
<body>


<section class="navigation-bar">
    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="brand navbar-brand">
                    <img src="../../resources/images/icons/register.svg" alt="..." width="50">
                    <a href="#" class="h3">Register</a>
                </div>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right menu">
                    <li class="active"><a href="#">Register<span class="sr-only">(current)</span></a></li>
                    <li><a href="../Login/logout.php?q=1" class="logout">Log out</a></li>
                    <li><a href="../Login/edit.php?q=<?php echo $_SESSION['user_name']?>" class="logout">REGISTER-Edit</a></li>
                </ul>
            </div>
        </div>
    </nav>
</section>

<section id="register">
    <div class="container">
        <div class="message">
            <p class="color-1 lead text-capitalize text-center">
                <?php
                echo Message::message();
                ?>
            </p>
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="form-div">
                    <p class="lead text-uppercase text-center head-text">New Appeared</p>
                    <div class="front-div">
                        <div class="table-responsive table-div">
                            <table class="table table-bordered table-hover ">
                                <tr>
                                    <th class="text-center text-capitalize">Student ID</th>
                                    <th class="text-center text-capitalize">Name</th>
                                    <th class="text-center text-capitalize">Apply Date</th>
                                    <th class="text-center text-capitalize">View</th>
                                </tr>

                                <?php

                                while ($dataRow = $statement->fetch()) {
                                    $studentID = $dataRow['student_id'];
                                    $apply_date = $dataRow['apply_date'];
                                    $studentName = $dataRow['student_name'];
                                    $applyID = $dataRow['apply_id'];
                                    echo <<<Tag
                                    <tr>
                                        <td>$studentID</td>
                                        <td>$studentName</td>
                                        <td>$apply_date</td>
                                        <td>
                                            <a href="view_form.php?id=$studentID&aid=$applyID" class="btn btn-success">VIEW</a>
                                        </td>
                                    </tr>
Tag;
                                }

                                ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="form-div">
                    <p class="lead text-uppercase text-center head-text">Completed</p>
                    <div class="front-div">
                        <div class="table-responsive table-div">
                            <table class="table table-condensed table-bordered table-hover table-striped">
                                <tr>
                                    <th class="text-center text-capitalize">Student ID</th>
                                    <th class="text-center text-capitalize">Name</th>
                                    <th class="text-center text-capitalize">Apply Date</th>
                                    <th class="text-center text-capitalize">View</th>
                                </tr>
                                <?php

                                while ($finalData = $finalStatement->fetch()) {
                                    $studentID = $finalData['student_id'];
                                    $apply_date = $finalData['apply_date'];
                                    $studentName = $finalData['student_name'];
                                    $applyID = $finalData['apply_id'];
                                    echo <<<Tag
                                    <tr rowspan="2">
                                        <td>$studentID</td>
                                        <td>$studentName</td>
                                        <td>$apply_date</td>
                                        <td>
                                            <a href="register_newAppeared_form.php?id=$studentID&aid=$applyID" class="btn btn-success">VIEW</a>
                                            <form action="registerFormController.php?id=$studentID&aid=$applyID"" method="post" style="margin: 4px 0;">
                                            <button class="btn btn-warning" name="approve">APPROVE</button>
</form>
                                        </td>
                                    </tr>
Tag;
                                }

                                ?>
                            </table>
                        </div>
                    </div>
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


<script>

    // for fade out the session message
    $(function ($) {
        $(".message").fadeOut(3000)
    });


</script>


</body>
</html>
