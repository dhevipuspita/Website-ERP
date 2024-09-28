<?php
header("Content-Type: application/json");
include 'conn.php';

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        getPemasaran($conn);
        break;
    case 'POST':
        addPemasaran($conn);
        break;
    case 'PUT':
        updatePemasaran($conn);
        break;
    case 'DELETE':
        deletePemasaran($conn);
        break;
    default:
        echo json_encode(["message" => "Method not supported"]);
        break;
}

function getPemasaran($conn) {
    $sql = "SELECT * FROM pemasaran";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($result);
}

function addPemasaran($conn) {
    $data = json_decode(file_get_contents("php://input"), true);
    
    $tanggal = $data['tanggal'];
    $jenis_pemasaran = $data['jenis_pemasaran'];
    $target_pemasaran = $data['target_pemasaran'];
    $hasil_pemasaran = $data['hasil_pemasaran'];
    $durasi_pemasaran = $data['durasi_pemasaran'];
    
    $sql = "INSERT INTO pemasaran (tanggal, jenis, target_pemasaran, hasil_pemasaran, durasi_pemasaran) VALUES (:tanggal, :jenis_pemasaran, :target_pemasaran, :hasil_pemasaran, :durasi_pemasaran)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':tanggal', $tanggal);
    $stmt->bindParam(':jenis_pemasaran', $jenis_pemasaran);
    $stmt->bindParam(':target_pemasaran', $target_pemasaran);
    $stmt->bindParam(':hasil_pemasaran', $hasil_pemasaran);
    $stmt->bindParam(':durasi_pemasaran', $durasi_pemasaran);
    
    if ($stmt->execute()) {
        echo json_encode(["message" => "New pemasaran entry created successfully"]);
    } else {
        echo json_encode(["message" => "Error creating pemasaran entry"]);
    }
}

function updatePemasaran($conn) {
    $data = json_decode(file_get_contents("php://input"), true);
    
    $id_pemasaran = $data['id_pemasaran'];
    $tanggal = $data['tanggal'];
    $jenis_pemasaran = $data['jenis_pemasaran'];
    $target_pemasaran = $data['target_pemasaran'];
    $hasil_pemasaran = $data['hasil_pemasaran'];
    $durasi_pemasaran = $data['durasi_pemasaran'];
    
    $sql = "UPDATE pemasaran SET tanggal = :tanggal, jenis = :jenis_pemasaran, target_pemasaran = :target_pemasaran, hasil_pemasaran = :hasil_pemasaran, durasi_pemasaran = :durasi_pemasaran WHERE id_pemasaran = :id_pemasaran";
    
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':tanggal', $tanggal);
    $stmt->bindParam(':jenis_pemasaran', $jenis_pemasaran);
    $stmt->bindParam(':target_pemasaran', $target_pemasaran);
    $stmt->bindParam(':hasil_pemasaran', $hasil_pemasaran);
    $stmt->bindParam(':durasi_pemasaran', $durasi_pemasaran);
    $stmt->bindParam(':id_pemasaran', $id_pemasaran);
    
    if ($stmt->execute()) {
        echo json_encode(["message" => "Pemasaran entry updated successfully"]);
    } else {
        echo json_encode(["message" => "Error updating pemasaran entry"]);
    }
}

function deletePemasaran($conn) {
    $data = json_decode(file_get_contents("php://input"), true);
    
    $id_pemasaran = $data['id_pemasaran'];
    
    $sql = "DELETE FROM pemasaran WHERE id_pemasaran = :id_pemasaran";
    
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id_pemasaran', $id_pemasaran);
    
    if ($stmt->execute()) {
        echo json_encode(["message" => "Pemasaran entry deleted successfully"]);
    } else {
        echo json_encode(["message" => "Error deleting pemasaran entry"]);
    }
}
