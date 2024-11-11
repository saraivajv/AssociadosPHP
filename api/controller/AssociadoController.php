<?php
require_once __DIR__ . '/../service/AssociadoService.php';

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

class AssociadoController {
    private $associadoService;

    public function __construct() {
        $this->associadoService = new AssociadoService();
    }

    // Cadastrar novo associado
    public function cadastrar() {
        $data = json_decode(file_get_contents("php://input"), true);

        // Verifica se todos os campos estão presentes
        if (!isset($data['nome'], $data['email'], $data['cpf'], $data['data_filiacao'])) {
            http_response_code(400);
            echo json_encode(["error" => "Dados incompletos. Verifique se todos os campos estão preenchidos."]);
            return;
        }

        // Recebe os dados
        $nome = $data['nome'];
        $email = $data['email'];
        $cpf = $data['cpf'];
        $data_filiacao = $data['data_filiacao'];

        // Tenta cadastrar e captura qualquer erro
        try {
            $result = $this->associadoService->cadastrarAssociado($nome, $email, $cpf, $data_filiacao);
            if ($result) {
                echo json_encode(["success" => "Associado cadastrado com sucesso."]);
            } else {
                http_response_code(500);
                echo json_encode(["error" => "Erro ao cadastrar o associado."]);
            }
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(["error" => $e->getMessage()]);
        }
    }

    // Realizar pagamento de anuidade para um associado
    public function pagarAnuidade() {
        $data = json_decode(file_get_contents("php://input"), true);
        $associadoId = $data['associado_id'] ?? null;
        $anuidadeId = $data['anuidade_id'] ?? null;

        if ($associadoId && $anuidadeId) {
            try {
                $result = $this->associadoService->pagarAnuidade($associadoId, $anuidadeId);
                echo json_encode(['success' => $result]);
            } catch (Exception $e) {
                http_response_code(500);
                echo json_encode(["error" => $e->getMessage()]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["error" => "Dados inválidos"]);
        }
    }

    // Verificar status de pagamento do associado (em dia ou atrasado)
    public function verificarStatus() {
        $associadoId = $_GET['associado_id'] ?? null;
        
        if ($associadoId) {
            try {
                $status = $this->associadoService->verificarStatusPagamento($associadoId);
                echo json_encode(['status' => $status]);
            } catch (Exception $e) {
                http_response_code(500);
                echo json_encode(["error" => $e->getMessage()]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["error" => "ID do associado não fornecido"]);
        }
    }
}

// Roteamento
$controller = new AssociadoController();

// Verifica se o método é OPTIONS e responde com 200 OK
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        if (isset($_GET['action']) && $_GET['action'] === 'pagarAnuidade') {
            $controller->pagarAnuidade();
        } else {
            $controller->cadastrar();
        }
        break;
    case 'GET':
        $controller->verificarStatus();
        break;
    default:
        http_response_code(405);
        echo json_encode(["error" => "Método não permitido"]);
}
?>
