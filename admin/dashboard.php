<?php
    require '../conn.php';
    
    $sumber = 'https://erpkel12.my.id/api/product';
    $konten = file_get_contents($sumber);
    $data_transaksi = json_decode($konten, true);

    $sql_dashboard = "SELECT transaksi.id_transaksi, transaksi.tanggal, pelanggan.nama_pelanggan, transaksi.nama_produk, transaksi.id_produk, transaksi.qty, transaksi.biaya, transaksi.bayar, transaksi.kembalian 
    FROM transaksi
    INNER JOIN pelanggan ON transaksi.id_pelanggan = pelanggan.id_pelanggan
    ORDER BY transaksi.id_transaksi DESC LIMIT 5";
    $stmt_dashboard = $conn->prepare($sql_dashboard);
    $stmt_dashboard->execute();
    
    // Logout
    if (isset($_GET['logout']) && $_GET['logout'] === 'true') {
        include('../logout.php');
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../sidebar.css">
    <link rel="stylesheet" href="../table.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="icon" href="../Pemasaran.ico" type="image/x-icon">
    <title>PEMASARAN (FP)</title>
</head>

<body>
    <div class="sidebar close">

    <div class="logo-details">
        <i class='bx bxs-store' ></i>
        <span class="logo_name">PEMASARAN</span>
    </div>

    <ul class="nav-links">
        <li>
            <a href="<?php echo "../admin/dashboard.php"; ?>" class="active">
                <i class='bx bxs-home-smile'></i>
                <span class="link_name">Home</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="<?php echo "../admin/dashboard.php"; ?>">Home</a></li>
            </ul>
        </li>
        <li>
            <div class="iocn-link">
                <a href="<?php echo "../pelanggan/list_pelanggan.php"; ?>" >
                    <i class='bx bxs-user'></i>
                    <span class="link_name">Pelanggan</span>
                </a>
                <i class='bx bxs-chevron-down arrow'></i>
            </div>
            <ul class="sub-menu">
                <li><a class="link_name" href="#">Pelanggan</a></li>
                <li><a href="<?php echo "../pelanggan/list_pelanggan.php"; ?>">List Pelanggan </a></li>
                <li><a href="<?php echo "../pelanggan/add_pelanggan.php"; ?>">Tambah Pelanggan</a></li>
            </ul>
        </li>
        <li>
                <div class="iocn-link">
                    <a href="<?php echo "../transaksi/transaksi.php"; ?>">
                        <i class='bx bx-transfer'></i>
                        <span class="link_name">Transaksi</span>
                    </a>
                    <i class='bx bxs-chevron-down arrow'></i>
                </div>
                <ul class="sub-menu">
                    <li><a class="link_name" href="#">Transaksi</a></li>
                    <li><a href="<?php echo "../transaksi/transaksi.php"; ?>">List Transaksi</a></li>
                    <li><a href="<?php echo "../transaksi/add_transaksi.php"; ?>">Tambah Transaksi</a></li>
                </ul>
            </li>
            <li>
                <div class="iocn-link">
                    <a href="<?php echo "../pemasaran/pemasaran.php"; ?>">
                        <i class='bx bxs-tv'></i>
                        <span class="link_name">Pemasaran</span>
                    </a>
                    <i class='bx bxs-chevron-down arrow'></i>
                </div>
                <ul class="sub-menu">
                    <li><a class="link_name" href="#">Pemasaran</a></li>
                    <li><a href="<?php echo "../pemasaran/pemasaran.php"; ?>">List Pemasaran</a></li>
                    <li><a href="<?php echo "../pemasaran/add_pemasaran.php"; ?>">Tambah Pemasaran</a></li>
                </ul>
            </li>
        </ul>
    </div>

    <section class="dashboard">
        <div class="top">
            <div class="sidebar-button">
                <i class='bx bx-menu sidebar-toggle'></i>

            </div>
            <div class="search-box">
                <input type="text" placeholder="Search...">
                <i class='bx bx-search'></i>
            </div>
            <div class="profile-details">
                <span class="admin_name">Admin</span>
                <i class="bx bx-chevron-down"></i>
                <div class="dropdown">
                    
                    <a href="?logout=true" id="logout">
                        <i class="fas fa-sign-out-alt"></i> Log Out
                    </a>
                </div>
            </div>
        </div>
           

        <div class="dash-content">
            <div class="database">
                <div class="title">
                    <i class="uil uil-clock-three"></i>
                    <span class="text">Recent Transactions</span>
                </div>

                <div class="database-data">
                    <div class="center">
                        <table id="dataTables" class="table table-hover">
                            <thead>
                                <tr style="text-align: center;">
                                    <th>No</th>
                                    <th>Id Transaksi</th>
                                    <th>Tanggal Transaksi</th>
                                    <th>Nama Pelanggan</th>
                                    <th>Nama Barang</th>
                                    <th>ID Barang</th>
                                    <th>Quantity</th>
                                    <th>Biaya</th>
                                    <th>Bayar</th>
                                    <th>Kembalian</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>

                            <tbody>
                            <?php
                                $no = 1;
                                while ($data = $stmt_dashboard->fetch(PDO::FETCH_ASSOC)) {
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
                                        <td style="text-align: center;">
                                            <?php
                                            if ($data['kembalian'] < 0) {
                                                echo "<span class='keterangan-lunas'>Belum Lunas</span>";
                                            } else {
                                                echo "<span class='keterangan-belum-lunas'>Lunas</span>";
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>                       
                    </div>
                </div>
            </div>
        </div>

    </section>

    <script src="../script.js"></script>
   
</body>

</html>
