<?php
$host = "localhost"; // Nama hostnya
$username = "root"; // Username
$password = ""; // Password (Isi jika menggunakan password)
$database = "db_buku"; // Nama databasenya

// Koneksi ke MySQL dengan PDO
$pdo = new PDO('mysql:host=' . $host . ';dbname=' . $database, $username, $password);
$conn = mysqli_connect('localhost', 'root', '', 'db_buku');
