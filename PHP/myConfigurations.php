<!DOCTYPE html>
<html lang="en">
<?php
require_once('accounts.php');
require_once("name.php");
require_once('configurations.php');
require_once 'vendor/autoload.php';
require_once('parts.php');
require_once('ID.php');
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\Query;



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
$select = "";



?>

<head>
    <meta charset="UTF-8" />
    <title>Konfigurate your PC</title>
    <link rel="stylesheet" href="../STYLES/style.css" />
</head>

<body>
    <header>
        <h2 class="logo">Build your PC!</h2>
        <nav class="navigation">
            <a href="add.php">Add new part</a>
            <a href="konfigurepc.php">Config PC</a>
        </nav>
    </header>
    <div class="konfiguracje">


        <!--<form action="" method="POST">
            <input type="text" name="id" placeholder="Enter ID of a configuration">
            <input type="Submit" name="delete" value="Submit">
        </form>-->
        <h2>My configurations</h2>

        <?php
        $queryBuilder = $entityManager->createQueryBuilder();
        $dane = $queryBuilder
            ->select('c')
            ->from(configurations::class, 'c')
            ->getQuery();
        $dane_lista = $dane->getResult();

        if ($dane_lista == null) {
            echo "<p>There is no elements to show.</p>";
        } else {
            ?>
            <table>
                <tr>
                    <th> ID </th>
                    <th>Configuration name</th>
                    <th>CPU</th>
                    <th>MotherBoard</th>
                    <th>GPU</th>
                    <th>RAM</th>
                    <th>HDD</th>
                    <th>SSD</th>
                    <th>PSU</th>
                    <th>Case</th>
                    <th>Edit</th>
                    <th>Delete</th>

                </tr>
                <?php
                foreach ($dane_lista as $d) {
                    echo "<tr><td>" . $d->getID() . "</td><td>" . $d->getName() . "</td><td>" . getProductname($d->getID_cpu()) . "</td><td>" . getProductMbName($d->getID_mb()) . "</td><td>" . getProductGpuName($d->getID_gpu()) . "</td><td>" . getProductRamName($d->getID_ram()) . "</td><td>" . getProductHddName($d->getID_hdd()) . "</td><td>" . getProductSSDName($d->getID_ssd()) . "</td><td>" . getProductZasilaczName($d->getID_zasilacz()) . "</td><td>" . getProductObudowaName($d->getID_obudowa()) . "</td><td><form method='post'><button type='submit' name='edit'>Edit</button></td><td><button type='submit' name='delete'>Delete</button></td><td><input type='number' name='cpu_id' hidden value='" . $d->getID_cpu() . "'><input type='number' name='mb_id' hidden value='" . $d->getID_mb() . "'><input type='number' name='ram_id' hidden value='" . $d->getID_ram() . "'><input type='number' name='gpu_id' hidden value='" . $d->getID_gpu() . "'><input type='number' name='zasilacz_id' hidden value='" . $d->getID_zasilacz() . "'><input type='number' name='obudowa_id' hidden value='" . $d->getID_obudowa() . "'><input type='number' name='ssd_id' hidden value='" . $d->getID_ssd() . "'><input type='number' name='hdd_id' hidden value='" . $d->getID_hdd() . "'><input type='number' name='chlodzenie_id' hidden value='" . $d->getID_chlodzenie() . "'><input type='number' name='id' hidden value='" . $d->getID() . "'><input type='number' name='account_id' hidden value='" . $d->getID_account() . "'><input type='text' name='nazwa' id='nazwa' hidden value='" . $d->getName() . "'></form></td>";

                    $nazwaCPU = $d->getID_cpu();
                    $nazwaGPU = $d->getID_gpu();
                    $nazwaMB = $d->getID_mb();
                    $nazwaRam = $d->getID_ram();
                    $nazwaHdd = $d->getID_hdd();
                    $nazwaSSD = $d->getID_ssd();
                    $nazwaZasilacz = $d->getID_zasilacz();
                    $nazwaObudowa = $d->getID_obudowa();
                    $nazwaID = $d->getID();
                    $nazwaAccount = $d->getID_account();
                }
                ?>
            </table>
            <?php
        }




        function usunKonfiguration($nazwaID)
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
            $single_user = $entityManager->find('Configurations', $nazwaID);

            $entityManager->remove($single_user);

            $entityManager->flush();
            header("Location: myConfigurations.php");
        }




        function getProductObudowaName($nazwaObudowa)
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


            $queryBuilder = $entityManager->createQueryBuilder();
            $dane2 = $queryBuilder
                ->select('c')
                ->from(Obudowa::class, 'c')
                ->where('c.id_obudowa = ' . $nazwaObudowa)
                ->getQuery();
            $obudowa = $dane2->getSingleResult()->getNazwa();
            return $obudowa;
        }

        function getProductZasilaczName($nazwaZasilacz)
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


            $queryBuilder = $entityManager->createQueryBuilder();
            $dane2 = $queryBuilder
                ->select('c')
                ->from(Zasilacz::class, 'c')
                ->where('c.id_zasilacz = ' . $nazwaZasilacz)
                ->getQuery();
            $zasilacz = $dane2->getSingleResult()->getNazwa();
            return $zasilacz;
        }

        function getProductSSDName($nazwaSSD)
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


            $queryBuilder = $entityManager->createQueryBuilder();
            $dane2 = $queryBuilder
                ->select('c')
                ->from(Ssd::class, 'c')
                ->where('c.id = ' . $nazwaSSD)
                ->getQuery();
            $ssd = $dane2->getSingleResult()->getNazwa();
            return $ssd;
        }

        function getProductHddName($nazwaHdd)
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


            $queryBuilder = $entityManager->createQueryBuilder();
            $dane2 = $queryBuilder
                ->select('c')
                ->from(Hdd::class, 'c')
                ->where('c.id_hdd = ' . $nazwaHdd)
                ->getQuery();
            $hdd = $dane2->getSingleResult()->getNazwa();
            return $hdd;
        }

        function getProductRamName($nazwaRam)
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


            $queryBuilder = $entityManager->createQueryBuilder();
            $dane2 = $queryBuilder
                ->select('c')
                ->from(Ram::class, 'c')
                ->where('c.id_ram = ' . $nazwaRam)
                ->getQuery();
            $ram = $dane2->getSingleResult()->getNazwa();
            return $ram;
        }

        function getProductname($nazwaCPU)
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


            $queryBuilder = $entityManager->createQueryBuilder();
            $dane2 = $queryBuilder
                ->select('c')
                ->from(Cpu::class, 'c')
                ->where('c.id_cpu = ' . $nazwaCPU)
                ->getQuery();
            $procek = $dane2->getSingleResult()->getNazwa();
            return $procek;

        }

        function getProductMbName($nazwaMB)
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


            $queryBuilder = $entityManager->createQueryBuilder();
            $dane2 = $queryBuilder
                ->select('c')
                ->from(Mb::class, 'c')
                ->where('c.id_mb = ' . $nazwaMB)
                ->getQuery();
            $mb = $dane2->getSingleResult()->getNazwa();
            return $mb;
        }

        function getProductGpuName($nazwaGPU)
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


            $queryBuilder = $entityManager->createQueryBuilder();
            $dane3 = $queryBuilder
                ->select('c')
                ->from(Gpu::class, 'c')
                ->where('c.id_gpu = ' . $nazwaGPU)
                ->getQuery();
            $gpu = $dane3->getSingleResult()->getNazwa();
            return $gpu;

        }


        if (isset($_POST['cpu_id']) && isset($_POST['mb_id']) && isset($_POST['ram_id']) && isset($_POST['gpu_id']) && isset($_POST['zasilacz_id']) && isset($_POST['obudowa_id']) && isset($_POST['ssd_id']) && isset($_POST['hdd_id']) && isset($_POST['chlodzenie_id']) && isset($_POST['id']) && isset($_POST['account_id']) && isset($_POST['nazwa'])) {

            if (isset($_POST['edit'])) {
                $cpu_id = $_POST['cpu_id'];
                $mb_id = $_POST['mb_id'];
                $ram_id = $_POST['ram_id'];
                $gpu_id = $_POST['gpu_id'];
                $zasilacz_id = $_POST['zasilacz_id'];
                $obudowa_id = $_POST['obudowa_id'];
                $ssd_id = $_POST['ssd_id'];
                $hdd_id = $_POST['hdd_id'];
                $chlodzenie_id = $_POST['chlodzenie_id'];
                $id = $_POST['id'];
                $account_id = $_POST['account_id'];
                $nazwa = $_POST['nazwa'];
                $nameofconfig = (new NameOfConfig())
                    ->setName($nazwa);
                $entityManager->persist($nameofconfig);
                $entityManager->flush();
                $link = "konfigurepc.php?type=&cpu=" . $cpu_id . "&mb=" . $mb_id . "&ram=" . $ram_id . "&gpu=" . $gpu_id . "&zasilacz=" . $zasilacz_id . "&chlodzenie_cpu=" . $chlodzenie_id . "&hdd=" . $hdd_id . "&ssd=" . $ssd_id . "&obudowa=" . $obudowa_id;
                header("Location: " . $link);
            }

            if (isset($_POST['delete'])) {
                $cpu_id = $_POST['cpu_id'];
                $mb_id = $_POST['mb_id'];
                $ram_id = $_POST['ram_id'];
                $gpu_id = $_POST['gpu_id'];
                $zasilacz_id = $_POST['zasilacz_id'];
                $obudowa_id = $_POST['obudowa_id'];
                $ssd_id = $_POST['ssd_id'];
                $hdd_id = $_POST['hdd_id'];
                $chlodzenie_id = $_POST['chlodzenie_id'];
                $id = $_POST['id'];
                $account_id = $_POST['account_id'];
                $nazwa = $_POST['nazwa'];

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


                $queryBuilder = $entityManager->createQueryBuilder();
                $dane2 = $queryBuilder
                    ->select('c')
                    ->from(Configurations::class, 'c')
                    ->where('c.ID = ' . $id)
                    ->getQuery();
                $date = $dane2->getResult();

                foreach ($date as $q) {
                    $nowaZmienna = $q->getID();
                    usunKonfiguration($nowaZmienna);
                }
            }
        }







        ?>
    </div>
    <script src="JS/script.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>