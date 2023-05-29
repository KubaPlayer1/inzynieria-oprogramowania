<?php
require_once 'vendor/autoload.php';
require_once 'DB_connection.php';
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

// Inicjalizacja Doctrine ORM
$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__), true);
$entityManager = EntityManager::create($conn, $config);

// Sprawdzenie, czy formularz został wysłany
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Pobranie danych konfiguracji z formularza
    $ID_account = $_POST['ID_account'];
    $ID_cpu = $_POST['ID_cpu'];
    $ID_mb = $_POST['ID_mb'];
    $ID_ram = $_POST['ID_ram'];
    $ID_gpu = $_POST['ID_gpu'];
    $ID_zasilacz = $_POST['ID_zasilacz'];
    $ID_chlodzenie = $_POST['ID_chlodzenie'];
    $ID_hdd = $_POST['ID_hdd'];
    $ID_ssd = $_POST['ID_ssd'];
    $ID_obudowa = $_POST['ID_obudowa'];
    $name = $_POST['name'];

    // Zapis danych konfiguracji do bazy danych
    $configurations = new Configurations();
    $configurations->setID_account($ID_account)
        ->setID_cpu($ID_cpu)
        ->setID_mb($ID_mb)
        ->setID_ram($ID_ram)
        ->setID_gpu($ID_gpu)
        ->setID_zasilacz($ID_zasilacz)
        ->setID_chlodzenie($ID_chlodzenie)
        ->setID_hdd($ID_hdd)
        ->setID_ssd($ID_ssd)
        ->setID_obudowa($ID_obudowa)
        ->setName($name);

    $entityManager->persist($configurations);
    $entityManager->flush();

    echo "Konfiguracja została zapisana.";
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Formularz zapisu konfiguracji</title>
</head>

<body>
    <h2>Formularz zapisu konfiguracji</h2>
    <form method="post" action="save_configuration.php">
        <label for="ID_account">ID konta:</label>
        <input type="number" name="ID_account" id="ID_account" required><br>

        <label for="ID_cpu">ID CPU:</label>
        <input type="number" name="ID_cpu" id="ID_cpu" required><br>

        <label for="ID_mb">ID płyty głównej:</label>
        <input type="number" name="ID_mb" id="ID_mb" required><br>

        <label for="ID_ram">ID pamięci RAM:</label>
        <input type="number" name="ID_ram" id="ID_ram" required><br>

        <label for="ID_gpu">ID karty graficznej:</label>
        <input type="number" name="ID_gpu" id="ID_gpu" required><br>

        <label for="ID_zasilacz">ID zasilacza:</label>
        <input type="number" name="ID_zasilacz" id="ID_zasilacz" required><br>

        <label for="ID_chlodzenie">ID chłodzenia:</label>
        <input type="number" name="ID_chlodzenie" id="ID_chlodzenie" required><br>

        <label for="ID_hdd">ID dysku HDD:</label>
        <input type="number" name="ID_hdd" id="ID_hdd" required><br>

        <label for="ID_ssd">ID dysku SSD:</label>
        <input type="number" name="ID_ssd" id="ID_ssd" required><br>

        <label for="ID_obudowa">ID obudowy:</label>
        <input type="number" name="ID_obudowa" id="ID_obudowa" required><br>

        <label for="name">Nazwa konfiguracji:</label>
        <input type="text" name="name" id="name" required><br>

        <input type="submit" value="Zapisz konfigurację">
    </form>
</body>

</html>