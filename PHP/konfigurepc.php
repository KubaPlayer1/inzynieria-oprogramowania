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

if (isset($_POST['type'])) {
  $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

  var_dump($actual_link);
  var_dump($_POST['type']);
  var_dump($_POST['id']);

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
$select = "";
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
      <a href="add.php">Add new part</a>
      <a href="#">My account</a>
      <a href="#">Save configuration</a>
      <a href="#">My configurations</a>
      <button class="button-out" href="../index.html">Log out</button>
    </nav>
  </header>

  <?php if (isset($_GET['type']) && $_GET['type'] != NULL) {
    ?>
    <div class="modal">
      <?php switch ($_GET['type']) {
        case "cpu":
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
              <th>Nazwa</th>
              <th>Socket</th>
              <th>Turbo</th>
              <th>Rdzenie</th>
              <th>Wątki</th>
              <th>Dodaj</th>
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
              echo "<td><form method='POST'><button type='submit'>Dodaj</button><input type='text' name='type' hidden value='" . $_GET['type'] . "'><input name='id' type='number' hidden value='" . $cpu->getId_cpu() . "'></form></td>";
              echo "</tr>";
            }
            ?>
          </table>
          <?php
          break;
        case 'chlodzenie_cpu':
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
              <th>Nazwa</th>
              <th>Maks TDP</th>
              <th>Socket</th>
              <th>Wysokość</th>
              <th>Szerokość</th>
              <th>Głębokość</th>
              <th>Ilość ciepłowodów</th>
              <th>Średnica ciepłowodów</th>
              <th>Dodaj</th>
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
              echo "<td><form method='POST'><button type='submit'>Dodaj</button><input type='text' name='type' hidden value='" . $_GET['type'] . "'><input name='id' type='number' hidden value='" . $cpuC->getId_chlodzenie_cpu() . "'></form></td>";
              echo "</tr>";
            }
            ?>
          </table>
          <?php
          break;
        case 'dysk':
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
              <th>Nazwa</th>
              <th>Interfejs</th>
              <th>Pojemność</th>
              <th>Format</th>
              <th>Odczyt</th>
              <th>Zapis</th>
              <th>Dodaj</th>
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
              echo "<td><form method='POST'><button type='submit'>Dodaj</button><input type='text' name='type' hidden value='" . $_GET['type'] . "'><input name='id' type='number' hidden value='" . $ssd->getId() . "'></form></td>";
              echo "</tr>";
            }
            ?>
          </table>
          <?php
          break;
        case 'gpu':
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
              <th>Nazwa</th>
              <th>Producent Chipsetu</th>
              <th>Długość Karty</th>
              <th>Ilość RAM</th>
              <th>Rodzaj Chipsetu</th>
              <th>Rekomendowana Moc Zasilacza</th>
              <th>Taktowanie Boost</th>
              <th>Dodaj</th>
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
              echo "<td><form method='POST'><button type='submit'>Dodaj</button><input type='text' name='type' hidden value='" . $_GET['type'] . "'><input name='id' type='number' hidden value='" . $gpu->getId_gpu() . "'></form></td>";
              echo "</tr>";
            }
            ?>
          </table>
          <?php
          break;
        case 'obudowa':
          $queryBuilder = $entityManager->createQueryBuilder();
          $obudowaQuery = $queryBuilder
            ->select('c')
            ->from(Obudowa::class, 'c')
            ->getQuery();
          $obudowy = $obudowaQuery->getResult();
          ?>
          <table>
            <tr>
              <th>$id_obudowa = null</th>
              <th>$nazwa</th>
              <th>$standard</th>
              <th>$maks_dlugosc_karty_graf</th>
              <th>$typ_obudowy</th>
              <th>$wysokosc</th>
              <th>$szerokosc</th>
              <th>$glebokosc</th>
              <th>Dodaj</th>
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
              echo "<td><form method='POST'><button type='submit'>Dodaj</button><input type='text' name='type' hidden value='" . $_GET['type'] . "'><input name='id' type='number' hidden value='" . $obudowa->getId_obudowa() . "'></form></td>";
              echo "</tr>";
            }
            ?>
          </table>
          <?php
          break;
        case 'mb':
          $queryBuilder = $entityManager->createQueryBuilder();
          $moboQuery = $queryBuilder
            ->select('c')
            ->from(Mb::class, 'c')
            ->getQuery();
          $mobos = $moboQuery->getResult();
          ?>
          <table>
            <tr>
              <th>$id_mb</th>
              <th>$nazwa</th>
              <th>$chipset_plyty</th>
              <th>$gniazdo_procesora</th>
              <th>$liczba_slotow_pamieci</th>
              <th>$standard_plyty</th>
              <th>$standard_pamieci</th>
              <th>$maks_ilosc_pamieci_ram</th>
              <th>Dodaj</th>
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
              echo "<td><form method='POST'><button type='submit'>Dodaj</button><input type='text' name='type' hidden value='" . $_GET['type'] . "'><input name='id' type='number' hidden value='" . $mb->getId_mb() . "'></form></td>";
              echo "</tr>";
            }
            ?>
          </table>
          <?php
          break;
        case 'ram':
          $queryBuilder = $entityManager->createQueryBuilder();
          $ramQuery = $queryBuilder
            ->select('c')
            ->from(Ram::class, 'c')
            ->getQuery();
          $ramMemories = $ramQuery->getResult();
          ?>
          <table>
            <tr>
              <th>$id_ram = null</th>
              <th>$nazwa</th>
              <th>$czestotliwosc</th>
              <th>$liczba_modulow</th>
              <th>$laczna_pamiec</th>
              <th>$opluznienie</th>
              <th>$typ_pamieci</th>
              <th>Dodaj</th>
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
              echo "<td><form method='POST'><button type='submit'>Dodaj</button><input type='text' name='type' hidden value='" . $_GET['type'] . "'><input name='id' type='number' hidden value='" . $ram->getId_ram() . "'></form></td>";
              echo "</tr>";
            }
            ?>
          </table>
          <?php
          break;
        case 'zasilacz':
          $queryBuilder = $entityManager->createQueryBuilder();
          $zasilaczeQuery = $queryBuilder
            ->select('c')
            ->from(Zasilacz::class, 'c')
            ->getQuery();
          $zasilacze = $zasilaczeQuery->getResult();
          ?>
          <table>
            <tr>
              <th>$id_zasilacz = null</th>
              <th>$nazwa</th>
              <th>$certyfikat</th>
              <th>$srednica_wentylatora</th>
              <th>$moc</th>
              <th>$standard</th>
              <th>$wysokosc</th>
              <th>$szerokosc</th>
              <th>$glebokosc</th>
              <th>Dodaj</th>
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
              echo "<td><form method='POST'><button type='submit'>Dodaj</button><input type='text' name='type' hidden value='" . $_GET['type'] . "'><input name='id' type='number' hidden value='" . $zasilacz->getId_zasilacz() . "'></form></td>";
              echo "</tr>";
            }
            ?>
          </table>
          <?php
          break;
        default:
          echo "Nieprawidłowe dane!";
          break;
      } ?>

    </div>
  <?php } ?>

  <?php
  function getProductName($type, $id)
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

    switch ($type) {
      case 'chlodzenie_cpu':
        $queryBuilder = $entityManager->createQueryBuilder();
        $dane = $queryBuilder
          ->select('c')
          ->from(CpuCooler::class, 'c')
          ->where('c.id_chlodzenie_cpu = ' . $id)
          ->getQuery();
        return $dane->getSingleResult()->getNazwa();
        break;
      case 'cpu':
        $queryBuilder = $entityManager->createQueryBuilder();
        $dane = $queryBuilder
          ->select('c')
          ->from(Cpu::class, 'c')
          ->where('c.id_cpu = ' . $id)
          ->getQuery();
        return $dane->getSingleResult()->getNazwa();
        break;
      case 'dysk':
        $queryBuilder = $entityManager->createQueryBuilder();
        $dane = $queryBuilder
          ->select('c')
          ->from(Ssd::class, 'c')
          ->where('c.id = ' . $id)
          ->getQuery();
        return $dane->getSingleResult()->getNazwa();
        break;
      case 'gpu':
        $queryBuilder = $entityManager->createQueryBuilder();
        $dane = $queryBuilder
          ->select('c')
          ->from(Gpu::class, 'c')
          ->where('c.id_gpu = ' . $id)
          ->getQuery();
        return $dane->getSingleResult()->getNazwa();
        break;
      case 'obudowa':
        $queryBuilder = $entityManager->createQueryBuilder();
        $dane = $queryBuilder
          ->select('c')
          ->from(Obudowa::class, 'c')
          ->where('c.id_obudowa = ' . $id)
          ->getQuery();
        return $dane->getSingleResult()->getNazwa();
        break;
      case 'mb':
        $queryBuilder = $entityManager->createQueryBuilder();
        $dane = $queryBuilder
          ->select('c')
          ->from(Mb::class, 'c')
          ->where('c.id_mb = ' . $id)
          ->getQuery();
        return $dane->getSingleResult()->getNazwa();
        break;
      case 'ram':
        $queryBuilder = $entityManager->createQueryBuilder();
        $dane = $queryBuilder
          ->select('c')
          ->from(Ram::class, 'c')
          ->where('c.id_ram = ' . $id)
          ->getQuery();
        return $dane->getSingleResult()->getNazwa();
        break;
      case 'zasilacz':
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

  <div class="container">
    <div class="logo">
      <img src="../GRAPHICS/strona_logo.png" alt="LOGO" />
    </div>
    <div class="grid">
      <a href="?type=chlodzenie_cpu">
        <div class="tile">
          <img src="../GRAPHICS/chlodzenie-grafika.png" alt="obrazek 1" />
          <p>
            <?php echo isset($_GET['chlodzenie_cpu']) ? getProductName('chlodzenie_cpu', $_GET['chlodzenie_cpu']) : "" ?>
          </p>
        </div>
      </a>
      <a href="?type=cpu">
        <div class="tile">
          <img src="../GRAPHICS/cpu-grafika.png" alt="obrazek 2" />
          <p>
            <?php echo isset($_GET['gpu']) ? getProductName('gpu', $_GET['gpu']) : "" ?>
          </p>
        </div>
      </a>
      <a href="?type=dysk">
        <div class="tile">
          <img src="../GRAPHICS/dysk-grafika.png" alt="obrazek 3" />
          <p>
            <?php echo isset($_GET['dysk']) ? getProductName('dysk', $_GET['dysk']) : "" ?>
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
      <a href="?type=obudowa">
        <div class="tile">
          <img src="../GRAPHICS/obudowa-grafika.png" alt="obrazek 5" />
          <p>
            <?php echo isset($_GET['obudowa']) ? getProductName('obudowa', $_GET['obudowa']) : "" ?>
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
      <a href="?type=zasilacz">
        <div class="tile">
          <img src="../GRAPHICS/zasilacz-grafika.png" alt="obrazek 8" />
          <p>
            <?php echo isset($_GET['zasilacz']) ? getProductName('zasilacz', $_GET['zasilacz']) : "" ?>
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

  <script src="JS/script.js"></script>
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>