
<?php

require_once ('../../vendor/autoload.php');

$studentID = $_GET['id'];
$applyID = $_GET['aid'];

$db = new \App\Model\Database();
$data = null;

$query = "SELECT * FROM `credit_details` cd WHERE cd.apply_id = $applyID";

try {
    $data = $db->retrieve($query);
} catch (PDOException $e) {
$e->getMessage();
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
                    <a href="#" class="h3">Exam Controller</a>
                </div>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right menu">
                    <li class="active"><a href="#">Credits Details<span class="sr-only">(current)</span></a></li>
                    <li><a href="../Login/logout.php?q=1" class="logout">Log out</a></li>
                </ul>
            </div>
        </div>
    </nav>
</section>

<section id="ec-form">
    <div class="container">
        <div class="row">
            <div class="col-md-offset-4 col-sm-offset-4 col-xs-offset-4 col-md-4 col-sm-4 col-xs-4 ">
                <a href="../view/view_form.php?id=<?php echo $studentID ;?>" name="Submit" class="btn btn-warning" target="_blank">View Application</a>
            </div>
            <br>
            <hr>
            <div class="row">
                <div class="col-md-5 co-sm-5 col-xs-12 ec-final-stage">
                    <div class="form-div">
                        <p class="head-text lead text-left text-capitalize reject">Clearance Info</p>
                        <div class="row fieldRows">
                            <table class="table table-hover table-responsive">
                                <tr>
                                    <th>SL. no</th>
                                    <th>Department</th>
                                    <th class="text-center">Clearance</th>
                                </tr>

                                <tr>
                                    <td class="h4">1</td>
                                    <td>Register <br>(First Stage)</td>
                                    <td>
                                        <p class="text-center"><i class="fa fa-check-circle" aria-hidden="true"></i></p>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="h4">2</td>
                                    <td>Exam Controller <br>(First Stage)</td>
                                    <td>
                                        <p class="text-center"><i class="fa fa-check-circle" aria-hidden="true"></i></p>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="h4">3</td>
                                    <td>Department</td>
                                    <td>
                                        <p class="text-center"><i class="fa fa-check-circle" aria-hidden="true"></i></p>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="h4">4</td>
                                    <td>Accounts</td>
                                    <td>
                                        <p class="text-center"><i class="fa fa-check-circle" aria-hidden="true"></i></p>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="h4">5</td>
                                    <td>Library</td>
                                    <td>
                                        <p class="text-center"><i class="fa fa-check-circle" aria-hidden="true"></i></p>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="h4">6</td>
                                    <td>GED</td>
                                    <td>
                                        <p class="text-center"><i class="fa fa-check-circle" aria-hidden="true"></i></p>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="h4">7</td>
                                    <td>Exam Controller <br>(Final Stage)</td>
                                    <td>
                                        <p class="text-center warning">on-progress... </p>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="h4">8</td>
                                    <td>Register <br>(Final Stage)</td>
                                    <td>
                                        <p class="text-center error">Rolling... </p>
                                    </td>
                                </tr>

                            </table>
                        </div>
                    </div>
                </div>


                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="form-div credit_and_course">
                        <p class="head-text lead text-center text-uppercase">Credit & Course Info</p>

                        <div class="row fieldRows">
                            <div class="col-md-5 col-sm-5 col-xs-5 propertyName">

                                <p><i class="fa fa-hand-o-right" aria-hidden="true"></i> &nbsp; &nbsp;Student ID<span class="start-mark">&ast;</span></p>
                            </div>
                            <div class="col-md-offset-1 col-sm-offset-1 col-md-6 col-sm-6 col-xs-7 propertyValue">
                                <p><?php echo $studentID ;?></p>
                            </div>
                        </div>

                        <div class="row fieldRows">
                            <div class="col-md-5 col-sm-5 col-xs-5 propertyName">
                                <p><i class="fa fa-hand-o-right" aria-hidden="true"></i> &nbsp; &nbsp;Total Credit<span class="start-mark">&ast;</span></p>
                            </div>
                            <div class="col-md-offset-1 col-sm-offset-1 col-md-6 col-sm-6 col-xs-7 propertyValue">
                                <p><?php echo $data['total_credit'] ;?></p>
                            </div>
                        </div>
                        <div class="row fieldRows">
                            <div class="col-md-5 col-sm-5 col-xs-5 propertyName">
                                <p><i class="fa fa-hand-o-right" aria-hidden="true"></i> &nbsp; &nbsp;Earned Credit<span class="start-mark">&ast;</span></p>
                            </div>
                            <div class="col-md-offset-1 col-sm-offset-1 col-md-6 col-sm-6 col-xs-7 propertyValue">
                                <p><?php echo $data['earned_credit'] ;?></p>
                            </div>
                        </div>
                        <div class="row fieldRows">
                            <div class="col-md-5 col-sm-5 col-xs-5 propertyName">
                                <p><i class="fa fa-hand-o-right" aria-hidden="true"></i> &nbsp; &nbsp;Credit Waiver</p>
                            </div>
                            <div class="col-md-offset-1 col-sm-offset-1 col-md-6 col-sm-6 col-xs-7 propertyValue">
                                <p><?php
                                    if (empty($data['credit_waiver']))
                                        echo '--' ;
                                    else
                                        echo $data['credit_waiver'];
                                    ?>
                                </p>
                            </div>
                        </div>
                        <div class="row fieldRows">
                            <div class="col-md-5 col-sm-5 col-xs-5 propertyName">
                                <p><i class="fa fa-hand-o-right" aria-hidden="true"></i> &nbsp; &nbsp;CGPA<span class="start-mark">&ast;</span></p>
                            </div>
                            <div class="col-md-offset-1 col-sm-offset-1 col-md-6 col-sm-6 col-xs-7 propertyValue">
                                <p><?php echo $data['result'] ;?></p>
                            </div>
                        </div>
                    </div>

                    <form action="ec_controller.php" method="post">
                        <div class="form-div new-form-div">
                            <div class="row">
                                <div class="col-md-offset-1 col-sm-offset-1 col-xs-offset-1 col-md-11 col-sm-11 col-xs-11">
                                    <div class="checkbox">
                                        <label class="propertyValue">
                                            <div class="col-md-12 text-capitalize">
                                                <input type="checkbox" value="1" name="approve" required>
                                                <span class="h5 approval-text"><i>I'm responsible for the information</i></span>
                                                <input type="text" name="applyID" value="<?php echo $applyID;?>" hidden>
                                            </div>

                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-offset-3 col-sm-offset-3 col-xs-offset-3 col-md-6 col-sm-6 col-xs-6">
                                    <button type="submit" name="Ec-Final_Stage" class="btn btn-success">Send to Register</button>
                                </div>
                            </div>
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
