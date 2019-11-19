
<?php

require_once('../../vendor/autoload.php');

if (!isset($_SESSION))
    session_start();

if (!isset($_SESSION['user_name'])) {
    header("Location: ../Login/login.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Not-Found</title>

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
                    <img src="../../resources/images/icons/error.png" alt="..." width="200" class="img-responsive">
                </div>
                <p class="lead complete-message reject-message">Not Found! Try Another...</p>
            </div>
        </div>
    </div>
</section>

<script src="../../resources/js/jquery.min.js"></script>
<script src="../../resources/js/bootstrap.min.js"></script>

</body>
</html>
