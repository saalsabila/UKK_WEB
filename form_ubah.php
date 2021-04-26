<html>

<head>
    <title>Aplikasi CRUD dengan PHP</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>

<body>
    <div class="container" style="margin-top:20px">
        <h1>Ubah Data Buku</h1>

        <hr>

        <?php
        // Load file koneksi.php
        include "koneksi.php";

        // Ambil data NIS yang dikirim oleh index.php melalui URL
        $id = $_GET['id'];

        // Query untuk menampilkan data buku berdasarkan ID yang dikirim
        $sql = $pdo->prepare("SELECT * FROM buku WHERE id=:id");
        $sql->bindParam(':id', $id);
        $sql->execute(); // Eksekusi query insert
        $data = $sql->fetch(); // Ambil semua data dari hasil eksekusi $sql
        ?>

        <form method="post" action="proses_ubah.php?id=<?php echo $id; ?>" enctype="multipart/form-data">
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Judul Buku</label>
                <div class="col-sm-10">
                    <input type="text" name="judul" class="form-control" size="4" value="<?php echo $data['judul']; ?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Pengarang</label>
                <div class="col-sm-10">
                    <input type="text" name="pengarang" class="form-control" value="<?php echo $data['pengarang']; ?>" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Penerbit</label>
                <div class="col-sm-10">
                    <input type="text" name="penerbit" class="form-control" value="<?php echo $data['penerbit']; ?>" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">&nbsp;</label>
                <div class="col-sm-10">
                    <input type="submit" name="submit" class="btn btn-primary" value="SIMPAN">
                    <a href="index.php" class="btn btn-warning">KEMBALI</a>
                </div>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

</body>

</html>