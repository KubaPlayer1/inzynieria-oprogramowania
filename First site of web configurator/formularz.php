<?php
    require_once('DB.php');
    require_once('konta.php');
    $DB = new Connect;
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    

    if (isset($_POST["username"])){
        $username = test_input($_POST["username"]);
        $email = test_input($_POST["email"]);
        $password = $_POST["password"];
        $terms = test_input($_POST["terms"]);

        $konta = new konta(["username", "email", "password"], $username, $email, $password);
        $DB->add($konta);
        
    }

    if (isset($_GET["email"])){
        $email = test_input($_GET["email"]);
        $password = $_GET["password"];

        $konta = new konta(["username", "email", "password"], "", $email, $password);
        $DB->show($konta);
        /*$result = mysqli_query($Connect, "SELECT * FROM konta WHERE email = '$email'");
        $resultCount = $result->num_rows;
        if($resultCount>=1){
            //$Connected = True;
            while($row=mysqli_fetch_array($result)){
                $haslo = $row['haslo'];
            }

            if ($password == $haslo){
                echo "przeszlo";

            }else echo "Nie ma takiego uzytkownika!";
        }else echo "strawdz login lub haslo!";*/
    }

    $DB->Close();
?>