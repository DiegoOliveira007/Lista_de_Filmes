<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
     $bd = new mysqli("localhost", "root", "Fd08131028!", "cinerates");

     if ($bd->connect_error) {
        die("Erro na conexão: " . $bd->connect_error);
    }

     $API_KEY = '12511f01e01ceb7d4a5d8c872e3aa020';
     $URL = 'https://api.themoviedb.org/3/movie/';
     $id_filmes = $_GET["id"] ?? null;
     $id_categoria = $_GET["categoria"] ?? null;

    $URLbase = "$URL$id_filmes?api_key=$API_KEY&language=pt-br";
    $obterdados = file_get_contents($URLbase);
    $dadosjson = json_decode($obterdados, true);

    if($dadosjson){
        e$cod_filme = $dadosjson["id"];
        $nomefilm = $bd->real_escape_string($dadosjson["title"]);
        $sinopse = $bd->real_escape_string($dadosjson["overview"]);
        $data_lancamento = $dadosjson["release_date"];
        $class_idade = $dadosjson["adult"] ? "18+" : "Livre";
        $imagem = $dadosjson["poster_path"];

    
if(!empty($dadosjson["genres"])){
        $genero = $dadosjson["genres"][0]["id"];
        $nome_genero = $bd->real_escape_string($dadosjson["genres"][0]["name"]);

        $sql_genero = "INSERT INTO generos(id_genero, nome)
        VALUES ('$genero', '$nome_genero')
        ON DUPLICATE KEY UPDATE
        id_genero = '$genero', nome = '$nome_genero'";

        $bd->query($sql_genero);
    }
    else{
        $genero = "NULL";
    }

    $sql_filmes = "INSERT INTO filmes(cod_filme, data_lançamento, nome_filme, sinopse, classe_idade, imagem_poster, quant_avaliacao, id_genero)
    VALUES ('$cod_filme', '$data_lancamento', '$nomefilme', '$sinopse', '$class_idade', '$imagem', $genero)
    ON DUPLICATE KEY UPDATE 
    nome_filme = '$nomefilme', sinopse = '$sinopse', classe_idade = '$class_idade', imagem_poster = '$imagem', 0, id_genero = '$genero'"; 


    if($bd->query($sql_filmes)){
        $sql_categoria = "INSERT INTO filmes_categorias(cod_filme, id_catalogo)
        VALUES ('$cod_filme', '$id_categoria')
        ON DUPLICATE KEY UPDATE id_catalogo = '$id_categoria'";

        $bd->query($sql_categoria);
    }

    if($bd->query($sql_filmes) === TRUE){
        echo "Foi armazenado com sucesso";
    }
    else {
        echo "ERROR";
    }
}

$bd->close();
    ?>
</body>
</html>