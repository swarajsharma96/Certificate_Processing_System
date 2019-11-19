
<?php

use App\Model\Database;

require_once('../../vendor/autoload.php');

if (!isset($_SESSION))
    session_start();

if (!isset($_SESSION['user_name'])) {
    header("Location: ../Login/login.php");
}

$id = null;
if (isset($_REQUEST['q'])) {
    $id = $_REQUEST['q'];
}

//if (isset($_POST['Reset'])) {
//    $reset_query = "DELETE FROM `apply` WHERE `apply`.`student_id` = '$id'";
//    $db = new Database();
//    try {
//        if ($db->delete_Update_Store($reset_query)) {
//            header("Location: ../Home/admin.php");
//        }
//    } catch (PDOException $e) {
//        $e->getMessage();
//    }
//}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Reject</title>

    <link rel="stylesheet" href="../../resources/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="../../resources/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="../../resources/css/normalize.css"/>
    <link rel="stylesheet" href="../../resources/css/dashboard.css"/>
    <link rel="stylesheet" href="../../resources/css/register.css"/>
    <script src="../../resources/js/scrollreveal.js"></script>
</head>
<body>

<section id="reject">
    <div class="container">
        <div class="row">
            <div class="col-md-offset-1 col-sm-offset-1 col-md-10 col-sm-10 col-xs-12">
                <div class="thumbnail">
                    <img src="../../resources/images/icons/reject.png" alt="..." width="200" class="img-responsive">
                </div>
                <p class="lead complete-message reject-message">Your Application Have Rejected!</p>
                <form action="resetController.php?id=<?php echo $id; ?>" method="post">
                    <button type="submit" name="Reset" class="btn btn-info">RESET-Apply</button>
                </form>
            </div>
        </div>
    </div>
</section>

<script src="../../resources/js/jquery.min.js"></script>
<script src="../../resources/js/bootstrap.min.js"></script>

</body>
</html>
