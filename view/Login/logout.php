<?php

if (!isset($_SESSION))
    session_start();


if (isset($_REQUEST['q'])) {
    $_SESSION['user_name'] = null;
    session_destroy();
    header("Location: ../Login/login.php");
}
