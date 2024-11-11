<?php
require_once __DIR__ . '/../service/AnuidadeAssociadoService.php';

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");

class AnuidadeAssociadoController {
    private $anuidadeAssociadoService;

    public function __construct() {
        $this->anuidadeAssociadoService = new AnuidadeAssociadoService();
    }

    // Realizar o checkout das anuidades devidas com base na data de filiação
    public function checkoutAnuidades() {
        $associadoId = $_GET['associado_id'] ?? null;
        $dataFiliacao = $_GET['data_filiacao'] ?? null;

        if ($associadoId && $dataFiliacao) {
            $anuidadesDevidas = $this->anuidadeAssociadoService->checkoutAnuidadesDevidas($associadoId, $dataFiliacao);
            echo json_encode($anuidadesDevidas);
        } else {
            http_response_code(400);
            echo json_encode(["error" => "ID do associado ou data de filiação não fornecidos"]);
        }
    }
}

// Roteamento
$controller = new AnuidadeAssociadoController();

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        $controller->checkoutAnuidades();
        break;
    default:
        http_response_code(405);
        echo json_encode(["error" => "Método não permitido"]);
}
?>
