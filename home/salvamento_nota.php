<?php
$bd = new mysqli("localhost", "root", "Fd08131028!", "cinerates");

$nota = $_POST['nota'] ?? null;
$filme_id = $_POST['filme_id'] ?? null;
$usuario_id = $_POST['usuario_id'] ?? null;

if (!$nota || !$filme_id || !$usuario_id) {
    echo json_encode(["error" => "Dados incompletos"]);
    exit;
}


$sql = "INSERT INTO avaliacoes (cod_usuario, cod_filme, quant_avaliacao) 
        VALUES ('$usuario_id', '$filme_id', '$nota')
        ON DUPLICATE KEY UPDATE quant_avaliacao = '$nota'";

if ($bd->query($sql)) {

    
    $sql_update_quant = "UPDATE filmes 
                         SET quant_avaliacao = (SELECT COUNT(*) FROM avaliacoes WHERE cod_filme = '$filme_id') 
                         WHERE cod_filme = '$filme_id'";
    $bd->query($sql_update_quant);

    echo json_encode(["success" => "Avaliação salva com sucesso"]);
} else {
    echo json_encode(["error" => "Erro ao salvar avaliação"]);
}

$bd->close();
?>