<?php
require_once __DIR__ . '/../models/Anuidade.php';

class AnuidadeService {
    private $anuidadeModel;

    public function __construct() {
        $this->anuidadeModel = new Anuidade();
    }

    // Cadastrar uma nova anuidade
    public function cadastrarAnuidade($ano, $valor) {
        return $this->anuidadeModel->cadastrar($ano, $valor);
    }

    // Editar o valor de uma anuidade existente
    public function editarAnuidade($ano, $valor) {
        return $this->anuidadeModel->atualizar($ano, $valor);
    }
}
?>
