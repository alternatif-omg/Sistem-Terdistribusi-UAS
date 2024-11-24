<?php
function getConnection() {
    $host = 'localhost'; // Ganti sesuai konfigurasi server
    $dbname = 'ekskul'; // Nama database
    $username = 'root'; // Username MySQL (default: root)
    $password = ''; // Password MySQL (kosongkan jika tidak ada password)

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        // Mengatur mode error agar menggunakan exception
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        // Jika koneksi gagal, keluarkan pesan error
        die("Connection failed: " . $e->getMessage());
    }
}
?>
