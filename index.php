<?php
header("Content-Type: application/json");
require_once __DIR__ . './tasks.php';

$method = $_SERVER["REQUEST_METHOD"];

switch ($method) {
    case "POST":
        $data = json_decode(file_get_contents("php://input"), true);
        if (!empty($data["descricao"])) {
            if (adicionarTarefa($data["descricao"])) {
                echo json_encode(["message" => "Tarefa adicionada com sucesso"]);
            } else {
                echo json_encode(["error" => "Erro ao adicionar tarefa"]);
            }
        } else {
            echo json_encode(["error" => "Descrição é obrigatória"]);
        }
        break;

    case "GET":
        echo json_encode(listarTarefas());
        break;

    case "PUT":
        $data = json_decode(file_get_contents("php://input"), true);
        if (!empty($data["id"])) {
            $concluida = isset($data["concluida"]) ? $data["concluida"] : 0;
            if (atualizarTarefa($data["id"], $concluida)) {
                echo json_encode(["message" => "Tarefa atualizada"]);
            } else {
                echo json_encode(["error" => "Erro ao atualizar tarefa"]);
            }
        } else {
            echo json_encode(["error" => "ID é obrigatório"]);
        }
        break;

    case "DELETE":
        $data = json_decode(file_get_contents("php://input"), true);
        if (!empty($data["id"])) {
            if (excluirTarefa($data["id"])) {
                echo json_encode(["message" => "Tarefa excluída"]);
            } else {
                echo json_encode(["error" => "Erro ao excluir tarefa"]);
            }
        } else {
            echo json_encode(["error" => "ID é obrigatório"]);
        }
        break;

    default:
        echo json_encode(["error" => "Método não permitido"]);
        break;
}
?>