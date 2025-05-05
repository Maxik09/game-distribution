<?php
require '../database/dbconfig.php';
$db = new DatabaseConnection();

$data = json_decode(file_get_contents("php://input"), true);

$action = isset($_GET['action']) ? $_GET['action'] : '';

switch ($action) {
    case 'add':
        $name = $data['name'];
        $location = $data['location'];
        $type = $data['type'];

        $query = "INSERT INTO Store (Name, Location, Type) VALUES (:name, :location, :type)";
        $stmt = $db->getConn()->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':location', $location);
        $stmt->bindParam(':type', $type);

        if ($stmt->execute()) {
            echo json_encode(['message' => 'Store added successfully']);
        } else {
            echo json_encode(['message' => 'Failed to add store']);
        }
        break;

    case 'update':
        $storeId = $data['storeId'];
        $name = $data['name'];
        $location = $data['location'];
        $type = $data['type'];

        $query = "UPDATE Store SET Name = :name, Type = :type, Location = :location WHERE StoreID = :storeId";
        $stmt = $db->getConn()->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':location', $location);
        $stmt->bindParam(':storeId', $storeId);

        if ($stmt->execute()) {
            echo json_encode(['message' => 'Store updated successfully']);
        } else {
            echo json_encode(['message' => 'Failed to update store']);
        }
        break;

    case 'delete':
        $storeId = $data['storeId'];

        $query = "DELETE FROM Store WHERE StoreID = :storeId";
        $stmt = $db->getConn()->prepare($query);
        $stmt->bindParam(':storeId', $storeId);

        if ($stmt->execute()) {
            echo json_encode(['message' => 'Store deleted successfully']);
        } else {
            echo json_encode(['message' => 'Failed to delete store']);
        }
        break;

    case 'get':
        $storeId = $_GET['storeId'];
        $query = "SELECT * FROM Store WHERE StoreID = :storeId";
        $stmt = $db->getConn()->prepare($query);
        $stmt->bindParam(':storeId', $storeId);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            echo json_encode($result);
        } else {
            echo json_encode(['message' => 'No store found']);
        }
        break;

    default:
        echo json_encode(['message' => 'Invalid action']);
}

