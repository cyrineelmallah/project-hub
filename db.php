<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "daily_planner";

try {
    // Create a PDO instance
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    
    // Set PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Optional: echo a success message
    // echo "Connected successfully";
    
} catch (PDOException $e) {
    // Catch any connection error
    die("Connection failed: " . $e->getMessage());
}
?>


