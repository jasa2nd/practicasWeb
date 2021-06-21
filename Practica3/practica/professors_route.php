<?php
    header("Content-Type: application/json");
    require 'professors_controller_class.php';

    $professorsController = new ProfessorsController();

    switch ($requestMethod) {
        case 'GET':
            if (empty($_GET['id'])) {
                echo json_encode($professorsController->getProfessors());
            } else {
                echo json_encode($professorsController->getProfessorById($_GET['id']));
            }
            break;
        case 'POST':
            $jsonProfessor = json_decode(file_get_contents("php://input"), true);
            echo json_encode(['result' => $professorsController->postProfessor($jsonProfessor)]);
            break;
        case 'PUT':
            $jsonProfessor = json_decode(file_get_contents("php://input"), true);
            echo json_encode(['result' => $professorsController->putProfessor($jsonProfessor)]);
            break;
        case 'DELETE':
            $query = $_SERVER['QUERY_STRING'];
            list($key, $value) = explode('=', $query);
            echo json_encode(['result' => $professorsController->deleteProfessor($value)]);
            break;
    }