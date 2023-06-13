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


    $id = $_POST['id_gpu'];
                                    
    $nazwaGPU = $_POST['nazwa'];
    $producentChipsetu = $_POST['producent_chipsetu'];
    $dlugoscKarty = $_POST['dlugosc_karty'];
    $iloscRam = $_POST['ilosc_ram'];
    $rodzajChipsetu = $_POST['rodzaj_chipsetu'];
    $rekomendowanaMocZasilacza = $_POST['rekomendowana_moc_zasilacza'];
    $taktowanieRdzeniaBoost = $_POST['taktowanie_rdzenia_boost'];
    
    $query = "UPDATE gpu SET nazwa='$nazwaGPU', producent_chipsetu='$producentChipsetu', ilosc_ram='$iloscRam', rodzaj_chipsetu='$rodzajChipsetu', rekomendowana_moc_zasilacza='$rekomendowanaMocZasilacza', taktowanie_rdzenia_boost='$taktowanieRdzeniaBoost' WHERE id_gpu='$id'";
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