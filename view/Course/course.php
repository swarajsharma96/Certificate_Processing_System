
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
    $dbInstance = $db->getDbInstance();

    $query = "SELECT * FROM `course` ORDER BY course_id DESC";
    try {
        $statement = $dbInstance->prepare($query);
        $statement->execute();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }


?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Course</title>

    <link rel="stylesheet" href="../../resources/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../../resources/css/font-awesome.min.css" />
    <link rel="stylesheet" href="../../resources/css/normalize.css" />
    <link rel="stylesheet" href="../../resources/css/dashboard.css" />
    <link rel="stylesheet" href="../../resources/css/add-course.css" />
    <script src="../../resources/js/scrollreveal.js"></script>
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
                    <img src="../../resources/images/icons/add-course.png" alt="..." width="50">
                    <a href="#" class="h3">Courses</a>
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



    <section id="add-course">
        <div class="container">
            <div class="row">
                <div class="message">
                    <p class="color-1 lead text-capitalize text-center">
                        <?php
                            echo Message::message();
                        ?>
                    </p>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="form-div">
                        <p class="color-1 lead text-uppercase top">Add Courses</p>
                        <form method="post" action="storeCourse.php">
                            <div class="form-group">
                                <label for="course-name">Course Name</label>
                                <input type="text" class="form-control" id="course-name" placeholder="Enter your course Name" name="courseName" required>
                            </div>
                            <div class="form-group">
                                <label for="course-credit">Course Credit</label>
                                <input type="number" class="form-control" id="course-credit" placeholder="Enter your course Credit" name="courseCredit" required>
                            </div>
                            <button type="submit" class="btn btn-success">SAVE</button>
                        </form>
                    </div>
                </div>
                <div class="col-md-8 col-sm-8 col-xs-12">
                    <p class="course-head-text color-1">List of courses</p>
                    <div class="scroll-div">
                        <div class="my-table table-responsive">
                            <table class="table table-bordered table-striped table-hover table-condensed">
                                <tr>
                                    <th class="text-uppercase">No</th>
                                    <th class="text-uppercase">Course Name</th>
                                    <th class="text-uppercase">Credit</th>
                                    <th hidden>ID</th>
                                    <th class="text-uppercase">Operation</th>

                                </tr>
                                <?php

                                $serialNo = 0;
                                while ($data = $statement->fetch()) {
                                    $serialNo += 1;
                                    $courseName = $data['course_name'];
                                    $courseCredit = $data['course_credit'];
                                    $id = $data['course_id'];
                                    echo <<<Tag
                                    <tr>
                                        <td>$serialNo</td>
                                        <td>$courseName</td>
                                        <td>$courseCredit</td>
                                        <td hidden>$id</td>
                                        <td>
                                            <a href="edit_course.php?update=$id" class="btn btn-success">EDIT</a>
                                            <a href="storeCourse.php?courseID=$id" class="btn btn-warning">DELETE</a>
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
    </section>

    <footer>
        <p class="text-center text-capitalize h5">Copyright &copy; Developed by Department of CSE</p>
    </footer>

    
    <script src="../../resources/js/jquery.min.js"></script>
    <script src="../../resources/js/bootstrap.min.js"></script>

    <!-- custom script -->
    <script>

        // for fade out the session message
        $(function ($) {
            $(".message").fadeOut(3000)
        });


    </script>


  </body>
</html>
