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
$id = $_POST['id_obudowa'];
                                            
    $nazwaCase = $_POST['nazwa'];
    $standardCase = $_POST['standard'];
    $maksDlugoscKarty = $_POST['maks_dlugosc_karty_graf'];
    $typObudowy = $_POST['typ_obudowy'];
    $wysokoscObudowy = $_POST['wysokosc'];
    $szerokoscObudowy = $_POST['szerokosc'];
    $glebokoscObudowy = $_POST['glebokosc'];
    
    
    $query = "UPDATE obudowa SET nazwa='$nazwaCase', standard='$standardCase', maks_dlugosc_karty_graf='$maksDlugoscKarty', typ_obudowy='$typObudowy', wysokosc='$wysokoscObudowy', szerokosc='$szerokoscObudowy', glebokosc='$glebokoscObudowy'  WHERE id_obudowa='$id'";
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