<?php
$servername = "localhost:3307"; // Change this to your MySQL server's hostname
$username = "root"; // Change this to your MySQL username
$password = ""; // Change this to your MySQL password
$database = "login"; // Change this to the name of your MySQL database

try {
    $connection = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Connection successful, but no message is displayed
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
