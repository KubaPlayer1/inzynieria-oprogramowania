<!DOCTYPE html>
<html lang="en">
<?php
require_once('accounts.php');
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
            <a href="save_configuration.php">Save configuration</a>
            <a href="myConfigurations.php">My configurations</a>
            <button class="button-out" href="../index.html">Log out</button>
        </nav>
    </header>
    <div class="konfiguracje">


        <form action="" method="POST">
            <input type="text" name="id" placeholder="Enter ID of a configuration">
            <input type="Submit" name="delete" value="Submit">
        </form>

        <?php

        if (isset($_POST['delete'])) {


            $id = $_POST['id'];
            // Pobierz encję, którą chcesz usunąć
            $entity = $entityManager->getRepository(Configurations::class)->find($id); // Zastąp 'YourEntity' nazwą twojej encji i '$id' konkretnym ID wiersza
        
            if (!$entity) {
                //throw $this->createNotFoundException('Nie znaleziono encji o podanym ID');
            }

            // Oznacz encję do usunięcia
            $entityManager->remove($entity);

            // Zatwierdź zmiany i usuń wiersz z bazy danych
            $entityManager->flush();

        }


        ?>

        <?php
        $queryBuilder = $entityManager->createQueryBuilder();
        $dane = $queryBuilder
            ->select('c')
            ->from(configurations::class, 'c')
            ->getQuery();
        $dane_lista = $dane->getResult();
        ?>

        <table>
            <tr>
                <th> ID </th>
                <th>Nazwa Konfiguracji </th>
                <th>CPU </th>
                <th>MotherBoard </th>
                <th>GPU </th>
                <th>Ram </th>
                <th>HDD </th>
                <th>SSD </th>
                <th>Zasilacz </th>
                <th>obudowa </th>
                <th>Edit </th>

            </tr>
            <?php
            foreach ($dane_lista as $d) {
                echo "<tr><td>" . $d->getID() . "</td><td>" . $d->getName() . "</td><td>" . getProductname($d->getID_cpu()) . "</td><td>" . getProductMbName($d->getID_mb()) . "</td><td>" . getProductGpuName($d->getID_gpu()) . "</td><td>" . getProductRamName($d->getID_ram()) . "</td><td>" . getProductHddName($d->getID_hdd()) . "</td><td>" . getProductSSDName($d->getID_ssd()) . "</td><td>" . getProductZasilaczName($d->getID_zasilacz()) . "</td><td>" . getProductObudowaName($d->getID_obudowa()) . "</td><td>" . "<form method='post'><button type='submit' name='edit'>Edit</button></td><td><input type='number' name='cpu_id' hidden value='" . $d->getID_cpu() . "'><input type='number' name='mb_id' hidden value='" . $d->getID_mb() . "'><input type='number' name='ram_id' hidden value='" . $d->getID_ram() . "'><input type='number' name='gpu_id' hidden value='" . $d->getID_gpu() . "'><input type='number' name='zasilacz_id' hidden value='" . $d->getID_zasilacz() . "'><input type='number' name='obudowa_id' hidden value='" . $d->getID_obudowa() . "'><input type='number' name='ssd_id' hidden value='" . $d->getID_ssd() . "'><input type='number' name='hdd_id' hidden value='" . $d->getID_hdd() . "'><input type='number' name='chlodzenie_id' hidden value='" . $d->getID_chlodzenie() . "'><input type='number' name='id' hidden value='" . $d->getID() . "'></form></td>";

                $nazwaCPU = $d->getID_cpu();
                $nazwaGPU = $d->getID_gpu();
                $nazwaMB = $d->getID_mb();
                $nazwaRam = $d->getID_ram();
                $nazwaHdd = $d->getID_hdd();
                $nazwaSSD = $d->getID_ssd();
                $nazwaZasilacz = $d->getID_zasilacz();
                $nazwaObudowa = $d->getID_obudowa();
                $nazwaID = $d->getID();
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
                $single_user = $entityManager->find('Iddb', $nazwaID);

                $entityManager->remove($single_user);

                $entityManager->flush();
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




            if (isset($_POST['edit'])) {

                $link = "konfigurepc.php?type=&cpu=" . $_POST['cpu_id'] . "&mb=" . $_POST['mb_id'] . "&ram=" . $_POST['ram_id'] . "&gpu=" . $_POST['gpu_id'] . "&zasilacz=" . $_POST['zasilacz_id'] . "&chlodzenie_cpu=" . $_POST['chlodzenie_id'] . "&hdd=" . $_POST['hdd_id'] . "&ssd=" . $_POST['ssd_id'] . "&obudowa=" . $_POST['obudowa_id'];
                header("Location: " . $link);
            }


            if (isset($_POST['usun']) && isset($_POST['id'])) {

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
                    ->where('c.ID = ' . $nazwaID)
                    ->getQuery();
                $date = $dane2->getResult();

                foreach ($date as $q) {
                    $nowaZmienna = $q->getID();

                }

                usunKonfiguration($nowaZmienna);
            }

            ?>

        </table>
    </div>
    <script src="JS/script.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>