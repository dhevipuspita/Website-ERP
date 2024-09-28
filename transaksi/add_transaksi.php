<?php
    include('../conn.php');
    include('function.php');

    $data_transaksi = getDataTransaksi();
    $data_karyawan = getDataKaryawan();
    addTransaksi($conn, $data_transaksi);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-a1H+hRVW/n4h4/d73yQyRRgkFgn3jBku3a2lRlZImFHAj6rM2RUv8D6vymMBLtXPHfXE02hOlhRq/hE49lMDwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="formtransaksi.css">
    <link rel="icon" href="../Pemasaran.ico" type="image/x-icon">
    <link rel="stylesheet" href="../style_form.css">
    <title>Tambah Transaksi</title>
</head>

<body>
    <div class="container">
        <div class="form-container">
            <h1>Tambah Data Transaksi Baru</h1>
            <form method="post" enctype="multipart/form-data" onsubmit="showSuccessAlert()">
                <!-- Form -->
                <div>
                <label for="nama_karyawan">Nama Karyawan</label>
                <select id="nama_karyawan" name="nama_karyawan" class="form-control" required>
                    <?php
                    foreach ($data_karyawan as $karyawan) {
                        echo "<option value='{$karyawan['name']}'>{$karyawan['name']}</option>";
                    }
                    ?>
                </select>
                </div>
                <div>
                    <label for="id_pelanggan">Nama Pelanggan</label>
                    <select name="id_pelanggan" maxlength="50" class="form-control" placeholder="Pilih Nama Pelanggan" required autofocus>
                        <?php
                        $pelanggan = "SELECT id_pelanggan, nama_pelanggan FROM pelanggan";
                        $result_pelanggan = $conn->query($pelanggan);
                        while ($row = $result_pelanggan->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option value='{$row['id_pelanggan']}'>{$row['nama_pelanggan']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="id">Nama Barang</label>
                    <select id="id" name="id" maxlength="50" class="form-control" placeholder="Pilih Jenis Barang" required autofocus onchange="updateTotalHarga()">
                        <?php
                        foreach ($data_transaksi as $produk) {
                            echo "<option value='{$produk['id']}' data-harga='{$produk['selling_price']}'>{$produk['name']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="tanggal">Tanggal</label>
                    <input type="date" maxlength="50" class="form-control" name="tanggal" id="tanggal" placeholder="Masukkan tanggal transaksi" required>
                </div>
                <div>
                    <label for="qty">Quantity</label>
                    <input type="text" maxlength="50" class="form-control" name="qty" id="qty" placeholder="Masukkan jumlah barang" required oninput="updateTotalHarga()">
                </div>
                <div>
                    <label for="biaya">Total Harga</label>
                    <input type="text" maxlength="50" class="form-control" name="biaya" id="biaya" readonly required>
                </div>
                <div>
                    <label for="bayar">Bayar</label>
                    <input type="text" maxlength="50" class="form-control" name="bayar" id="bayar" placeholder="Masukkan total biaya yang dibayarkan" required oninput="hitungKembalian()">
                </div>
                <div class="center-button">
                    <button type="reset" class="btn btn-reset"><i class="fas fa-undo"></i> Hapus</button>
                    <button type="submit" name="submit" class="btn btn-save"><i class="fas fa-save"></i> Simpan</button>
                </div>
                <div class="center-button">
                    <a href="../transaksi/transaksi.php" class="btn btn-back"> <i class="fas fa-home"></i> Kembali</a>
                </div>
            </form>
        </div>
    </div>
    <script>
        function hitungKembalian() {
            var totalHarga = parseFloat(document.getElementById('biaya').value);
            var pembayaran = parseFloat(document.getElementById('bayar').value);
            var kembalian = pembayaran - totalHarga;
            document.getElementById('kembalian').value = kembalian;
        }

        function updateTotalHarga() {
            var qty = parseFloat(document.getElementById('qty').value);
            var produkSelect = document.getElementById('id');
            var harga = parseFloat(produkSelect.options[produkSelect.selectedIndex].getAttribute('data-harga'));

            var totalHarga = qty * harga;
            document.getElementById('biaya').value = totalHarga;
        }

        // Fungsi untuk menampilkan alert
        function showSuccessAlert() {
            alert("Data berhasil ditambahkan!");
        }
    </script>
</body>

</html>
