<?php
    $connect = @new mysqli('localhost', 'root', '', 'testbazy');
    if ($Connect->connect_error) {
        die('Connection failed: ' . $Connect->connect_error);
    }
    if(isset($_POST["submit"])){
        $nazwa = $_POST["nazwa"];
        $nazwa2 = $_POST["nazwa2"];
        $sql = "INSERT INTO test (nazwa, nazwa2) VALUES ('$nazwa', '$nazwa2')";
    }
    $connect->close();
?>