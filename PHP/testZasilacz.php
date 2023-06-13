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
    $id = $_POST['id_zasilacz'];
                                        
    $nazwaZasilacz = $_POST['nazwa'];
    $certyfikatZasilacz = $_POST['certyfikat'];
    $srednicaWentylatora = $_POST['srednica_wentylatora'];
    $mocZasilacz = $_POST['moc'];
    $standardZasilacz = $_POST['standard'];
    $wysokoscZasilacz = $_POST['wysokosc'];
    $szerokoscZasilacz = $_POST['szerokosc'];
    $glebokoscZasilacz = $_POST['glebokosc'];

    $query = "UPDATE zasilacz SET nazwa='$nazwaZasilacz', certyfikat='$certyfikatZasilacz', srednica_wentylatora='$srednicaWentylatora', moc='$mocZasilacz', standard='$standardZasilacz', wysokosc='$wysokoscZasilacz', szerokosc='$szerokoscZasilacz', glebokosc='$glebokoscZasilacz' WHERE id_zasilacz='$id'";
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