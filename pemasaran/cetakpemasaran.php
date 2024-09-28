<?php
// URL API untuk mendapatkan data pemasaran
$api_url = 'http://localhost/api_pemasaran/api.php';

// Membuat permintaan HTTP GET untuk mendapatkan data dari API
$response = file_get_contents($api_url);

// Mengubah JSON menjadi array
$pemasaran_data = json_decode($response, true);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" href="../binatoo.ico" type="image/x-icon">
    <link rel="stylesheet" href="../style_cetak.css">
    <title>Cetak Data Pemasaran</title>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th>ID Pemasaran</th>
                <th>Tanggal</th>
                <th>Jenis Pemasaran</th>
                <th>Target Pemasaran</th>
                <th>Hasil Pemasaran</th>
                <th>Durasi Pemasaran</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Periksa apakah ada data pemasaran dari API
            if (!empty($pemasaran_data)) {
                foreach ($pemasaran_data as $data) {
                    echo "<tr>";
                    echo "<td>" . $data['id_pemasaran'] . "</td>";
                    echo "<td>" . $data['tanggal'] . "</td>";
                    echo "<td>" . $data['jenis_pemasaran'] . "</td>";
                    echo "<td>" . $data['target_pemasaran'] . "</td>";
                    echo "<td>" . $data['hasil_pemasaran'] . "</td>";
                    echo "<td>" . $data['durasi_pemasaran'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>Data pemasaran tidak tersedia.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <script>
        window.print();
    </script>
</body>

</html>
