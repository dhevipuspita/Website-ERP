<?php
include('../conn.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tanggal = $_POST['tanggal'];
    $jenis_pemasaran = $_POST['jenis_pemasaran'];
    $target_pemasaran = $_POST['target_pemasaran'];
    $hasil_pemasaran = $_POST['hasil_pemasaran'];
    $durasi_pemasaran = $_POST['durasi_pemasaran'];

    // Menyiapkan pernyataan (prepared statement) untuk kueri INSERT
    $query = $conn->prepare("INSERT INTO pemasaran (tanggal, jenis_pemasaran, target_pemasaran, hasil_pemasaran, durasi_pemasaran) 
                            VALUES (:tanggal, :jenis_pemasaran, :target_pemasaran, :hasil_pemasaran, :durasi_pemasaran)");

    // Mengikat nilai-nilai parameter ke pernyataan
    $query->bindParam(':tanggal', $tanggal);
    $query->bindParam(':jenis_pemasaran', $jenis_pemasaran);
    $query->bindParam(':target_pemasaran', $target_pemasaran);
    $query->bindParam(':hasil_pemasaran', $hasil_pemasaran);
    $query->bindParam(':durasi_pemasaran', $durasi_pemasaran);

    // Mengeksekusi pernyataan (prepared statement)
    if ($query->execute()) {
        echo "
            <script>
                alert('Data berhasil ditambahkan');
                window.location.href = '../pemasaran/pemasaran.php';
            </script>";
    } else {
        echo "
            <script>
                alert('Data gagal ditambahkan');
                window.location.href = '../pemasaran/pemasaran.php';
            </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style_form.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-a1H+hRVW/n4h4/d73yQyRRgkFgn3jBku3a2lRlZImFHAj6rM2RUv8D6vymMBLtXPHfXE02hOlhRq/hE49lMDwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="formtransaksi.css">
    <link rel="icon" href="../Pemasaran.ico" type="image/x-icon">
    <title>Tambah Pemasaran</title>
</head>

<body>
    <div class="container">
        <div class="form-container">
            <h1>Tambah Data Pemasaran Baru</h1>
            <form method="post" enctype="multipart/form-data">
                <div>
                    <label for="id_pemasaran">ID Pemasaran</label>
                    <input type="text" maxlength="50" class="form-control" name="id_pemasaran" id="id_pemasaran" placeholder="Masukkan ID pemasaran" required>
                </div>
                <div>
                    <label for="tanggal">Tanggal Pemasaran</label>
                    <input type="date" maxlength="50" class="form-control" name="tanggal" id="tanggal" placeholder="Masukkan tanggal pemasaran" required>
                </div>
                <div>
                    <label for="jenis_pemasaran">Jenis Pemasaran</label>
                    <input type="text" maxlength="50" class="form-control" name="jenis_pemasaran" id="jenis_pemasaran" placeholder="Masukkan jenis pemasaran" required>
                </div>
                <div>
                    <label for="target_pemasaran">Target Pemasaran</label>
                    <input type="text" maxlength="50" class="form-control" name="target_pemasaran" id="target_pemasaran" placeholder="Masukkan target pemasaran" required>
                </div>
                <div>
                    <label for="hasil_pemasaran">Hasil Pemasaran</label>
                    <input type="text" maxlength="50" class="form-control" name="hasil_pemasaran" id="hasil_pemasaran" placeholder="Masukkan hasil pemasaran" required>
                </div>
                <div>
                    <label for="durasi_pemasaran">Durasi Pemasaran</label>
                    <input type="text" maxlength="50" class="form-control" name="durasi_pemasaran" id="durasi_pemasaran" placeholder="Masukkan durasi pemasaran" required>
                </div>
                <div class="center-button">
                    <button type="reset" class="btn btn-reset"><i class="fas fa-undo"></i> Hapus</button>
                    <button type="submit" name="submit" class="btn btn-save"><i class="fas fa-save"></i> Simpan</button>
                </div>
                <div class="center-button">
                    <a href="../pemasaran/pemasaran.php" class="btn btn-back"> <i class="fas fa-home"></i> Kembali</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
