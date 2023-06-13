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
$id = $_POST['id_mb'];
                                    
$nazwaMB = $_POST['nazwa'];
$chipsetPlyty = $_POST['chipset_plyty'];
$gniazdoProcesora = $_POST['gniazdo_procesora'];
$liczbaSlotowPamieci = $_POST['liczba_slotow_pamieci'];
$standardPlyty = $_POST['standard_plyty'];
$standardPamieci = $_POST['standard_pamieci'];
$maksIloscPamieciRam = $_POST['maks_ilosc_pamieci_ram'];


$query = "UPDATE mb SET nazwa='$nazwaMB', chipset_plyty='$chipsetPlyty', gniazdo_procesora='$gniazdoProcesora', liczba_slotow_pamieci='$liczbaSlotowPamieci', standard_plyty='$standardPlyty', standard_pamieci='$standardPamieci', maks_ilosc_pamieci_ram='$maksIloscPamieciRam' WHERE id_mb='$id'";
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