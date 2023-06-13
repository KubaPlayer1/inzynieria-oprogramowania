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
$id = $_POST['id_ram'];
                                    
    $nazwaRAM = $_POST['nazwa'];
    $czestotliwosc = $_POST['czestotliwosc'];
    $liczbaModulow = $_POST['liczba_modulow'];
    $lacznaPamiec = $_POST['laczna_pamiec'];
    $opoznienie = $_POST['opoznienie'];
    $typPamieci = $_POST['typ_pamieci'];
    
    $query = "UPDATE ram SET nazwa='$nazwaRAM', czestotliwosc='$czestotliwosc', liczba_modulow='$liczbaModulow', laczna_pamiec='$lacznaPamiec', opoznienie='$opoznienie', typ_pamieci='$typPamieci' WHERE id_ram='$id'";
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