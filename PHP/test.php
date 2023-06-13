<?php
 require_once('parts.php');
 require_once 'vendor/autoload.php';
 use Doctrine\DBAL\DriverManager;
 use Doctrine\ORM\EntityManager;
 use Doctrine\ORM\Tools\Setup;
 use Doctrine\ORM\Query;

 $conn = mysqli_connect("localhost","root","","peryferia");
 /*
$connectionParams = [
    'dbname' => 'peryferia',
    'user' => 'root',
    'password' => '',
    'host' => 'localhost',
    'driver' => 'mysqli',
];
$conn = DriverManager::getConnection($connectionParams);

$entityManager = EntityManager::create(
    $conn,
    Setup::createAttributeMetadataConfiguration([__DIR__ . '/Entity'])
); 
*/ 
    $id = $_POST['id_cpu'];
                                                         
    $nazwaCPU = $_POST['nazwa'];
    $socket = $_POST['socket'];
    $zegar = $_POST['zegar'];
    $turbo = $_POST['turbo'];
    $rdzenie = $_POST['rdzenie'];
    $watki = $_POST['watki'];

    $query = "UPDATE cpu SET nazwa='$nazwaCPU', socket='$socket', zegar='$zegar', turbo='$turbo', rdzenie='$rdzenie', watki='$watki' WHERE id_cpu='$id'";
    echo $query;

    $query_run = mysqli_query($conn,$query);

    if($query_run)
    {
        $_SESSION['status'] = "Data Updated Succesufully";
        //header("Location: add.php");
    }
    else
    {
        $_SESSION['status'] = "Not Updated";
       // header("Location: add.php");
    }
?>