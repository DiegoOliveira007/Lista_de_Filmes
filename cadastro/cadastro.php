<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
</head>
<body>
    <?php

    $bd = mysqli_connect("localhost", "root", "Fd08131028!", "cinerates");

    
    $email = $_POST['Email'];
    $nomeuser = $_POST['nomeUsuario'];
    $datanasc = $_POST['datanas'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    $dadosmysql = "INSERT INTO usuario (email, senha, data_nascimento, nome_usuario)
    VALUES ('$email', '$senha', '$datanasc', '$nomeuser')";

    if (mysqli_query($bd, $dadosmysql)){
        header("Location: ../home/central.html");
        exit();
    }

    mysqli_close($bd);

    ?>
</body>
</html>