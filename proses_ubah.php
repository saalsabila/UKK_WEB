<?php
// Load file koneksi.php
include "koneksi.php";

// Ambil data ID yang dikirim oleh form_ubah.php melalui URL
$id = $_GET['id'];

// Ambil Data yang Dikirim dari Form
$judul = $_POST['judul'];
$pengarang = $_POST['pengarang'];
$penerbit = $_POST['penerbit'];

// Ambil data foto yang dipilih dari form
$gambar = $_FILES['gambar']['name'];
$tmp = $_FILES['gambar']['tmp_name'];

// Cek apakah user ingin mengubah fotonya atau tidak
if (empty($gambar)) { // Jika user tidak memilih file foto pada form
    // Lakukan proses update tanpa mengubah fotonya
    // Proses ubah data ke Database
    $sql = $pdo->prepare("UPDATE buku SET judul=:judul, pengarang=:pengarang, penerbit=:penerbit WHERE id=:id");
    $sql->bindParam(':judul', $judul);
    $sql->bindParam(':pengarang', $pengarang);
    $sql->bindParam(':penerbit', $penerbit);
    $sql->bindParam(':id', $id);
    $execute = $sql->execute(); // Eksekusi / Jalankan query

    if ($sql) { // Cek jika proses simpan ke database sukses atau tidak
        // Jika Sukses, Lakukan :
        header("location: index.php"); // Redirect ke halaman index.php
    } else {
        // Jika Gagal, Lakukan :
        echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";
        echo "<br><a href='form_ubah.php'>Kembali Ke Form</a>";
    }
} else { // Jika user memilih foto / mengisi input file foto pada form
    // Lakukan proses update termasuk mengganti foto sebelumnya
    // Rename nama fotonya dengan menambahkan tanggal dan jam upload
    $fotobaru = date('dmYHis') . $gambar;

    // Set path folder tempat menyimpan fotonya
    $path = "images/" . $fotobaru;

    // Proses upload
    if (move_uploaded_file($tmp, $path)) { // Cek apakah gambar berhasil diupload atau tidak
        // Query untuk menampilkan data siswa berdasarkan ID yang dikirim
        $sql = $pdo->prepare("SELECT gambar FROM buku WHERE id=:id");
        $sql->bindParam(':id', $id);
        $sql->execute(); // Eksekusi query insert
        $data = $sql->fetch(); // Ambil semua data dari hasil eksekusi $sql

        // Cek apakah file foto sebelumnya ada di folder images
        if (is_file("images/" . $data['gambar'])) // Jika foto ada
            unlink("images/" . $data['gambar']); // Hapus file foto sebelumnya yang ada di folder images

        // Proses ubah data ke Database
        $sql = $pdo->prepare("UPDATE buku SET judul=:judul, pengarang=:pengarang, penerbit=:penerbit WHERE id=:id");
        $sql->bindParam(':judul', $judul);
        $sql->bindParam(':pengarang', $pengarang);
        $sql->bindParam(':penerbit', $penerbit);
        $sql->bindParam(':gambar', $fotobaru);
        $sql->bindParam(':id', $id);
        $execute = $sql->execute(); // Eksekusi / Jalankan query

        if ($sql) { // Cek jika proses simpan ke database sukses atau tidak
            // Jika Sukses, Lakukan :
            header("location: index.php"); // Redirect ke halaman index.php
        } else {
            // Jika Gagal, Lakukan :
            echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";
            echo "<br><a href='form_ubah.php'>Kembali Ke Form</a>";
        }
    } else {
        // Jika gambar gagal diupload, Lakukan :
        echo "Maaf, Gambar gagal untuk diupload.";
        echo "<br><a href='form_ubah.php'>Kembali Ke Form</a>";
    }
}
