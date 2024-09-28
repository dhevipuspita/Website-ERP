<?php
    include('../conn.php');

    // URL API
    $sumber = 'https://erpkel12.my.id/api/product';
    $konten = file_get_contents($sumber);
    $data_transaksi = json_decode($konten, true);

    $id_transaksi = isset($_GET['id_transaksi']) ? $_GET['id_transaksi'] : die('ERROR: Id Transaksi tidak ditemukan.');

    // Query untuk mendapatkan data transaksi berdasarkan id_transaksi
    $query = "SELECT transaksi.id_transaksi, transaksi.tanggal, pelanggan.nama_pelanggan, transaksi.nama_produk, transaksi.id_produk, transaksi.qty, transaksi.biaya, transaksi.bayar, transaksi.kembalian 
              FROM transaksi 
              INNER JOIN pelanggan ON transaksi.id_pelanggan = pelanggan.id_pelanggan
              WHERE transaksi.id_transaksi = :id_transaksi";

    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id_transaksi', $id_transaksi);
    $stmt->execute();
    $data = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$data) {
        die('ERROR: Id Transaksi tidak ditemukan.');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../Pemasaran.ico" type="image/x-icon">
    <title>Cetak Transaksi</title>
    <link rel="stylesheet" href="../style_cetak.css">
</head>
<body>
    <h2>Data Transaksi</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Id Transaksi</th>
                <th>Tanggal Transaksi</th>
                <th>Nama Pelanggan</th>
                <th>Nama Barang</th>
                <th>ID Barang</th>
                <th>Quantity</th>
                <th>Total Harga</th>
                <th>Bayar</th>
                <th>Kembalian</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $no = 1;
            $nama_produk = '';
            $id_produk = $data['id_produk'];
                foreach ($data_transaksi as $row) {
                    if ($row['id'] == $data['id_produk']) {
                        $nama_produk = $row['name'];
                        break;
                    }
                }
            $keterangan = $data['kembalian'] < 0 ? 'Belum Lunas' : 'Lunas';
            $keteranganClass = $data['kembalian'] < 0 ? 'belum-lunas' : 'lunas';
        ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $data['id_transaksi']; ?></td>
                <td><?= $data['tanggal']; ?></td>
                <td><?= $data['nama_pelanggan']; ?></td>
                <td><?= $row['name']; ?></td>
                <td><?= $row['id']; ?></td>
                <td><?= $data['qty']; ?></td>
                <td>Rp <?= number_format($data['biaya'], 0, ',', '.'); ?></td>
                <td>Rp <?= number_format($data['bayar'], 0, ',', '.'); ?></td>
                <td>Rp <?= number_format($data['kembalian'], 0, ',', '.'); ?></td>
                <td>
                    <span class="<?= $keteranganClass; ?>">
                        <?= $keterangan; ?>
                    </span>
                </td>
            </tr>
        </tbody>
    </table>

    <script>
        window.print();

        window.onafterprint = function() {
            alert('Data Berhasil Dicetak');
            window.location.href = '../transaksi/transaksi.php';
        };
    </script>

</body>
</html>