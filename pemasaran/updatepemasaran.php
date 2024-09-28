<?php
// Ambil ID pemasaran dari URL
$id_pemasaran = isset($_GET['id_pemasaran']) ? $_GET['id_pemasaran'] : '';

// Inisialisasi cURL untuk mengambil data pemasaran berdasarkan id_pemasaran
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://127.0.0.1:5000/api/pemasaran/' . $id_pemasaran);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

$data_pemasaran = json_decode($response, true);

// Periksa apakah form telah disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $id_pemasaran = isset($_POST['id_pemasaran']) ? $_POST['id_pemasaran'] : '';
    $tanggal_pemasaran = isset($_POST['tanggal_pemasaran']) ? $_POST['tanggal_pemasaran'] : '';
    $jenis_pemasaran = isset($_POST['jenis_pemasaran']) ? $_POST['jenis_pemasaran'] : '';
    $target_pemasaran = isset($_POST['target_pemasaran']) ? $_POST['target_pemasaran'] : '';
    $hasil_pemasaran = isset($_POST['hasil_pemasaran']) ? $_POST['hasil_pemasaran'] : '';
    $durasi_pemasaran = isset($_POST['durasi_pemasaran']) ? $_POST['durasi_pemasaran'] : '';

    // Data yang akan dikirimkan
    $data = [
        'id_pemasaran' => $id_pemasaran,
        'tanggal_pemasaran' => $tanggal_pemasaran,
        'jenis_pemasaran' => $jenis_pemasaran,
        'target_pemasaran' => $target_pemasaran,
        'hasil_pemasaran' => $hasil_pemasaran,
        'durasi_pemasaran' => $durasi_pemasaran
    ];

    // Inisialisasi cURL untuk memperbarui data pemasaran
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://127.0.0.1:5000/api/pemasaran/' . $id_pemasaran);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen(json_encode($data))
    ));

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE); // Mendapatkan status HTTP

    // Periksa jika ada kesalahan cURL
    if (curl_errno($ch)) {
        $error_msg = curl_error($ch);
    }

    curl_close($ch);

    // Cek status HTTP
    if ($httpCode == 200) {
        echo "<script>alert('Data berhasil diperbarui');</script>";
        echo "<script>window.location.href = 'pemasaran.php';</script>";
        exit();
    } else {
        $error_message = isset($error_msg) ? $error_msg : 'Data gagal diperbarui';
        echo "<script>alert('{$error_message}');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-a1H+hRVW/n4h4/d73yQyRRgkFgn3jBku3a2lRlZImFHAj6rM2RUv8D6vymMBLtXPHfXE02hOlhRq/hE49lMDwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="../style_update.css">
    <link rel="icon" href="../Pemasaran.ico" type="image/x-icon">
    <title>Update Pemasaran</title>
</head>

<body>
    <div class="container">
        <div class="form-container">
            <h2 class="form-title">Update Data Pemasaran</h2>
            <form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id_pemasaran=' . $id_pemasaran; ?>">
                <div>
                    <input type="hidden" name="id_pemasaran" value="<?php echo $data_pemasaran['id_pemasaran']; ?>">
                </div>
                <div>
                    <label for="tanggal_pemasaran">Tanggal Pemasaran</label>
                    <input type="date" name="tanggal_pemasaran" id="tanggal_pemasaran" value="<?php echo isset($data_pemasaran['tanggal_pemasaran']) ? $data_pemasaran['tanggal_pemasaran'] : ''; ?>" required>
                </div>
                <div>
                    <label for="jenis_pemasaran">Jenis Pemasaran</label>
                    <input type="text" name="jenis_pemasaran" id="jenis_pemasaran" value="<?php echo isset($data_pemasaran['jenis_pemasaran']) ? $data_pemasaran['jenis_pemasaran'] : ''; ?>" required>
                </div>
                <div>
                    <label for="target_pemasaran">Target Pemasaran</label>
                    <input type="text" name="target_pemasaran" id="target_pemasaran" value="<?php echo isset($data_pemasaran['target_pemasaran']) ? $data_pemasaran['target_pemasaran'] : ''; ?>" required>
                </div>
                <div>
                    <label for="hasil_pemasaran">Hasil Pemasaran</label>
                    <input type="text" name="hasil_pemasaran" id="hasil_pemasaran" value="<?php echo isset($data_pemasaran['hasil_pemasaran']) ? $data_pemasaran['hasil_pemasaran'] : ''; ?>" required>
                </div>
                <div>
                    <label for="durasi_pemasaran">Durasi Pemasaran</label>
                    <input type="text" name="durasi_pemasaran" id="durasi_pemasaran" value="<?php echo isset($data_pemasaran['durasi_pemasaran']) ? $data_pemasaran['durasi_pemasaran'] : ''; ?>" required>
                </div>
                <div class="center-button">
                    <button type="reset" class="reset"><i class="fas fa-undo"></i> Reset</button>
                    <button type="submit" name="submit" class="save"><i class="fas fa-save"></i> Save</button>
                </div>
                <div class="center-button">
                    <button class="back"><i class="fas fa-home"></i><a href="../pemasaran/pemasaran.php"> Kembali</a></button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
