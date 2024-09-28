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
    <link rel="icon" href="../binatoo.ico" type="image/x-icon">
    <title>PEMASARAN (FP)</title>
</head>

<body>
    <div class="sidebar close">
        <div class="logo-details">
            <i class='bx bxs-washer'></i>
            <span class="logo_name">PEMASARAN</span>
        </div>

        <ul class="nav-links">
            <li>
                <a href="../admin/dashboard.php">
                    <i class='bx bxs-home-smile'></i>
                    <span class="link_name">Home</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="../admin/dashboard.php">Home</a></li>
                </ul>
            </li>
            <li>
                <div class="iocn-link">
                    <a href="../pelanggan/list_pelanggan.php">
                        <i class='bx bxs-user'></i>
                        <span class="link_name">Pelanggan</span>
                    </a>
                    <i class='bx bxs-chevron-down arrow'></i>
                </div>
                <ul class="sub-menu">
                    <li><a class="link_name" href="#">Pelanggan</a></li>
                    <li><a href="../pelanggan/list_pelanggan.php">List Pelanggan </a></li>
                    <li><a href="../pelanggan/add_pelanggan.php">Tambah Pelanggan</a></li>
                </ul>
            </li>
            <li>
                <div class="iocn-link">
                    <a href="../transaksi/transaksi.php">
                        <i class='bx bx-transfer'></i>
                        <span class="link_name">Transaksi</span>
                    </a>
                    <i class='bx bxs-chevron-down arrow'></i>
                </div>
                <ul class="sub-menu">
                    <li><a class="link_name" href="#">Transaksi</a></li>
                    <li><a href="../transaksi/transaksi.php">List Transaksi</a></li>
                    <li><a href="../transaksi/add_transaksi.php">Tambah Transaksi</a></li>
                </ul>
            </li>
            <li>
                <div class="iocn-link">
                    <a href="../pemasaran/pemasaran.php" class="active">
                        <i class='bx bxs-tv'></i>
                        <span class="link_name">Pemasaran</span>
                    </a>
                    <i class='bx bxs-chevron-down arrow'></i>
                </div>
                <ul class="sub-menu">
                    <li><a class="link_name" href="#">Pemasaran</a></li>
                    <li><a href="../pemasaran/pemasaran.php">List Pemasaran</a></li>
                    <li><a href="../pemasaran/add_pemasaran.php">Tambah Pemasaran</a></li>
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
            <div class="overview">
                <div class="title">
                    <i class="uil uil-tachometer-fast-alt"></i>
                    <span class="text">List Pemasaran</span>
                </div>
                <div class="card-body">
                    <div class="button-group">
                        <a href="../pemasaran/add_pemasaran.php" class="button-tambah">
                            <i class="fas fa-plus fa-sm"></i> Tambah Data
                        </a>
                        <span>&nbsp;&nbsp;</span>
                        <a href="../pemasaran/cetakpemasaran.php" target="_blank" class="button-cetak">
                            <i class="fas fa-download fa-sm"></i> Cetak Data Pemasaran
                        </a>
                    </div>
                </div>
            </div>
        
            <div class="database">
                <div class="database-data">
                    <div class="center">        
                        <table id="dataTables" class="table table-hover">
                            <thead>
                                <tr style="text-align : center;">
                                    <th>Id Pemasaran</th>
                                    <th>Tanggal </th>
                                    <th>Jenis Pemasaran</th>
                                    <th>Target Pemasaran</th>
                                    <th>Hasil Pemasaran</th>
                                    <th>Durasi Pemasaran</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="table-body">
                                <!-- Data will be inserted here by JavaScript -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
         document.addEventListener('DOMContentLoaded', function() {
        fetch('http://localhost/api_pemasaran/api.php')
            .then(response => response.json())
            .then(data => {
                const tableBody = document.getElementById('table-body');
                data.forEach(pemasaran => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                            <td>${pemasaran.id_pemasaran}</td>
                            <td>${pemasaran.tanggal || '-'}</td>
                            <td>${pemasaran.jenis_pemasaran}</td>
                            <td>${pemasaran.target_pemasaran}</td>
                            <td>${pemasaran.hasil_pemasaran}</td>
                            <td>${pemasaran.durasi_pemasaran}</td>
                            <td id="action">
                                <a href="../pemasaran/updatepemasaran.php?id_pemasaran=${pemasaran.id_pemasaran}" class="btn btn-edit"><i class="fas fa-edit"></i> Edit</a>
                                <form method="POST" action="../pemasaran/hapuspemasaran.php" style="display: inline-block;">
                                    <input type="hidden" name="id_pemasaran" value="${pemasaran.id_pemasaran}">
                                    <button type="submit" name="deletes" class="btn btn-hapus" onclick="return confirm('Yakin hapus data?')"><i class="fas fa-trash"></i> Hapus</button>
                                </form>
                            </td>
                        `;
                        tableBody.appendChild(row);
                    });
                })
                .catch(error => console.error('Error fetching data:', error));
        });
    </script>
    <script src="../script.js"></script>
</body>
</html>
