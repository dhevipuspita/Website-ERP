<?php 
    include('../conn.php');

    // URL API
    $sumber = 'https://erpkel12.my.id/api/product';
    $konten = file_get_contents($sumber);
    $data_transaksi = json_decode($konten, true);

    //Query untuk semua data
    $query = "SELECT transaksi.id_transaksi, transaksi.tanggal, pelanggan.nama_pelanggan, transaksi.nama_produk, transaksi.id_produk, transaksi.qty, transaksi.biaya, transaksi.bayar, transaksi.kembalian 
    FROM transaksi 
    INNER JOIN pelanggan ON transaksi.id_pelanggan = pelanggan.id_pelanggan
    ORDER BY transaksi.id_transaksi ASC";

    $result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../Pemasaran.ico" type="image/x-icon">
    <link rel="stylesheet" href="../style_cetak.css">
    <title>Cetak Transaksi</title>
</head>

<body>
    <h2>Data Transaksi Pemasaran</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>ID Transaksi</th>
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
            $totalBiaya = 0; 
            
            while ($data = $result->fetch(PDO::FETCH_ASSOC)) :
                $keterangan = $data['kembalian'] < 0 ? 'Belum Lunas' : 'Lunas';
                $keteranganClass = $data['kembalian'] < 0 ? 'belum-lunas' : 'lunas';
                $totalBiaya += $data['biaya'];

                // Mencari nama produk dari data API
                $nama_produk = '';
                $id_produk = $data['id_produk'];
                foreach ($data_transaksi as $row) {
                    if ($row['id'] == $id_produk) {
                        $nama_produk = $row['name'];
                        break;
                    }
                }
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
            <?php  endwhile; ?>

            <!-- Tambahkan baris untuk menampilkan total biaya -->
            <tr>
                <td colspan="6">Total Biaya</td>
                <td>Rp <?= number_format($totalBiaya, 0, ',', '.'); ?></td>
                <td colspan="4"></td>
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
