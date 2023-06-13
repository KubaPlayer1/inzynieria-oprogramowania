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
            <a href="konfigurepc.php">Configurate PC</a>
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