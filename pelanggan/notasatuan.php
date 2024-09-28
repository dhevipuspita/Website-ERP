<?php
    session_start();
    include '../conn.php';

    if (!isset($_SESSION['username'])) {
        header("Location: loginpelanggan.php");
        exit();
    }

    $username = $_SESSION['username'];

    $sql_pelanggan = "SELECT id_pelanggan, `nama_pelanggan` FROM pelanggan WHERE username = :username";
    $stmt_pelanggan = $conn->prepare($sql_pelanggan);
    $stmt_pelanggan->bindParam(':username', $username);
    $stmt_pelanggan->execute();
    $hasil_pelanggan = $stmt_pelanggan->fetch(PDO::FETCH_ASSOC);
    $id_pelanggan = $hasil_pelanggan['id_pelanggan'];
    $nama = $hasil_pelanggan['nama_pelanggan'];

    $sql_transaksi = "SELECT * FROM transaksi WHERE id_pelanggan = :id_pelanggan";
    $stmt_transaksi = $conn->prepare($sql_transaksi);
    $stmt_transaksi->bindParam(':id_pelanggan', $id_pelanggan);
    $stmt_transaksi->execute();
    $transaksi = $stmt_transaksi->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../Pemasaran.ico" type="image/x-icon">
    <title>Daftar Transaksi</title>
    <link rel="stylesheet" href="stylenota.css">
</head>
<body>
        <div class="container">
            <div class = "head">
                <h2>BINATOO LAUNDRY</h2>
                <p>Jl. Pahlawan  Negara No 9 - Surabaya <br>
                086876987678 <br>
                Tanggal Cetak: <?php echo date(' d - m - Y'); ?> <br>
                Waktu Cetak: <?php echo date('H : i : s'); ?></p>
            </div>

            <div>
                <table>
                    <?php foreach ($transaksi as $row) : ?>
                        <?php if ($row['kembalian'] > 0) : ?>
                        <tr>
                            <td>ID Transaksi</td>
                            <td> : <?php echo $row['id_transaksi']; ?></td>
                        </tr>
                        <tr>
                            <td>Tanggal</td>
                            <td> : <?php echo $row['tanggal']; ?></td>
                        </tr>
                        <tr>
                            <td>ID Pelanggan</td>
                            <td> : <?php echo $row['id_pelanggan']; ?></td>
                        </tr>
                        <tr>
                            <td>ID Paket</td>
                            <td> : <?php echo $row['id_paket']; ?></td>
                        </tr>
                        <tr>
                            <td>Qty</td>
                            <td> : <?php echo $row['qty']; ?></td>
                        </tr>
                        <tr>
                            <td>Biaya</td>
                            <td> : Rp <?php echo $row['biaya']; ?></td>
                        </tr>
                        <tr>
                            <td>Bayar</td>
                            <td> : Rp <?php echo $row['bayar']; ?></td>
                        </tr>
                        <tr>
                            <td>Kembalian</td>
                            <td> : Rp <?php echo $row['kembalian']; ?></td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td> : Lunas </td>
                        </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </table>
            </div>

            <div class = "foot">
                <p> Terima Kasih ! <br> Kami tunggu laundry selanjutnya <br>
            </div>

        </div>

                <br>

        <script>
		    window.print();
	    </script>

</body>
</html>
