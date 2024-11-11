<?php

class DB {
    private $host = 'localhost';
    private $dbname = 'devs_do_rn';
    private $username = 'postgres';
    private $password = 'password';

    public function connect() {
        try {
            return new PDO("pgsql:host={$this->host};dbname={$this->dbname}", $this->username, $this->password);
        } catch (PDOException $e) {
            echo json_encode(['error' => $e->getMessage()]);
            exit;
        }
    }
}
?>
