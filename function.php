<?php

//Koneksi Ke Database
require '../conn.php';

//PAKET LAUNDRY
function addpaket($data)
{
    global $conn;
    $paket =  htmlspecialchars($data["paket"]);
    $harga_kilo =  htmlspecialchars($data["harga_kilo"]);
    $deskripsi =  htmlspecialchars($data["deskripsi"]);

    // Mendapatkan ID terakhir yang disisipkan
    $lastIdQuery = "SELECT MAX(SUBSTRING(id_paket, 4)) AS max_id FROM paket_cuci";
    $stmt = $conn->prepare($lastIdQuery);
    $stmt->execute();
    $lastIdRow = $stmt->fetch(PDO::FETCH_ASSOC);
    $lastId = $lastIdRow['max_id'];
    $newIdNumber = ($lastId !== null) ? intval($lastId) + 1 : 1;

    // Menghasilkan ID baru dengan gabungan karakter dan angka
    $newId = 'PKT' . str_pad($newIdNumber, 3, '0', STR_PAD_LEFT);

    $query = "INSERT INTO  paket_cuci VALUES ('$newId', '$paket', '$harga_kilo', '$deskripsi')";
    $result = $conn->query($query);

    // Mengubah auto increment pada kolom id_pelanggan
    $alterQuery = "ALTER TABLE pelanggan AUTO_INCREMENT = " . ($newIdNumber + 1);
    $conn->query($alterQuery);
    return $result;
}

function updatepaket($data)
{
    global $conn;

    $id_paket = $data["id_paket"];
    $paket = htmlspecialchars($data["paket"]);
    $harga_kilo = htmlspecialchars($data["harga_kilo"]);
    $deskripsi = htmlspecialchars($data["deskripsi"]);

    $query = "UPDATE paket_cuci SET 
                paket = :paket,
                harga_kilo = :harga_kilo,
                deskripsi = :deskripsi
                WHERE id_paket = :id_paket";

    $statement = $conn->prepare($query);
    $statement->bindParam(':paket', $paket);
    $statement->bindParam(':harga_kilo', $harga_kilo);
    $statement->bindParam(':deskripsi', $deskripsi);
    $statement->bindParam(':id_paket', $id_paket);

    $result = $statement->execute();

    return $result;
}

function generateRandomPassword() {
    $length = 10;
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $password = '';

    for ($i = 0; $i < $length; $i++) {
        $index = random_int(0, strlen($characters) - 1);
        $password .= $characters[$index];
    }

    return $password;
}
