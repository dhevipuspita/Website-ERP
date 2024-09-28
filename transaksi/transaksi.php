<?php
    include('../conn.php');
    include('function.php');

    $data_transaksi = getDataTransaksi();
    $data_karyawan = getDataKaryawan(); // Ambil data karyawan dari API

    // Logout
    if (isset($_GET['logout']) && $_GET['logout'] === 'true') {
        include('../logout.php');
    }

    // Query Transaksi
    $query = "SELECT transaksi.id_transaksi, transaksi.tanggal, transaksi.nama_karyawan, pelanggan.nama_pelanggan, transaksi.nama_produk, transaksi.id_produk, transaksi.qty, transaksi.biaya, transaksi.bayar, transaksi.kembalian 
            FROM transaksi 
            INNER JOIN pelanggan ON transaksi.id_pelanggan = pelanggan.id_pelanggan 
            ORDER BY transaksi.id_transaksi ASC";
    $result = $conn->query($query);

    // Cek apakah query berhasil dieksekusi
    if (!$result) {
        die("Query gagal: " . $conn->error);
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
            <i class='bx bxs-store'></i>
            <span class="logo_name">PEMASARAN</span>
        </div>
        <ul class="nav-links">
            <!-- Navigation Links -->
            <li><a href="../admin/dashboard.php"><i class='bx bxs-home-smile'></i><span class="link_name">Home</span></a></li>
            <li>
                <div class="iocn-link">
                    <a href="../pelanggan/list_pelanggan.php"><i class='bx bxs-user'></i><span class="link_name">Pelanggan</span></a>
                    <i class='bx bxs-chevron-down arrow'></i>
                    <ul class="sub-menu">
                        <li><a class="link_name" href="#">Pelanggan</a></li>
                        <li><a href="../pelanggan/list_pelanggan.php">List Pelanggan</a></li>
                        <li><a href="../pelanggan/add_pelanggan.php">Tambah Pelanggan</a></li>
                    </ul>
                </div>
            </li>
            <li>
                <div class="iocn-link">
                    <a href="../transaksi/transaksi.php" class="active"><i class='bx bx-transfer'></i><span class="link_name">Transaksi</span></a>
                    <i class='bx bxs-chevron-down arrow'></i>
                    <ul class="sub-menu">
                        <li><a class="link_name" href="#">Transaksi</a></li>
                        <li><a href="../transaksi/transaksi.php">List Transaksi</a></li>
                        <li><a href="../transaksi/add_transaksi.php">Tambah Transaksi</a></li>
                    </ul>
                </div>
            </li>
            <li>
                <div class="iocn-link">
                    <a href="../pemasaran/pemasaran.php"><i class='bx bxs-tv'></i><span class="link_name">Pemasaran</span></a>
                    <i class='bx bxs-chevron-down arrow'></i>
                    <ul class="sub-menu">
                        <li><a class="link_name" href="#">Pemasaran</a></li>
                        <li><a href="../pemasaran/pemasaran.php">List Pemasaran</a></li>
                        <li><a href="../pemasaran/add_pemasaran.php">Tambah Pemasaran</a></li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>

    <section class="dashboard">
        <div class="top">
            <div class="sidebar-button"><i class='bx bx-menu sidebar-toggle'></i></div>
            <div class="search-box"><input type="text" placeholder="Search..."><i class='bx bx-search'></i></div>
            <div class="profile-details">
                <span class="admin_name">Admin</span>
                <i class="bx bx-chevron-down"></i>
                <div class="dropdown">
                    <a href="?logout=true" id="logout"><i class="fas fa-sign-out-alt"></i> Log Out</a>
                </div>
            </div>
        </div>

        <div class="dash-content">
            <div class="overview">
                <div class="title"><i class="uil uil-tachometer-fast-alt"></i><span class="text">List Transaksi</span></div>
                <div class="card-body">
                    <div class="button-group">
                        <a href="../transaksi/add_transaksi.php" class="button-tambah"><i class="fas fa-plus fa-sm"></i> Tambah Data</a>
                        <span>&nbsp;&nbsp;</span>
                        <a href="../transaksi/cetakTransaksi.php" target="_blank" class="button-cetak"><i class="fas fa-download fa-sm"></i> Cetak Semua Transaksi</a>
                    </div>
                </div>
            </div>

            <div class="database">
                <div class="database-data">
                    <div class="center">
                        <table id="dataTables" class="table table-hover">
                            <thead>
                                <tr style="text-align : center;">
                                    <th>No</th>
                                    <th>ID Transaksi</th>
                                    <th>Tanggal Transaksi</th>
                                    <th>Nama Karyawan</th>
                                    <th>Nama Pelanggan</th>
                                    <th>Nama Barang</th>
                                    <th>ID Barang</th>
                                    <th>Quantity</th>
                                    <th>Total Harga</th>
                                    <th>Bayar</th>
                                    <th>Kembalian</th>
                                    <th>Keterangan</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($result && $result->rowCount() > 0) {
                                    $no = 1;
                                    while ($data = $result->fetch(PDO::FETCH_ASSOC)) {
                                        // Ambil nama_produk berdasarkan id_produk
                                        $nama_produk = '';
                                        if ($data['id_produk'] !== false) {
                                            foreach ($data_transaksi as $row) {
                                                if ($row['id'] == $data['id_produk']) {
                                                    $nama_produk = $row['name'];
                                                    break;
                                                }
                                            }
                                        }

                                        // Ambil nama_karyawan berdasarkan nama_karyawan yang tersimpan
                                        $nama_karyawan = '';
                                        if ($data['nama_karyawan'] !== false) {
                                            foreach ($data_karyawan as $karyawan) {
                                                if ($karyawan['name'] == $data['nama_karyawan']) {
                                                    $nama_karyawan = $karyawan['name'];
                                                    break;
                                                }
                                            }
                                        }
                                ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $data['id_transaksi']; ?></td>
                                            <td><?= $data['tanggal']; ?></td>
                                            <td><?= $nama_karyawan; ?></td>
                                            <td><?= $data['nama_pelanggan']; ?></td>
                                            <td><?= $nama_produk; ?></td>
                                            <td><?= $data['id_produk']; ?></td>
                                            <td><?= $data['qty']; ?></td>
                                            <td><?= $data['biaya']; ?></td>
                                            <td><?= $data['bayar']; ?></td>
                                            <td><?= $data['kembalian']; ?></td>
                                            <td>
                                                <?php
                                                if ($data['kembalian'] < 0) {
                                                    echo "<span class='keterangan-lunas'>Belum Lunas</span>";
                                                } else {
                                                    echo "<span class='keterangan-belum-lunas'>Lunas</span>";
                                                }
                                                ?>
                                            </td>
                                            <td id="action">
                                                <a href="../transaksi/updatetransaksi.php?id_transaksi=<?= $data['id_transaksi']; ?>" class="btn btn-edit"><i class="fas fa-edit"></i> Edit</a>
                                                <form method="POST" action="../transaksi/hapustransaksi.php" style="display: inline-block;">
                                                    <input type="hidden" name="id_transaksi" value="<?= $data['id_transaksi']; ?>">
                                                    <button type="submit" name="deletes" class="btn btn-hapus" onclick="return confirm('Yakin hapus data?')" >
                                                        <i class="fas fa-trash"></i> Hapus
                                                    </button>
                                                </form>
                                                <a href="../transaksi/cetak1.php?id_transaksi=<?= $data['id_transaksi']; ?>" class="btn btn-print">
                                                    <i class="fas fa-print"></i> Print
                                                </a>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                } else {
                                    echo "<tr><td colspan='13' style='text-align: center;'>Tidak ada data transaksi.</td></tr>";
                                }
                                ?>
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
