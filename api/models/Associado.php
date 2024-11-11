<?php
require_once __DIR__ . '/../lib/db.php';

class Associado {
    private $db;

    public function __construct() {
        $this->db = (new DB())->connect();
    }

    public function cadastrar($nome, $email, $cpf, $data_filiacao) {
        $sql = "INSERT INTO associados (nome, email, cpf, data_filiacao) VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$nome, $email, $cpf, $data_filiacao]);
    }

    public function listar() {
        $sql = "SELECT * FROM associados";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
