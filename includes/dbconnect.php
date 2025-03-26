<?php
// includes/dbconnect.php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nexus_archive";

// Create a connection using MySQLi
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
