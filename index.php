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
        <div id="dropdownMenu2" class="col-3">
    <nav class="nav-menu">
        <ul>
            <li class="liActive bg-success bg-opacity-10 fs-5"><a href="index.php"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-pen-fill me-3" viewBox="0 0 16 16">
  <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001"/>
</svg> Notas</a></li>
            <li class="fs-5"><a href="trash.php"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-trash me-3" viewBox="0 0 16 16">
  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
  <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
</svg> Lixeira</a></li>
        </ul>
    </nav>
    </div>
    <div class="col-4 shadow-lg p-3 mb-5 rounded text-center mx-5 mt-3 h-50">
  <form action="inserirPost.php" method="post" class="d-flex">
    <textarea class="text-light me-auto" name="content" placeholder="Criar uma nota..."></textarea>
    <button type="submit" class="button btn">
      <span>Anotar</span>
      <span>
        <svg xmlns="http://www.w3.org/2000/svg" width="24" viewBox="0 0 24 24" stroke-width="2" stroke-linejoin="round" stroke-linecap="round" stroke="currentColor" height="24" fill="none" class="svg">
          <line y2="19" y1="5" x2="12" x1="12"></line>
          <line y2="12" y1="12" x2="19" x1="5"></line>
        </svg>  
      </span>
    </button>
  </form>
</div>

<section>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-10 ms-5">
        <div class="d-flex flex-wrap justify-content-start ms-5">
    <?php $dados->exibirPosts(); ?>
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
