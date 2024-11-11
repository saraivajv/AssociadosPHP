<?php
require_once __DIR__ . '/../lib/db.php';

class Anuidade {
    private $db;

    public function __construct() {
        $this->db = (new DB())->connect();
    }

    public function cadastrar($ano, $valor) {
        $sql = "INSERT INTO anuidades (ano, valor) VALUES (?, ?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$ano, $valor]);
    }

    public function atualizar($ano, $valor) {
        $sql = "UPDATE anuidades SET valor = ? WHERE ano = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$valor, $ano]);
    }

    public function obterPorAno($ano) {
        $sql = "SELECT * FROM anuidades WHERE ano = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$ano]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
