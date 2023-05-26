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
  Setup::createAnnotationMetadataConfiguration([__DIR__ . '/Entity'], true)
);

function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if (isset($_POST['save_configuration'])) {
  if (isset($_POST['configuration_name'])) {
    $configurationName = test_input($_POST['configuration_name']);

    $user = "username";
    $userId = 1; 

  
    $selectedConfiguration = $entityManager->getRepository(Configuration::class)->find($_POST['save_configuration']);
    $parts = $selectedConfiguration->getParts();

    
    $newConfiguration = new Configuration();
    $newConfiguration->setName($configurationName);
    $newConfiguration->setUser($user);
    $newConfiguration->setUserId($userId);

    foreach ($parts as $part) {
      
      $newPart = clone $part;
      $newConfiguration->addPart($newPart);
    }

    
    $entityManager->persist($newConfiguration);
    $entityManager->flush();

    
    header('Location: my_configurations.php');
    exit;
  }
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

  <?php if (isset($_GET['type']) && $_GET['type'] != NULL) { ?>
    <div class="modal">
      <?php switch ($_GET['type']) {
        case "cpu":
          
          break;
        case 'chlodzenie_cpu':
        
          break;
        case 'hdd':
                
          break;
          
          default:
            echo "Invalid part type";
            break;
        } ?>
      </div>
    <?php } ?>
  
    <div class="container">
      <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="form-group">
          <label for="configuration_name">Configuration Name:</label>
          <input type="text" name="configuration_name" id="configuration_name" required />
        </div>
        <div class="table-container">
          <?php echo $select; ?>
        </div>
        <input type="hidden" name="save_configuration" value="<?php echo $_GET['type']; ?>" />
        <button type="submit">Save Configuration</button>
      </form>
    </div>
  </body>