<?php

use App\Message\Message;

require_once('../../vendor/autoload.php');

if (!isset($_SESSION))
    session_start();

if (!isset($_SESSION['user_name'])) {
    header("Location: ../Login/login.php");
}


$data = null;
$profile_picture = null;
$apply_warning_class = null;
$document_class = null;
$profile_picture_path = null;
$apply_now_path = null;
$present_clearance_status = null;
$appearing_text = "hidden";
$isBtnActive = null;
$iframe = "hidden";
$clearance = "hidden";
$success = "hidden";
$not_found = 'hidden';
$div_hidden = '';
$isShow = 'hidden';

function hasId($id, $db) {
    $checking_query = "SELECT COUNT(student_id) as student FROM `student`s WHERE s.student_id = '$id'";
    $count = $db->retrieve($checking_query);

    if ($count['student'] == 1) {
        return true;
    } else {
        return false;
    }
}

if (isset($_POST['check']) || isset($_REQUEST['id']) ) {
    $studentID = null;

    if (!isset($_POST['student_id']) || trim($_POST['student_id']) == '') {
        header("Location: ../Home/admin.php");
    } else {

        $studentID = $_POST['student_id'];

        $db = new \App\Model\Database();

        // if id found then execute if block. if not found then execute else block

        if (hasId($studentID, $db)) {

            $query = "SELECT s.profile_picture, d.student_id as docs, a.apply_id as apply FROM student s LEFT JOIN documents d 
                    ON d.student_id = s.student_id LEFT JOIN apply a ON a.student_id = s.student_id 
                    WHERE s.student_id = '$studentID'";

            try {
                $data = $db->retrieve($query);

                $isDocumentFound = $data['docs'];
                $isApply = $data['apply'];
                $isProfilePictureFound = $data['profile_picture'];

                if (!empty($isProfilePictureFound)) {

                    $profile_picture_path = "../Student/Uploads/$isProfilePictureFound";

                    if (empty($isApply)) {
                        $apply_warning_class = "";
                        $clearance = "hidden";

                    } else {

                        $reject_or_success_query = "SELECT a.apply_id, a.progress FROM apply a WHERE a.student_id = '$studentID'";
                        $progress = $db->retrieve($reject_or_success_query);
                        // check if the application is rejected or not
                        if ($progress['progress'] == -1) {
                            // rejected the application in the past
                            $iframe = "";
                            $apply_warning_class = "hidden";
                        } elseif ($progress['progress'] == 0) {
                            // Your certificate & transcript is appeared
                            $iframe = "hidden";
                            $apply_warning_class = "hidden";
                            $success = "";
                        } else {
                            $apply_warning_class = "hidden";
                            $clearance = "";
                            $clearance_query = "SELECT * FROM `administrator` ad WHERE ad.apply_id = (SELECT a.apply_id FROM apply a WHERE a.student_id = '$studentID')";
                            $clearance_data = $db->retrieve($clearance_query);
                            if ($clearance_data['register_status'] == 0)
                                $present_clearance_status = "Register (First-Stage)";
                            if ($clearance_data['ec_status'] == 0)
                                $present_clearance_status = "Exam-Controller(First-Stage)";
                            if ($clearance_data['dept_status'] == 0)
                                $present_clearance_status = "Department";
                            if ($clearance_data['account_status'] == 0)
                                $present_clearance_status = "Account";
                            if ($clearance_data['lib_status'] == 0)
                                $present_clearance_status = "Library";
                            if ($clearance_data['ged_status'] == 0)
                                $present_clearance_status = "GED";
                            if ($clearance_data['register_status'] == 1) {
                                $present_clearance_status = "Register (Final-Stage)";
                                $appearing_text = "";
                            }
                            if ($clearance_data['ec_status'] == 1)
                                $present_clearance_status = "Exam-Controller(Final-Stage)";

                        }

                    }


                    if (empty($isDocumentFound)) {
                        $isDocumentFound = false;
                        $document_class = "";
                        $add_documents_path = "../Documents/add_student_documents.php?id=$studentID";
                        $view = "../Student/view_student.php?id=$studentID&q=1";
                        $docs_clearance = "hidden";
                        $isShow = "hidden";
                        $isBtnActive = "hidden";
                    } else {
                        $document_class = "hidden";
                        $apply_query = "SELECT count(*) AS find FROM `apply` WHERE student_id = '$studentID'";
                        $data_row = $db->retrieve($apply_query);
                        if ($data_row['find'] == 1)
                            $view = "../view/view_form.php?id=$studentID";
                        else
                            $view = "../view/view_form.php?id=$studentID&q=1";
                        $docs_clearance = "";
                        $isBtnActive = "";
                    }

                    if (empty($isApply) && !empty($isDocumentFound)) {
                        $apply_now_path = "../Apply/apply.php?id=$studentID";
                        $isShow = "";
                    }
                } else {

                }

            } catch (PDOException $e) {
                $e->getMessage();
            }

        } else {

            $not_found = '';
            $div_hidden = 'hidden';

        }

    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Searched Info</title>

    <link rel="stylesheet" href="../../resources/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="../../resources/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="../../resources/css/normalize.css"/>
    <link rel="stylesheet" href="../../resources/css/dashboard.css"/>
    <link rel="stylesheet" href="../../resources/css/register.css"/>
    <script src="../../resources/js/scrollreveal.js"></script>
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
                    <img src="../../resources/images/icons/registration.png" alt="..." width="50">
                    <a href="#" class="h3">Search</a>
                </div>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right menu">
                    <li class="active"><a href="#">Admin<span class="sr-only">(current)</span></a></li>
                    <li><a href="../Home/admin.php" class="logout">Home</a></li>
                </ul>
            </div>
        </div>
    </nav>
</section>

<section id="search">
    <div class="container">
        <div class="row">
            <p class="lead complete-message">Search Complete!</p>
            <div class="col-md-3" <?php echo $div_hidden ;?>>
                <div class="row">
                    <div class="col-md-10 pp">
                        <div class="btns">
                            <a href="searchController.php?id=<?php echo $studentID?>&q=1" class="btn btn-warning text-capitalize">Delete Student</a>
                        </div>
                        <div class="btns">
                            <a href="searchController.php?id=<?php echo $studentID?>&q=0" class="btn btn-danger text-capitalize"<?php echo $isBtnActive; ?> >Delete Documents</a>
                        </div>

                        <div class="thumbnail">
                            <img src="<?php echo $profile_picture_path; ?>" alt="..."
                                 class="img-responsive" width="250">
                        </div>
                        <div class="btns">
                            <a href="<?php echo $view ;?>" class="btn btn-success text-capitalize" target="_blank">View Data</a>
                        </div>
                        <div class="btns">
                            <form action="" method="post">
                                <input type="text" name="student_id" value="<?php echo $studentID;?>" class="form-control" id="inputPassword2" placeholder="Student ID" hidden>
                                <button type="submit" name="check" class="btn btn-warning">Reload</button>
                            </form>
                        </div>
                        <div class="btns" >
                            <a href="<?php echo $add_documents_path ;?>" class="btn btn-info text-capitalize" target="_blank" <?php echo $document_class; ?>>Add Documents</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6" <?php echo $div_hidden ;?>>
                <div <?php echo $apply_warning_class; ?> >
                    <div class="thumbnail not-apply">
                        <img src="../../resources/images/icons/not-applied.png" alt="..." width="200"
                             class="img-responsive">
                    </div>
                    <p class="complete-message isApplied lead text-center" >Not Applied Yet!</p>
                    <div class="btns">
                        <a href="<?php echo $apply_now_path ;?>" class="btn btn-info text-capitalize" <?php echo $isShow; ?>>Apply-Now!</a>
                    </div>
                </div>
                <div class="form-div" <?php echo $clearance; ?>>
                    <p class="head-text lead text-center text-capitalize reject">Clearance-Info (Present Application Status)</p>
                    <div class="row">
                        <div class="col-md-12">
                            <p class="lead text-center"><span style="color: red"><i class="fa fa-paper-plane" aria-hidden="true"></i></span>
                                <span style="color: #fc8c0c" class="head-text status"><?php echo $present_clearance_status;?></span></p>

                            <p class="lead text-center" <?php echo $appearing_text?> >Your Certificate & Transcript on way...!</p>
                        </div>
                    </div>
                </div>
                <div <?php echo $iframe ;?>>
                    <div class="form-div">
                        <iframe src="reject.php?q=<?php echo $studentID; ?>" height="400" width="100%"></iframe>
                    </div>
                </div>
                <div <?php echo $success ;?>>
                    <div class="form-div">
                        <iframe src="success.php" height="400" width="100%"></iframe>
                    </div>
                </div>
            </div>

            <div class="col-md-offset-3 col-md-6 col-sm-offset-2 col-sm-8 col-xs-12" <?php echo $not_found ;?>>

                <div>
                    <div class="form-div">
                        <iframe src="not-found.php" height="400" width="100%"></iframe>
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

</body>
</html>
