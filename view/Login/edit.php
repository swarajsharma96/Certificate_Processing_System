
<?php

require_once ("../../vendor/autoload.php");

if (!isset($_SESSION))
    session_start();

use App\Message\Message;
use App\Model\Database;

$username = $_GET['q'];

$db = new Database();
$query = "SELECT * FROM `user` WHERE user_name = '$username'";
$dataRow = $db->retrieve($query);
$username = $dataRow['user_name'];
$email = $dataRow['email'];
$password = $dataRow['password'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Edit User</title>

    <link rel="stylesheet" href="../../resources/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../../resources/css/font-awesome.min.css" />
    <link rel="stylesheet" href="../../resources/css/normalize.css" />
    <link rel="stylesheet" href="../../resources/css/login.css">
</head>
<body>

<section id="signup-section">
    <div class="container">
        <div class="row">
            <div class="col-md-offset-3 col-sm-offset-3 col-xs-offset-2 col-md-6 col-sm-7 col-xs-8">
                <form action="userController.php?q=<?php echo $username; ?>" method="post">
                    <button type="submit" name="Delete" class="btn btn-success inputValue">Delete Account</button>
                </form>
                <div class="login">
                    <p class="lead text-uppercase text-center head-text">Edit user</p>
                    <div class="login-insider">
                        <form method="post" action="userController.php">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="email" value="<?php echo $email ;?>" name="email" class="form-control inputValue" id="exampleInputEmail1" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" value="<?php echo $password ;?>" name="password" class="form-control inputValue" id="exampleInputPassword1" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <label for="username">UserName</label>
                                <input type="email" value="<?php echo $username ;?>" name="userName" class="form-control inputValue" id="username" placeholder="Username" readonly>
                            </div>
                            <br>
                            <br>

                            <button type="submit" name="Update" class="btn btn-success inputValue">Update</button>

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
