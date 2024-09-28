<?php
    include("../conn.php");
    include('function.php');

    $data_transaksi = getDataTransaksi();
    $data = updateTransaksi($conn, $data_transaksi);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-a1H+hRVW/n4h4/d73yQyRRgkFgn3jBku3a2lRlZImFHAj6rM2RUv8D6vymMBLtXPHfXE02hOlhRq/hE49lMDwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="../style_update.css">
    <link rel="icon" href="../Pemasaran.ico" type="image/x-icon">
    <title>Update Transaksi</title>
</head><?php
include("../conn.php");
include('function.php');

$data_transaksi = getDataTransaksi();
$data = updateTransaksi($conn, $data_transaksi);
$id_transaksi = isset($_GET['id_transaksi']) ? $_GET['id_transaksi'] : '';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-a1H+hRVW/n4h4/d73yQyRRgkFgn3jBku3a2lRlZImFHAj6rM2RUv8D6vymMBLtXPHfXE02hOlhRq/hE49lMDwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="../style_update.css">
    <link rel="icon" href="../Pemasaran.ico" type="image/x-icon">
    <title>Update Transaksi</title>
</head>

<body>
    <div class="container">
        <div class="form-container">
            <h2 class="form-title">Update Data Transaksi</h2>
            <form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id_transaksi=' . $id_transaksi; ?>">
                <div>
                    <label for="id_transaksi">ID Transaksi</label>
                    <input type="text" name="id_transaksi" id="id_transaksi" style="background-color: #ccc" value="<?= $data['id_transaksi'] ?? ''; ?>" required readonly>
                </div>
                <div>
                    <label for="id_pelanggan">Nama Pelanggan</label>
                    <select name="id_pelanggan" required autofocus>
                        <?php
                        $pelanggan = "SELECT id_pelanggan, nama_pelanggan FROM pelanggan";
                        $result_pelanggan = $conn->query($pelanggan);
                        while ($row = $result_pelanggan->fetch(PDO::FETCH_ASSOC)) {
                            $selected = ($row['id_pelanggan'] == $data['id_pelanggan']) ? 'selected' : '';
                            echo "<option value='{$row['id_pelanggan']}' {$selected}>{$row['nama_pelanggan']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="id_produk">Nama Barang</label>
                    <select name="id_produk" required autofocus>
                        <?php
                        foreach ($data_transaksi as $produk) {
                            $selected = ($produk['id'] == $data['id_produk']) ? 'selected' : '';
                            echo "<option value='{$produk['id']}' data-harga='{$produk['selling_price']}' {$selected}>{$produk['name']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="tanggal">Tanggal</label>
                    <input type="date" name="tanggal" id="tanggal" value="<?= $data['tanggal']; ?>" required>
                </div>
                <div>
                    <label for="qty">Quantity</label>
                    <input type="number" name="qty" id="qty" value="<?= $data['qty']; ?>" required oninput="updateTotalHarga()">
                </div>
                <div>
                    <label for="biaya">Total Harga</label>
                    <input type="number" name="biaya" id="biaya" value="<?= $data['biaya']; ?>" readonly required>
                </div>
                <div>
                    <label for="bayar">Bayar</label>
                    <input type="number" name="bayar" id="bayar" value="<?= $data['bayar']; ?>" required oninput="hitungKembalian()">
                </div>
                <!-- <div>
                    <label for="kembalian">Kembalian</label>
                    <input type="number" name="kembalian" id="kembalian" value="<?= $data['kembalian']; ?>" readonly>
                </div> -->
                <div class="center-button">
                    <button type="reset" class="reset"><i class="fas fa-undo"></i> Reset</button>
                    <button type="submit" name="submit" class="save"><i class="fas fa-save"></i> Save</button>
                </div>
                <div class="center-button">
                    <button class="back"><i class="fas fa-home"></i><a href="../transaksi/transaksi.php"> Kembali</a></button>
                </div>
            </form>
        </div>
    </div>
    
    <script>
        function updateTotalHarga() {
            var qty = parseFloat(document.getElementById('qty').value);
            var produkSelect = document.querySelector('select[name="id_produk"]');
            var harga = parseFloat(produkSelect.options[produkSelect.selectedIndex].getAttribute('data-harga'));

            var totalHarga = qty * harga;
            document.getElementById('biaya').value = totalHarga;
        }

        function hitungKembalian() {
            var totalHarga = parseFloat(document.getElementById('biaya').value);
            var pembayaran = parseFloat(document.getElementById('bayar').value);
            var kembalian = pembayaran - totalHarga;
            document.getElementById('kembalian').value = kembalian;
        }

        document.getElementById('qty').addEventListener('input', updateTotalHarga);
        document.querySelector('select[name="id_produk"]').addEventListener('change', updateTotalHarga);

        // Inisialisasi nilai biaya saat halaman dimuat
        updateTotalHarga();

        // Fungsi untuk menampilkan alert
        function showSuccessAlert() {
            alert("Data berhasil ditambahkan!");
        }
    </script>
</body>

</html>


<body>
    <div class="container">
        <div class="form-container">
            <h2 class="form-title">Update Data Transaksi</h2>
            <form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id_transaksi=' . $id_transaksi; ?>">
                <div>
                    <label for="id_transaksi">ID Transaksi</label>
                    <input type="text" name="id_transaksi" id="id_transaksi" style="background-color: #ccc" value="<?= $data['id_transaksi'] ?? ''; ?>" required readonly>
                </div>
                <div>
                    <label for="id_pelanggan">Nama Pelanggan</label>
                    <select name="id_pelanggan" required autofocus>
                        <?php
                        $pelanggan = "SELECT id_pelanggan, nama_pelanggan FROM pelanggan";
                        $result_pelanggan = $conn->query($pelanggan);
                        while ($row = $result_pelanggan->fetch(PDO::FETCH_ASSOC)) {
                            $selected = ($row['id_pelanggan'] == $data['id_pelanggan']) ? 'selected' : '';
                            echo "<option value='{$row['id_pelanggan']}' {$selected}>{$row['nama_pelanggan']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="id_produk">Nama Barang</label>
                    <select name="id_produk" required autofocus>
                        <?php
                        foreach ($data_transaksi as $produk) {
                            $selected = ($produk['id'] == $data['id_produk']) ? 'selected' : '';
                            echo "<option value='{$produk['id']}' data-harga='{$produk['selling_price']}' {$selected}>{$produk['name']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="tanggal">Tanggal</label>
                    <input type="date" name="tanggal" id="tanggal" value="<?= $data['tanggal']; ?>" required>
                </div>
                <div>
                    <label for="qty">Quantity</label>
                    <input type="number" name="qty" id="qty" value="<?= $data['qty']; ?>" required oninput="updateTotalHarga()">
                </div>
                <div>
                    <label for="biaya">Total Harga</label>
                    <input type="number" name="biaya" id="biaya" value="<?= $data['biaya']; ?>" readonly required>
                </div>
                <div>
                    <label for="bayar">Bayar</label>
                    <input type="number" name="bayar" id="bayar" value="<?= $data['bayar']; ?>" required oninput="hitungKembalian()">
                </div>
                <!-- <div>
                    <label for="kembalian">Kembalian</label>
                    <input type="number" name="kembalian" id="kembalian" value="<?= $data['kembalian']; ?>" readonly>
                </div> -->
                <div class="center-button">
                    <button type="reset" class="reset"><i class="fas fa-undo"></i> Reset</button>
                    <button type="submit" name="submit" class="save"><i class="fas fa-save"></i> Save</button>
                </div>
                <div class="center-button">
                    <button class="back"><i class="fas fa-home"></i><a href="../transaksi/transaksi.php"> Kembali</a></button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function updateTotalHarga() {
            var qty = parseFloat(document.getElementById('qty').value);
            var produkSelect = document.querySelector('select[name="id_produk"]');
            var harga = parseFloat(produkSelect.options[produkSelect.selectedIndex].getAttribute('data-harga'));

            var totalHarga = qty * harga;
            document.getElementById('biaya').value = totalHarga;
        }

        function hitungKembalian() {
            var totalHarga = parseFloat(document.getElementById('biaya').value);
            var pembayaran = parseFloat(document.getElementById('bayar').value);
            var kembalian = pembayaran - totalHarga;
            document.getElementById('kembalian').value = kembalian;
        }

        document.getElementById('qty').addEventListener('input', updateTotalHarga);
        document.querySelector('select[name="id_produk"]').addEventListener('change', updateTotalHarga);

        // Inisialisasi nilai biaya saat halaman dimuat
        updateTotalHarga();

        // Fungsi untuk menampilkan alert
        function showSuccessAlert() {
            alert("Data berhasil ditambahkan!");
        }
    </script>
</body>

</html>
