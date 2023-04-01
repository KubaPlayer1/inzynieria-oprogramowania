<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = "baza";
$conn = mysqli_connect($servername, $username, $password, "$dbname");
if (!$conn) {
    die('Could not Connect MySql Server:' . mysql_error());
}
if (isset($_POST['submit'])) {
    $login = $_POST['login'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "INSERT INTO konta (login,email,haslo)
             VALUES ('$login','$email','$password')";
    if (mysqli_query($conn, $sql)) {
        echo "New record has been added successfully !";
    } else {
        echo "Error: " . $sql . ":-" . mysqli_error($conn);
    }
    mysqli_close($conn);
}
?>