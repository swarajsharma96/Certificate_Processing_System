<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../resources/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../../resources/css/font-awesome.min.css" />
    <link rel="stylesheet" href="../../resources/css/normalize.css" />
    <link rel="stylesheet" href="../../resources/css/dashboard.css" />
    <link rel="stylesheet" href="../../resources/css/confirmation.css" />
<!--    <link rel="stylesheet" href="../../resources/css/style.css">-->
    <title>Confirmation</title>
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
                    <img src="../../resources/images/icons/star-icon.svg" alt="..." width="50">
                    <a href="#" class="h3">Confirmation</a>
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



<section id="confirmation">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="thumbnail">
                    <img src="../../resources/images/woman-head-cap.png" alt="..." class="img-responsive" style="width: 250px;">
                </div>
            </div>
            <div class="col-md-12 col-sm1-12 col-xs-12">
                <p class="lead text-center">You have successfully Applied!</p>
                <p class="lead text-center">Please, Wait for Certificate & Transcript also</p>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <p class="text-center">
                    <a href="../Student/create_student.php" class="btn btn-success">Add More Student</a>
                </p>
            </div>
        </div>

    </div>
</section>

<footer>
    <p class="text-center text-capitalize h5">Copyright &copy; Developed by Department of CSE </p>
</footer>

</body>
</html>