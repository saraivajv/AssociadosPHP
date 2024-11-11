<?php
require_once __DIR__ . '/../models/Anuidade.php';
require_once __DIR__ . '/../models/AnuidadeAssociado.php';

class AnuidadeAssociadoService {
    private $anuidadeModel;
    private $anuidadeAssociadoModel;

    public function __construct() {
        $this->anuidadeModel = new Anuidade();
        $this->anuidadeAssociadoModel = new AnuidadeAssociado();
    }

    // Realiza o checkout das anuidades devidas por um associado
    public function checkoutAnuidadesDevidas($associadoId, $dataFiliacao) {
        $anoAtual = date("Y");
        $anoFiliacao = date("Y", strtotime($dataFiliacao));

        $anuidadesDevidas = [];
        for ($ano = $anoFiliacao; $ano <= $anoAtual; $ano++) {
            $anuidade = $this->anuidadeModel->obterPorAno($ano);
            if ($anuidade) {
                $pagamento = $this->anuidadeAssociadoModel->obterPagamento($associadoId, $anuidade['id']);
                if (!$pagamento || !$pagamento['pago']) {
                    $anuidadesDevidas[] = [
                        'ano' => $ano,
                        'valor' => $anuidade['valor'],
                        'pago' => $pagamento['pago'] ?? false
                    ];
                }
            }
        }
        return $anuidadesDevidas;
    }
}
?>
