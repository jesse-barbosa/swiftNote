<?php
session_start();

include_once("classes/conexao.php");
include_once("classes/manipularDados.php");


if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

$dados = new ManipularDados();
?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- FAVICON -->
  <link rel="icon" type="image/png" sizes="192x192"  href="img/icon.png">
    <title>SwiftNote - Início</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/style.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="js/script.js"></script>
    </head>
  <body class="bg-dark">
  <section>
  <header>
  <div class="container-fluid">
    <div class="row">
        <div class="col-3 d-inline-flex p-4">
        <div class="fw-bold fs-2 ms-1 px-3 text-light">SwiftNote</div>
        <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="bi bi-pen-fill mt-2" viewBox="0 0 16 16">
  <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001"/>
</svg>
</div>
    <div class="col">
        <div id="profile-info">
            <div class="dropdown text-end mt-3 me-3">
  <button class="border-0 bg-transparent" type="button" data-bs-toggle="dropdown" aria-expanded="false">
    <img id="profile-picture" src="img/profilePicture/defaultIcon.png" alt="">
  </button>
  <ul class="dropdown-menu p-3">
    <li><span id="username" class="dropdown-item text-black"><?php echo $_SESSION['username']; ?></span></li>
    <li><a href="login.php" class="dropdown-item text-center" id="logout-button">Sair</a></li>
  </ul>
</div>
            <br />
        </div>
      </div>
    </div>
    </header>
    </section>
    <hr>

    <section>
    <div class="container-fluid">
        <div class="row">
        <div class="col-3">
    <nav class="nav-menu">
        <ul>
            <li class="fs-5"><a href="index.php"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-pen me-3" viewBox="0 0 16 16">
  <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001m-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708z"/>
</svg> Notas</a></li>
            <li class="liActive bg-success bg-opacity-10 fs-5"><a href="trash.php"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-trash-fill me-3" viewBox="0 0 16 16">
  <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0"/>
</svg> Lixeira</a></li>
        </ul>
    </nav>
    </div>
    <div class="col-5 p-3 mb-5 text-center mx-5 mt-3 h-50 text-emphasis">
    As notas deletadas aparecem aqui.
    </div>
          <section>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-10 ms-5">
        <div class="d-flex flex-wrap justify-content-start">
          <?php $dados->exibirDeletePosts(); ?>
        </div>
      </div>
    </div>
  </div>
</section>
      </div>
  </div>
</section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>
