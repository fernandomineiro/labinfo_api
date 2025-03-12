
<?php
require_once __DIR__ . './db.php';

function adicionarTarefa($descricao) {
    global $conn;
    $descricao = $conn->real_escape_string($descricao);
    $sql = "INSERT INTO tarefas (descricao) VALUES ('$descricao')";
    return $conn->query($sql);
}
function listarTarefas() {
    global $conn;
    $result = $conn->query("SELECT * FROM tarefas");
    $tarefas = [];
    while ($row = $result->fetch_assoc()) {
        $tarefas[] = $row;
    }
    return $tarefas;
}
function atualizarTarefa($id, $concluida) {
    global $conn;
    $id = intval($id);
    $concluida = intval($concluida);
    return $conn->query("UPDATE tarefas SET concluida = $concluida WHERE id = $id");
}
function excluirTarefa($id) {
    global $conn;
    $id = intval($id);
    return $conn->query("DELETE FROM tarefas WHERE id = $id");
}