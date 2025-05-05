<?php
require '../database/dbconfig.php';
$db = new DatabaseConnection();

$data = json_decode(file_get_contents("php://input"), true);

$action = isset($_GET['action']) ? $_GET['action'] : '';

switch ($action) {
    case 'add':
        $name = $data['name'];
        $type = $data['type'];
        $address = $data['address'];

        $query = "INSERT INTO Company (Name, Type, Address) VALUES (:name, :type, :address)";
        $stmt = $db->getConn()->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':address', $address);

        if ($stmt->execute()) {
            echo json_encode(['message' => 'Company added successfully']);
        } else {
            echo json_encode(['message' => 'Failed to add company']);
        }
        break;

    case 'update':
        $companyId = $data['companyId'];
        $name = $data['name'];
        $type = $data['type'];
        $address = $data['address'];

        $query = "UPDATE Company SET Name = :name, Type = :type, Address = :address WHERE CompanyID = :companyId";
        $stmt = $db->getConn()->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':companyId', $companyId);

        if ($stmt->execute()) {
            echo json_encode(['message' => 'Company updated successfully']);
        } else {
            echo json_encode(['message' => 'Failed to update company']);
        }
        break;

    case 'delete':
        $companyId = $data['companyId'];

        $query = "DELETE FROM Company WHERE CompanyID = :companyId";
        $stmt = $db->getConn()->prepare($query);
        $stmt->bindParam(':companyId', $companyId);

        if ($stmt->execute()) {
            echo json_encode(['message' => 'Company deleted successfully']);
        } else {
            echo json_encode(['message' => 'Failed to delete company']);
        }
        break;

    case 'get':
        $companyId = $_GET['companyId'];
        $query = "SELECT * FROM Company WHERE CompanyID = :companyId";
        $stmt = $db->getConn()->prepare($query);
        $stmt->bindParam(':companyId', $companyId);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            echo json_encode($result);
        } else {
            echo json_encode(['message' => 'No company found']);
        }
        break;

    default:
        echo json_encode(['message' => 'Invalid action']);
}

