<?php
require '../database/dbconfig.php';
$db = new DatabaseConnection();

$data = json_decode(file_get_contents("php://input"), true);

$action = isset($_GET['action']) ? $_GET['action'] : '';

switch ($action) {
    case 'add':
        $title = $data['title'];
        $genre = $data['genre'];
        $price = $data['price'];
        $rating = $data['rating'];
        $publisher = $data['publisher'];

        $query = "INSERT INTO Game (Title, Genre, Price, AgeRating, PublisherID) VALUES (:title, :genre, :price, :rating, :publisher)";
        $stmt = $db->getConn()->prepare($query);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam('genre', $genre);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':rating', $rating);
        $stmt->bindParam(':publisher', $publisher);

        if ($stmt->execute()) {
            echo json_encode(['message' => 'Game added successfully']);
        } else {
            echo json_encode(['message' => 'Failed to add game']);
        }
        break;

    case 'update':
        $gameId = $data['gameId'];
        $title = $data['title'];
        $genre = $data['genre'];
        $price = $data['price'];
        $rating = $data['rating'];
        $publisher = $data['publisher'];

        $query = "UPDATE Game SET Title = :title, Genre = :genre, Price = :price, AgeRating = :rating, PublisherID = :publisher WHERE GameID = :gameId";
        $stmt = $db->getConn()->prepare($query);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam('genre', $genre);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':rating', $rating);
        $stmt->bindParam(':publisher', $publisher);
        $stmt->bindParam(':gameId', $gameId);

        if ($stmt->execute()) {
            echo json_encode(['message' => 'Game updated successfully']);
        } else {
            echo json_encode(['message' => 'Failed to update game']);
        }
        break;

    case 'delete':
        $gameId = $data['gameId'];

        $query = "DELETE FROM Game WHERE GameID = :gameId";
        $stmt = $db->getConn()->prepare($query);
        $stmt->bindParam(':gameId', $gameId);

        if ($stmt->execute()) {
            echo json_encode(['message' => 'Game deleted successfully']);
        } else {
            echo json_encode(['message' => 'Failed to delete game']);
        }
        break;

    case 'get':
        $gameId = $_GET['gameId'];
        $query = "SELECT Game.*,Company.CompanyID FROM Game join Company on Game.PublisherID = Company.CompanyID WHERE GameID = :gameId";
        $stmt = $db->getConn()->prepare($query);
        $stmt->bindParam(':gameId', $gameId);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            echo json_encode($result);
        } else {
            echo json_encode(['message' => 'No game found']);
        }
        break;

    case 'companies':
        $query = "SELECT CompanyID, Name FROM Company";
        $stmt = $db->getConn()->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($result) {
            echo json_encode($result);
        } else {
            echo json_encode(['message' => 'No companies found']);
        }
        break;

    default:
        echo json_encode(['message' => 'Invalid action']);
}

