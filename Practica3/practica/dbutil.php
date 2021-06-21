<?php
    /**
     * DBUtil
     * Contiene métodos utilitarios para acceder a la base de datos
     */
    class DBUtil {
        /**
         * getConnection
         * 
         * Realiza la conexión a la base de datos utilizando la interfaz PDO
         */
        public static function getConnection() {
            $server = 'localhost';
            $username = 'root';
            $password = '123456';
            $database = 'example3';
            $port = 3306;

            $dsn = "mysql:host=$server;dbname=$database;port=$port";
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false
            ];

            try {
                $pdo = new PDO($dsn, $username, $password, $options);
            } catch (PDOException $e) {
                throw new PDOException($e->getMessage(), (int)$e->getCode());
            }

            return $pdo;
        }
    }