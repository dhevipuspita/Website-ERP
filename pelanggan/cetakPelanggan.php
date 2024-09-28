<?php
include('../conn.php');
include('../function.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" href="../Pemasaran.ico" type="image/x-icon">
    <link rel="stylesheet" href="../style_cetak.css">
    <title>Cetak Data Pelanggan</title>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>ID Pelanggan</th>
                <th>Nama Pelanggan</th>
                <th>Username</th>
                <th>Password</th>
                <th>Alamat Pelanggan</th>
                <th>No. HP Pelanggan</th>            
            </tr>
        </thead>
        <tbody>
            <?php
            //siapkan query SQL
            $query = "SELECT * FROM pelanggan";

            //eksekusi query
            $result = $conn->query($query);
            $no = 1;
            while ($data = $result->fetch(PDO::FETCH_ASSOC)) :
            ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $data['id_pelanggan']; ?></td>
                    <td><?php echo $data['nama_pelanggan']; ?></td>
                    <td><?php echo $data['username']; ?></td>
                    <td><?php echo $data['password']; ?></td>
                    <td><?php echo $data['alamat_pelanggan']; ?></td>
                    <td><?php echo $data['no_hp_pelanggan']; ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    </section>

    <script>
        window.print();
    </script>
</body>

</html>
