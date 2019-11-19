<?php

require_once ("../../vendor/autoload.php");

$studentID = $_GET['id'];
$apply_hidden = null;

$db = new \App\Model\Database();

$query_first = "SELECT * FROM student s JOIN project_thesis p ON p.student_id = s.student_id JOIN documents d ON d.student_id = s.student_id JOIN apply a ON a.student_id = s.student_id RIGHT JOIN administrator ad ON ad.apply_id = a.apply_id WHERE s.student_id = '$studentID'";

if (isset($_REQUEST['q'])) {
    $query_first = "SELECT * FROM student s JOIN project_thesis p ON p.student_id = s.student_id JOIN documents d ON d.student_id = s.student_id WHERE s.student_id = '$studentID'";
    $apply_hidden = "hidden";
}

$dataRow = null;
$courseData = null;

try {
    $dataRow = $db->retrieve($query_first);

    $courseID = $dataRow['course_id'];
    $query_second = "SELECT * FROM course WHERE course_id = $courseID";

    $courseData = $db->retrieve($query_second);

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
    <title>View Info</title>

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
                    <a href="#" class="h3">Register</a>
                </div>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right menu">
                    <li class="active"><a href="#">Register<span class="sr-only">(current)</span></a></li>
                    <li><a href="#" class="logout">Log out</a></li>
                </ul>
            </div>
        </div>
    </nav>
</section>


<section id="form-body">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-8 col-xs-12">
                <div class="form-div">
                    <p class="head-text lead text-center text-uppercase">Profile Information</p>
                    <div class="row fieldRows">
                        <div class="col-md-3 col-sm-4 col-xs-5 propertyName">
                            <p>Apply Date<span class="start-mark">&ast;</span></p>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-7 propertyValue">
                            <p <?php echo $apply_hidden; ?> ><?php echo $dataRow['apply_date'] ;?></p>
                        </div>
                    </div>
                    <div class="row fieldRows">
                        <div class="col-md-3 col-sm-4 col-xs-5 propertyName">
                            <p>Student Name<span class="start-mark">&ast;</span></p>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-7 propertyValue">
                            <p><?php echo $dataRow['student_name'] ;?></p>
                        </div>
                    </div>
                    <div class="row fieldRows">
                        <div class="col-md-3 col-sm-4 col-xs-5 propertyName">
                            <p>Birth Date<span class="start-mark">&ast;</span></p>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-7 propertyValue">
                            <p><?php echo $dataRow['dob'] ;?></p>
                        </div>
                    </div>
                    <div class="row fieldRows">
                        <div class="col-md-3 col-sm-4 col-xs-5 propertyName">
                            <p>Student ID<span class="start-mark">&ast;</span></p>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-7 propertyValue">
                            <p><?php echo $dataRow['student_id'] ;?></p>
                        </div>
                    </div>
                    <div class="row fieldRows">
                        <div class="col-md-3 col-sm-4 col-xs-5 propertyName">
                            <p>Father Name<span class="start-mark">&ast;</span></p>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-7 propertyValue">
                            <p><?php echo $dataRow['father_name'] ;?></p>
                        </div>
                    </div>
                    <div class="row fieldRows">
                        <div class="col-md-3 col-sm-4 col-xs-5 propertyName">
                            <p>Mother Name<span class="start-mark">&ast;</span></p>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-7 propertyValue">
                            <p><?php echo $dataRow['mother_name'] ;?></p>
                        </div>
                    </div>
                    <div class="row fieldRows">
                        <div class="col-md-3 col-sm-4 col-xs-5 propertyName">
                            <p>Course<span class="start-mark">&ast;</span></p>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-7 propertyValue">
                            <p><?php echo $courseData['course_name'] ;?></p>
                        </div>
                    </div>
                    <div class="row fieldRows">
                        <div class="col-md-3 col-sm-4 col-xs-5 propertyName">
                            <p>Credit Hours<span class="start-mark">&ast;</span></p>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-7 propertyValue">
                            <p><?php echo $courseData['course_credit'] ;?></p>
                        </div>
                    </div>
                    <div class="row fieldRows">
                        <div class="col-md-3 col-sm-4 col-xs-5 propertyName">
                            <p>Staring Year<span class="start-mark">&ast;</span></p>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-7 propertyValue">
                            <p><?php echo $dataRow['year_start'] ;?></p>
                        </div>
                    </div>
                    <div class="row fieldRows">
                        <div class="col-md-3 col-sm-4 col-xs-5 propertyName">
                            <p>Ending Year<span class="start-mark">&ast;</span></p>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-7 propertyValue">
                            <p><?php echo $dataRow['year_end'] ;?></p>
                        </div>
                    </div>

                    <div class="row fieldRows">
                        <div class="col-md-3 col-sm-4 col-xs-5 propertyName">
                            <p>Contact No<span class="start-mark">&ast;</span></p>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-7 propertyValue">
                            <p><?php echo $dataRow['mobile_no'] ;?></p>
                        </div>
                    </div>

                    <div class="row fieldRows">
                        <div class="col-md-3 col-sm-4 col-xs-5 propertyName">
                            <p>Email<span class="start-mark">&ast;</span></p>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-7 propertyValue">
                            <p><?php echo $dataRow['email'] ;?></p>
                        </div>
                    </div>

                    <div class="row fieldRows">
                        <div class="col-md-3 col-sm-4 col-xs-5 propertyName">
                            <p>Project/Thesis<span class="start-mark">&ast;</span></p>
                        </div>
                        <div class="col-md-9 col-sm-9 col-xs-7 propertyValue">
                            <p><?php echo $dataRow['project_thesis_name'] ;?></p>
                        </div>
                    </div>
                    <div class="row fieldRows">
                        <div class="col-md-3 col-sm-4 col-xs-5 propertyName">
                            <p>Supervisor Name<span class="start-mark">&ast;</span></p>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-7 propertyValue">
                            <p><?php echo $dataRow['supervisor_name'] ;?></p>
                        </div>
                    </div>
                    <div class="row fieldRows">
                        <div class="col-md-3 col-sm-4 col-xs-5 propertyName">
                            <p>Designation<span class="start-mark">&ast;</span></p>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-7 propertyValue">
                            <p><?php echo $dataRow['designation'] ;?></p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="view-form-docs form-div">
                    <p class="lead text-uppercase text-center head-text">Profile Picture</p>
                    <div class="thumbnail">
                        <img src="../Student/Uploads/<?php echo $dataRow['profile_picture'] ;?>" alt="..." class="img-responsive" width="250px">
                    </div>
                </div>


            </div>
        </div>
    </div>
</section>

<section id="docs2">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-8 col-xs-12">
                <div class="form-div">
                    <p class="head-text lead text-center text-uppercase">Documents</p>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="thumbnail">
                                <img src="../Documents/Uploads/<?php echo $dataRow['ssc_certificate'] ;?>" alt="..." class="img-responsive" width="600px">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="thumbnail">
                                <img src="../Documents/Uploads/<?php echo $dataRow['ssc_transcript'] ;?>" alt="..." class="img-responsive" width="600px">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                                <?php
                                if (!empty($dataRow['hsc_certificate'])) {
                                    $hsc = $dataRow['hsc_certificate'];

                                    echo <<<Tag
                                    <div class="thumbnail">
                                        <img src="../Documents/Uploads/$hsc" alt="..." class="img-responsive" width="600px">
                                    </div>
Tag;
                                }
                                ?>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                                <?php
                                if (!empty($dataRow['hsc_transcript'])) {
                                    $hsc = $dataRow['hsc_transcript'];

                                    echo <<<Tag
                                    <div class="thumbnail">
                                        <img src="../Documents/Uploads/$hsc" alt="..." class="img-responsive" width="600px">
                                    </div>
Tag;
                                }
                                ?>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                                <?php
                                if (!empty($dataRow['honours_certificate'])) {
                                    $bsc = $dataRow['honours_certificate'];

                                    echo <<<Tag
                                    <div class="thumbnail">
                                        <img src="../Documents/Uploads/$bsc" alt="..." class="img-responsive" width="600px">
                                    </div>
Tag;
                                }
                                ?>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                                <?php
                                if (!empty($dataRow['bsc_transcript'])) {
                                    $bsc = $dataRow['bsc_transcript'];

                                    echo <<<Tag
                                    <div class="thumbnail">
                                        <img src="../Documents/Uploads/$bsc" alt="..." class="img-responsive" width="600px">
                                    </div>
Tag;
                                }
                                ?>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="thumbnail">
                                <img src="../Documents/Uploads/<?php echo $dataRow['certificate_fee'] ; ?>" alt="..." class="img-responsive" width="600px">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <?php
                            if (!empty($dataRow['nid'])) {
                                $nid = $dataRow['nid'];

                                echo <<<Tag
                                    <div class="thumbnail">
                                        <img src="../Documents/Uploads/$nid" alt="..." class="img-responsive" width="600px">
                                    </div>
Tag;
                            }
                            ?>
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


</script>


</body>
</html>
