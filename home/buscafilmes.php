
<?php 
    header('Content-Type: application/json');

    $bd = new mysqli("localhost", "root", "Fd08131028!", "cinerates");

    $id_categoria = $_GET["categoria"] ?? null;

    $sql_filmes = "SELECT f.cod_filme, f.nome_filme, f.sinopse, f.data_lançamento, f.classe_idade, f.imagem_poster 
    
                FROM filmes f
                JOIN filmes_categorias fc ON f.cod_filme = fc.cod_filme
                WHERE fc.id_catalogo = ?";

    $stmt = $bd->prepare($sql_filmes);
    $stmt->bind_param("i", $id_categoria);
    $stmt->execute();
    $resultado = $stmt->get_result();

    $dados = [];  
    while ($linha = mysqli_fetch_assoc($resultado)) {
    $dados[] = $linha; 
    }
    echo json_encode($dados);

    $stmt->close();
    $bd->close();
?>

