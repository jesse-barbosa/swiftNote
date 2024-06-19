<?php
include_once("classes/conexao.php");
include_once("classes/manipularDados.php");

$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $manipularDados = new ManipularDados();

    if ($manipularDados->cadastrarUsuario($username, $password)) {
        header("Location: login.php");
        exit;
    } else {
        $error_message = "Erro ao cadastrar usuário. Tente novamente.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - SwiftNote</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="bg-dark text-light d-flex flex-column justify-content-center align-items-center vh-100">
    <header class="mb-4">
        <h1 class="fw-bold">SwiftNote</h1>
    </header>
    <div class="card bg-secondary text-light" style="width: 100%; max-width: 360px;">
        <div class="card-body">
            <h5 class="card-title fw-semibold">Seja bem-vindo,</h5>
            <p class="card-text">Crie uma conta para continuar</p>
            <form action="cadastro.php" method="post">
                <div class="my-4">
                    <input type="text" class="form-control" id="username" name="username" placeholder="Usuário" required>
                </div>
                <div class="my-4">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Senha" required>
                </div>
                <?php if(isset($error_message) && $error_message != ""): ?>
                    <p class="text-danger"><?php echo $error_message; ?></p>
                <?php endif; ?>
                <div class="mb-3">
                    <span class="form-text">Já tem uma conta?<a href="login.php" class="link-dark fw-semibold ms-1">Entrar</a></span>
                </div>
                <button type="submit" class="btn btn-dark w-100">Cadastrar &rarr;</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
