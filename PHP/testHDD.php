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
$id = $_POST['id_hdd'];
                                            
$nazwaHDD = $_POST['nazwa'];
$formatHDD = $_POST['format'];
$interfejsHDD = $_POST['interfejs'];
$pamiecPodreczna = $_POST['pamiec_podreczna'];
$pojemnoscHDD = $_POST['pojemnosc'];
$predkoscHDD = $_POST['predkosc'];


$query = "UPDATE hdd SET nazwa='$nazwaHDD', format='$formatHDD', interfejs='$interfejsHDD', pamiec_podreczna='$pamiecPodreczna', pojemnosc='$pojemnoscHDD', predkosc='$predkoscHDD' WHERE id_hdd='$id'";
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