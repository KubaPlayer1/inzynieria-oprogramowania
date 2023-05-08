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
        <img src="GRAPHICS/strona_logo.png">
        <header><h2 class="logo">Build your PC!</h2>
            <nav class="navigation">
                <a href="../PHP/add.php">Add new part</a>
                <a href="#">My account</a>
                <a href="#">My configurations</a>
                <a href="../HTML/konfigurepc.html"><ion-icon name="home-sharp">Konfigure PC</ion-icon></a>
                <button class="button-out" href="../index.html">Log out</button>
            </nav>
        </header>

        <form action="" method="post">
            
            <?php
             if(!isset($_POST['submit'])) { ?>
            <label>Choose what you wont to search: </label>
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
            <input type="submit" name="submit" value="Submit"/>
            
            <?php } ?>
             </form>
            
             <form action="" method="post">
            
             <input type="text" name="select" hidden value="<?php echo $select ?>">
            
            <?php
            
                $podzespoly = ["cpu", "gpu", "zasilacz", "mb", "ram", "ssd", "hdd", "chlodzenie_cpu", "obudowa"];
                if(isset($_POST["submit"]))
                { 
                    
                    $select = $_POST["select"];
                    echo($select);
                    $select ="cpu";
                    if (empty($select)){
                        echo "There is no opption choosed.";
                    }
                    
                    if ($podzespoly[0] == $select) 
                    {
                       ?>
                       <input type="submit" name="submit" value="Submit"/>
                       <input type="text"  name="name">
                       <?php
                       $zmiennaName=$_POST["name"];
                       ?>
                       <label> wpisz cos </label>
                       <?php
                        
                        if(isset($_POST["submit"]))
                       {
                            
                            $queryBuilder = $entityManager->createQueryBuilder();
                            $jakaszmienna=$queryBuilder
                                ->select('c')
                                ->from(Cpu::class,'c')
                                ->where('c.nazwa LIKE :' . $zmiennaName)
                                ->getQuery();
                            $cpus=$jakaszmienna->getResult();    
                        ?>

                        <div class="lista">
                        <?php
                            foreach($cpus as $cpu)
                            {
                                echo $cpus->getId_cpu() . "\n";
                                echo $cpus->getNazwa() . "\n";
                                echo $cpus->getCpu_socket() . "\n";
                                echo $cpus->getTurbo() . "\n";
                                echo $cpus->getRdzenie() . "\n";
                                echo $cpus->getWatki() . "\n";
                            }
                        
                        }
                        else
                        {
                            echo "nie zostalo nic wpisane";
                        }
                        ?>
                        <?php
                        
                    }
                    if ($podzespoly[1] == $select) 
                    {
                        echo "ram";
                        ?>
                        <?php 
                    }
                    if ($podzespoly[2] == $select) 
                    {
                        echo "ram";
                        ?>
                        <?php 
                    }
                    if ($podzespoly[3] == $select) 
                    {
                        echo "ram";
                        ?>
                        <?php
                    }
                    if ($podzespoly[4] == $select) 
                    {
                        echo "ram";
                        ?>
                        <?php
                    }
                    if ($podzespoly[5] == $select) 
                    {
                        echo "ssd";
                        ?>
                        <?php
                    }
                    if ($podzespoly[6] == $select) 
                    {
                        echo "hdd";
                        ?>
                        <?php
                    }
                    if ($podzespoly[7] == $select) 
                    {
                        echo "chlodzenie";
                        ?>
                        <?php
                    }
                    if ($podzespoly[8] == $select) 
                    {
                        echo "obudowa";
                        ?>
                        <?php
                    }

                    ?>
                    
                    <?php


                }
            ?>
        </form>













        <script src="JS/script.js"></script>
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    </body>
</html>
