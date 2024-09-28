<?php
    session_start();
    include '../conn.php';

    $sumber = 'https://erpkel12.my.id/api/product';
    $konten = file_get_contents($sumber);
    $data_transaksi = json_decode($konten, true);

    if (!isset($_SESSION['username'])) {
        header("Location: loginpelanggan.php");
        exit();
    }

    $username = $_SESSION['username'];

    $sql_pelanggan = "SELECT id_pelanggan, `nama_pelanggan` FROM pelanggan 
                        WHERE username = :username";
    $stmt_pelanggan = $conn->prepare($sql_pelanggan);
    $stmt_pelanggan->bindParam(':username', $username);
    $stmt_pelanggan->execute();
    $hasil_pelanggan = $stmt_pelanggan->fetch(PDO::FETCH_ASSOC);
    $id_pelanggan = $hasil_pelanggan['id_pelanggan'];
    $nama = $hasil_pelanggan['nama_pelanggan'];

    $sql_riwayat = "SELECT * FROM transaksi 
                    WHERE id_pelanggan = :id_pelanggan";
    $stmt_riwayat = $conn->prepare($sql_riwayat);
    $stmt_riwayat->bindParam(':id_pelanggan', $id_pelanggan);
    $stmt_riwayat->execute();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../Pemasaran.ico" type="image/x-icon">
    <title>Daftar Transaksi</title>
    <link rel="stylesheet" href="styleriwayattransaksi.css">
</head>
<body>
    <h2>Selamat datang, <?php echo $nama; ?>!</h2>
    <div class="container">
        <h2>Daftar Transaksi</h2>
        <table>
            <tr>
                <th>ID Transaksi</th>
                <th>Tanggal Transaksi</th>
                <th>ID Barang</th>
                <th>Nama Barang</th>
                <th>Qty</th>
                <th>Biaya</th>
                <th>Bayar</th>
                <th>Kembalian</th>
            </tr>
            <?php
            $no = 1;
            while ($data = $stmt_riwayat->fetch(PDO::FETCH_ASSOC)) {
                $nama_produk = '';
                $id_produk = $data['id_produk'];
                foreach ($data_transaksi as $row) {
                    if ($row['id'] == $data['id_produk']) {
                        $nama_produk = $row['name'];
                        break;
                    }
                }
            ?>
                <tr>
                    <td style="text-align: center;"><?php echo $data['id_transaksi']; ?></td>
                    <td style="text-align: center;"><?php echo $data['tanggal']; ?></td>
                    <td style="text-align: center;"><?php echo $row['id']; ?></td>
                    <td style="text-align: center;"><?php echo $row['name']; ?></td>
                    <td style="text-align: center;"><?php echo $data['qty']; ?></td>
                    <td style="text-align: center;"><?php echo $data['biaya']; ?></td>
                    <td style="text-align: center;"><?php echo $data['bayar']; ?></td>
                    <td style="text-align: center;"><?php echo $data['kembalian']; ?></td>
                </tr>
            <?php } ?>
        </table>
        <br>
        <div class="button">
            <a href="loginpelanggan.php" class="button button-primary">Log Out</a>
            <a href="notasatuan.php" class="button button-secondary">Cetak</a>
        </div>
    </div>
</body>
</html>
