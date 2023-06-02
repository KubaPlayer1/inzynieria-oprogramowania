<?php
require_once('accounts.php');
require_once 'vendor/autoload.php';
require_once('ID.php');
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

if (isset($_POST["username"])) {
    $username = test_input($_POST["username"]);
    $email = test_input($_POST["email"]);
    $password = $_POST["password"];
    $terms = test_input($_POST["terms"]);

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Email address '$email' is considered valid.\n";
    } else {
        echo "Email address '$email' is considered invalid.\n";
    }

    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number = preg_match('@[0-9]@', $password);
    $specialChars = preg_match('@[^\w]@', $password);

    if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
        echo 'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.';
    } else {
        echo 'Strong password.';
    }

    if (preg_match('/^[a-z]\w{2,23}[^_]$/i', $username)) {
        echo "Username correct.";
    } else {
        echo "Please enter valid username.";
    }

    $accounts = (new Accounts())
        ->setUsername($username)
        ->setEmail($email)
        ->setPassword($password);

    $entityManager->persist($accounts);
    $entityManager->flush();
    header("Location: ../index.html");
}

if (isset($_GET["email"])) {
    $email = test_input($_GET["email"]);
    $password = $_GET["password"];

    /*$query = $entityManager->createQuery('SELECT c FROM Accounts c WHERE c.email LIKE(' .$email. ')');
    $accounts = $query->getResult();*/

    $queryBuilder = $entityManager->createQueryBuilder();

    $query = $queryBuilder
        ->select('c')
        ->from(Accounts::class, 'c')
        //->where('c.email LIKE('.$email.')')
        ->getQuery();

    //echo $query->getDQL();

    $accounts = $query->getResult();

    var_dump($accounts);

    foreach ($accounts as $account) {
        if ($account->getEmail() == $email) {
            if ($account->getPassword() == $password) {
                $ida = $account->getId();
                $idaccount = (new Iddb())
                    ->setId_account($ida);
                $entityManager->persist($idaccount);
                $entityManager->flush();
                echo "Zalogowany.";
                header("Location: konfigurepc.php");
                break;
            } else {
                echo "Hasło nie jest poprawne.";
                header("Location: ../index.html");
                break;
            }
        } else {
            echo "Niepoprawny adres email.";
            header("Location: ../index.html");
            break;
        }
    }

    /*if ($account->getEmail() == $email){
        if ($account->getPassword() == $password){
            echo "Zalogowany.";
        }
        else {
            echo "Hasło nie jest poprawne.";
        }
    }
    else {
        echo "Niepoprawny adres email.";
    }*/
}

?>