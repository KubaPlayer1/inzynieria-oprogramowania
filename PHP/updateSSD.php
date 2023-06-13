<?php session_start(); ?>

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
        $conn = mysqli_connect("localhost","root","","peryferia");
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

        function test_input($data) {
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
        <?php
        if(isset($_SESSION['status']))
        {
            echo "<h4>".$_SESSION['status']."</h4>";
            unset($_SESSION['status']);
        }
        ?>
        <header><h2 class="logo">ADD A NEW PART</h2>
            <nav class="navigation">
                <a href="../HTML/konfigurepc.html"><ion-icon name="home-sharp">Konfigure PC</ion-icon></a>
                <a href="serch.php"><ion-icon name="search-sharp">Serch</ion-icon></a>
                <button class="button-out" href="../index.html">Log out</button>
            </nav>
        </header>

        
        <form action="testSSD.php" method="POST">
            <div class="form-group">
                <label for="">Id</label>
                <input type="text" name="id" class="form-control">
            </div>
            <div class="form-group">
                <label for="">nazwa</label>
                <input type="text" name="nazwa" class="form-control">
            </div>
            <div class="form-group">
                <label for="">interfejs</label>
                <input type="text" name="interfejs" class="form-control">
            </div>
            <div class="form-group">
                <label for="">pojemnosc</label>
                <input type="text" name="pojemnosc" class="form-control">
            </div>
            <div class="form-group">
                <label for="">format</label>
                <input type="text" name="format" class="form-control">
            </div>
            <div class="form-group">
                <label for="">odczyt</label>
                <input type="text" name="odczyt" class="form-control">
            </div>
            <div class="form-group">
                <label for="">zapis</label>
                <input type="text" name="zapis" class="form-control">
            </div>
            <div class="form-group">
                    <button type="submit" name="updateSSD"> Update Data </button>
                </div>
        </form>

        
<script src="../JS/script.js"></script>
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    </body>
</html>