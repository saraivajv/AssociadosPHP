<?php
require_once __DIR__ . '/../lib/db.php';

class AnuidadeAssociado {
    private $db;

    public function __construct() {
        $this->db = (new DB())->connect();
    }

    public function registrarPagamento($associadoId, $anuidadeId) {
        $sql = "INSERT INTO pagamentos (associado_id, anuidade_id, pago) VALUES (?, ?, TRUE)
                ON CONFLICT (associado_id, anuidade_id) DO UPDATE SET pago = TRUE";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$associadoId, $anuidadeId]);
    }

    public function verificarStatusPagamentos($associadoId) {
        $sql = "SELECT a.ano, a.valor, p.pago 
                FROM anuidades a
                LEFT JOIN pagamentos p ON a.id = p.anuidade_id AND p.associado_id = ?
                ORDER BY a.ano ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$associadoId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obterPagamento($associadoId, $anuidadeId) {
        $sql = "SELECT * FROM pagamentos WHERE associado_id = ? AND anuidade_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$associadoId, $anuidadeId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
