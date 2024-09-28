<?php
require '../conn.php';

// Fungsi untuk menghasilkan ID transaksi baru
if (!function_exists('generateNewTransactionId')) {
    function generateNewTransactionId($conn) {
        $lastIdQuery = "SELECT MAX(SUBSTRING(id_transaksi, 4)) AS max_id FROM transaksi";
        $stmt = $conn->prepare($lastIdQuery);
        $stmt->execute();
        $lastIdRow = $stmt->fetch(PDO::FETCH_ASSOC);
        $lastId = $lastIdRow['max_id'];
        $newIdNumber = ($lastId !== null) ? intval($lastId) + 1 : 1;
        $newId = 'TRS' . str_pad($newIdNumber, 3, '0', STR_PAD_LEFT);
        return $newId;
    }
}

// Fungsi untuk mengambil data transaksi dari API
if (!function_exists('getDataTransaksi')) {
    function getDataTransaksi() {
        $sumber = 'https://erpkel12.my.id/api/product';
        $konten = file_get_contents($sumber);
        return json_decode($konten, true);
    }
}

if (!function_exists('getDataKaryawan')) {
    function getDataKaryawan() {
        $url = 'https://sdm.kelompok10.erpkel12.my.id/api/fetch-employee';
        $konten = file_get_contents($url);
        return json_decode($konten, true);
    }
}

//fungsi add
if (!function_exists('addTransaksi')) {
    function addTransaksi($conn, $data_transaksi) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Ambil data yang diinput dari form
            $nama_karyawan = $_POST['id_karyawan'];
            $tanggal = $_POST['tanggal'];
            $id_pelanggan = $_POST['id_pelanggan'];
            $id_produk = $_POST['id'];

            // Cari produk yang sesuai dengan id dari API
            $nama_produk = '';
            $harga_produk = 0;
            foreach ($data_transaksi as $produk) {
                if ($produk['id'] == $id_produk) {
                    $nama_produk = $produk['name'];
                    $harga_produk = $produk['selling_price'];
                    break;
                }
            }

            // Cari ID karyawan berdasarkan nama karyawan
            $query_karyawan = "SELECT id FROM karyawan WHERE name = :nama_karyawan";
            $stmt_karyawan = $conn->prepare($query_karyawan);
            $stmt_karyawan->bindParam(':nama_karyawan', $nama_karyawan);
            $stmt_karyawan->execute();
            $karyawan = $stmt_karyawan->fetch(PDO::FETCH_ASSOC);
            $id_karyawan = $karyawan['id'];

            // Jika produk ditemukan dan ID karyawan valid, simpan ke dalam tabel transaksi
            if ($nama_produk != '' && $id_karyawan != '') {
                $id_transaksi = generateNewTransactionId($conn); 
                $qty = $_POST['qty'];
                $biaya = $harga_produk * $qty;
                $bayar = $_POST['bayar'];
                $kembalian = $bayar - $biaya;

                $query = "INSERT INTO transaksi (id_transaksi, tanggal, id_karyawan, id_pelanggan, id_produk, nama_produk, qty, biaya, bayar, kembalian) 
                VALUES (:id_transaksi, :tanggal, :id_karyawan, :id_pelanggan, :id_produk, :nama_produk, :qty, :biaya, :bayar, :kembalian)";
                $stmt = $conn->prepare($query);
                $stmt->bindParam(':id_transaksi', $id_transaksi);
                $stmt->bindParam(':id_karyawan', $id_karyawan);
                $stmt->bindParam(':tanggal', $tanggal);
                $stmt->bindParam(':id_pelanggan', $id_pelanggan);
                $stmt->bindParam(':id_produk', $id_produk);
                $stmt->bindParam(':nama_produk', $nama_produk);
                $stmt->bindParam(':qty', $qty);
                $stmt->bindParam(':biaya', $biaya);
                $stmt->bindParam(':bayar', $bayar);
                $stmt->bindParam(':kembalian', $kembalian);

                if ($stmt->execute()) {
                    header('Location: ../transaksi/transaksi.php');
                    exit;
                } else {
                    echo "Error: " . $stmt->errorInfo()[2];
                }
            } else {
                echo "Produk atau karyawan tidak ditemukan.";
            }
        }
    }
}

if (!function_exists('updateTransaksi')) {
    function updateTransaksi($conn, $data_transaksi) {
        $id_transaksi = isset($_GET['id_transaksi']) ? $_GET['id_transaksi'] : '';

        // Ambil data transaksi yang ada berdasarkan ID
        $query = "SELECT * FROM transaksi WHERE id_transaksi = :id_transaksi";
        $statement = $conn->prepare($query);
        $statement->bindParam(':id_transaksi', $id_transaksi);
        $statement->execute();
        $data = $statement->fetch(PDO::FETCH_ASSOC);

        // Periksa apakah form telah disubmit
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tanggal = isset($_POST['tanggal']) ? $_POST['tanggal'] : '';
            $id_karyawan = isset($_POST['id_karyawan']) ? $_POST['id_karyawan'] : '';
            $id_pelanggan = isset($_POST['id_pelanggan']) ? $_POST['id_pelanggan'] : '';
            $id_produk = isset($_POST['id_produk']) ? $_POST['id_produk'] : '';
            $qty = isset($_POST['qty']) ? $_POST['qty'] : '';
            $bayar = isset($_POST['bayar']) ? $_POST['bayar'] : '';

            $nama_produk = '';
            $harga_produk = 0;
            foreach ($data_transaksi as $produk) {
                if ($produk['id'] == $id_produk) {
                    $nama_produk = $produk['name'];
                    $harga_produk = $produk['selling_price'];
                    break;
                }
            }

            if ($nama_produk != '') {
                $biaya = $harga_produk * $qty;
                $kembalian = $bayar - $biaya;

                $query_update = "UPDATE transaksi SET tanggal = :tanggal, id_karyawan = :id_karyawan, id_pelanggan = :id_pelanggan, id_produk = :id_produk, qty = :qty, biaya = :biaya, bayar = :bayar, kembalian = :kembalian WHERE id_transaksi = :id_transaksi";
                $statement = $conn->prepare($query_update);
                $statement->bindParam(':tanggal', $tanggal);
                $statement->bindParam(':id_karyawan', $id_karyawan);
                $statement->bindParam(':id_pelanggan', $id_pelanggan);
                $statement->bindParam(':id_produk', $id_produk);
                $statement->bindParam(':qty', $qty);
                $statement->bindParam(':biaya', $biaya);
                $statement->bindParam(':bayar', $bayar);
                $statement->bindParam(':kembalian', $kembalian);
                $statement->bindParam(':id_transaksi', $id_transaksi);
                if ($statement->execute()) {
                    header("Location: ../transaksi/transaksi.php");
                    exit();
                } else {
                    echo "Error: " . $statement->errorInfo()[2];
                }
            } else {
                echo "Produk tidak ditemukan.";
            }
        }
        return $data;
    }
}
?>
