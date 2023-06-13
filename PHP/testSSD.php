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
$id = $_POST['id'];
                                            
$nazwaSSD = $_POST['nazwa'];
$interfejs = $_POST['interfejs'];
$pojemnosc = $_POST['pojemnosc'];
$format = $_POST['format'];
$odczyt = $_POST['odczyt'];
$zapis = $_POST['zapis'];


$query = "UPDATE ssd SET nazwa='$nazwaSSD', interfejs='$interfejs', pojemnosc='$pojemnosc', format='$format', odczyt='$odczyt', zapis='$zapis' WHERE id='$id'";
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