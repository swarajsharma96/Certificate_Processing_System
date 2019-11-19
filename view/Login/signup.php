
<?php

require_once ("../../vendor/autoload.php");

if (!isset($_SESSION))
    session_start();

use App\Message\Message;

if (isset($_REQUEST['q'])) {
    $class_name = 'form-control inputValue2';
}
else {
    $class_name = 'form-control inputValue';
    $isHidden = "hidden";
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Signup</title>

    <link rel="stylesheet" href="../../resources/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../../resources/css/font-awesome.min.css" />
    <link rel="stylesheet" href="../../resources/css/normalize.css" />
    <link rel="stylesheet" href="../../resources/css/login.css">
</head>
<body>

<section id="signup-section">
    <div class="container">
        <div class="row">

            <p class="text-left text-lowercase lead warning-message <?php echo $isHidden; ?> ">
                <?php
                echo Message::message();
                ?>
            </p>

            <div class="col-md-offset-3 col-sm-offset-3 col-xs-offset-2 col-md-6 col-sm-7 col-xs-8">
                <div class="login">
                    <p class="lead text-uppercase text-center head-text">Sign Up</p>
                    <div class="login-insider">
                        <form method="post" action="userController.php">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="email" name="email" class="<?php echo $class_name;?>" id="exampleInputEmail1" placeholder="Email" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" name="password" class="<?php echo $class_name;?>" id="exampleInputPassword1" placeholder="Password" required>
                            </div>
                            <div class="form-group">
                                <label for="username">UserName</label>
                                <input type="text" name="userName" class="<?php echo $class_name;?>" id="username" placeholder="Username" required>
                            </div>

                            <div class="option">
                                <label for="login_as">Login as</label>
                                <select name="LoginAs" id="login_as" class="form-control" required>
                                    <option value="">Select a category</option>
                                    <option value="admin">Admin</option>
                                    <option value="register">Register</option>
                                    <option value="ec">Exam Controller</option>
                                    <option value="department">Department</option>
                                    <option value="ged">GED</option>
                                    <option value="account">Accounts</option>
                                    <option value="lib">Library</option>
                                </select>
                            </div>
                            <br>
                            <br>

                            <button type="submit" name="SignUp" class="btn btn-success inputValue">Signup</button>
                        </form>

                        <div class="signup">
                            <p class="h5 text-uppercase text-center">Have an account ?</p>
                            <p class="text-center"><a href="login.php" >Login</a></p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>






<script src="../../resources/js/jquery.min.js"></script>
<script src="../../resources/js/bootstrap.min.js"></script>


<script>


</script>


</body>
</html>
