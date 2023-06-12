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
            <a href="konfigurepc.php"><ion-icon name="home-sharp">Konfigure PC</ion-icon></a>
            <a href="serch2.php"><ion-icon name="search-sharp">Serch</ion-icon></a>
            <a href="add.php">Return to main page</a>
            <button class="button-out" href="../index.html">Log out</button>
        </nav>
    </header>

    <div class="add">
        <form action="" method="post">
            <?php if (!isset($_POST['submit'])) { ?>
                <label>Choose what you wont to add: </label>
                <select name="select">
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
                <button type="submit" name="submit">Submit</button>
            <?php } ?>
            <?php
            $podzespoly = ["cpu", "gpu", "zasilacz", "mb", "ram", "ssd", "hdd", "chlodzenie_cpu", "obudowa"];
            if (isset($_POST["submit"])) {
                $select = $_POST["select"];
                //echo($select);
                if (empty($select)) {
                    echo "There is no opption choosed.";
                }
                if ($podzespoly[0] == $select) {
                    ?>
                    <label>Name</label>
                    <input type="text" id="nazwa" name="nazwa">
                    <label>Socket</label>
                    <input type="text" id="socket" name="socket">
                    <label>Clock</label>
                    <input type="number" step="0.1" min="0.0" max="10.0" id="zegar" name="zegar">
                    <label>Turbo</label>
                    <input type="number" step="0.1" min="0.0" max="10.0" id="turbo" name="turbo">
                    <label>Cores</label>
                    <input type="number" min="0" max="64" id="rdzenie" name="rdzenie">
                    <label>Threads</label>
                    <input type="number" min="0" max="128" id="watki" name="watki">
                    <button type="submit" name="add">Add</button>
                    <?php
                }
                if ($podzespoly[1] == $select) {
                    ?>
                    <label>Name</label>
                    <input type="text" id="nazwa" name="nazwa">
                    <label>Manyfacturer od chipset</label>
                    <input type="text" id="producent_chipsetu" name="producent_chipsetu">
                    <label>Length of GPU</label>
                    <input type="number" step="0.1" min="15" max="45" id="dlugosc_karty" name="dlugosc_karty">
                    <label>Capacity of RAM</label>
                    <input type="number" step="1" min="2" max="32" id="ilosc_ram" name="ilosc_ram">
                    <label>Type of chipset</label>
                    <input type="text" id="rodzaj_chipsetu" name="rodzaj_chipsetu">
                    <label>Recomended power of power supply</label>
                    <input type="number" step="1" min="500" max="2000" id="rekomendowana_moc_zasilacza"
                        name="rekomendowana_moc_zasilacza">
                    <label>Timing of thread boost</label>
                    <input type="number" step="0.1" min="0.0" max="10.0" id="taktowanie_rdzenia_boost"
                        name="taktowanie_rdzenia_boost">
                    <button type="submit" name="add">Add</button>
                    <?php
                }
                if ($podzespoly[2] == $select) {
                    ?>
                    <label>Name</label>
                    <input type="text" id="nazwa" name="nazwa">
                    <label>Certyfication</label>
                    <input type="text" id="certyfikat" name="certyfikat">
                    <label>Vent size</label>
                    <input type="number" step="1" min="10" max="36" id="srednica_wentylatora" name="srednica_wentylatora">
                    <label>Power</label>
                    <input type="number" step="1" min="500" max="2000" id="moc" name="moc">
                    <label>Standarization</label>
                    <input type="text" id="standard" name="standard">
                    <label>Height</label>
                    <input type="number" step="0.1" min="5" max="15" id="wysokosc" name="wysokosc">
                    <label>Width</label>
                    <input type="number" step="0.1" min="5" max="20" id="szerokosc" name="szerokosc">
                    <label>Depth</label>
                    <input type="number" step="0.1" min="5" max="25" id="glebokosc" name="glebokosc">
                    <button type="submit" name="add">Add</button>
                    <?php
                }
                if ($podzespoly[3] == $select) {
                    ?>
                    <label>Name</label>
                    <input type="text" id="nazwa" name="nazwa">
                    <label>Board chipset</label>
                    <input type="text" id="chipset_plyty" name="chipset_plyty">
                    <label>Processor socket</label>
                    <input type="text" id="gniazdo_procesora" name="gniazdo_procesora">
                    <label>RAM slots count</label>
                    <input type="number" id="liczba_slotow_pamieci" name="liczba_slotow_pamieci">
                    <label>Board standard</label>
                    <input type="text" id="standard_plyty" name="standard_plyty">
                    <label>RAM standard</label>
                    <input type="text" id="standard_pamieci" name="standard_pamieci">
                    <label>Max size of RAM capacity</label>
                    <input type="number" id="maks_ilosc_pamieci_ram" name="maks_ilosc_pamieci_ram">
                    <button type="submit" name="add">Add</button>
                    <?php
                }
                if ($podzespoly[4] == $select) {
                    ?>
                    <label>Name</label>
                    <input type="text" id="nazwa" name="nazwa">
                    <label>Frequency</label>
                    <input type="number" id="czestotliwosc" name="czestotliwosc">
                    <label>Count of modules</label>
                    <input type="number" id="liczba_modulow" name="liczba_modulow">
                    <label>Summary capacity</label>
                    <input type="number" id="laczna_pamiec" name="laczna_pamiec">
                    <label>Delay</label>
                    <input type="text" id="opoznienie" name="opoznienie">
                    <label>Type of memory</label>
                    <input type="text" id="typ_pamieci" name="typ_pamieci">
                    <button type="submit" name="add">Add</button>
                    <?php
                }
                if ($podzespoly[5] == $select) {
                    ?>
                    <label>Name</label>
                    <input type="text" id="nazwa" name="nazwa">
                    <label>Interface</label>
                    <input type="number" id="interfejs" name="interfejs">
                    <label>Capacity</label>
                    <input type="number" id="pojemnosc" name="pojemnosc">
                    <label>Format</label>
                    <input type="number" id="format" name="format">
                    <label>Reading</label>
                    <input type="text" id="odczyt" name="odczyt">
                    <label>Saving</label>
                    <input type="text" id="zapis" name="zapis">
                    <button type="submit" name="add">Add</button>
                    <?php
                }
                if ($podzespoly[6] == $select) {
                    ?>
                    <label>Name</label>
                    <input type="text" id="nazwa" name="nazwa">
                    <label>Format</label>
                    <input type="text" id="format" name="format">
                    <label>Interface</label>
                    <input type="number" id="interfejs" name="interfejs">
                    <label>Cache</label>
                    <input type="text" id="pamiec_podreczna" name="pamiec_podreczna">
                    <label>Capacity</label>
                    <input type="number" id="pojemnosc" name="pojemnosc">
                    <label>Speed</label>
                    <input type="number" id="predkosc" name="predkosc">
                    <button type="submit" name="add">Add</button>
                    <?php
                }
                if ($podzespoly[7] == $select) {
                    ?>
                    <label>Name</label>
                    <input type="text" id="nazwa" name="nazwa">
                    <label>MAX TDP</label>
                    <input type="number" id="maks_TDP" name="maks_TDP">
                    <label>Socket</label>
                    <input type="text" id="socket" name="socket">
                    <label>Height</label>
                    <input type="number" id="wysokosc" name="wysokosc">
                    <label>Width</label>
                    <input type="number" id="szerokosc" name="szerokosc">
                    <label>Depth</label>
                    <input type="number" id="glebokosc" name="glebokosc">
                    <label>Count of heatpipes</label>
                    <input type="number" id="ilosc_cieplowodow" name="ilosc_cieplowodow">
                    <label>Diameter of heatpipes</label>
                    <input type="number" id="srednica_cieplowodow" name="srednica_cieplowodow">
                    <button type="submit" name="add">Add</button>
                    <?php
                }
                if ($podzespoly[8] == $select) {
                    ?>
                    <label>Name</label>
                    <input type="text" id="nazwa" name="nazwa">
                    <label>Standard</label>
                    <input type="text" id="standard" name="standard">
                    <label>MAX size of GPU</label>
                    <input type="number" id="maks_dlugosc_karty_graficznej" name="maks_dlugosc_karty_graficznej">
                    <label>Type of case</label>
                    <input type="text" id="typ_obudowy" name="typ_obudowy">
                    <label>Height</label>
                    <input type="number" id="wyskokosc" name="wyskokosc">
                    <label>Width</label>
                    <input type="number" id="szerokosc" name="szerokosc">
                    <label>Depth</label>
                    <input type="number" id="glebokosc" name="glebokosc">
                    <button type="submit" name="add">Add</button>
                    <?php
                }
                ?>
                <input type="text" name="select" hidden value="<?php echo $select ?>">
                <?php
            }
            ?>
        </form>
    </div>
    <div class="parts">
        <?php
        if (isset($_POST["submit"])) {
            $select = $_POST["select"];
            //echo($select);
            if (empty($select)) {
                echo "There is no opption choosed.";
            }
            if ($podzespoly[0] == $select) {
                $queryBuilder = $entityManager->createQueryBuilder();
                $cpusQuery = $queryBuilder
                    ->select('c')
                    ->from(Cpu::class, 'c')
                    ->getQuery();
                $cpus = $cpusQuery->getResult();
                ?>
                <table>
                    <tr>
                        <!--<th>ID</th>-->
                        <th>Name</th>
                        <th>Socket</th>
                        <!--<th>Turbo</th>-->
                        <!--<th>Cores</th>-->
                        <!--<th>Threads</th>-->
                        <th>Add</th>
                    </tr>
                    <?php
                    foreach ($cpus as $cpu) {
                        echo "<tr>";
                        //echo "<td>" . $cpu->getId_cpu() . "</td>";
                        echo "<td>" . $cpu->getNazwa() . "</td>";
                        echo "<td>" . $cpu->getCpu_socket() . "</td>";
                        //echo "<td>" . $cpu->getTurbo() . "</td>";
                        //echo "<td>" . $cpu->getRdzenie() . "</td>";
                        //echo "<td>" . $cpu->getWatki() . "</td>";
                        echo "<td><form method='POST'><button type='submit'>Edit</button></form></td>";
                        echo "</tr>";
                    }
                    ?>
                </table>
                <?php
            }
            if ($podzespoly[1] == $select) {
                $queryBuilder = $entityManager->createQueryBuilder();
                $gpusQuery = $queryBuilder
                    ->select('c')
                    ->from(Gpu::class, 'c')
                    ->getQuery();
                $gpus = $gpusQuery->getResult();
                ?>
                <table>
                    <tr>
                        <!--<th>ID</th>-->
                        <th>Name</th>
                        <!--<th>Chipset manufacturer</th>-->
                        <!--<th>Length</th>-->
                        <th>RAM</th>
                        <!--<th>Chipset type</th>-->
                        <th>Recomended PSU power</th>
                        <!--<th>BOOST</th>-->
                        <th>Add</th>
                    </tr>

                    <?php

                    foreach ($gpus as $gpu) {
                        echo "<tr>";
                        echo "<td>" . $gpu->getId_gpu() . "</td>";
                        echo "<td>" . $gpu->getNazwa() . "</td>";
                        echo "<td>" . $gpu->getProducent_chipsetu() . "</td>";
                        echo "<td>" . $gpu->getDlugosc_karty() . "</td>";
                        echo "<td>" . $gpu->getIlosc_ram() . "</td>";
                        echo "<td>" . $gpu->getRodzaj_chipsetu() . "</td>";
                        echo "<td>" . $gpu->getRekomendowana_moc_zasilacza() . "</td>";
                        echo "<td>" . $gpu->getTaktowanie_rdzenia_boost() . "</td>";
                        echo "<td><form method='POST'><button type='submit'>Add</button></form></td>";
                        echo "</tr>";
                    }
                    ?>
                </table>

                <?php
            }
            if ($podzespoly[2] == $select) {
                $queryBuilder = $entityManager->createQueryBuilder();
                $zasilaczeQuery = $queryBuilder
                    ->select('c')
                    ->from(Zasilacz::class, 'c')
                    ->getQuery();
                $zasilacze = $zasilaczeQuery->getResult();
                ?>

                <table>
                    <tr>
                        <!--<th>ID</th>-->
                        <th>Name</th>
                        <!--<th>Certyficate</th>-->
                        <!--<th>Fan size</th>-->
                        <th>Power</th>
                        <th>Standard</th>
                        <!--<th>Heigth</th>-->
                        <!--<th>Width</th>-->
                        <!--<th>Depth</th>-->
                        <th>Add</th>
                    </tr>

                    <?php

                    foreach ($zasilacze as $zasilacz) {
                        echo "<tr>";
                        //echo "<td>" . $zasilacz->getId_zasilacz() . "</td>";
                        echo "<td>" . $zasilacz->getNazwa() . "</td>";
                        //echo "<td>" . $zasilacz->getCertyfikat() . "</td>";
                        //echo "<td>" . $zasilacz->getSrednica_wentylatora() . "</td>";
                        echo "<td>" . $zasilacz->getMoc() . "</td>";
                        echo "<td>" . $zasilacz->getStandard() . "</td>";
                        //echo "<td>" . $zasilacz->getWysokosc() . "</td>";
                        //echo "<td>" . $zasilacz->getSzerokosc() . "</td>";
                        //echo "<td>" . $zasilacz->getGlebokosc() . "</td>";
                        echo "<td><form method='POST'><button type='submit'>Add</button></form></td>";
                        echo "</tr>";
                    }
                    ?>
                </table>

                <?php
            }
            if ($podzespoly[3] == $select) {
                $queryBuilder = $entityManager->createQueryBuilder();
                $moboQuery = $queryBuilder
                    ->select('c')
                    ->from(Mb::class, 'c')
                    ->getQuery();
                $mobos = $moboQuery->getResult();
                ?>
                <table>
                    <tr>
                        <!--<th>ID</th>-->
                        <th>Name</th>
                        <!--<th>Mb chipset</th>-->
                        <!--<th>CPU socket</th>-->
                        <th>RAM slots</th>
                        <!--<th>Mb standard</th>-->
                        <!--<th>RAM standard</th>-->
                        <th>Max RAM capacity</th>
                        <th>Add</th>
                    </tr>
                    <?php
                    foreach ($mobos as $mb) {
                        echo "<tr>";
                        //echo "<td>" . $mb->getId_mb() . "</td>";
                        echo "<td>" . $mb->getNazwa() . "</td>";
                        //echo "<td>" . $mb->getChipset_plyty() . "</td>";
                        //echo "<td>" . $mb->getGniazdo_procesora() . "</td>";
                        echo "<td>" . $mb->getLiczba_slotow_pamieci() . "</td>";
                        echo "<td>" . $mb->getStandard_plyty() . "</td>";
                        //echo "<td>" . $mb->getStandard_pamieci() . "</td>";
                        echo "<td>" . $mb->getMaks_ilosc_pamieci_ram() . "</td>";
                        echo "<td><form method='POST'><button type='submit'>Add</button></form></td>";
                        echo "</tr>";
                    }
                    ?>
                </table>
                <?php
            }
            if ($podzespoly[4] == $select) {
                $queryBuilder = $entityManager->createQueryBuilder();
                $ramQuery = $queryBuilder
                    ->select('c')
                    ->from(Ram::class, 'c')
                    ->getQuery();
                $ramMemories = $ramQuery->getResult();
                ?>
                <table>
                    <table>
                        <tr>
                            <!--<th>ID</th>-->
                            <th>Name</th>
                            <th>Friquency</th>
                            <th>How much modules</th>
                            <th>Capacity</th>
                            <!--<th>CLI</th>-->
                            <!--<th>Type</th>-->
                            <th>Add</th>
                        </tr>

                        <?php

                        foreach ($ramMemories as $ram) {
                            echo "<tr>";
                            //echo "<td>" . $ram->getId_ram() . "</td>";
                            echo "<td>" . $ram->getNazwa() . "</td>";
                            echo "<td>" . $ram->getCzestotliwosc() . "</td>";
                            echo "<td>" . $ram->getLiczba_modulow() . "</td>";
                            echo "<td>" . $ram->getLaczna_pamiec() . "</td>";
                            //echo "<td>" . $ram->getOpluznienie() . "</td>";
                            //echo "<td>" . $ram->getTyp_pamieci() . "</td>";
                            echo "<td><form method='POST'><button type='submit'>Add</button></form></td>";
                            echo "</tr>";
                        }
                        ?>
                    </table>

                    <?php
            }
            if ($podzespoly[5] == $select) {
                $queryBuilder = $entityManager->createQueryBuilder();
                $ssdQuery = $queryBuilder
                    ->select('c')
                    ->from(Ssd::class, 'c')
                    ->getQuery();
                $ssds = $ssdQuery->getResult();
                ?>
                    <table>
                        <tr>
                            <!--<th>ID</th>-->
                            <th>Name</th>
                            <!--<th>Interface</th>-->
                            <th>Capacity</th>
                            <!--<th>Format</th>-->
                            <!--<th>Reading</th>-->
                            <!--<th>Saving</th>-->
                            <th>Add</th>
                        </tr>

                        <?php

                        foreach ($ssds as $ssd) {
                            echo "<tr>";
                            //echo "<td>" . $ssd->getId() . "</td>";
                            echo "<td>" . $ssd->getNazwa() . "</td>";
                            //echo "<td>" . $ssd->getInterfejs() . "</td>";
                            echo "<td>" . $ssd->getPojemnosc() . "</td>";
                            //echo "<td>" . $ssd->getFormat() . "</td>";
                            //echo "<td>" . $ssd->getOdczyt() . "</td>";
                            //echo "<td>" . $ssd->getZapis() . "</td>";
                            echo "<td><form method='POST'><button type='submit'>Add</button></form></td>";
                            echo "</tr>";
                        }
                        ?>
                    </table>

                    <?php
            }
            if ($podzespoly[6] == $select) {
                $queryBuilder = $entityManager->createQueryBuilder();
                $hddQuery = $queryBuilder
                    ->select('c')
                    ->from(Hdd::class, 'c')
                    ->getQuery();
                $hdds = $hddQuery->getResult();
                ?>
                    <table>
                        <tr>
                            <!--<th>ID</th>-->
                            <th>Name</th>
                            <th>Format</th>
                            <!--<th>Interface</th>-->
                            <!--<th>ROM memory</th>-->
                            <th>Capacity</th>
                            <th>Speed</th>
                            <th>Add</th>
                        </tr>

                        <?php

                        foreach ($hdds as $hdd) {
                            echo "<tr>";
                            //echo "<td>" . $hdd->getId_hdd() . "</td>";
                            echo "<td>" . $hdd->getNazwa() . "</td>";
                            echo "<td>" . $hdd->getFormat() . "</td>";
                            //echo "<td>" . $hdd->getInterfejs() . "</td>";
                            //echo "<td>" . $hdd->getPamiec_podreczna() . "</td>";
                            echo "<td>" . $hdd->getPojemnosc() . "</td>";
                            echo "<td>" . $hdd->getPredkosc() . "</td>";
                            echo "<td><form method='POST'><button type='submit'>Add</button></form></td>";
                            echo "</tr>";
                        }
                        ?>
                    </table>

                    <?php
            }
            if ($podzespoly[7] == $select) {
                $queryBuilder = $entityManager->createQueryBuilder();
                $cpusCQuery = $queryBuilder
                    ->select('c')
                    ->from(CpuCooler::class, 'c')
                    ->getQuery();
                $cpusC = $cpusCQuery->getResult();
                ?>
                    <table>
                        <tr>
                            <!--<th>ID</th>-->
                            <th>Name</th>
                            <!--<th>Max TDP</th>-->
                            <th>Socket</th>
                            <!--<th>Heigth</th>-->
                            <!--<th>Width</th>-->
                            <!--<th>Depth</th>-->
                            <!--<th>Count of heatpipes</th>-->
                            <!--<th>Size of heatpipe</th>-->
                            <th>Add</th>
                        </tr>

                        <?php

                        foreach ($cpusC as $cpuC) {
                            echo "<tr>";
                            //echo "<td>" . $cpuC->getId_chlodzenie_cpu() . "</td>";
                            echo "<td>" . $cpuC->getNazwa() . "</td>";
                            //echo "<td>" . $cpuC->getMaks_TDP() . "</td>";
                            echo "<td>" . $cpuC->getSocket() . "</td>";
                            //echo "<td>" . $cpuC->getWysokosc() . "</td>";
                            //echo "<td>" . $cpuC->getSzerokosc() . "</td>";
                            //echo "<td>" . $cpuC->getGlebokosc() . "</td>";
                            //echo "<td>" . $cpuC->getIlosc_cieplowodow() . "</td>";
                            //echo "<td>" . $cpuC->getSrednica_cieplowodow() . "</td>";
                            echo "<td><form method='POST'><button type='submit'>Add</button></form></td>";
                            echo "</tr>";
                        }
                        ?>
                    </table>

                    <?php
            }
            if ($podzespoly[8] == $select) {
                $queryBuilder = $entityManager->createQueryBuilder();
                $obudowaQuery = $queryBuilder
                    ->select('c')
                    ->from(Obudowa::class, 'c')
                    ->getQuery();
                $obudowy = $obudowaQuery->getResult();
                ?>
                    <table>
                        <tr>
                            <!--<th>ID</th>-->
                            <th>Name</th>
                            <th>Standard</th>
                            <th>Max size of GPU</th>
                            <!--<th>Type</th>-->
                            <!--<th>Heigth</th>-->
                            <!--<th>Width</th>-->
                            <!--<th>Depth</th>-->
                            <th>Add</th>
                        </tr>

                        <?php

                        foreach ($obudowy as $obudowa) {
                            echo "<tr>";
                            //echo "<td>" . $obudowa->getId_obudowa() . "</td>";
                            echo "<td>" . $obudowa->getNazwa() . "</td>";
                            echo "<td>" . $obudowa->getStandard() . "</td>";
                            echo "<td>" . $obudowa->getMaks_dlugosc_karty_graf() . "</td>";
                            //echo "<td>" . $obudowa->getTyp_obudowy() . "</td>";
                            //echo "<td>" . $obudowa->getWysokosc() . "</td>";
                            //echo "<td>" . $obudowa->getSzerokosc() . "</td>";
                            //echo "<td>" . $obudowa->getGlebokosc() . "</td>";
                            echo "<td><form method='POST'><button type='submit'>Add</button></form></td>";
                            echo "</tr>";
                        }
                        ?>
                    </table>

                    <?php
            }
            ?>
                <input type="text" name="select" hidden value="<?php echo $select ?>">
                <?php
        }
        ?>
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