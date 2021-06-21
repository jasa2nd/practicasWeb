<?php
    
    /**
     * professors_controller.php
     * Implementa los servicios para realizar altas, bajas, modificaciones y lectura
     * de datos de profesoresS
     */

    require 'professor_dao.php';
    $requestMethod = $_SERVER['REQUEST_METHOD'];

    class ProfessorsController {
        private $professorDAO;

        public function __construct() {
            $this->professorDAO = new ProfessorDAO();
        }

        public function getProfessors() {
            return $this->professorDAO->findProfessors();
        }

        public function getProfessorById($id) {
            return $this->professorDAO->findProfessorById($id);
        }

        public function postProfessor($jsonProfessor) {
            $professorArray = json_decode($jsonProfessor, true);
            $professor = new Professor(
                $professorArray['firstName'],
                $professorArray['lastName'],
                $professorArray['city'],
                $professorArray['yearsExperience'],
                $professorArray['salary']
            );
            return $this->professorDAO->save($professor);
        }

        public function putProfessor($jsonProfessor) {
            $professorArray = json_decode($jsonProfessor, true);
            $professor = new Professor(
                $professorArray['firstName'],
                $professorArray['lastName'],
                $professorArray['city'],
                $professorArray['yearsExperience'],
                $professorArray['salary'],
                $professorArray['id']
            );
            return $this->professorDAO->update($professor);
        }

        public function deleteProfessor($id) {
            return $this->professorDAO->delete($id);
        }
    }