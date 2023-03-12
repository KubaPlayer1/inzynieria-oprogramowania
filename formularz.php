<?php
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $Connect = @new mysqli('localhost', 'root', '', 'baza');

    if ($Connect->connect_error) {
        die("Connection failed: " . $Connect->connect_error);
    }

    if (isset($_GET["username"])){
        $username = test_input($_GET["username"]);
        $email = test_input($_GET["email"]);
        $password = $_GET["password"];
        $terms = test_input($_GET["terms"]);

        $sql = "INSERT INTO konta (login, email, haslo) VALUES ('$username', '$email', '$password')";

        if ($Connect->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $Connect->error;
        }
    }

    if (isset($_POST["email"])){
        $email = test_input($_POST["email"]);
        $password = $_POST["password"];
        $result = mysqli_query($Connect, "SELECT * FROM konta WHERE email = '$email'");
        $resultCount = $result->num_rows;
        if($resultCount>=1){
            //$Connected = True;
            while($row=mysqli_fetch_array($result)){
                $haslo = $row['haslo'];
            }

            if ($password == $haslo){
                echo "przeszlo";

            }else echo "Nie ma takiego uzytkownika!";
        }else echo "strawdz login lub haslo!";
    }

    $Connect->close();
?>