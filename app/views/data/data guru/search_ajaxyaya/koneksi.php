<?php
$host = 'localhost'; // Nama hostnya
$username = 'root'; // Username
$password = ''; 
$database = 'finyan'; // Nama databasenya
// Koneksi ke MySQL dengan PDO
$pdo = new
PDO('mysql:host='.$host.';dbname='.$database,
$username, $password);
?>