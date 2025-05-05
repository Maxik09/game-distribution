<?php
require '../database/dbconfig.php';
$db = new DatabaseConnection();

$data = json_decode(file_get_contents("php://input"), true);

$action = isset($_GET['action']) ? $_GET['action'] : '';

switch ($action) {
    case 'add':
        $name = $data['name'];
        $manufacturer = $data['manufacturer'];
        $type = $data['type'];

        $query = "INSERT INTO Platform (Name, Manufacturer, Type) VALUES (:name, :manufacturer, :type)";
        $stmt = $db->getConn()->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':manufacturer', $manufacturer);
        $stmt->bindParam(':type', $type);

        if ($stmt->execute()) {
            echo json_encode(['message' => 'Platform added successfully']);
        } else {
            echo json_encode(['message' => 'Failed to add platform']);
        }
        break;

    case 'update':
        $platformId = $data['platformId'];
        $name = $data['name'];
        $manufacturer = $data['manufacturer'];
        $type = $data['type'];

        $query = "UPDATE Platform SET Name = :name, Type = :type, Manufacturer = :manufacturer WHERE PlatformID = :platformId";
        $stmt = $db->getConn()->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':manufacturer', $manufacturer);
        $stmt->bindParam(':platformId', $platformId);

        if ($stmt->execute()) {
            echo json_encode(['message' => 'Platform updated successfully']);
        } else {
            echo json_encode(['message' => 'Failed to update platform']);
        }
        break;

    case 'delete':
        $platformId = $data['platformId'];

        $query = "DELETE FROM Platform WHERE PlatformID = :platformId";
        $stmt = $db->getConn()->prepare($query);
        $stmt->bindParam(':platformId', $platformId);

        if ($stmt->execute()) {
            echo json_encode(['message' => 'Platform deleted successfully']);
        } else {
            echo json_encode(['message' => 'Failed to delete platform']);
        }
        break;

    case 'get':
        $platformId = $_GET['platformId'];
        $query = "SELECT * FROM Platform WHERE PlatformID = :platformId";
        $stmt = $db->getConn()->prepare($query);
        $stmt->bindParam(':platformId', $platformId);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            echo json_encode($result);
        } else {
            echo json_encode(['message' => 'No platform found']);
        }
        break;

    default:
        echo json_encode(['message' => 'Invalid action']);
}

