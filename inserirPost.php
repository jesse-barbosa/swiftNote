<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["content"])) {
    $content = $_POST["content"];
    $autor = $_SESSION["username"];

    include_once("classes/conexao.php");
    include_once("classes/manipularDados.php");

    $conexao = new Conexao();
    $dados = new ManipularDados($conexao);
    $inserido = $dados->inserirPost($content, $autor);
    
    if (true) {
        header("Location: index.php");
        exit();
    }
}
?>
