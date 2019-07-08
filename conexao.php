<?php
$username = 'root';
$password = '';
try {
    //Lembar do charset=utf8 <<
    $conn = new PDO('mysql:host=localhost;dbname=test;charset=utf8', $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}
?>