<?php
require '../database/dbconfig.php';
$db = new DatabaseConnection();

$data = json_decode(file_get_contents("php://input"), true);

$action = isset($_GET['action']) ? $_GET['action'] : '';

switch ($action) {
    case 'add':
        $description = $data['description'];
        $date = $data['date'];
        $status = $data['status'];
        $reporter = $data['reporter'];

        $query = "INSERT INTO Support (IssueDescription, DateReported, ResolutionStatus, GamerID) VALUES (:description, :date, :status, :reporter)";
        $stmt = $db->getConn()->prepare($query);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam('date', $date);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':reporter', $reporter);

        if ($stmt->execute()) {
            echo json_encode(['message' => 'Support added successfully']);
        } else {
            echo json_encode(['message' => 'Failed to add support']);
        }
        break;

    case 'update':
        $supportId = $data['supportId'];
        $description = $data['description'];
        $date = $data['date'];
        $status = $data['status'];
        $reporter = $data['reporter'];

        $query = "UPDATE Support SET IssueDescription = :description, DateReported = :date, ResolutionStatus = :status, GamerID = :reporter WHERE SupportID = :supportId";
        $stmt = $db->getConn()->prepare($query);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam('date', $date);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':reporter', $reporter);
        $stmt->bindParam(':supportId', $supportId);

        if ($stmt->execute()) {
            echo json_encode(['message' => 'Support updated successfully']);
        } else {
            echo json_encode(['message' => 'Failed to update support']);
        }
        break;

    case 'delete':
        $supportId = $data['supportId'];

        $query = "DELETE FROM Support WHERE SupportID = :supportId";
        $stmt = $db->getConn()->prepare($query);
        $stmt->bindParam(':supportId', $supportId);

        if ($stmt->execute()) {
            echo json_encode(['message' => 'Support ticket deleted successfully']);
        } else {
            echo json_encode(['message' => 'Failed to delete support']);
        }
        break;

    case 'resolve':
        $supportId = $data['supportId'];
        $status = 'Resolved';

        $query = "UPDATE Support SET ResolutionStatus = :status WHERE SupportID = :supportId";
        $stmt = $db->getConn()->prepare($query);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':supportId', $supportId);

        if ($stmt->execute()) {
            echo json_encode(['message' => 'Support ticket resolved successfully']);
        } else {
            echo json_encode(['message' => 'Failed to resolve support ticket']);
        }
        break;

    case 'get':
        $supportId = $_GET['supportId'];
        $query = "SELECT Support.*,Gamer.GamerID FROM Support join Gamer on Support.GamerID = Gamer.GamerID WHERE SupportID = :supportId";
        $stmt = $db->getConn()->prepare($query);
        $stmt->bindParam(':supportId', $supportId);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            echo json_encode($result);
        } else {
            echo json_encode(['message' => 'No support ticket found']);
        }
        break;

    case 'reporters':
        $query = "SELECT GamerID, Username FROM Gamer";
        $stmt = $db->getConn()->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($result) {
            echo json_encode($result);
        } else {
            echo json_encode(['message' => 'No gamers found']);
        }
        break;

    default:
        echo json_encode(['message' => 'Invalid action']);
}

