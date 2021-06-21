<?php
    header("Content-Type: application/json");

    /**
     * professors_controller.php
     * Implementa los servicios para realizar altas, bajas, modificaciones y lectura
     * de datos de professors
     */

    require 'professor_dao.php';
    $requestMethod = $_SERVER['REQUEST_METHOD'];
    $professorDAO = new ProfessorDAO();

    switch ($requestMethod) {
        case 'GET':
            if (empty($_GET['id'])) {
                echo json_encode($professorDAO->findProfessors());
            } else {
                echo json_encode($professorDAO->findProfessorById($_GET['id']));
            }
            break;
        case 'POST':
            $jsonProfessor = json_decode(file_get_contents("php://input"), true);
            $professor = new Professor(
                $jsonProfessor['firstName'],
                $jsonProfessor['lastName'],
                $jsonProfessor['city'],
                $jsonProfessor['yearsExperience'],
                $jsonProfessor['salary']
            );
            echo json_encode(['result' => $professorDAO->save($professor)]);
            break;
        case 'PUT':
            $jsonProfessor = json_decode(file_get_contents("php://input"), true);
            $professor = new Professor(
                $jsonProfessor['firstName'],
                $jsonProfessor['lastName'],
                $jsonProfessor['city'],
                $jsonProfessor['yearsExperience'],
                $jsonProfessor['salary'],
                $jsonProfessor['id']
            );
            echo json_encode(['result' => $professorDAO->update($professor)]);
            break;
        case 'DELETE':
            $query = $_SERVER['QUERY_STRING'];
            list($key, $value) = explode('=', $query);
            echo json_encode(['result' => $professorDAO->delete($value)]);
            break;
}