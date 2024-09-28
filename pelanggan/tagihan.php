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

    $sql_pelanggan = "SELECT id_pelanggan, `nama_pelanggan` FROM pelanggan WHERE username = :username";
    $stmt_pelanggan = $conn->prepare($sql_pelanggan);
    $stmt_pelanggan->bindParam(':username', $username);
    $stmt_pelanggan->execute();
    $hasil_pelanggan = $stmt_pelanggan->fetch(PDO::FETCH_ASSOC);
    $id_pelanggan = $hasil_pelanggan['id_pelanggan'];
    $nama = $hasil_pelanggan['nama_pelanggan'];

    $sql_tagihan = "SELECT transaksi.id_transaksi, transaksi.tanggal, pelanggan.nama_pelanggan, transaksi.nama_produk, transaksi.id_produk, transaksi.qty, transaksi.biaya, transaksi.bayar, transaksi.kembalian 
                    FROM transaksi 
                    INNER JOIN pelanggan 
                    ON transaksi.id_pelanggan = pelanggan.id_pelanggan
                    WHERE transaksi.kembalian < 0 AND pelanggan.id_pelanggan = :id_pelanggan
                    ORDER BY transaksi.id_transaksi ASC";

    $stmt_tagihan = $conn->prepare($sql_tagihan);
    $stmt_tagihan->bindParam(':id_pelanggan', $id_pelanggan);
    $stmt_tagihan->execute();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="tagihan.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="icon" href="../Pemasaran.ico" type="image/x-icon">
    <title>Tagihan</title>
</head>

<body>
    <section class="dashboard">
    <div class="dash-content">
       <a href="dashboardpelanggan.php" class="home">home</a>
            <div class="overview">
                <div class="title">
                    <i class="uil uil-tachometer-fast-alt"></i>
                    <span class="text">List Tagihan</span>
                </div>
                <div class="top">
                    <div class="search-box">
                        <input type="text" placeholder="Search...">
                        <i class='bx bx-search'></i>
                    </div>
                </div>

                <div class="card-body">
                    <br>
                    <table id="dataTables" class="table table-hover">
                        <thead>
                            <tr style="text-align: center;">
                                <th>No</th>
                                <th>ID Transaksi</th>
                                <th>Tanggal Transaksi</th>
                                <th>Nama Pelanggan</th>
                                <th>Nama Barang</th>
                                <th>ID Barang</th>
                                <th>Quantity</th>
                                <th>Biaya</th>
                                <th>Bayar</th>
                                <th>Jumlah yang Belum dibayar</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $no = 1;
                            while ($data = $stmt_tagihan->fetch(PDO::FETCH_ASSOC)) {
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
                                    <td style="text-align: center;"><?= $no++; ?></td>
                                    <td style="text-align: center;"><?= $data['id_transaksi']; ?></td>
                                    <td style="text-align: center;"><?= $data['tanggal']; ?></td>
                                    <td style="text-align: center;"><?= $data['nama_pelanggan']; ?></td>
                                    <td style="text-align: center;"><?= $row['name']; ?></td>
                                    <td style="text-align: center;"><?= $row['id']; ?></td>
                                    <td style="text-align: center;"><?= $data['qty']; ?></td>
                                    <td style="text-align: center;"><?= $data['biaya']; ?></td>
                                    <td style="text-align: center;"><?= $data['bayar']; ?></td>
                                    <td style="text-align: center;"><?= $data['kembalian']; ?></td>
                                    <td style="text-align: center;"><span class='keterangan-lunas'>Belum Lunas</span></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <script src="../script.js"></script>
</body>

</html>
