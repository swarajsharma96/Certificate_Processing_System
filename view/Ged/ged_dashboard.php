
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

$query = "SELECT s.student_name, a.student_id, a.apply_date, a.apply_id FROM student s RIGHT JOIN apply a ON s.student_id = a.student_id RIGHT JOIN administrator ad ON ad.apply_id = a.apply_id WHERE ad.ged_status=0";
$statement = null;

try {
    $statement = $instance->query($query);
    $statement->execute();

} catch (\Exception $e) {
    echo $e->getMessage();
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>GED</title>

    <link rel="stylesheet" href="../../resources/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../../resources/css/font-awesome.min.css" />
    <link rel="stylesheet" href="../../resources/css/normalize.css" />
    <link rel="stylesheet" href="../../resources/css/dashboard.css" />
    <link rel="stylesheet" href="../../resources/css/register.css" />
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
                    <img src="../../resources/images/icons/register.svg" alt="..." width="50">
                    <a href="#" class="h3">GED</a>
                </div>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right menu">
                    <li class="active"><a href="#">Application List<span class="sr-only">(current)</span></a></li>
                    <li><a href="../Login/logout.php?q=1" class="logout">Log out</a></li>
                    <li><a href="../Login/edit.php?q=<?php echo $_SESSION['user_name']?>" class="logout">GED-Edit</a></li>
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
            <div class= "col-md-offset-2 col-sm-offset-1 col-md-8 col-sm-10 col-xs-12">
                <div class="form-div">
                    <p class="lead text-uppercase text-center head-text">Appeared</p>
                    <div class="front-div">
                        <div class="table-responsive table-div">
                            <table class="table table-bordered table-hover table-striped">
                                <tr>
                                    <th>Student ID</th>
                                    <th>Name</th>
                                    <th>Apply Date</th>
                                    <th>View</th>
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
                                            <a href="ged_form.php?id=$studentID&aid=$applyID" class="btn btn-success">NEXT</a>
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
