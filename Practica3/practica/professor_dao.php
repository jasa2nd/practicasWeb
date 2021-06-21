<?php
    require 'dbutil.php';
    require 'professor.php';

    /**
     * ProfessorDAO
     * 
     * Implementa las operaciones de altas, bajas, modificaciones y lectura
     * de datos de profesores
     */

    class ProfessorDAO {
        private $pdo;

        public function __construct() {
            $this->pdo = DBUtil::getConnection();
        }

        /**
         * findProfessors
         * 
         * Retorna los datos de todos los profesores
         */
        public function findProfessors() {
            $result = $this->pdo->query("SELECT id, first_name, last_name, city, years_experience, salary FROM professor");
            $professors = [];

            while ($row = $result->fetch()) {
                array_push($professors, new Professor(
                    $row['first_name'],
                    $row['last_name'],
                    $row['city'],
                    $row['years_experience'],
                    $row['salary'],
                    $row['id']
                ));
            }

            return $professors;
        }

        /**
         * findProfessorById
         * Retorna los datos del professor que le corresponden al id especificado
         * 
         * Parámetros:
         * $id: Id del profesores a obtener de la base de datos
         */
        public function findProfessorById($id) {
            $stmt = $this->pdo->prepare("SELECT id, first_name, last_name, city, years_experience, salary FROM professor WHERE id = :id");
            $stmt->execute(['id' => $id]);

            if ($row = $stmt->fetch()) {
                $professor = new Professor(
                    $row['first_name'],
                    $row['last_name'],
                    $row['city'],
                    $row['years_experience'],
                    $row['salary'],
                    $row['id']
                );

                return $professor;
            }

            return null;
        }

        /**
         * save
         * Registra los datos de un nuevo profesor.
         * 
         * Parámetros:
         * $professor: Instancia de Professor que contiene los datos a registrar
         */
        public function save($professor) {
            try {
                $sql = "INSERT INTO professor(first_name, last_name, city, years_experience, salary) " .
                       "VALUES (:firstName, :lastName, :city, :years_experience, :salary)";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute([
                    'firstName' => $professor->getFirstName(),
                    'lastName' => $professor->getLastName(),
                    'city' => $professor->getCity(),
                    'years_experience' => $professor->getYearsExperience(),
                    'salary' => $professor->getSalary()
                ]);

                return 1;
            } catch (Exception $e) {
                echo 'Error: ' . $e->getMessage();
            }

            return 0;
        }

        /**
         * update
         * Actualiza los datos de un profesor ya registrado.
         * 
         * Parámetros:
         * $profesor: Instancia de Profesor que contiene los datos a actualizar
         */
        public function update($professor) {
            try {
                $sql = "UPDATE professor SET first_name=:firstName, last_name=:lastName, city=:city, years_experience=:years_experience, salary=:salary " .
                       "WHERE id = :id";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute([
                    'firstName' => $professor->getFirstName(),
                    'lastName' => $professor->getLastName(),
                    'city' => $professor->getCity(),
                    'yearsExperience' => $professor->getYearsExperience(),
                    'salary' => $professor->getSalary(),
                    'id' => $professor->getId()
                ]);

                return 1;
            } catch (Exception $e) {
                echo 'Error: ' . $e->getMessage();
            }

            return 0;
        }

        /**
         * delete
         * Elimina los datos de un profesor ya registrado.
         * 
         * Parámetros:
         * $id: id del profesor que se elimina de la base de datos
         */
        public function delete($id) {
            try {
                $sql = "DELETE FROM professor WHERE id = :id";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute([
                    'id' => $id
                ]);

                return 1;
            } catch (Exception $e) {
                echo 'Error: ' . $e->getMessage();
            }

            return 0;
        }
    }