<!DOCTYPE html>
<html lang="en">
<?php
require_once('parts.php');
require_once 'vendor/autoload.php';
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
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../STYLES/serchStyle.css">
    <title>Konfigurate your PC</title>

</head>

<body>
    <img src="GRAPHICS/strona_logo.png">
    <header>
        <h2 class="logo">Build your PC!</h2>
        <nav class="navigation">
            <a href="konfigurepc.php"><ion-icon name="home-sharp">Konfigure PC</ion-icon></a>

        </nav>
    </header>
    <div class="pudelko">
        <form action="serch.php" method="post">

            <?php
            if (!isset($_POST['type'])) { ?>
                <label>Choose what you wont to search: </label>
                <select name="type">
                    <option value="">Select...</option>
                    <option value="cpu">CPU</option>
                    <option value="gpu">GPU</option>
                    <option value="zasilacz">Power supply</option>
                    <option value="mb">Mother board</option>
                    <option value="ram">RAM</option>
                    <option value="ssd">SSD</option>
                    <option value="hdd">HDD</option>
                    <option value="chlodzenie_cpu">CPU cooler</option>
                    <option value="obudowa">Case</option>
                </select>
                <input type="submit" name="submit" value="Submit" />

            <?php } ?>
        </form>

        <?php if (isset($_POST['type'])) { ?>
            <form action="serch.php" method="POST">

                <input type="text" name="type" hidden value="<?php echo $_POST['type'] ?>">
                <input type="text" name="name" placeholder="Enter name" />
                <input type="submit" name="submit" value="Submit" />
                <a href="serch.php"> Wyszukaj od nowa</a>
            </form>
        <?php } ?>

        <?php if (isset($_POST['type']) && isset($_POST['name'])) {
            ?>
            <ul>
                <?php
                switch ($_POST['type']) {
                    case 'chlodzenie_cpu':
                        $queryBuilder = $entityManager->createQueryBuilder();
                        $dane = $queryBuilder
                            ->select('c')
                            ->from(CpuCooler::class, 'c')
                            ->where("c.nazwa LIKE '%" . $_POST['name'] . "%'")
                            ->getQuery();
                        $dane_lista = $dane->getResult();

                        ?>
                        <table>
                            <tr>
                                <th>Nazwa </th>
                                <th>Soket |</th>
                                <th>Max TDP</th>

                            </tr>

                            <?php

                            foreach ($dane_lista as $d) {
                                ?>
                                <?php echo "<tr><td>" . $d->getNazwa() . " </td><td>" . $d->getSocket() . " </td><td>" . $d->getMaks_TDP() . "</td></tr>"; ?>
                            <?php }

                            ?>

                        </table>
                        <?php
                        break;
                    case 'cpu':
                        $queryBuilder = $entityManager->createQueryBuilder();
                        $dane = $queryBuilder
                            ->select('c')
                            ->from(Cpu::class, 'c')
                            ->where("c.nazwa LIKE '%" . $_POST['name'] . "%'")
                            ->getQuery();
                        $dane_lista = $dane->getResult();

                        ?>
                        <table>
                            <tr>
                                <th>Nazwa </th>
                                <th> socket </th>
                            </tr>
                            <?php

                            foreach ($dane_lista as $d) {
                                ?>
                                <?php echo "<tr><td>" . $d->getNazwa() . " </td><td>" . $d->getCpu_socket() . "</td></tr>" ?>
                            <?php }
                            ?>
                        </table>
                        <?php

                        break;
                    case 'ssd':
                        $queryBuilder = $entityManager->createQueryBuilder();
                        $dane = $queryBuilder
                            ->select('c')
                            ->from(Ssd::class, 'c')
                            ->where("c.nazwa LIKE '%" . $_POST['name'] . "%'")
                            ->getQuery();
                        $dane_lista = $dane->getResult();

                        ?>
                        <table>
                            <tr>
                                <th> Nazwa </th>
                                <th> Interfejs</th>
                                <th> Pojemnosc</th>
                            </tr>
                            <?php
                            foreach ($dane_lista as $d) { ?>
                                <?php echo "<tr><td>" . $d->getNazwa() . " </td><td>" . $d->getInterfejs() . " </td><td>" . $d->getPojemnosc() . "</td></tr>"; ?>
                            <?php }
                            ?>
                        </table>
                        <?php
                        break;
                    case 'hdd':
                        $queryBuilder = $entityManager->createQueryBuilder();
                        $dane = $queryBuilder
                            ->select('c')
                            ->from(Hdd::class, 'c')
                            ->where("c.nazwa LIKE '%" . $_POST['name'] . "%'")
                            ->getQuery();
                        $dane_lista = $dane->getResult();

                        ?>
                        <table>
                            <tr>
                                <th> Nazwa </th>
                                <th> Interfejs</th>
                                <th> Pojemnosc </th>
                            </tr>
                            <?php
                            foreach ($dane_lista as $d) { ?>
                                <?php echo "<tr><td>" . $d->getNazwa() . " </td><td>" . $d->getInterfejs() . " </td><td>" . $d->getPojemnosc() . "</td></tr>"; ?>
                            <?php }
                            ?>
                        </table>
                        <?php
                        break;
                    case 'gpu':
                        $queryBuilder = $entityManager->createQueryBuilder();
                        $dane = $queryBuilder
                            ->select('c')
                            ->from(Gpu::class, 'c')
                            ->where("c.nazwa LIKE '%" . $_POST['name'] . "%'")
                            ->getQuery();
                        $dane_lista = $dane->getResult();

                        ?>
                        <table>
                            <tr>
                                <th> Nazwa</th>
                                <th> Producent Chipsetu</th>
                            </tr>
                            <?php
                            foreach ($dane_lista as $d) { ?>
                                <?php echo "<tr><td>" . $d->getNazwa() . " </td><td>" . $d->getProducent_chipsetu() . "</td></tr>"; ?>
                            <?php }
                            ?>
                        </table>
                        <?php
                        break;
                    case 'obudowa':
                        $queryBuilder = $entityManager->createQueryBuilder();
                        $dane = $queryBuilder
                            ->select('c')
                            ->from(Obudowa::class, 'c')
                            ->where("c.nazwa LIKE '%" . $_POST['name'] . "%'")
                            ->getQuery();
                        $dane_lista = $dane->getResult();

                        ?>
                        <table>
                            <tr>
                                <th> Nazwa</th>
                                <th> Standard</th>
                                <th> Typ obudowy </th>
                                <th> Max dlugosc karty</th>
                            </tr>
                            <?php
                            foreach ($dane_lista as $d) { ?>
                                <?php echo "<tr><td>" . $d->getNazwa() . " </td><td>" . $d->getStandard() . " </td><td>" . $d->getTyp_obudowy() . " </td><td>" . $d->getMaks_dlugosc_karty_graf() . "</td></tr>"; ?>
                            <?php }
                            ?>
                        </table>
                        <?php
                        break;
                    case 'mb':
                        $queryBuilder = $entityManager->createQueryBuilder();
                        $dane = $queryBuilder
                            ->select('c')
                            ->from(Mb::class, 'c')
                            ->where("c.nazwa LIKE '%" . $_POST['name'] . "%'")
                            ->getQuery();
                        $dane_lista = $dane->getResult();

                        ?>
                        <table>
                            <tr>
                                <th> Nazwa </th>
                                <th> Chipset</th>
                                <th> Gniazdo </th>
                                <th> Standard</th>
                            </tr>
                            <?php
                            foreach ($dane_lista as $d) { ?>
                                <?php echo "<tr><td>" . $d->getNazwa() . " </td><td>" . $d->getChipset_plyty() . " </td><td>" . $d->getGniazdo_procesora() . " </td><td>" . $d->getStandard_plyty() . "</td></tr>"; ?>
                            <?php }
                            ?>
                        </table>
                        <?php
                        break;
                    case 'ram':
                        $queryBuilder = $entityManager->createQueryBuilder();
                        $dane = $queryBuilder
                            ->select('c')
                            ->from(Ram::class, 'c')
                            ->where("c.nazwa LIKE '%" . $_POST['name'] . "%'")
                            ->getQuery();
                        $dane_lista = $dane->getResult();

                        ?>
                        <table>
                            <tr>
                                <th> Nazwa</th>
                                <th> Czestotliwosc </th>
                                <th> Opoznienie</th>
                                <th> typ pamieci </th>
                            </tr>
                            <?php
                            foreach ($dane_lista as $d) { ?>
                                <?php echo "<tr><td>" . $d->getNazwa() . " </td><td>" . $d->getCzestotliwosc() . " </td><td>" . $d->getOpluznienie() . " </td><td>" . $d->getTyp_pamieci() . "</td></tr>"; ?>
                            <?php }
                            ?>
                        </table>
                        <?php
                        break;
                    case 'zasilacz':
                        $queryBuilder = $entityManager->createQueryBuilder();
                        $dane = $queryBuilder
                            ->select('c')
                            ->from(Zasilacz::class, 'c')
                            ->where("c.nazwa LIKE '%" . $_POST['name'] . "%'")
                            ->getQuery();
                        $dane_lista = $dane->getResult();

                        ?>
                        <table>
                            <tr>
                                <th> Nazwa</th>
                                <th> Certyfikat </th>
                                <th> Moc</th>
                                <th> Standard</th>
                            </tr>
                            <?php
                            foreach ($dane_lista as $d) { ?>
                                <?php echo "<tr><td>" . $d->getNazwa() . " </td><td>" . $d->getCertyfikat() . " </td><td>" . $d->getMoc() . " </td><td>" . $d->getStandard() . "</td></tr>"; ?>
                            <?php }
                            ?>
                        </table>
                        <?php
                        break;
                    default:
                        break;
                }
                ?>
            </ul>
        <?php } ?>


    </div>

    <script src="JS/script.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>