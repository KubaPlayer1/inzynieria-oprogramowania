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
$id = $_POST['id_chlodzenie_cpu'];
                                            
$nazwaCooler = $_POST['nazwa'];
$maks_TDP = $_POST['maks_TDP'];
$socketCooler = $_POST['socket'];
$wysokoscCooler = $_POST['wysokosc'];
$szerokoscCooler = $_POST['szerokosc'];
$glebokoscCooler = $_POST['glebokosc'];
$iloscCooler = $_POST['ilosc_cieplowodow'];
$srednicaCooler = $_POST['srednica_cieplowodow'];


$query = "UPDATE chlodzenie_cpu SET nazwa='$nazwaCooler', maks_TDP='$maks_TDP', socket='$socketCooler', wysokosc='$wysokoscCooler', szerokosc='$szerokoscCooler', glebokosc='$glebokoscCooler', ilosc_cieplowodow='$iloscCooler', srednica_cieplowodow='$srednicaCooler'   WHERE id_chlodzenie_cpu='$id'";
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