<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Pemasaran</title>
</head>
<body>
    <h2>Tambah Data Pemasaran</h2>
    <form action="http://127.0.0.1:5000/api/pemasaran" method="post">
        <label for="tanggal_pemasaran">Tanggal Pemasaran:</label>
        <input type="date" id="tanggal_pemasaran" name="tanggal_pemasaran" required><br><br>
        <label for="jenis_pemasaran">Jenis Pemasaran:</label>
        <input type="text" id="jenis_pemasaran" name="jenis_pemasaran" required><br><br>
        <label for="target_pemasaran">Target Pemasaran:</label>
        <input type="text" id="target_pemasaran" name="target_pemasaran" required><br><br>
        <label for="hasil_pemasaran">Hasil Pemasaran:</label>
        <input type="text" id="hasil_pemasaran" name="hasil_pemasaran" required><br><br>
        <label for="durasi_pemasaran">Durasi Pemasaran:</label>
        <input type="text" id="durasi_pemasaran" name="durasi_pemasaran" required><br><br>
        <button type="submit">Tambah Data</button>
    </form>

    <h2>Update Data Pemasaran</h2>
    <form action="http://127.0.0.1:5000/api/pemasaran/{id_pemasaran}" method="post">
        <input type="hidden" id="id_pemasaran" name="id_pemasaran" value="1">
        <label for="tanggal_pemasaran">Tanggal Pemasaran:</label>
        <input type="date" id="tanggal_pemasaran" name="tanggal_pemasaran" required><br><br>
        <label for="jenis_pemasaran">Jenis Pemasaran:</label>
        <input type="text" id="jenis_pemasaran" name="jenis_pemasaran" required><br><br>
        <label for="target_pemasaran">Target Pemasaran:</label>
        <input type="text" id="target_pemasaran" name="target_pemasaran" required><br><br>
        <label for="hasil_pemasaran">Hasil Pemasaran:</label>
        <input type="text" id="hasil_pemasaran" name="hasil_pemasaran" required><br><br>
        <label for="durasi_pemasaran">Durasi Pemasaran:</label>
        <input type="text" id="durasi_pemasaran" name="durasi_pemasaran" required><br><br>
        <button type="submit">Update Data</button>
    </form>

    <h2>Hapus Data Pemasaran</h2>
    <form action="http://127.0.0.1:5000/api/pemasaran/{id_pemasaran}" method="post">
        <input type="hidden" id="id_pemasaran" name="id_pemasaran" value="1">
        <button type="submit">Hapus Data</button>
    </form>
</body>
</html>
