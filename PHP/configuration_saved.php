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

if (isset($_POST['config_name'])) {
  $configName = test_input($_POST['config_name']);

  $selectedParts = $_GET;

  unset($selectedParts['type']);

  foreach ($selectedParts as $type => $partIds) {
    $selectedParts[$type] = json_decode($partIds);
  }

  $configuration = new Configurations();
  $configuration->setName($configName);
  $configuration->setParts($selectedParts);
  
  $entityManager->persist($configuration);
  $entityManager->flush();

  header('Location: my_configurations.php');
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>Save Configuration</title>
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

  <div class="modal">
    <h2>Save Configuration</h2>
    <form method="POST" action="">
      <label for="config_name">Configuration Name:</label>
      <input type="text" id="config_name" name="config_name" required>
      <button type="submit">Save</button>
    </form>
  </div>

</body>

</html>
