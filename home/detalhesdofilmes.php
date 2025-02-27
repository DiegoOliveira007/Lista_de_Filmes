<?php 
    header('Content-Type: application/json');

    $bd = new mysqli("localhost", "root", "Fd08131028!", "cinerates");

    $id_filme = $_GET["id"] ?? null;

   
    $sql_filme = "SELECT f.cod_filme, f.nome_filme, f.sinopse, f.data_lançamento, f.classe_idade, f.imagem_poster, 
    f.quant_avaliacao, g.nome AS genero
FROM filmes f
JOIN generos g ON f.id_genero = g.id_genero
WHERE f.cod_filme = ?";

    $stmt = $bd->prepare($sql_filme);
    $stmt->bind_param("i", $id_filme);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $filme = $resultado->fetch_assoc();

    echo json_encode($filme);

    $stmt->close();
    $bd->close();
?>