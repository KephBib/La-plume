<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "la_plume";

// Créer une connexion
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("La connexion a échoué : " . $conn->connect_error);
}
?>

