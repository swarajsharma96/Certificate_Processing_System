<?php

session_start();

if (!isset($_SESSION['user_name'])) {
    header("Location: ../Login/login.php");
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Admin Panel</title>

    <link rel="stylesheet" href="../../resources/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../../resources/css/font-awesome.min.css" />
    <link rel="stylesheet" href="../../resources/css/normalize.css" />
    <link rel="stylesheet" href="../../resources/css/admin.css" />
    <script src="../../resources/js/scrollreveal.js"></script>

</head>
<body>

<section id="admin-feature">

    <div class="container">

        <div class="insider">
            <div class="row">
                <div class="container">
                    <div class="thumbnail">
                        <img src="../../resources/images/IMG_20190822_134138.png" alt="..." class="img-responsive" width="350" height="100">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-offset-3 col-md-6">

                    <div class="form-div">
                        <p class="lead text-uppercase text-left head-text">Search by student ID</p>
                        <form class="form-inline" method="post" action="../Search/search.php">
                            <div class="form-group col-sm-offset-2">
                                <p class="form-control-static">Student ID</p>
                            </div>

                            <div class="form-group">
                                <input type="text" name="student_id" class="form-control" id="inputPassword2" placeholder="Student ID" required>
                            </div>
                            <button type="submit" name="check" class="btn btn-warning">Check</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-offset-3 col-md-6">
                    <div class="btns-div">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <a href="../Student/create_student.php">
                                    <div class="block">
                                        <p><i class="fa fa-user-circle-o" aria-hidden="true"></i></p>
                                        <p class="btn-name">STUDENTS</p>
                                    </div>
                                </a>
                            </li>
                            <li class="list-group-item">
                                <a href="../Course/course.php">
                                    <div class="block">
                                        <p><i class="fa fa-plug" aria-hidden="true"></i></p>
                                        <p class="btn-name">COURSES</p>
                                    </div>
                                </a>
                            </li>
                            <li class="list-group-item">
                                <a href="../Login/edit.php?q=<?php echo $_SESSION['user_name']?>" >
                                    <div class="block">
                                        <p><i class="fa fa-id-card-o" aria-hidden="true"></i></p>
                                        <p class="btn-name">ADMIN-EDIT</p>
                                    </div>
                                </a>
                            </li>
                            <li class="list-group-item">
                                <a href="../Login/logout.php?q=1">
                                    <div class="block">
                                        <p><i class="fa fa-window-close" aria-hidden="true"></i></p>
                                        <p class="btn-name">LOG-out</p>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>


        </div>

    </div>

</section>


<script src="../../resources/js/jquery.min.js"></script>
<script src="../../resources/js/bootstrap.min.js"></script>
</body>
</html>
