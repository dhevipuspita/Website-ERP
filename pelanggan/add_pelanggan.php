<?php
include('../conn.php');
include('function.php');

// ID otomatis
if (isset($_POST["submit"])) {
    if (addPelanggan($_POST) > 0) {
        echo "
            <script>
                alert('Data Tidak Berhasil Ditambahkan');
                document.location.href = 'list_pelanggan.php';
            </script> 
        ";
    } else {
        echo "
            <script>
                alert('Data Berhasil Ditambahkan');
                document.location.href = 'list_pelanggan.php';
            </script> 
    ";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style_form.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400&family=Open+Sans&family=Raleway:wght@800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="icon" href="../Pemasaran.ico" type="image/x-icon">
    <title>Tambah Pelanggan</title>
</head>


<body>
    <div class="container">
        <div class="form-container">
            <h1>Tambah Data Pelanggan</h1>
            <form method="post" enctype="multipart/form-data">
                <div>
                    <label for="nama_pelanggan">Nama Pelanggan</label>
                    <input type="text" maxlength="50" class="form-control" name="nama_pelanggan" id="nama_pelanggan" placeholder="Masukkan nama pelanggan" required>
                </div>
                <div>
                    <label for="username">Username</label>
                    <input type="text" maxlength="50" class="form-control" name="username" id="username" placeholder="Masukkan username" required>
                </div>
                <div>
                    <label for="password">Password</label>
                    <input type="text" maxlength="50" class="form-control" name="password" id="password" placeholder="Masukkan password" required>
                </div>                
                <div>
                    <label for="alamat_pelanggan">Alamat Pelanggan</label>
                    <input type="text" maxlength="50" class="form-control" name="alamat_pelanggan" id="alamat_pelanggan" placeholder="Masukkan alamat" required>
                </div>
                <div>
                    <label for="no_hp_pelanggan">No. HP Pelanggan</label>
                    <input type="text" maxlength="50" class="form-control" name="no_hp_pelanggan" id="no_hp_pelanggan" placeholder="Masukkan nomor Hp" required>
                </div>
                <div class="center-button">
                    <button type="reset" class="btn btn-reset"><i class="fas fa-undo"></i> Hapus</button>
                    <button type="submit" name="submit" class="btn btn-save"><i class="fas fa-save"></i> Simpan</button>
                </div>
                <div class="center-button">
                    <a href="../paketlaundry/list_paketlaundry.php" class="btn btn-back"> <i class="fas fa-home"></i> Kembali</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
