<?php
require_once('parts.php');
require_once('configurations.php');
require_once('accounts.php');
require_once('ID.php');
//require_once('DB_connection.php');
require_once 'vendor/autoload.php';
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\Query;

use function PHPSTORM_META\type;


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


function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}



if (isset($_POST['type'])) {
    $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

    var_dump($actual_link);
    var_dump($_POST['type']);
    var_dump($_POST['id']);
    if ($_POST['type'] == 'zasilacz') {
        echo "<td><form method='POST'><input type='number' name='zasi' hidden value='" . $_POST['id'] . "'></form>";
    }

    $url = addToUrl($actual_link, $_POST['type'], $_POST['id']);
    $url = addToUrl($url, 'type', '');

    header('Location: ' . $url);
}

function addToUrl($url, $key, $value = null)
{
    $query = parse_url($url, PHP_URL_QUERY);
    if ($query) {
        parse_str($query, $queryParams);
        $queryParams[$key] = $value;
        $url = str_replace("?$query", '?' . http_build_query($queryParams), $url);
    } else {
        $url .= '?' . urlencode($key) . '=' . urlencode($value);
    }
    return $url;
}
function saveConfiguration($config)
{
    global $entityManager;

    //$configuration = new Configurations();
    //$configuration->setID_account($ID_account);
    //$configuration->setID_cpu($ID_cpu);
    //$configuration->setID_mb($ID_mb);
    //$configuration->setID_ram($ID_ram);
    //$configuration->setID_gpu($ID_gpu);
    //$configuration->setID_zasilacz($ID_zasilacz);
    //$configuration->setID_chlodzenie($ID_chlodzenie);
    //$configuration->setID_hdd($ID_hdd);
    //$configuration->setID_ssd($ID_ssd);
    //$configuration->setID_obudowa($ID_obudowa);
    //$configuration->setName($name);

    //$entityManager->persist($configuration);
    //$entityManager->flush();

    echo "Konfiguracja została zapisana w bazie danych.";
}
$select = "";
$account;
$chlo = 0;
$proc = 0;
$obu = 0;
$ssddy = 0;
$hdddy = 0;
$pami = 0;
$graf = 0;
$plyta = 0;
$zasi = 0;

function del_user($id)
{
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
    $single_user = $entityManager->find('Iddb', $id);

    $entityManager->remove($single_user);

    $entityManager->flush();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Konfigurate your PC</title>
    <link rel="stylesheet" href="../STYLES/style.css" />
</head>

<body>
    <header>
        <h2 class="logo">Account</h2>
        <nav class="navigation">
            <form action="#" method="get"><button class="button-out" name="button-out">Log out</button></form>
            <?php
            if (isset($_GET['button-out'])) {
                $queryBuilder = $entityManager->createQueryBuilder();
                $accQuery = $queryBuilder
                    ->select('c')
                    ->from(Iddb::class, 'c')
                    ->getQuery();
                $acc = $accQuery->getResult();
                foreach ($acc as $ac) {
                    $idaccount = $ac->getId();
                }
                del_user($idaccount);
                header("Location: ../index.html");
            }
            ?>
        </nav>
    </header>
    <div class='info'>
        <h1>Information</h1>
        <div class="data1">
            <p>If you wont to change password: </p>
            <a href="../HTML/change.html">Change password</a>
            <p>My configurations: </p>
            <a href="myConfigurations.php">Click here</a>
            <p>Add a new part to database: </p>
            <a href="add.php">Click here</a>
        </div>
        <div class="data2">
            <?php
            $queryBuilder = $entityManager->createQueryBuilder();
            $accQuery = $queryBuilder
                ->select('c')
                ->from(Iddb::class, 'c')
                ->getQuery();
            $acc = $accQuery->getResult();
            foreach ($acc as $ac) {
                $idaccount = $ac->getId_account();
            }
            $queryBuilder = $entityManager->createQueryBuilder();
            $myacQuery = $queryBuilder
                ->select('c')
                ->from(Accounts::class, 'c')
                ->where('c.id = ' . $idaccount)
                ->getQuery();
            $myac = $myacQuery->getResult();
            foreach ($myac as $myacc) {
                echo "<h3>Email: \n" . $myacc->getEmail() . "</h3>";
                echo "<h3>Nick: \n" . $myacc->getUsername() . "</h3>";
            }
            ?>
        </div>
    </div>


    <script src="JS/script.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>