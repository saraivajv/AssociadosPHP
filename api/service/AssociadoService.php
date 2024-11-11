<?php
require_once __DIR__ . '/../models/Associado.php';
require_once __DIR__ . '/../models/AnuidadeAssociado.php';

class AssociadoService {
    private $associadoModel;
    private $anuidadeAssociadoModel;

    public function __construct() {
        $this->associadoModel = new Associado();
        $this->anuidadeAssociadoModel = new AnuidadeAssociado();
    }

    // Cadastro de novo associado
    public function cadastrarAssociado($nome, $email, $cpf, $data_filiacao) {
        return $this->associadoModel->cadastrar($nome, $email, $cpf, $data_filiacao);
    }

    // Realizar pagamento de anuidade para um associado
    public function pagarAnuidade($associadoId, $anuidadeId) {
        return $this->anuidadeAssociadoModel->registrarPagamento($associadoId, $anuidadeId);
    }

    // Verificar o status de pagamento de um associado (se está em dia ou em atraso)
    public function verificarStatusPagamento($associadoId) {
        $statusPagamentos = $this->anuidadeAssociadoModel->verificarStatusPagamentos($associadoId);

        // Verifica se há alguma anuidade pendente
        foreach ($statusPagamentos as $status) {
            if (!$status['pago']) {
                return 'Atrasado';
            }
        }
        return 'Em dia';
    }
}
?>
