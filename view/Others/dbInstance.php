<?php

require_once ("../../vendor/autoload.php");

use \App\Model\Database;
use \App\Message\Message;

$db = new Database();
$instance = $db->getDbInstance();

