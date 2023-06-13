<?php
require_once('parts.php');
require_once('configurations.php');
require_once('accounts.php');
require_once("name.php");
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
    <h2 class="logo">Build your PC!</h2>
    <nav class="navigation">
      <a href="konfigurepc.php">Clear configuration</a>
      <a href="myAccount.php">My account</a>
      <a href="myConfigurations.php">My configurations</a>
    </nav>
  </header>

  <?php if (isset($_GET['type']) && $_GET['type'] != NULL) {
    ?>
    <div class="modal">
      <?php switch ($_GET['type']) {
        case "cpu":
          ?>

          <form method="GET" style="display: flex; align-items: center;">
            <input type="text" name="search" placeholder="Search.."
              style="padding: 10px; border-radius: 5px; border: 1px solid #ccc; width: 250px;">
            <input type="submit" value="Search"
              style="padding: 10px 20px; border-radius: 5px; background-color: #4CAF50; color: white; border: none; margin-left: 10px; cursor: pointer;">
          </form>
          <?php
          if ((empty($_GET['search']))) {

            $queryBuilder = $entityManager->createQueryBuilder();
            $cpusQuery = $queryBuilder
              ->select('c')
              ->from(Cpu::class, 'c')
              ->getQuery();
            $cpus = $cpusQuery->getResult();
            ?>
            <table>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Socket</th>
                <th>Turbo</th>
                <th>Cores</th>
                <th>Threads</th>
                <th>Add</th>
              </tr>

              <?php

              foreach ($cpus as $cpu) {
                echo "<tr>";
                echo "<td>" . $cpu->getId_cpu() . "</td>";
                echo "<td>" . $cpu->getNazwa() . "</td>";
                echo "<td>" . $cpu->getCpu_socket() . "</td>";
                echo "<td>" . $cpu->getTurbo() . "</td>";
                echo "<td>" . $cpu->getRdzenie() . "</td>";
                echo "<td>" . $cpu->getWatki() . "</td>";
                echo "<td><form method='POST'><button type='submit'>Add</button><input type='text' name='type' hidden value='" . $_GET['type'] . "'><input name='id' type='number' hidden value='" . $cpu->getId_cpu() . "'></form></td>";
                echo "</tr>";
              }
              ?>
            </table>

            <?php

          } else {
            $search = $_GET['search'];
            $queryBuilder = $entityManager->createQueryBuilder();
            $cpusQuery = $queryBuilder
              ->select('c')
              ->from(Cpu::class, 'c')
              ->where('c.nazwa LIKE :input')
              ->setParameter('input', '%' . $search . '%')
              ->getQuery();
            $cpus = $cpusQuery->getResult();
            ?>
            <table>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Socket</th>
                <th>Turbo</th>
                <th>Cores</th>
                <th>Threads</th>
                <th>Add</th>
              </tr>
              <?php
              foreach ($cpus as $cpu) {
                echo "<tr>";
                echo "<td>" . $cpu->getId_cpu() . "</td>";
                echo "<td>" . $cpu->getNazwa() . "</td>";
                echo "<td>" . $cpu->getCpu_socket() . "</td>";
                echo "<td>" . $cpu->getTurbo() . "</td>";
                echo "<td>" . $cpu->getRdzenie() . "</td>";
                echo "<td>" . $cpu->getWatki() . "</td>";
                echo "<td><form method='POST'><button type='submit'>Add</button><input type='text' name='type' hidden value='" . $_GET['type'] . "'><input name='id' type='number' hidden value='" . $cpu->getId_cpu() . "'></form></td>";
                echo "</tr>";
              }
              ?>
            </table>
            <?php
          }

          break;
        case 'chlodzenie_cpu':
          ?>

          <form method="GET" style="display: flex; align-items: center;">
            <input type="text" name="search" placeholder="Search.."
              style="padding: 10px; border-radius: 5px; border: 1px solid #ccc; width: 250px;">
            <input type="submit" value="Search"
              style="padding: 10px 20px; border-radius: 5px; background-color: #4CAF50; color: white; border: none; margin-left: 10px; cursor: pointer;">
          </form>
          <?php
          if ((empty($_GET['search']))) {

            $queryBuilder = $entityManager->createQueryBuilder();
            $cpusCQuery = $queryBuilder
              ->select('c')
              ->from(CpuCooler::class, 'c')
              ->getQuery();
            $cpusC = $cpusCQuery->getResult();
            ?>
            <table>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Max TDP</th>
                <th>Socket</th>
                <th>Heigth</th>
                <th>Width</th>
                <th>Depth</th>
                <th>Count of heatpipes</th>
                <th>Size of heatpipe</th>
                <th>Add</th>
              </tr>

              <?php

              foreach ($cpusC as $cpuC) {
                echo "<tr>";
                echo "<td>" . $cpuC->getId_chlodzenie_cpu() . "</td>";
                echo "<td>" . $cpuC->getNazwa() . "</td>";
                echo "<td>" . $cpuC->getMaks_TDP() . "</td>";
                echo "<td>" . $cpuC->getSocket() . "</td>";
                echo "<td>" . $cpuC->getWysokosc() . "</td>";
                echo "<td>" . $cpuC->getSzerokosc() . "</td>";
                echo "<td>" . $cpuC->getGlebokosc() . "</td>";
                echo "<td>" . $cpuC->getIlosc_cieplowodow() . "</td>";
                echo "<td>" . $cpuC->getSrednica_cieplowodow() . "</td>";
                echo "<td><form method='POST'><button type='submit'>Add</button><input type='text' name='type' hidden value='" . $_GET['type'] . "'><input name='id' type='number' hidden value='" . $cpuC->getId_chlodzenie_cpu() . "'></form></td>";
                echo "</tr>";
              }
              ?>
            </table>

            <?php

          } else {
            $search = $_GET['search'];
            $queryBuilder = $entityManager->createQueryBuilder();
            $cpusCQuery = $queryBuilder
              ->select('c')
              ->from(CpuCooler::class, 'c')
              ->where('c.nazwa LIKE :input')
              ->setParameter('input', '%' . $search . '%')
              ->getQuery();
            $cpusC = $cpusCQuery->getResult();
            ?>
            <table>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Max TDP</th>
                <th>Socket</th>
                <th>Heigth</th>
                <th>Width</th>
                <th>Depth</th>
                <th>Count of heatpipes</th>
                <th>Size of heatpipe</th>
                <th>Add</th>
              </tr>
              <?php
              foreach ($cpusC as $cpuC) {
                echo "<tr>";
                echo "<td>" . $cpuC->getId_chlodzenie_cpu() . "</td>";
                echo "<td>" . $cpuC->getNazwa() . "</td>";
                echo "<td>" . $cpuC->getMaks_TDP() . "</td>";
                echo "<td>" . $cpuC->getSocket() . "</td>";
                echo "<td>" . $cpuC->getWysokosc() . "</td>";
                echo "<td>" . $cpuC->getSzerokosc() . "</td>";
                echo "<td>" . $cpuC->getGlebokosc() . "</td>";
                echo "<td>" . $cpuC->getIlosc_cieplowodow() . "</td>";
                echo "<td>" . $cpuC->getSrednica_cieplowodow() . "</td>";
                echo "<td><form method='POST'><button type='submit'>Add</button><input type='text' name='type' hidden value='" . $_GET['type'] . "'><input name='id' type='number' hidden value='" . $cpuC->getId_chlodzenie_cpu() . "'></form></td>";
                echo "</tr>";
              }
              ?>
            </table>
            <?php
          }

          break;
        case 'hdd':
          ?>

          <form method="GET" style="display: flex; align-items: center;">
            <input type="text" name="search" placeholder="Search.."
              style="padding: 10px; border-radius: 5px; border: 1px solid #ccc; width: 250px;">
            <input type="submit" value="Search"
              style="padding: 10px 20px; border-radius: 5px; background-color: #4CAF50; color: white; border: none; margin-left: 10px; cursor: pointer;">
          </form>
          <?php
          if ((empty($_GET['search']))) {

            $queryBuilder = $entityManager->createQueryBuilder();
            $hddQuery = $queryBuilder
              ->select('c')
              ->from(Hdd::class, 'c')
              ->getQuery();
            $hdds = $hddQuery->getResult();
            ?>
            <table>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Format</th>
                <th>Interface</th>
                <th>ROM memory</th>
                <th>Capacity</th>
                <th>Speed</th>
                <th>Add</th>
              </tr>

              <?php

              foreach ($hdds as $hdd) {
                echo "<tr>";
                echo "<td>" . $hdd->getId_hdd() . "</td>";
                echo "<td>" . $hdd->getNazwa() . "</td>";
                echo "<td>" . $hdd->getFormat() . "</td>";
                echo "<td>" . $hdd->getInterfejs() . "</td>";
                echo "<td>" . $hdd->getPamiec_podreczna() . "</td>";
                echo "<td>" . $hdd->getPojemnosc() . "</td>";
                echo "<td>" . $hdd->getPredkosc() . "</td>";
                echo "<td><form method='POST'><button type='submit'>Add</button><input type='text' name='type' hidden value='" . $_GET['type'] . "'><input name='id' type='number' hidden value='" . $hdd->getId_hdd() . "'></form></td>";
                echo "</tr>";
              }
              ?>
            </table>

            <?php

          } else {
            $search = $_GET['search'];
            $queryBuilder = $entityManager->createQueryBuilder();
            $hddQuery = $queryBuilder
              ->select('c')
              ->from(Hdd::class, 'c')
              ->where('c.nazwa LIKE :input')
              ->setParameter('input', '%' . $search . '%')
              ->getQuery();
            $hdds = $hddQuery->getResult();
            ?>
            <table>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Format</th>
                <th>Interface</th>
                <th>ROM memory</th>
                <th>Capacity</th>
                <th>Speed</th>
                <th>Add</th>
              </tr>
              <?php
              foreach ($hdds as $hdd) {
                echo "<tr>";
                echo "<td>" . $hdd->getId_hdd() . "</td>";
                echo "<td>" . $hdd->getNazwa() . "</td>";
                echo "<td>" . $hdd->getFormat() . "</td>";
                echo "<td>" . $hdd->getInterfejs() . "</td>";
                echo "<td>" . $hdd->getPamiec_podreczna() . "</td>";
                echo "<td>" . $hdd->getPojemnosc() . "</td>";
                echo "<td>" . $hdd->getPredkosc() . "</td>";
                echo "<td><form method='POST'><button type='submit'>Add</button><input type='text' name='type' hidden value='" . $_GET['type'] . "'><input name='id' type='number' hidden value='" . $hdd->getId_hdd() . "'></form></td>";
                echo "</tr>";
              }
              ?>
            </table>
            <?php
          }

          break;
        case 'ssd':
          ?>

          <form method="GET" style="display: flex; align-items: center;">
            <input type="text" name="search" placeholder="Search.."
              style="padding: 10px; border-radius: 5px; border: 1px solid #ccc; width: 250px;">
            <input type="submit" value="Search"
              style="padding: 10px 20px; border-radius: 5px; background-color: #4CAF50; color: white; border: none; margin-left: 10px; cursor: pointer;">
          </form>
          <?php
          if ((empty($_GET['search']))) {

            $queryBuilder = $entityManager->createQueryBuilder();
            $ssdQuery = $queryBuilder
              ->select('c')
              ->from(Ssd::class, 'c')
              ->getQuery();
            $ssds = $ssdQuery->getResult();
            ?>
            <table>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Interface</th>
                <th>Capacity</th>
                <th>Format</th>
                <th>Reading</th>
                <th>Saving</th>
                <th>Add</th>
              </tr>

              <?php

              foreach ($ssds as $ssd) {
                echo "<tr>";
                echo "<td>" . $ssd->getId() . "</td>";
                echo "<td>" . $ssd->getNazwa() . "</td>";
                echo "<td>" . $ssd->getInterfejs() . "</td>";
                echo "<td>" . $ssd->getPojemnosc() . "</td>";
                echo "<td>" . $ssd->getFormat() . "</td>";
                echo "<td>" . $ssd->getOdczyt() . "</td>";
                echo "<td>" . $ssd->getZapis() . "</td>";
                echo "<td><form method='POST'><button type='submit'>Add</button><input type='text' name='type' hidden value='" . $_GET['type'] . "'><input name='id' type='number' hidden value='" . $ssd->getId() . "'></form></td>";
                echo "</tr>";
              }
              ?>
            </table>

            <?php

          } else {
            $search = $_GET['search'];
            $queryBuilder = $entityManager->createQueryBuilder();
            $ssdQuery = $queryBuilder
              ->select('c')
              ->from(Ssd::class, 'c')
              ->where('c.nazwa LIKE :input')
              ->setParameter('input', '%' . $search . '%')
              ->getQuery();
            $ssds = $ssdQuery->getResult();
            ?>
            <table>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Interface</th>
                <th>Capacity</th>
                <th>Format</th>
                <th>Reading</th>
                <th>Saving</th>
                <th>Add</th>
              </tr>
              <?php
              foreach ($ssds as $ssd) {
                echo "<tr>";
                echo "<td>" . $ssd->getId() . "</td>";
                echo "<td>" . $ssd->getNazwa() . "</td>";
                echo "<td>" . $ssd->getInterfejs() . "</td>";
                echo "<td>" . $ssd->getPojemnosc() . "</td>";
                echo "<td>" . $ssd->getFormat() . "</td>";
                echo "<td>" . $ssd->getOdczyt() . "</td>";
                echo "<td>" . $ssd->getZapis() . "</td>";
                echo "<td><form method='POST'><button type='submit'>Add</button><input type='text' name='type' hidden value='" . $_GET['type'] . "'><input name='id' type='number' hidden value='" . $ssd->getId() . "'></form></td>";
                echo "</tr>";
              }
              ?>
            </table>
            <?php
          }

          break;
        case 'gpu':
          ?>

          <form method="GET" style="display: flex; align-items: center;">
            <input type="text" name="search" placeholder="Search.."
              style="padding: 10px; border-radius: 5px; border: 1px solid #ccc; width: 250px;">
            <input type="submit" value="Search"
              style="padding: 10px 20px; border-radius: 5px; background-color: #4CAF50; color: white; border: none; margin-left: 10px; cursor: pointer;">
          </form>
          <?php
          if ((empty($_GET['search']))) {

            $queryBuilder = $entityManager->createQueryBuilder();
            $gpusQuery = $queryBuilder
              ->select('c')
              ->from(Gpu::class, 'c')
              ->getQuery();
            $gpus = $gpusQuery->getResult();
            ?>
            <table>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Chipset manufacturer</th>
                <th>Length</th>
                <th>RAM</th>
                <th>Chipset type</th>
                <th>Recomended PSU power</th>
                <th>BOOST</th>
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
                echo "<td><form method='POST'><button type='submit'>Add</button><input type='text' name='type' hidden value='" . $_GET['type'] . "'><input name='id' type='number' hidden value='" . $gpu->getId_gpu() . "'></form></td>";
                echo "</tr>";
              }
              ?>
            </table>

            <?php

          } else {
            $search = $_GET['search'];
            $queryBuilder = $entityManager->createQueryBuilder();
            $gpusQuery = $queryBuilder
              ->select('c')
              ->from(Gpu::class, 'c')
              ->where('c.nazwa LIKE :input')
              ->setParameter('input', '%' . $search . '%')
              ->getQuery();
            $gpus = $gpusQuery->getResult();
            ?>
            <table>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Chipset manufacturer</th>
                <th>Length</th>
                <th>RAM</th>
                <th>Chipset type</th>
                <th>Recomended PSU power</th>
                <th>BOOST</th>
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
                echo "<td><form method='POST'><button type='submit'>Add</button><input type='text' name='type' hidden value='" . $_GET['type'] . "'><input name='id' type='number' hidden value='" . $gpu->getId_gpu() . "'></form></td>";
                echo "</tr>";
              }
              ?>
            </table>
            <?php
          }

          break;
        case 'obudowa':
          ?>

          <form method="GET" style="display: flex; align-items: center;">
            <input type="text" name="search" placeholder="Search.."
              style="padding: 10px; border-radius: 5px; border: 1px solid #ccc; width: 250px;">
            <input type="submit" value="Search"
              style="padding: 10px 20px; border-radius: 5px; background-color: #4CAF50; color: white; border: none; margin-left: 10px; cursor: pointer;">
          </form>
          <?php
          if ((empty($_GET['search']))) {

            $queryBuilder = $entityManager->createQueryBuilder();
            $obudowaQuery = $queryBuilder
              ->select('c')
              ->from(Obudowa::class, 'c')
              ->getQuery();
            $obudowy = $obudowaQuery->getResult();
            ?>
            <table>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Standard</th>
                <th>Max size of GPU</th>
                <th>Type</th>
                <th>Heigth</th>
                <th>Width</th>
                <th>Depth</th>
                <th>Add</th>
              </tr>

              <?php

              foreach ($obudowy as $obudowa) {
                echo "<tr>";
                echo "<td>" . $obudowa->getId_obudowa() . "</td>";
                echo "<td>" . $obudowa->getNazwa() . "</td>";
                echo "<td>" . $obudowa->getStandard() . "</td>";
                echo "<td>" . $obudowa->getMaks_dlugosc_karty_graf() . "</td>";
                echo "<td>" . $obudowa->getTyp_obudowy() . "</td>";
                echo "<td>" . $obudowa->getWysokosc() . "</td>";
                echo "<td>" . $obudowa->getSzerokosc() . "</td>";
                echo "<td>" . $obudowa->getGlebokosc() . "</td>";
                echo "<td><form method='POST'><button type='submit'>Add</button><input type='text' name='type' hidden value='" . $_GET['type'] . "'><input name='id' type='number' hidden value='" . $obudowa->getId_obudowa() . "'></form></td>";
                echo "</tr>";
              }
              ?>
            </table>

            <?php

          } else {
            $search = $_GET['search'];
            $queryBuilder = $entityManager->createQueryBuilder();
            $obudowaQuery = $queryBuilder
              ->select('c')
              ->from(Obudowa::class, 'c')
              ->where('c.nazwa LIKE :input')
              ->setParameter('input', '%' . $search . '%')
              ->getQuery();
            $obudowy = $obudowaQuery->getResult();
            ?>
            <table>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Standard</th>
                <th>Max size of GPU</th>
                <th>Type</th>
                <th>Heigth</th>
                <th>Width</th>
                <th>Depth</th>
                <th>Add</th>
              </tr>
              <?php
              foreach ($obudowy as $obudowa) {
                echo "<tr>";
                echo "<td>" . $obudowa->getId_obudowa() . "</td>";
                echo "<td>" . $obudowa->getNazwa() . "</td>";
                echo "<td>" . $obudowa->getStandard() . "</td>";
                echo "<td>" . $obudowa->getMaks_dlugosc_karty_graf() . "</td>";
                echo "<td>" . $obudowa->getTyp_obudowy() . "</td>";
                echo "<td>" . $obudowa->getWysokosc() . "</td>";
                echo "<td>" . $obudowa->getSzerokosc() . "</td>";
                echo "<td>" . $obudowa->getGlebokosc() . "</td>";
                echo "<td><form method='POST'><button type='submit'>Add</button><input type='text' name='type' hidden value='" . $_GET['type'] . "'><input name='id' type='number' hidden value='" . $obudowa->getId_obudowa() . "'></form></td>";
                echo "</tr>";
              }
              ?>
            </table>
            <?php
          }

          break;
        case 'mb':
          ?>

          <form method="GET" style="display: flex; align-items: center;">
            <input type="text" name="search" placeholder="Search.."
              style="padding: 10px; border-radius: 5px; border: 1px solid #ccc; width: 250px;">
            <input type="submit" value="Search"
              style="padding: 10px 20px; border-radius: 5px; background-color: #4CAF50; color: white; border: none; margin-left: 10px; cursor: pointer;">
          </form>
          <?php
          if ((empty($_GET['search']))) {

            $queryBuilder = $entityManager->createQueryBuilder();
            $moboQuery = $queryBuilder
              ->select('c')
              ->from(Mb::class, 'c')
              ->getQuery();
            $mobos = $moboQuery->getResult();
            ?>
            <table>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Mb chipset</th>
                <th>CPU socket</th>
                <th>RAM slots</th>
                <th>Mb standard</th>
                <th>RAM standard</th>
                <th>Max RAM capacity</th>
                <th>Add</th>
              </tr>

              <?php

              foreach ($mobos as $mb) {
                echo "<tr>";
                echo "<td>" . $mb->getId_mb() . "</td>";
                echo "<td>" . $mb->getNazwa() . "</td>";
                echo "<td>" . $mb->getChipset_plyty() . "</td>";
                echo "<td>" . $mb->getGniazdo_procesora() . "</td>";
                echo "<td>" . $mb->getLiczba_slotow_pamieci() . "</td>";
                echo "<td>" . $mb->getStandard_plyty() . "</td>";
                echo "<td>" . $mb->getStandard_pamieci() . "</td>";
                echo "<td>" . $mb->getMaks_ilosc_pamieci_ram() . "</td>";
                echo "<td><form method='POST'><button type='submit'>Add</button><input type='text' name='type' hidden value='" . $_GET['type'] . "'><input name='id' type='number' hidden value='" . $mb->getId_mb() . "'></form></td>";
                echo "</tr>";
              }
              ?>
            </table>

            <?php

          } else {
            $search = $_GET['search'];
            $queryBuilder = $entityManager->createQueryBuilder();
            $moboQuery = $queryBuilder
              ->select('c')
              ->from(Mb::class, 'c')
              ->where('c.nazwa LIKE :input')
              ->setParameter('input', '%' . $search . '%')
              ->getQuery();
            $mobos = $moboQuery->getResult();
            ?>
            <table>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Mb chipset</th>
                <th>CPU socket</th>
                <th>RAM slots</th>
                <th>Mb standard</th>
                <th>RAM standard</th>
                <th>Max RAM capacity</th>
                <th>Add</th>
              </tr>
              <?php
              foreach ($mobos as $mb) {
                echo "<tr>";
                echo "<td>" . $mb->getId_mb() . "</td>";
                echo "<td>" . $mb->getNazwa() . "</td>";
                echo "<td>" . $mb->getChipset_plyty() . "</td>";
                echo "<td>" . $mb->getGniazdo_procesora() . "</td>";
                echo "<td>" . $mb->getLiczba_slotow_pamieci() . "</td>";
                echo "<td>" . $mb->getStandard_plyty() . "</td>";
                echo "<td>" . $mb->getStandard_pamieci() . "</td>";
                echo "<td>" . $mb->getMaks_ilosc_pamieci_ram() . "</td>";
                echo "<td><form method='POST'><button type='submit'>Add</button><input type='text' name='type' hidden value='" . $_GET['type'] . "'><input name='id' type='number' hidden value='" . $mb->getId_mb() . "'></form></td>";
                echo "</tr>";
              }
              ?>
            </table>
            <?php
          }

          break;
        case 'ram':
          ?>
          <form method="GET" style="display: flex; align-items: center;">
            <input type="text" name="search" placeholder="Search.."
              style="padding: 10px; border-radius: 5px; border: 1px solid #ccc; width: 250px;">
            <input type="submit" value="Search"
              style="padding: 10px 20px; border-radius: 5px; background-color: #4CAF50; color: white; border: none; margin-left: 10px; cursor: pointer;">
          </form>
          <?php
          if ((empty($_GET['search']))) {

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
                  <th>ID</th>
                  <th>Name</th>
                  <th>Friquency</th>
                  <th>How much modules</th>
                  <th>Capacity</th>
                  <th>CLI</th>
                  <th>Type</th>
                  <th>Add</th>
                </tr>

                <?php

                foreach ($ramMemories as $ram) {
                  echo "<tr>";
                  echo "<td>" . $ram->getId_ram() . "</td>";
                  echo "<td>" . $ram->getNazwa() . "</td>";
                  echo "<td>" . $ram->getCzestotliwosc() . "</td>";
                  echo "<td>" . $ram->getLiczba_modulow() . "</td>";
                  echo "<td>" . $ram->getLaczna_pamiec() . "</td>";
                  echo "<td>" . $ram->getOpluznienie() . "</td>";
                  echo "<td>" . $ram->getTyp_pamieci() . "</td>";
                  echo "<td><form method='POST'><button type='submit'>Add</button><input type='text' name='type' hidden value='" . $_GET['type'] . "'><input name='id' type='number' hidden value='" . $ram->getId_ram() . "'></form></td>";
                  echo "</tr>";
                }
                ?>
              </table>

              <?php

          } else {
            $search = $_GET['search'];
            $queryBuilder = $entityManager->createQueryBuilder();
            $ramQuery = $queryBuilder
              ->select('c')
              ->from(Ram::class, 'c')
              ->where('c.nazwa LIKE :input')
              ->setParameter('input', '%' . $search . '%')
              ->getQuery();
            $ramMemories = $ramQuery->getResult();
            ?>
              <table>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Friquency</th>
                  <th>How much modules</th>
                  <th>Capacity</th>
                  <th>CLI</th>
                  <th>Type</th>
                  <th>Add</th>
                </tr>
                <?php
                foreach ($ramMemories as $ram) {
                  echo "<tr>";
                  echo "<td>" . $ram->getId_ram() . "</td>";
                  echo "<td>" . $ram->getNazwa() . "</td>";
                  echo "<td>" . $ram->getCzestotliwosc() . "</td>";
                  echo "<td>" . $ram->getLiczba_modulow() . "</td>";
                  echo "<td>" . $ram->getLaczna_pamiec() . "</td>";
                  echo "<td>" . $ram->getOpluznienie() . "</td>";
                  echo "<td>" . $ram->getTyp_pamieci() . "</td>";
                  echo "<td><form method='POST'><button type='submit'>Add</button><input type='text' name='type' hidden value='" . $_GET['type'] . "'><input name='id' type='number' hidden value='" . $ram->getId_ram() . "'></form></td>";
                  echo "</tr>";
                }
                ?>
              </table>
              <?php
          }

          break;
        case 'zasilacz':
          ?>

            <form method="GET" style="display: flex; align-items: center;">
              <input type="text" name="search" placeholder="Search.."
                style="padding: 10px; border-radius: 5px; border: 1px solid #ccc; width: 250px;">
              <input type="submit" value="Search"
                style="padding: 10px 20px; border-radius: 5px; background-color: #4CAF50; color: white; border: none; margin-left: 10px; cursor: pointer;">
            </form>
            <?php
            if ((empty($_GET['search']))) {

              $queryBuilder = $entityManager->createQueryBuilder();
              $zasilaczeQuery = $queryBuilder
                ->select('c')
                ->from(Zasilacz::class, 'c')
                ->getQuery();
              $zasilacze = $zasilaczeQuery->getResult();
              ?>

              <table>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Certyficate</th>
                  <th>Fan size</th>
                  <th>Power</th>
                  <th>Standard</th>
                  <th>Heigth</th>
                  <th>Width</th>
                  <th>Depth</th>
                  <th>Add</th>
                </tr>

                <?php

                foreach ($zasilacze as $zasilacz) {
                  echo "<tr>";
                  echo "<td>" . $zasilacz->getId_zasilacz() . "</td>";
                  echo "<td>" . $zasilacz->getNazwa() . "</td>";
                  echo "<td>" . $zasilacz->getCertyfikat() . "</td>";
                  echo "<td>" . $zasilacz->getSrednica_wentylatora() . "</td>";
                  echo "<td>" . $zasilacz->getMoc() . "</td>";
                  echo "<td>" . $zasilacz->getStandard() . "</td>";
                  echo "<td>" . $zasilacz->getWysokosc() . "</td>";
                  echo "<td>" . $zasilacz->getSzerokosc() . "</td>";
                  echo "<td>" . $zasilacz->getGlebokosc() . "</td>";
                  echo "<td><form method='POST'><button type='submit'>Add</button><input type='text' name='type' hidden value='" . $_GET['type'] . "'><input name='id' type='number' hidden value='" . $zasilacz->getId_zasilacz() . "'></form></td>";
                  echo "</tr>";
                }
                ?>
              </table>

              <?php

            } else {
              $search = $_GET['search'];
              $queryBuilder = $entityManager->createQueryBuilder();
              $zasilaczQuery = $queryBuilder
                ->select('c')
                ->from(Zasilacz::class, 'c')
                ->where('c.nazwa LIKE :input')
                ->setParameter('input', '%' . $search . '%')
                ->getQuery();
              $zasilacze = $zasilaczQuery->getResult();
              ?>
              <table>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Certyficate</th>
                  <th>Fan size</th>
                  <th>Power</th>
                  <th>Standard</th>
                  <th>Heigth</th>
                  <th>Width</th>
                  <th>Depth</th>
                  <th>Add</th>

                </tr>
                <?php
                foreach ($zasilacze as $zasilacz) {
                  echo "<tr>";
                  echo "<td>" . $zasilacz->getId_zasilacz() . "</td>";
                  echo "<td>" . $zasilacz->getNazwa() . "</td>";
                  echo "<td>" . $zasilacz->getCertyfikat() . "</td>";
                  echo "<td>" . $zasilacz->getSrednica_wentylatora() . "</td>";
                  echo "<td>" . $zasilacz->getMoc() . "</td>";
                  echo "<td>" . $zasilacz->getStandard() . "</td>";
                  echo "<td>" . $zasilacz->getWysokosc() . "</td>";
                  echo "<td>" . $zasilacz->getSzerokosc() . "</td>";
                  echo "<td>" . $zasilacz->getGlebokosc() . "</td>";
                  echo "<td><form method='POST'><button type='submit'>Add</button><input type='text' name='type' hidden value='" . $_GET['type'] . "'><input name='id' type='number' hidden value='" . $zasilacz->getId_zasilacz() . "'></form></td>";
                  echo "</tr>";
                }
                ?>
              </table>
              <?php
            }

            break;

        default:
          echo "Nieprawidłowe dane!";
          break;
      } ?>

    </div>
  <?php } ?>

  <div class="container">
    <div class="grid">
      <a href="?type=cpu">
        <div class="tile">
          <img src="../GRAPHICS/cpu-grafika.png" alt="obrazek 2" />
          <p>
            <?php echo isset($_GET['cpu']) ? getProductName('cpu', $_GET['cpu']) : "" ?>
          </p>
        </div>
      </a>
      <a href="?type=mb">
        <div class="tile">
          <img src="../GRAPHICS/plyta-glowna-grafika.png" alt="obrazek 6" />
          <p>
            <?php echo isset($_GET['mb']) ? getProductName('mb', $_GET['mb']) : "" ?>
          </p>
        </div>
      </a>
      <a href="?type=ram">
        <div class="tile">
          <img src="../GRAPHICS/ram-grafika.png" alt="obrazek 7" />
          <p>
            <?php echo isset($_GET['ram']) ? getProductName('ram', $_GET['ram']) : "" ?>
          </p>
        </div>
      </a>
      <a href="?type=gpu">
        <div class="tile">
          <img src="../GRAPHICS/gpu-grafika.png" alt="obrazek 4" />
          <p>
            <?php echo isset($_GET['gpu']) ? getProductName('gpu', $_GET['gpu']) : "" ?>
          </p>
        </div>
      </a>
      <a href="?type=zasilacz">
        <div class="tile">
          <img src="../GRAPHICS/zasilacz-grafika.png" alt="obrazek 8" />
          <p>
            <?php echo isset($_GET['zasilacz']) ? getProductName('zasilacz', $_GET['zasilacz']) : "" ?>
          </p>
        </div>
      </a>
      <a href="?type=chlodzenie_cpu">
        <div class="tile">
          <img src="../GRAPHICS/chlodzenie-grafika.png" alt="obrazek 1" />
          <p>
            <?php echo isset($_GET['chlodzenie_cpu']) ? getProductName('chlodzenie_cpu', $_GET['chlodzenie_cpu']) : "" ?>
          </p>
        </div>
      </a>
      <a href="?type=hdd">
        <div class="tile">
          <img src="../GRAPHICS/dysk-grafika.png" alt="obrazek 3" />
          <p>
            <?php echo isset($_GET['hdd']) ? getProductName('hdd', $_GET['hdd']) : "" ?>
          </p>
        </div>
      </a>
      <a href="?type=ssd">
        <div class="tile">
          <img src="../GRAPHICS/ssd-grafika.png" alt="obrazek 3" />
          <p>
            <?php echo isset($_GET['ssd']) ? getProductName('ssd', $_GET['ssd']) : "" ?>
          </p>
        </div>
      </a>
      <a href="?type=obudowa">
        <div class="tile">
          <img src="../GRAPHICS/obudowa-grafika.png" alt="obrazek 5" />
          <p>
            <?php echo isset($_GET['obudowa']) ? getProductName('obudowa', $_GET['obudowa']) : "" ?>
          </p>
        </div>
      </a>

      <script>
        [...document.querySelector('.grid').querySelectorAll('a')].forEach(e => {
          //add window url params to to the href's params
          const url = new URL(e.href)
          for (let [k, v] of new URLSearchParams(window.location.search).entries()) {
            if (v == '') {
              continue;
            }
            url.searchParams.set(k, v)
          }
          e.href = url.toString();
        })
      </script>
    </div>
  </div>

  <?php

  function deleteNameOfConfiguration($nazwaID)
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
    $single_name = $entityManager->find('NameOfConfig', $nazwaID);

    $entityManager->remove($single_name);

    $entityManager->flush();
  }


  $queryBuilder = $entityManager->createQueryBuilder();
  $accQuery = $queryBuilder
    ->select('c')
    ->from(Iddb::class, 'c')
    ->getQuery();
  $acc = $accQuery->getResult();
  foreach ($acc as $ac) {
    $account = $ac->getId_account();
  }





  function getProductName($type, $id)
  {
    global $chlo, $proc, $ssddy, $hdddy, $graf, $obu, $plyta, $pami, $zasi;
    //echo $type, $id;
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


    switch ($type) {
      case 'chlodzenie_cpu':
        global $chlo;
        $chlo = $id;
        $queryBuilder = $entityManager->createQueryBuilder();
        $dane = $queryBuilder
          ->select('c')
          ->from(CpuCooler::class, 'c')
          ->where('c.id_chlodzenie_cpu = ' . $id)
          ->getQuery();
        return $dane->getSingleResult()->getNazwa();
        break;
      case 'cpu':
        global $proc;
        $proc = $id;
        $queryBuilder = $entityManager->createQueryBuilder();
        $dane = $queryBuilder
          ->select('c')
          ->from(Cpu::class, 'c')
          ->where('c.id_cpu = ' . $id)
          ->getQuery();
        return $dane->getSingleResult()->getNazwa();
        break;
      case 'ssd':
        global $ssddy;
        $ssddy = $id;
        $queryBuilder = $entityManager->createQueryBuilder();
        $dane = $queryBuilder
          ->select('c')
          ->from(Ssd::class, 'c')
          ->where('c.id = ' . $id)
          ->getQuery();
        return $dane->getSingleResult()->getNazwa();
        break;
      case 'hdd':
        global $hdddy;
        $hdddy = $id;
        $queryBuilder = $entityManager->createQueryBuilder();
        $dane = $queryBuilder
          ->select('c')
          ->from(Hdd::class, 'c')
          ->where('c.id_hdd = ' . $id)
          ->getQuery();
        return $dane->getSingleResult()->getNazwa();
        break;
      case 'gpu':
        global $graf;
        $graf = $id;
        $queryBuilder = $entityManager->createQueryBuilder();
        $dane = $queryBuilder
          ->select('c')
          ->from(Gpu::class, 'c')
          ->where('c.id_gpu = ' . $id)
          ->getQuery();
        return $dane->getSingleResult()->getNazwa();
        break;
      case 'obudowa':
        global $obu;
        $obu = $id;
        $queryBuilder = $entityManager->createQueryBuilder();
        $dane = $queryBuilder
          ->select('c')
          ->from(Obudowa::class, 'c')
          ->where('c.id_obudowa = ' . $id)
          ->getQuery();
        return $dane->getSingleResult()->getNazwa();
        break;
      case 'mb':
        global $plyta;
        $plyta = $id;
        $queryBuilder = $entityManager->createQueryBuilder();
        $dane = $queryBuilder
          ->select('c')
          ->from(Mb::class, 'c')
          ->where('c.id_mb = ' . $id)
          ->getQuery();
        return $dane->getSingleResult()->getNazwa();
        break;
      case 'ram':
        global $pami;
        $pami = $id;
        $queryBuilder = $entityManager->createQueryBuilder();
        $dane = $queryBuilder
          ->select('c')
          ->from(Ram::class, 'c')
          ->where('c.id_ram = ' . $id)
          ->getQuery();
        return $dane->getSingleResult()->getNazwa();
        break;
      case 'zasilacz':
        global $zasi;
        $zasi = $id;
        $queryBuilder = $entityManager->createQueryBuilder();
        $dane = $queryBuilder
          ->select('c')
          ->from(Zasilacz::class, 'c')
          ->where('c.id_zasilacz = ' . $id)
          ->getQuery();
        return $dane->getSingleResult()->getNazwa();
        break;
      default:
        break;
    }
  }

  ?>
  <div class="input">
    <form action="konfigurepc.php" method="post">
      <label>If you wont to save yor configuration please enter it's name: </label>
      <input type="text" name="nazwa" id="nazwa" value="<?php echo getNameConfig() ?>" onkeyup="saveValue();" required>
      <input type="number" name="account" hidden value="<?php echo $account; ?>">
      <input type="number" name="proc" hidden value="<?php global $proc;
      echo $proc; ?>">
      <input type="number" name="plyta" hidden value="<?php global $plyta;
      echo $plyta; ?>">
      <input type="number" name="pami" hidden value="<?php global $pami;
      echo $pami; ?>">
      <input type="number" name="graf" hidden value="<?php global $graf;
      echo $graf; ?>">
      <input type="number" name="zasi" hidden value="<?php global $zasi;
      echo $zasi; ?>">
      <input type="number" name="chlo" hidden value="<?php global $chlo;
      echo $chlo; ?>">
      <input type="number" name="hdddy" hidden value="<?php global $hdddy;
      echo $hdddy; ?>">
      <input type="number" name="ssddy" hidden value="<?php global $ssddy;
      echo $ssddy; ?>">
      <input type="number" name="zasi" hidden value="<?php global $zasi;
      echo $zasi; ?>">
      <input type="number" name="obu" hidden value="<?php global $obu;
      echo $obu; ?>">
      <button type='submit' name="save">Save configuration</button>
    </form>
  </div>
  <?php
  function getNameConfig()
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
    $nameQuery = $queryBuilder
      ->select('c')
      ->from(NameOfConfig::class, 'c')
      ->getQuery();
    $name_config = $nameQuery->getResult();
    foreach ($name_config as $name_conf) {
      if ($name_conf == null) {
        $nazwa = "";
        return $nazwa;
      } else {
        $nazwa = $name_conf->getName();
        $usuwana_wartosc = $name_conf->getID();
        deleteNameOfConfiguration($usuwana_wartosc);
        return $nazwa;
      }
    }
  }

  function deleteConfig($id)
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
    $single_config = $entityManager->find('Configurations', $id);

    $entityManager->remove($single_config);

    $entityManager->flush();
  }

  if (isset($_POST['nazwa'])) {
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
    $nazwa = $_POST['nazwa'];
    $konto = $_POST['account'];
    $procesor = (int) $_POST['proc'];
    $plyta_gl = (int) $_POST['plyta'];
    $pamiec = (int) $_POST['pami'];
    $grafika = (int) $_POST['graf'];
    $psu = (int) $_POST['zasi'];
    $chlodzenie = (int) $_POST['chlo'];
    $wolny = (int) $_POST['hdddy'];
    $szybki = (int) $_POST['ssddy'];
    $case = (int) $_POST['obu'];

    if (isset($_POST['save'])) {
      //var_dump($_POST);
      if ($konto != 0 && $procesor != 0 && $plyta_gl != 0 && $pamiec != 0 && $grafika != 0 && $psu != 0 && $chlodzenie != 0 && $wolny != 0 && $szybki != 0 && $case != 0) {
        $queryBuilder = $entityManager->createQueryBuilder();
        $conf = $queryBuilder
          ->select('c')
          ->from(Configurations::class, 'c')
          ->where('c.ID_account = ' . $konto)
          ->getQuery();
        $confi = $conf->getResult();

        foreach ($confi as $config) {
          if ($config->getName() == $nazwa) {
            $zamieniana = $config->getID();
            $nameOf = $config->getName();
            //deleteConfig($zamieniana);
          }
        }
        if ($nameOf != null && $zamieniana != null) {
          deleteConfig($zamieniana);
          $configurations = (new Configurations())
            ->setID_account($konto)
            ->setID_cpu($procesor)
            ->setID_mb($plyta_gl)
            ->setID_ram($pamiec)
            ->setID_gpu($grafika)
            ->setID_zasilacz($psu)
            ->setID_chlodzenie($chlodzenie)
            ->setID_hdd($wolny)
            ->setID_ssd($szybki)
            ->setID_obudowa($case)
            ->setName($nazwa);

          $entityManager->persist($configurations);
          $entityManager->flush();
          header("Location: konfigurepc.php");
        } else {
          $configurations = (new Configurations())
            ->setID_account($konto)
            ->setID_cpu($procesor)
            ->setID_mb($plyta_gl)
            ->setID_ram($pamiec)
            ->setID_gpu($grafika)
            ->setID_zasilacz($psu)
            ->setID_chlodzenie($chlodzenie)
            ->setID_hdd($wolny)
            ->setID_ssd($szybki)
            ->setID_obudowa($case)
            ->setName($nazwa);

          $entityManager->persist($configurations);
          $entityManager->flush();
          header("Location: konfigurepc.php");
        }
      } else {
        echo "nie dodano nic do tabeli.";
      }
      //echo $kon . " " . $chlo . " " . $proc . " " . $ssddy . " " . $hdddy . " " . $graf . " " . $obu . " " . $plyta . " " . $pami . " " . $zasi . " " . $nazwa;
    }
  }
  ?>
  <script type="text/javascript">
    saveValue();
    getSavedValue();
    /* Here you can add more inputs to set value. if it's saved */

    //Save the value function - save it to localStorage as (ID, VALUE)
    function saveValue() {
      let nazwazmienna = document.getElementById("nazwa").value;
      if (nazwazmienna != null && nazwazmienna.length != 0) {
        document.cookie = "nazwa=" + nazwazmienna;
      }

    }

    //get the saved value function - return the value of "v" from localStorage. 
    function getSavedValue() {
      const value = `; ${document.cookie}`;
      const parts = value.split(`; nazwa=`);
      let data = parts.pop().split(';').shift();
      document.getElementById("nazwa").value = data;
    }
  </script>


  <script src="JS/script.js"></script>
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>