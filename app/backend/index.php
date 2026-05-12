<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, OPTIONS, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

require 'db.php';

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {

    case 'GET':

        $stmt = $pdo->query("
            SELECT * FROM deliveries
            ORDER BY id DESC
        ");

        echo json_encode(
            $stmt->fetchAll(PDO::FETCH_ASSOC)
        );

        break;

    case 'POST':

        $data = json_decode(
            file_get_contents("php://input"),
            true
        );

        $customer_name = $data['customer_name'];
        $orderID = $data['order_id'];
        $address = $data['address'];

        $stmt = $pdo->prepare("
            INSERT INTO deliveries
            (customer_name, order_id, address, status)
            VALUES (?, ?, ?, ?)
        ");

        $stmt->execute([
            $customer_name,
            $orderID,
            $address,
            'Pendente'
        ]);

        echo json_encode([
            "message" => "Entrega criada"
        ]);

        break;

    case 'PUT':

        parse_str($_SERVER['QUERY_STRING'], $query);

        $id = $query['id'];

        $data = json_decode(
            file_get_contents("php://input"),
            true
        );

        $status = $data['status'];

        $stmt = $pdo->prepare("
            UPDATE deliveries
            SET status = ?
            WHERE id = ?
        ");

        $stmt->execute([$status, $id]);

        echo json_encode([
            "message" => "Status atualizado"
        ]);

        break;

    case 'DELETE':
        parse_str($_SERVER['QUERY_STRING'], $query);

        $id = $query['id'];

        $stmt = $pdo->prepare("
            delete from deliveries
            WHERE id = ?
        ");

        $stmt->execute([$id]);

        echo json_encode([
            "message" => "Entrega Removida"
        ]);

        break;
    default:

        http_response_code(405);

        echo json_encode([
            "message" => "Método não permitido"
        ]);
}
