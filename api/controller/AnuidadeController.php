<?php
// api/controllers/AnuidadeController.php
require_once __DIR__ . '/../service/AnuidadeService.php';

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, PUT");

class AnuidadeController {
    private $anuidadeService;

    public function __construct() {
        $this->anuidadeService = new AnuidadeService();
    }

    // Cadastrar nova anuidade
    public function cadastrar() {
        $data = json_decode(file_get_contents("php://input"), true);
        $ano = $data['ano'] ?? null;
        $valor = $data['valor'] ?? null;

        if ($ano && $valor) {
            $result = $this->anuidadeService->cadastrarAnuidade($ano, $valor);
            echo json_encode(['success' => $result]);
        } else {
            http_response_code(400);
            echo json_encode(["error" => "Dados inválidos"]);
        }
    }

    // Editar uma anuidade existente
    public function editar() {
        $data = json_decode(file_get_contents("php://input"), true);
        $ano = $data['ano'] ?? null;
        $valor = $data['valor'] ?? null;

        if ($ano && $valor) {
            $result = $this->anuidadeService->editarAnuidade($ano, $valor);
            echo json_encode(['success' => $result]);
        } else {
            http_response_code(400);
            echo json_encode(["error" => "Dados inválidos"]);
        }
    }
}

// Roteamento
$controller = new AnuidadeController();

switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        $controller->cadastrar();
        break;
    case 'PUT':
        $controller->editar();
        break;
    default:
        http_response_code(405);
        echo json_encode(["error" => "Método não permitido"]);
}
?>
