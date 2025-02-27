<?php
session_start();

$bd = mysqli_connect("localhost", "root", "Fd08131028!", "cinerates");

$nomeUsuario = $_POST['nomeUsuario'];
$senha = $_POST['senha'];

$query = "SELECT cod_usuario, senha FROM usuario WHERE nome_usuario = ?";
$stmt = mysqli_prepare($bd, $query);
mysqli_stmt_bind_param($stmt, "s", $nomeUsuario);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($row = mysqli_fetch_assoc($result)) {
    if (password_verify($senha, $row['senha'])) {
        $_SESSION['id_usuario'] = $row['id_usuario'];
        header("Location: ../home/central.html");
        exit();
    } else {
        echo "<script>alert('Senha incorreta!'); window.location.href='../login.html';</script>";
    }
} else {
    echo "<script>alert('Usuário não encontrado!'); window.location.href='../login.html';</script>";
}

mysqli_stmt_close($stmt);
mysqli_close($bd);
?>
