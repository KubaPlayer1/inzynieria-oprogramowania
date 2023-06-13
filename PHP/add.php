<!DOCTYPE html>
<html lang="en">
<?php
//error_reporting(E_ALL);
require_once('parts.php');
require_once 'vendor/autoload.php';
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\Query;



//..
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
    <title>Konfigurate your PC</title>
    <link rel="stylesheet" href="../STYLES/style.css">
</head>

<body>
    <!--<img src="GRAPHICS/strona_logo.png">-->
    <header>
        <h2 class="logo">ADD A NEW PART</h2>
        <nav class="navigation">
            <a href="add.php">Go back to selecting</a>
            <a href="konfigurepc.php"><ion-icon name="home-sharp">Konfigure PC</ion-icon></a>
            <a href="serch2.php"><ion-icon name="search-sharp">Serch</ion-icon></a>
        </nav>
    </header>


    <form action="" method="post">
        <?php if (!isset($_POST['submit'])) { ?>
            <label style="Font-size:25px">Choose what you wont to add: </label>
            <select name="select" style="height:50px; width:120px; Font-size: 25px">
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

            <input type="submit" name="submit" value="Submit" style="height:50px; width:100px; Font-size: 25px" />

        <?php } ?>
        <div class="box">

            <?php
            $podzespoly = ["cpu", "gpu", "zasilacz", "mb", "ram", "ssd", "hdd", "chlodzenie_cpu", "obudowa"];
            if (isset($_POST["submit"])) {

                $select = $_POST["select"];
                //echo($select);
                if (empty($select)) {
                    echo "There is no opption choosed.";
                }
                ?>
                <div class="dodawanie">
                    <?php
                    if ($podzespoly[0] == $select) {
                        ?>

                        <label>Name</label>
                        <input type="text" id="nazwa" name="nazwa">
                        </br>
                        <label>Socket</label>
                        <input type="text" id="socket" name="socket">
                        </br>
                        <label>Clock</label>
                        <input type="number" step="0.1" min="0.0" max="10.0" id="zegar" name="zegar">
                        </br>
                        <label>Turbo</label>
                        <input type="number" step="0.1" min="0.0" max="10.0" id="turbo" name="turbo">
                        </br>
                        <label>Cores</label>
                        <input type="number" min="0" max="64" id="rdzenie" name="rdzenie">
                        </br>
                        <label>Threads</label>
                        <input type="number" min="0" max="128" id="watki" name="watki">
                        </br>
                        <input type="submit" name="add" value="Add"
                            style="padding: 10px; border-radius: 5px; border: 1px solid #ccc; width: 250px;" />
                        <div class="a">
                            <a href='update.php'>Edit</a>
                        </div>
                    </div>
                    <div class="lista">
                        <form action="add.php" method="POST">
                            <input type="text" name="name" placeholder="give me nazwa " />
                            <input type="submit" name="submit" value="Submit "
                                style="padding: 10px; border-radius: 5px; border: 1px solid #ccc; width: 250px;" />

                        </form>

                        <?php if (isset($_POST['name'])) {

                            session_start();
                            $conn = mysqli_connect("localhost", "root", "", "peryferia");
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
                                    <th> Id </th>
                                    <th>Nazwa </th>
                                    <th> socket </th>
                                    <th> Edit </th>
                                </tr>
                                <?php
                                foreach ($dane_lista as $d) {
                                    ?>
                                    <?php echo "<tr><td>" . $d->getId_cpu() . "</td><td>" . $d->getNazwa() . " </td><td>" . $d->getCpu_socket() . "</td><td></td></tr>" ?>
                                    <?php
                                    if (isset($_POST['update_cpu_data'])) {
                                        $id = $_POST['id_cpu'];

                                        $nazwaCPU = $_POST['nazwa'];
                                        $socket = $_POST['socket'];
                                        $zegar = $_POST['zegar'];
                                        $turbo = $_POST['turbo'];
                                        $rdzenie = $_POST['rdzenie'];
                                        $watki = $_POST['watki'];

                                        $query = "UPDATE cpu SET nazwa='$nazwaCPU', socket='$socket', zegar='$zegar', turbo='$turbo', rdzenie='$rdzenie', watki='$watki' WHERE id_cpu='$id'";
                                        echo $query;

                                        $query_run = mysqli_query($conn, $query);

                                        if ($query_run) {
                                            $_SESSION['status'] = "Data Updated Succesufully";
                                            // header("Location: add.php");
                                        } else {
                                            $_SESSION['status'] = "Not Updated";
                                            // header("Location: add.php");
                                        }
                                    }
                                }
                                ?>
                            </table>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="dodawanie">
                        <?php
                    }
                    if ($podzespoly[1] == $select) {
                        ?>
                        <label>Name</label>
                        <input type="text" id="nazwa" name="nazwa">
                        </br>
                        <label>Manyfacturer od chipset</label>
                        <input type="text" id="producent_chipsetu" name="producent_chipsetu">
                        </br>
                        <label>Length of GPU</label>
                        <input type="number" step="0.1" min="15" max="45" id="dlugosc_karty" name="dlugosc_karty">
                        </br>
                        <label>Capacity of RAM</label>
                        <input type="number" step="1" min="2" max="32" id="ilosc_ram" name="ilosc_ram">
                        </br>
                        <label>Type of chipset</label>
                        <input type="text" id="rodzaj_chipsetu" name="rodzaj_chipsetu">
                        </br>
                        <label>Recomended power of power supply</label>
                        <input type="number" step="1" min="500" max="2000" id="rekomendowana_moc_zasilacza"
                            name="rekomendowana_moc_zasilacza">
                        </br>
                        <label>Timing of thread boost</label>
                        <input type="number" step="0.1" min="0.0" max="10.0" id="taktowanie_rdzenia_boost"
                            name="taktowanie_rdzenia_boost">
                        </br>
                        <input type="submit" name="add" value="Add"
                            style="padding: 10px; border-radius: 5px; border: 1px solid #ccc; width: 250px;" />

                        <div class="a">
                            <a href='updateGpu.php'>Edit</a>
                        </div>
                    </div>
                    <div class="lista">
                        <?php
                        ?>


                        <form action="add.php" method="POST">
                            <input type="text" name="name" placeholder="give me nazwa " />
                            <input type="submit" name="submit" value="Submit"
                                style="padding: 10px; border-radius: 5px; border: 1px solid #ccc; width: 250px;" />

                        </form>
                        <?php if (isset($_POST['name'])) {


                            session_start();
                            $conn = mysqli_connect("localhost", "root", "", "peryferia");

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
                                    <th> Id </th>
                                    <th> Nazwa</th>
                                    <th> Producent Chipsetu</th>
                                </tr>
                                <?php
                                foreach ($dane_lista as $d) { ?>
                                    <?php echo "<tr><td>" . $d->getId_gpu() . "</td><td>" . $d->getNazwa() . " </td><td>" . $d->getProducent_chipsetu() . "</td></tr>"; ?>
                                    <?php
                                    if (isset($_POST['update_gpu_data'])) {
                                        $id = $_POST['id_gpu'];

                                        $nazwaGPU = $_POST['nazwa'];
                                        $producentChipsetu = $_POST['producent_chipsetu'];
                                        $dlugoscKarty = $_POST['dlugosc_karty'];
                                        $iloscRam = $_POST['ilosc_ram'];
                                        $rodzajChipsetu = $_POST['rodzaj_chipsetu'];
                                        $rekomendowanaMocZasilacza = $_POST['rekomendowana_moc_zasilacza'];
                                        $taktowanieRdzeniaBoost = $_POST['taktowanie_rdzenia_boost'];

                                        $query = "UPDATE cpu SET nazwa='$nazwaGPU', producent_chipsetu='$producentChipsetu', ilosc_ram='$iloscRam', rodzaj_chipsetu='$rodzajChipsetu', rekomendowana_moc_zasilacza='$rdzrekomendowanaMocZasilaczaenie', taktowanie_rdzenia_boost='$taktowanieRdzeniaBoost' WHERE id_gpu='$id'";
                                        echo $query;

                                        $query_run = mysqli_query($conn, $query);

                                        if ($query_run) {
                                            $_SESSION['status'] = "Data Updated Succesufully";
                                            // header("Location: add.php");
                                        } else {
                                            $_SESSION['status'] = "Not Updated";
                                            // header("Location: add.php");
                                        }
                                    }

                                }

                        }
                        ?>


                    </div>
                    <div class="dodawanie">
                        </table>
                        <?php
                    }
                    if ($podzespoly[2] == $select) {
                        ?>
                        <label>Name</label>
                        <input type="text" id="nazwa" name="nazwa">
                        </br>
                        <label>Certyfication</label>
                        <input type="text" id="certyfikat" name="certyfikat">
                        </br>
                        <label>Vent size</label>
                        <input type="number" step="1" min="10" max="36" id="srednica_wentylatora" name="srednica_wentylatora">
                        </br>
                        <label>Power</label>
                        <input type="number" step="1" min="500" max="2000" id="moc" name="moc">
                        </br>
                        <label>Standarization</label>
                        <input type="text" id="standard" name="standard">
                        </br>
                        <label>Height</label>
                        <input type="number" step="0.1" min="5" max="15" id="wysokosc" name="wysokosc">
                        </br>
                        <label>Width</label>
                        <input type="number" step="0.1" min="5" max="20" id="szerokosc" name="szerokosc">
                        </br>
                        <label>Depth</label>
                        <input type="number" step="0.1" min="5" max="25" id="glebokosc" name="glebokosc">
                        </br>
                        <input type="submit" name="add" value="Add"
                            style="padding: 10px; border-radius: 5px; border: 1px solid #ccc; width: 250px;" />
                        <div class="a">
                            <a href='updateZasilacz.php'>Edit</a>
                        </div>
                    </div>
                    <div class="lista">

                        <form action="add.php" method="POST">
                            <input type="text" name="name" placeholder="give me nazwa " />
                            <input type="submit" name="submit" value="Submit"
                                style="padding: 10px; border-radius: 5px; border: 1px solid #ccc; width: 250px;" />

                        </form>

                        <?php if (isset($_POST['name'])) {

                            session_start();
                            $conn = mysqli_connect("localhost", "root", "", "peryferia");

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
                                    <th> Id </th>
                                    <th> Nazwa</th>
                                    <th> Certyfikat </th>
                                    <th> Moc</th>
                                    <th> Standard</th>
                                </tr>
                                <?php
                                foreach ($dane_lista as $d) { ?>
                                    <?php echo "<tr><td>" . $d->getId_zasilacz() . "</td><td>" . $d->getNazwa() . " </td><td>" . $d->getCertyfikat() . " </td><td>" . $d->getMoc() . " </td><td>" . $d->getStandard() . "</td></tr>"; ?>
                                    <?php
                                    if (isset($_POST['updateZasilacz.php'])) {
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

                                        $query_run = mysqli_query($conn, $query);

                                        if ($query_run) {
                                            $_SESSION['status'] = "Data Updated Succesufully";
                                            // header("Location: add.php");
                                        } else {
                                            $_SESSION['status'] = "Not Updated";
                                            // header("Location: add.php");
                                        }
                                    }

                                }
                        }
                        ?>
                            <?php

                            ?>
                    </div>
                    <div class="dodawanie">
                        </table>
                        <?php

                    }
                    if ($podzespoly[3] == $select) {
                        ?>
                        <label>Name</label>
                        <input type="text" id="nazwa" name="nazwa">
                        </br>
                        <label>Board chipset</label>
                        <input type="text" id="chipset_plyty" name="chipset_plyty">
                        </br>
                        <label>Processor socket</label>
                        <input type="text" id="gniazdo_procesora" name="gniazdo_procesora">
                        </br>
                        <label>RAM slots count</label>
                        <input type="number" id="liczba_slotow_pamieci" name="liczba_slotow_pamieci">
                        </br>
                        <label>Board standard</label>
                        <input type="text" id="standard_plyty" name="standard_plyty">
                        </br>
                        <label>RAM standard</label>
                        <input type="text" id="standard_pamieci" name="standard_pamieci">
                        </br>
                        <label>Max size of RAM capacity</label>
                        <input type="number" id="maks_ilosc_pamieci_ram" name="maks_ilosc_pamieci_ram">
                        </br>
                        <input type="submit" name="add" value="Add"
                            style="padding: 10px; border-radius: 5px; border: 1px solid #ccc; width: 250px;" />
                        <div class="a">
                            <a href='updateMB.php'>Edit</a>
                        </div>
                    </div>
                    <div class="lista">
                        <form action="add.php" method="POST">
                            <input type="text" name="name" placeholder="give me nazwa " />
                            <input type="submit" name="submit" value="Submit"
                                style="padding: 10px; border-radius: 5px; border: 1px solid #ccc; width: 250px;" />
                        </form>

                        <?php if (isset($_POST['name'])) {
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
                                    <th> Id </th>
                                    <th> Nazwa </th>
                                    <th> Chipset</th>
                                    <th> Gniazdo </th>
                                    <th> Standard</th>
                                </tr>

                                <?php
                                foreach ($dane_lista as $d) { ?>
                                    <?php echo "<tr><td>" . $d->getId_mb() . "</td><td>" . $d->getNazwa() . " </td><td>" . $d->getChipset_plyty() . " </td><td>" . $d->getGniazdo_procesora() . " </td><td>" . $d->getStandard_plyty() . "</td></tr>";
                                    if (isset($_POST['updateMB.php'])) {
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

                                        $query_run = mysqli_query($conn, $query);

                                        if ($query_run) {
                                            $_SESSION['status'] = "Data Updated Succesufully";
                                            // header("Location: add.php");
                                        } else {
                                            $_SESSION['status'] = "Not Updated";
                                            // header("Location: add.php");
                                        }
                                    }
                                }
                                ?>
                            </table>
                        </div>
                        <div class="dodawanie">
                            <?php
                        }
                    }
                    if ($podzespoly[4] == $select) {
                        ?>
                        <label>Name</label>
                        <input type="text" id="nazwa" name="nazwa">
                        </br>
                        <label>Frequency</label>
                        <input type="number" id="czestotliwosc" name="czestotliwosc">
                        </br>
                        <label>Count of modules</label>
                        <input type="number" id="liczba_modulow" name="liczba_modulow">
                        </br>
                        <label>Summary capacity</label>
                        <input type="number" id="laczna_pamiec" name="laczna_pamiec">
                        </br>
                        <label>Delay</label>
                        <input type="text" id="opoznienie" name="opoznienie">
                        </br>
                        <label>Type of memory</label>
                        <input type="text" id="typ_pamieci" name="typ_pamieci">
                        </br>
                        <input type="submit" name="add" value="Add"
                            style="padding: 10px; border-radius: 5px; border: 1px solid #ccc; width: 250px;" />
                        <div class="a">
                            <a href='updateRAM.php'>Edit</a>
                        </div>
                    </div>
                    <div class="lista">
                        <form action="add.php" method="POST">
                            <input type="text" name="name" placeholder="give me nazwa " />
                            <input type="submit" name="submit" value="Submit"
                                style="padding: 10px; border-radius: 5px; border: 1px solid #ccc; width: 250px;" />
                        </form>

                        <?php if (isset($_POST['name'])) {
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
                                    <th> Id </th>
                                    <th> Nazwa</th>
                                    <th> Czestotliwosc </th>
                                    <th> Opoznienie</th>
                                    <th> typ pamieci </th>
                                </tr>
                                <?php
                                foreach ($dane_lista as $d) { ?>
                                    <?php echo "<tr><td>" . $d->getId_ram() . "</td><td>" . $d->getNazwa() . " </td><td>" . $d->getCzestotliwosc() . " </td><td>" . $d->getOpluznienie() . " </td><td>" . $d->getTyp_pamieci() . "</td></tr>";
                                    if (isset($_POST['updateRAM.php'])) {
                                        $id = $_POST['id_ram'];

                                        $nazwaRAM = $_POST['nazwa'];
                                        $czestotliwosc = $_POST['czestotliwosc'];
                                        $liczbaModulow = $_POST['liczba_modulow'];
                                        $lacznaPamiec = $_POST['laczna_pamiec'];
                                        $opoznienie = $_POST['opoznienie'];
                                        $typPamieci = $_POST['typ_pamieci'];

                                        $query = "UPDATE ram SET nazwa='$nazwaRAM', czestotliwosc='$czestotliwosc', liczba_modulow='$liczbaModulow', laczna_pamiec='$lacznaPamiec', opoznienie='$opoznienie', typ_pamieci='$typPamieci' WHERE id_ram='$id'";
                                        echo $query;

                                        $query_run = mysqli_query($conn, $query);

                                        if ($query_run) {
                                            $_SESSION['status'] = "Data Updated Succesufully";
                                            // header("Location: add.php");
                                        } else {
                                            $_SESSION['status'] = "Not Updated";
                                            // header("Location: add.php");
                                        }
                                    }

                                }


                                ?>
                            </table>
                        </div>
                        <div class="dodawanie">
                            <?php
                        }
                    }
                    if ($podzespoly[5] == $select) {
                        ?>
                        <label>Name</label>
                        <input type="text" id="nazwa" name="nazwa">
                        </br>
                        <label>Interface</label>
                        <input type="number" id="interfejs" name="interfejs">
                        </br>
                        <label>Capacity</label>
                        <input type="number" id="pojemnosc" name="pojemnosc">
                        </br>
                        <label>Format</label>
                        <input type="number" id="format" name="format">
                        </br>
                        <label>Reading</label>
                        <input type="text" id="odczyt" name="odczyt">
                        </br>
                        <label>Saving</label>
                        <input type="text" id="zapis" name="zapis">
                        </br>
                        <input type="submit" name="add" value="Add"
                            style="padding: 10px; border-radius: 5px; border: 1px solid #ccc; width: 250px;" />
                        <div class="a">
                            <a href='updateSSD.php'>Edit</a>
                        </div>
                    </div>
                    <div class="lista">
                        <form action="add.php" method="POST">
                            <input type="text" name="name" placeholder="give me nazwa " />
                            <input type="submit" name="submit" value="Submit"
                                style="padding: 10px; border-radius: 5px; border: 1px solid #ccc; width: 250px;" />
                        </form>
                        <?php if (isset($_POST['name'])) {
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
                                    <th> Id </th>
                                    <th> Nazwa </th>
                                    <th> Interfejs</th>
                                    <th> Pojemnosc</th>
                                </tr>
                                <?php
                                foreach ($dane_lista as $d) { ?>
                                    <?php echo "<tr><td>" . $d->getId() . "</td><td>" . $d->getNazwa() . " </td><td>" . $d->getInterfejs() . " </td><td>" . $d->getPojemnosc() . "</td></tr>";
                                    if (isset($_POST['updateSSD.php'])) {
                                        $id = $_POST['id'];

                                        $nazwaSSD = $_POST['nazwa'];
                                        $interfejs = $_POST['interfejs'];
                                        $pojemnosc = $_POST['pojemnosc'];
                                        $format = $_POST['format'];
                                        $odczyt = $_POST['odczyt'];
                                        $zapis = $_POST['zapis'];


                                        $query = "UPDATE ssd SET nazwa='$nazwaSSD', interfejs='$interfejs', pojemnosc='$pojemnosc', format='$format', odczyt='$odczyt', zapis='$zapis' WHERE id='$id'";
                                        echo $query;

                                        $query_run = mysqli_query($conn, $query);

                                        if ($query_run) {
                                            $_SESSION['status'] = "Data Updated Succesufully";
                                            // header("Location: add.php");
                                        } else {
                                            $_SESSION['status'] = "Not Updated";
                                            // header("Location: add.php");
                                        }
                                    }

                                }
                                ?>
                            </table>
                        </div>
                        <div class="dodawanie">
                            <?php
                        }
                    }
                    if ($podzespoly[6] == $select) {
                        ?>
                        <label>Name</label>
                        <input type="text" id="nazwa" name="nazwa">
                        </br>
                        <label>Format</label>
                        <input type="text" id="format" name="format">
                        </br>
                        <label>Interface</label>
                        <input type="number" id="interfejs" name="interfejs">
                        </br>
                        <label>Cache</label>
                        <input type="text" id="pamiec_podreczna" name="pamiec_podreczna">
                        </br>
                        <label>Capacity</label>
                        <input type="number" id="pojemnosc" name="pojemnosc">
                        </br>
                        <label>Speed</label>
                        <input type="number" id="predkosc" name="predkosc">
                        </br>
                        <input type="submit" name="add" value="Add"
                            style="padding: 10px; border-radius: 5px; border: 1px solid #ccc; width: 250px;" />
                        <div class="a">
                            <a href='updateHDD.php'>Edit</a>
                        </div>
                    </div>
                    <div class="lista">
                        <form action="add.php" method="POST">
                            <input type="text" name="name" placeholder="give me nazwa " />
                            <input type="submit" name="submit" value="Submit"
                                style="padding: 10px; border-radius: 5px; border: 1px solid #ccc; width: 250px;" />
                        </form>
                        <?php if (isset($_POST['name'])) {
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
                                    <th> Id </th>
                                    <th> Nazwa </th>
                                    <th> Interfejs</th>
                                    <th> Pojemnosc </th>
                                </tr>
                                <?php
                                foreach ($dane_lista as $d) { ?>
                                    <?php echo "<tr><td>" . $d->getId_hdd() . "</td><td>" . $d->getNazwa() . " </td><td>" . $d->getInterfejs() . " </td><td>" . $d->getPojemnosc() . "</td></tr>";
                                    if (isset($_POST['updateHDD.php'])) {
                                        $id = $_POST['id_hdd'];

                                        $nazwaHDD = $_POST['nazwa'];
                                        $formatHDD = $_POST['format'];
                                        $interfejsHDD = $_POST['interfejs'];
                                        $pamiecPodreczna = $_POST['pamiec_podreczna'];
                                        $pojemnoscHDD = $_POST['pojemnosc'];
                                        $predkoscHDD = $_POST['predkosc'];


                                        $query = "UPDATE hdd SET nazwa='$nazwaHDD', format='$formatHDD', interfejs='$interfejsHDD', pamiec_podreczna='$forpamiecPodrecznamat', pojemnosc='$pojemnoscHDD', predkosc='$predkoscHDD' WHERE id_hdd='$id'";
                                        echo $query;

                                        $query_run = mysqli_query($conn, $query);

                                        if ($query_run) {
                                            $_SESSION['status'] = "Data Updated Succesufully";
                                            // header("Location: add.php");
                                        } else {
                                            $_SESSION['status'] = "Not Updated";
                                            // header("Location: add.php");
                                        }
                                    }
                                }
                                ?>
                            </table>
                        </div>
                        <div class="dodawanie">
                            <?php
                        }
                    }
                    if ($podzespoly[7] == $select) {
                        ?>
                        <label>Name</label>
                        <input type="text" id="nazwa" name="nazwa">
                        </br>
                        <label>MAX TDP</label>
                        <input type="number" id="maks_TDP" name="maks_TDP">
                        </br>
                        <label>Socket</label>
                        <input type="text" id="socket" name="socket">
                        </br>
                        <label>Height</label>
                        <input type="number" id="wysokosc" name="wysokosc">
                        </br>
                        <label>Width</label>
                        <input type="number" id="szerokosc" name="szerokosc">
                        </br>
                        <label>Depth</label>
                        <input type="number" id="glebokosc" name="glebokosc">
                        </br>
                        <label>Count of heatpipes</label>
                        <input type="number" id="ilosc_cieplowodow" name="ilosc_cieplowodow">
                        </br>
                        <label>Diameter of heatpipes</label>
                        <input type="number" id="srednica_cieplowodow" name="srednica_cieplowodow">
                        </br>
                        <input type="submit" name="add" value="Add"
                            style="padding: 10px; border-radius: 5px; border: 1px solid #ccc; width: 250px;" />
                        <div class="a">
                            <a href='updateCooler.php'>Edit</a>
                        </div>
                    </div>
                    <div class="lista">
                        <form action="add.php" method="POST">
                            <input type="text" name="name" placeholder="give me nazwa " />
                            <input type="submit" name="submit" value="Submit"
                                style="padding: 10px; border-radius: 5px; border: 1px solid #ccc; width: 250px;" />
                        </form>
                        <?php if (isset($_POST['name'])) {
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
                                    <th> Id </th>
                                    <th>Nazwa </th>
                                    <th>Soket |</th>
                                    <th>Max TDP</th>

                                </tr>
                                <?php
                                foreach ($dane_lista as $d) { ?>
                                    <?php echo "<tr><td>" . $d->getId_chlodzenie_cpu() . "</td><td>" . $d->getNazwa() . " </td><td>" . $d->getSocket() . " </td><td>" . $d->getMaks_TDP() . "</td></tr>";
                                    if (isset($_POST['updateCooler.php'])) {
                                        $id = $_POST['id_chlodzenie_cpu'];

                                        $nazwaCooler = $_POST['nazwa'];
                                        $maks_TDP = $_POST['maks_TDP'];
                                        $socketCooler = $_POST['socket'];
                                        $wysokoscCooler = $_POST['wysokosc'];
                                        $szerokoscCooler = $_POST['szerokosc'];
                                        $glebokoscCooler = $_POST['glebokosc'];
                                        $iloscCooler = $_POST['ilosc_cieplowodow'];
                                        $srednicaCooler = $_POST['srednica_cieplowodow'];


                                        $query = "UPDATE chlodzenie_cpu SET nazwa='$nazwaCooler', maks_TDP='$maks_TDP', socket='$socketCooler', wysokosc='$wysokoscCooler', szerokosc='$szerokoscCooler', glebokosc='$glebokoscCooler', ilosc_cieplowodow='$iloscCooler', srednica_cieplowodow='$srednicaCooler'   WHERE id_chlodzenie_cpu='$id'";
                                        echo $query;

                                        $query_run = mysqli_query($conn, $query);

                                        if ($query_run) {
                                            $_SESSION['status'] = "Data Updated Succesufully";
                                            // header("Location: add.php");
                                        } else {
                                            $_SESSION['status'] = "Not Updated";
                                            // header("Location: add.php");
                                        }
                                    }
                                }
                                ?>
                            </table>
                        </div>
                        <div class="dodawanie">
                            <?php
                        }

                    }
                    if ($podzespoly[8] == $select) {
                        ?>
                        <label>Name</label>
                        <input type="text" id="nazwa" name="nazwa">
                        </br>
                        <label>Standard</label>
                        <input type="text" id="standard" name="standard">
                        </br>
                        <label>MAX size of GPU</label>
                        <input type="number" id="maks_dlugosc_karty_graficznej" name="maks_dlugosc_karty_graficznej">
                        </br>
                        <label>Type of case</label>
                        <input type="text" id="typ_obudowy" name="typ_obudowy">
                        </br>
                        <label>Height</label>
                        <input type="number" id="wyskokosc" name="wyskokosc">
                        </br>
                        <label>Width</label>
                        <input type="number" id="szerokosc" name="szerokosc">
                        </br>
                        <label>Depth</label>
                        <input type="number" id="glebokosc" name="glebokosc">
                        </br>
                        <input type="submit" name="add" value="Add"
                            style="padding: 10px; border-radius: 5px; border: 1px solid #ccc; width: 250px;" />
                        <div class="a">
                            <a href='updateCase.php'>Edit</a>
                        </div>
                    </div>
                    <div class="lista">
                        <form action="add.php" method="POST">
                            <input type="text" name="name" placeholder="give me nazwa " />
                            <input type="submit" name="submit" value="Submit"
                                style="padding: 10px; border-radius: 5px; border: 1px solid #ccc; width: 250px;" />
                        </form>
                        <?php if (isset($_POST['name'])) {
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
                                    <th> Id </th>
                                    <th> Nazwa</th>
                                    <th> Standard</th>
                                    <th> Typ obudowy </th>
                                    <th> Max dlugosc karty</th>
                                </tr>
                                <?php
                                foreach ($dane_lista as $d) { ?>
                                    <?php echo "<tr><td>" . $d->getId_obudowa() . "</td><td>" . $d->getNazwa() . " </td><td>" . $d->getStandard() . " </td><td>" . $d->getTyp_obudowy() . " </td><td>" . $d->getMaks_dlugosc_karty_graf() . "</td></tr>";
                                    if (isset($_POST['updateCase.php'])) {
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

                                        $query_run = mysqli_query($conn, $query);

                                        if ($query_run) {
                                            $_SESSION['status'] = "Data Updated Succesufully";
                                            // header("Location: add.php");
                                        } else {
                                            $_SESSION['status'] = "Not Updated";
                                            // header("Location: add.php");
                                        }

                                    }
                                }
                                ?>
                            </table>
                        </div>
                        <?php
                        }

                    }
                    ?>
                <input type="text" name="select" hidden value="<?php echo $select ?>">
                <?php
            }


            ?>



    </form>
    </div>
    <?php

    if (isset($_POST['select'])) {
        $select = $_POST['select'];
    }

    //echo $select;
    //var_dump($_POST);
    
    if ($select == "cpu" && isset($_POST["add"]) && isset($_POST["nazwa"]) && isset($_POST["socket"]) && isset($_POST["zegar"]) && isset($_POST["turbo"]) && $_POST["rdzenie"] && isset($_POST["watki"])) {
        $nazwa = test_input($_POST["nazwa"]);
        $socket = test_input($_POST["socket"]);
        $zegar = test_input($_POST["zegar"]);
        $turbo = test_input($_POST["turbo"]);
        $rdzenie = test_input($_POST["rdzenie"]);
        $watki = test_input($_POST["watki"]);

        $cpu = (new Cpu())
            ->setNazwa($nazwa)
            ->setCpu_socket($socket)
            ->setZegar($zegar)
            ->setTurbo($turbo)
            ->setRdzenie($rdzenie)
            ->setWatki($watki);

        $entityManager->persist($cpu);
        $entityManager->flush();
        //header("Location: add.php");
        echo "CPU add was succesful.";

    } else if ($select == "gpu" && isset($_POST["add"]) && isset($_POST["nazwa"]) && isset($_POST["producent_chipsetu"]) && isset($_POST["dlugosc_karty"]) && isset($_POST["ilosc_ram"]) && isset($_POST["rodzaj_chipsetu"]) && isset($_POST["rekomendowana_moc_zasilacza"]) && isset($_POST["taktowanie_rdzenia_boost"])) {
        $nazwa = test_input($_POST["nazwa"]);
        $producnet_chipsetu = test_input($_POST["producent_chipsetu"]);
        $dlugosc_karty = test_input($_POST["dlugosc_karty"]);
        $ilosc_ram = test_input($_POST["ilosc_ram"]);
        $rodzaj_chipsetu = test_input($_POST["rodzaj_chipsetu"]);
        $rekomendowana_moc_zasilacza = test_input($_POST["rekomendowana_moc_zasilacza"]);
        $taktowanie_rdzenia_boost = test_input($_POST["taktowanie_rdzenia_boost"]);

        $gpu = (new Gpu())
            ->setNazwa($nazwa)
            ->setProducent_chipsetu($producnet_chipsetu)
            ->setDlugosc_karty($dlugosc_karty)
            ->setIlosc_ram($ilosc_ram)
            ->setRodzaj_chipsetu($rodzaj_chipsetu)
            ->setRekomendowana_moc_zasilacza($rekomendowana_moc_zasilacza)
            ->setTaktowanie_rdzenia_boost($taktowanie_rdzenia_boost);

        $entityManager->persist($gpu);
        $entityManager->flush();
        echo "GPU add was succesful.";
    } else if ($select == "zasilacz" && isset($_POST["add"]) && isset($_POST["nazwa"]) && isset($_POST["certyfikat"]) && isset($_POST["srednica_wentylatora"]) && isset($_POST["moc"]) && isset($_POST["standard"]) && isset($_POST["wysokosc"]) && isset($_POST["szerokosc"]) && isset($_POST["glebokosc"])) {
        $nazwa = test_input($_POST["nazwa"]);
        $certyfikat = test_input($_POST["certyfikat"]);
        $srednica_wentylatora = test_input($_POST["srednica_wentylatora"]);
        $moc = test_input($_POST["moc"]);
        $standard = test_input($_POST["standard"]);
        $wysokosc = test_input($_POST["wysokosc"]);
        $szerokosc = test_input($_POST["szerokosc"]);
        $glebokosc = test_input($_POST["glebokosc"]);

        $zasilacz = (new Zasilacz())
            ->setNazwa($nazwa)
            ->setCertyfikat($certyfikat)
            ->setSrednica_wentylatora($srednica_wentylatora)
            ->setMoc($moc)
            ->setStandard($standard)
            ->setWysokosc($wysokosc)
            ->setSzerokosc($szerokosc)
            ->setGlebokosc($glebokosc);

        $entityManager->persist($zasilacz);
        $entityManager->flush();
        echo "Power supply add was succesful.";
    } else if ($select == "mb" && isset($_POST["add"]) && isset($_POST["nazwa"]) && isset($_POST["chipset_plyty"]) && isset($_POST["gniazdo_procesora"]) && isset($_POST["liczba_slotow_pamieci"]) && isset($_POST["standard_plyty"]) && isset($_POST["standard_pamieci"]) && isset($_POST["maks_ilosc_pamieci_ram"])) {
        $nazwa = test_input($_POST["nazwa"]);
        $chipset_plyty = test_input($_POST["chipset_plyty"]);
        $gniazdo_procesora = test_input($_POST["gniazdo_procesora"]);
        $liczba_slotow_pamieci = test_input($_POST["liczba_slotow_pamieci"]);
        $standard_plyty = test_input($_POST["standard_plyty"]);
        $standard_pamieci = test_input($_POST["standard_pamieci"]);
        $maks_ilosc_pamieci_ram = test_input($_POST["maks_ilosc_pamieci_ram"]);

        $mb = (new Mb())
            ->setNazwa($nazwa)
            ->setChipset_plyty($chipset_plyty)
            ->setGniazdo_procesora($gniazdo_procesora)
            ->setLiczba_slotow_pamieci($liczba_slotow_pamieci)
            ->setStandard_plyty($standard_plyty)
            ->setStandard_pamieci($standard_pamieci)
            ->setMaks_ilosc_pamieci_ram($maks_ilosc_pamieci_ram);

        $entityManager->persist($mb);
        $entityManager->flush();
        echo "Mother board add was succesful.";
    } else if ($select == "ram" && isset($_POST["add"]) && isset($_POST["nazwa"]) && isset($_POST["czestotliwosc"]) && isset($_POST["liczba_modulow"]) && isset($_POST["laczna_pamiec"]) && isset($_POST["opuznienie"]) && isset($_POST["typ_pamieci"])) {
        $nazwa = test_input($_POST["nazwa"]);
        $czestotliwosc = test_input($_POST["czestotliwosc"]);
        $liczba_modulow = test_input($_POST["liczba_modulow"]);
        $laczna_pamiec = test_input($_POST["laczna_pamiec"]);
        $opuznienie = test_input($_POST["opuznienie"]);
        $typ_pamieci = test_input($_POST["typ_pamieci"]);

        $ram = (new Ram())
            ->setNazwa($nazwa)
            ->setCzestotliwosc($czestotliwosc)
            ->setLiczba_modulow($liczba_modulow)
            ->setLaczna_pamiec($laczna_pamiec)
            ->setOpluznienie($opuznienie)
            ->setTyp_pamieci($typ_pamieci);

        $entityManager->persist($ram);
        $entityManager->flush();
        echo "RAM add was succesful.";
    } else if ($select == "ssd" && isset($_POST["add"]) && isset($_POST["nazwa"]) && isset($_POST["interfejs"]) && isset($_POST["pojemnosc"]) && isset($_POST["format"]) && isset($_POST["odczyt"]) && isset($_POST["zapis"])) {
        $nazwa = test_input($_POST["nazwa"]);
        $interfejs = test_input($_POST["interfejs"]);
        $pojemnosc = test_input($_POST["pojemnosc"]);
        $format = test_input($_POST["format"]);
        $odczyt = test_input($_POST["odczyt"]);
        $zapis = test_input($_POST["zapis"]);

        $ssd = (new Ssd())
            ->setNazwa($nazwa)
            ->setInterfejs($interfejs)
            ->setPojemnosc($pojemnosc)
            ->setFormat($format)
            ->setOdczyt($odczyt)
            ->setZapis($zapis);

        $entityManager->persist($ssd);
        $entityManager->flush();
        echo "SSD add was succesful.";
    } else if ($select == "hdd" && isset($_POST["add"]) && isset($_POST["nazwa"]) && isset($_POST["format"]) && isset($_POST["interfejs"]) && isset($_POST["pamiec_podreczna"]) && isset($_POST["pojemnosc"]) && isset($_POST["predkosc"])) {
        $nazwa = test_input($_POST["nazwa"]);
        $format = test_input($_POST["format"]);
        $interfejs = test_input($_POST["interfejs"]);
        $pamiec_podreczna = test_input($_POST["pamiec_podreczna"]);
        $pojemnosc = test_input($_POST["pojemnosc"]);
        $predkosc = test_input($_POST["predkosc"]);

        $hdd = (new Hdd())
            ->setNazwa($nazwa)
            ->setFormat($format)
            ->setInterfejs($interfejs)
            ->setPamiec_podreczna($pamiec_podreczna)
            ->setPojemnosc($pojemnosc)
            ->setPredkosc($predkosc);

        $entityManager->persist($hdd);
        $entityManager->flush();
        echo "HDD add was succesful.";
    } else if ($select == "chlodzenie_cpu" && isset($_POST["add"]) && isset($_POST["nazwa"]) && isset($_POST["maks_TDP"]) && isset($_POST["socket"]) && isset($_POST["wysokosc"]) && isset($_POST["szerokosc"]) && isset($_POST["glebokosc"]) && isset($_POST["ilosc_cieplowodow"]) && isset($_POST["srednica_cieplowodow"])) {
        $nazwa = test_input($_POST["nazwa"]);
        $maks_TDP = test_input($_POST["maks_TDP"]);
        $socket = test_input($_POST["socket"]);
        $wysokosc = test_input($_POST["wysokosc"]);
        $szerokosc = test_input($_POST["szerokosc"]);
        $glebokosc = test_input($_POST["glebokosc"]);
        $ilosc_cieplowodow = test_input($_POST["ilosc_cieplowodow"]);
        $srednica_cieplowodow = test_input($_POST["srednica_cieplowodow"]);

        $chlodzenie_cpu = (new CpuCooler())
            ->setNazwa($nazwa)
            ->setMaks_TDP($maks_TDP)
            ->setSocket($socket)
            ->setWysokosc($wysokosc)
            ->setSzerokosc($szerokosc)
            ->setGlebokosc($glebokosc)
            ->setIlosc_cieplowodow($ilosc_cieplowodow)
            ->setSrednica_cieplowodow($srednica_cieplowodow);

        $entityManager->persist($chlodzenie_cpu);
        $entityManager->flush();
        echo "CPU coller add was succesful.";
    } else if ($select == "obudowa" && isset($_POST["add"]) && isset($_POST["nazwa"]) && isset($_POST["standard"]) && isset($_POST["maks_dlugosc_karty_graf"]) && isset($_POST["typ_obudowy"]) && isset($_POST["wysokosc"]) && isset($_POST["szerokosc"]) && isset($_POST["glebokosc"])) {
        $nazwa = test_input($_POST["nazwa"]);
        $standard = test_input($_POST["standard"]);
        $maks_dlugosc_karty_graf = test_input($_POST["maks_dlugosc_karty_graf"]);
        $typ_obudowy = test_input($_POST["typ_obudowy"]);
        $wysokosc = test_input($_POST["wysokosc"]);
        $szerokosc = test_input($_POST["szerokosc"]);
        $glebokosc = test_input($_POST["glebokosc"]);

        $obudowa = (new Obudowa())
            ->setNazwa($nazwa)
            ->setStandard($standard)
            ->setMaks_dlugosc_karty_graf($maks_dlugosc_karty_graf)
            ->setTyp_obudowy($typ_obudowy)
            ->setWysokosc($wysokosc)
            ->setSzerokosc($szerokosc)
            ->setGlebokosc($glebokosc);

        $entityManager->persist($obudowa);
        $entityManager->flush();
        echo "Case add was succesful.";
    }
    ?>


    <script src="../JS/script.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>