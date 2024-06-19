<?php

session_start();
include_once("classes/conexao.php");
include_once("classes/manipularDados.php");


if(isset($_POST['postId'])){
    $codPost = $_POST['postId'];
    $dados = new ManipularDados();
    $dados->deletarPostTrash($codPost);
}

?>
