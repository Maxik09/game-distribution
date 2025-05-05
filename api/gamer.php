<?php
require '../database/dbconfig.php';
$db = new DatabaseConnection();

$data = json_decode(file_get_contents("php://input"), true);

$action = isset($_GET['action']) ? $_GET['action'] : '';

switch ($action) {
    case 'add':
        $name = $data['name'];
        $age = $data['age'];
        $email = $data['email'];

        $query = "INSERT INTO Gamer (Username, Age, Email) VALUES (:name, :age, :email)";
        $stmt = $db->getConn()->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':age', $age);
        $stmt->bindParam(':email', $email);

        if ($stmt->execute()) {
            echo json_encode(['message' => 'Gamer added successfully']);
        } else {
            echo json_encode(['message' => 'Failed to add gamer']);
        }
        break;

    case 'update':
        $gamerId = $data['gamerId'];
        $name = $data['name'];
        $age = $data['age'];
        $email = $data['email'];

        $query = "UPDATE Gamer SET Username = :name, Age = :age, Email = :email WHERE GamerID = :gamerId";
        $stmt = $db->getConn()->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':age', $age);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':gamerId', $gamerId);

        if ($stmt->execute()) {
            echo json_encode(['message' => 'Gamer updated successfully']);
        } else {
            echo json_encode(['message' => 'Failed to update gamer']);
        }
        break;

    case 'delete':
        $gamerId = $data['gamerId'];

        $query = "DELETE FROM Gamer WHERE GamerID = :gamerId";
        $stmt = $db->getConn()->prepare($query);
        $stmt->bindParam(':gamerId', $gamerId);

        if ($stmt->execute()) {
            echo json_encode(['message' => 'Gamer deleted successfully']);
        } else {
            echo json_encode(['message' => 'Failed to delete gamer']);
        }
        break;

    case 'get':
        $gamerId = $_GET['gamerId'];
        $query = "SELECT * FROM Gamer WHERE GamerID = :gamerId";
        $stmt = $db->getConn()->prepare($query);
        $stmt->bindParam(':gamerId', $gamerId);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            echo json_encode($result);
        } else {
            echo json_encode(['message' => 'No gamer found']);
        }
        break;

    default:
        echo json_encode(['message' => 'Invalid action']);
}

