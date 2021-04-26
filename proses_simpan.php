<?php
// Load file koneksi.php
include "koneksi.php";

// Ambil Data yang Dikirim dari Form
$judul = $_POST['judul'];
$pengarang = $_POST['pengarang'];
$penerbit = $_POST['penerbit'];
$gambar = $_FILES['gambar']['name'];
$tmp = $_FILES['gambar']['tmp_name'];

// Rename nama fotonya dengan menambahkan tanggal dan jam upload
$gambarbaru = date('dmYHis') . $gambar;

// Set path folder tempat menyimpan fotonya
$path = "images/" . $gambarbaru;

// Proses upload
if (move_uploaded_file($tmp, $path)) { // Cek apakah gambar berhasil diupload atau tidak
    // Proses simpan ke Database
    $sql = $pdo->prepare("INSERT INTO buku(judul, pengarang, penerbit, gambar) VALUES(:judul,:pengarang,:penerbit,:gambar)");
    $sql->bindParam(':judul', $judul);
    $sql->bindParam(':pengarang', $pengarang);
    $sql->bindParam(':penerbit', $penerbit);
    $sql->bindParam(':gambar', $gambarbaru);
    $sql->execute(); // Eksekusi query insert

    if ($sql) { // Cek jika proses simpan ke database sukses atau tidak
        // Jika Sukses, Lakukan :
        header("location: index.php"); // Redirect ke halaman index.php
    } else {
        // Jika Gagal, Lakukan :
        echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";
        echo "<br><a href='form_simpan.php'>Kembali Ke Form</a>";
    }
} else {
    // Jika gambar gagal diupload, Lakukan :
    echo "Maaf, Gambar gagal untuk diupload.";
    echo "<br><a href='form_simpan.php'>Kembali Ke Form</a>";
}
