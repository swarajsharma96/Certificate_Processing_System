
<?php
require_once ('../../vendor/autoload.php');

if (!isset($_SESSION))
    session_start();

if (!isset($_SESSION['user_name'])) {
    header("Location: ../Login/login.php");
}

$studentID = $_GET['id'];
$applyID = $_GET['aid'];

$db = new \App\Model\Database();
$data = null;

$query = "SELECT * FROM `credit_details`c WHERE c.apply_id = $applyID";

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
                    <a href="#" class="h3">Accounts</a>
                </div>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right menu">
                    <li class="active"><a href="#">Account info<span class="sr-only">(current)</span></a></li>
                    <li><a href="#" class="logout">Log out</a></li>
                    <li><a href="../Home/admin-dashboard.php" class="logout">Home</a></li>
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
            <div class= "col-md-offset-2 col-sm-offset-1 col-md-8 col-sm-10 col-xs-12">
                <p class="show-id">ID -> <?php echo $studentID ;?></p>
                <div class="form-div">
                    <p class="lead text-uppercase text-center head-text">Accounts Info</p>
                    <div class="">
                        <form action="accounts_controller.php" method="post">

                            <div class="row">
                                <div class="col-md-offset-1 col-sm-offset-1 col-xs-offset-1 col-md-11 col-sm-11 col-xs-11">
                                    <div class="checkbox">
                                        <label class="propertyValue">
                                            <div class="col-md-4">
                                                <input type="checkbox" value="1" name="" id="discount">
                                                Discount &nbsp; &nbsp;
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" name="discount" id="text-box-1" disabled required>
                                            </div>
                                            <div class="col-md-offset-1 col-md-1">
                                                <i class="fa fa-percent" aria-hidden="true"></i>
                                            </div>

                                        </label>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-offset-2 col-sm-offset-2 col-xs-offset-1 col-md-11 col-sm-11 col-xs-11">
                                    <div class="finance">
                                        <label class="propertyValue">
                                            <span class="icon-color"><i class="fa fa-hand-o-right" aria-hidden="true"></i></span>
                                            Financial Clearance &nbsp; &nbsp;&nbsp; &nbsp;
                                        </label>

                                        <div class="radio-inline">
                                            <label class="propertyValue">
                                                <input type="radio" name="clearance" id="radio-yes" value="YES" >
                                                YES
                                            </label>
                                        </div>

                                        <div class="radio-inline">
                                            <label class="propertyValue">
                                                <input type="radio" name="clearance" id="radio-no" value="NO" checked>
                                                NO
                                            </label>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <br>
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
                                    <button type="submit" name="Submit" class="btn btn-default" id="submit-button" disabled>Submit</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-offset-2 col-md-8">
                <div class="form-div">
                    <p class="lead text-uppercase text-center head-text reject">Reject & Comments</p>
                    <div class="">
                        <form action="../Remarks/remarksController.php?aid=<?php echo $applyID; ?>" method="post">

                            <div class="row">
                                <div class="col-md-offset-1 col-sm-offset-1 col-xs-offset-1 col-md-11 col-sm-11 col-xs-11">
                                    <div class="checkbox">
                                        <label class="propertyValue">
                                            <div class="col-md-5">
                                                <input type="checkbox" value="1" name="checkbox" id="borrowed" required>
                                                Has any issue ? &nbsp; &nbsp;
                                            </div>
                                            <div class="col-md-7">
                                                <div style="display: block">
                                                    <span>Comments:</span>
                                                </div>
                                                <div style="display: block">
                                                    <textarea name="Remarks" id="remarks" cols="30" rows="6" placeholder="Write the reason for rejection of application" disabled required></textarea>
                                                </div>
                                            </div>

                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-offset-3 col-sm-offset-3 col-xs-offset-3 col-md-6 col-sm-6 col-xs-6">
                                    <input type="text" name="path" value="Accounts/accounts_dashboard.php" hidden>
                                    <button type="submit" name="REJECT" value="Account" class="btn btn-danger">Reject</button>
                                </div>

                            </div>

                        </form>
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

    document.getElementById('borrowed').onchange = function() {
        document.getElementById('remarks').disabled = !this.checked;
    };


    document.getElementById('radio-no').onchange = function() {
        document.getElementById('submit-button').disabled = true;
    };


    document.getElementById('radio-yes').onchange = function() {
        document.getElementById('submit-button').disabled = !this.checked;
    };





    document.getElementById('discount').onchange = function() {
        document.getElementById('text-box-1').disabled = !this.checked;
    };



    // change a non-editable field to editable field **
    document.getElementById('waiver3').onchange = function() {
        // document.getElementById('text-box-3').disabled = !this.checked;
        document.getElementById("text-box-3").readOnly=false;
    };
    // ** end


</script>


</body>
</html>
