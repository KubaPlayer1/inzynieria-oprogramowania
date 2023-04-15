<?php
require_once 'vendor/autoload.php';
use Doctrine\DBAL\DriverManager;


//..
$connectionParams = [
    'dbname' => 'peryferia',
    'user' => 'root',
    'password' => '',
    'host' => 'localhost',
    'driver' => 'mysqli',
];
$conn = DriverManager::getConnection($connectionParams);

?>
