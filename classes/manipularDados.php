<?php

include_once("conexao.php");

class ManipularDados {
    
    public function cadastrarUsuario($username, $password) {
        $conexao = new Conexao();
        $conn = $conexao->getConexao();
        
        $username = mysqli_real_escape_string($conn, $username);
        $password = mysqli_real_escape_string($conn, $password);

    
        $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
        
        if ($conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }
    public function verificarCredenciais($username, $password) {
        $conexao = new Conexao();
        $conn = $conexao->getConexao();
        
        $username = mysqli_real_escape_string($conn, $username);
        $password = mysqli_real_escape_string($conn, $password);
        
        $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    
    public function exibirPosts() {
        $conexao = new Conexao();
        $conn = $conexao->getConexao();
        
        $username = $_SESSION['username'];
    
        $sql = "SELECT * FROM posts WHERE autorPost = '$username' ORDER BY codPost DESC";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<div class='post mx-2 my-2 pe-1 py-2'>";
                echo "<div class='bg-transparent text-end'>";

                echo "<div class='post-content text-light fw-bold text-start p-2'>" . $row["textPost"] . "</div>";

                echo "<div class='dropdwn'>";
                echo "<button class='dropdown dropbtn1 text-white' type='button' data-bs-toggle='dropdown' aria-expanded='false'>";
                echo "<i class='bi bi-info-circle'></i>";
                echo "</button>";
                echo "<ul class='dropdown-menu dropdown-content post-dropdown'>";
                echo "<span class='post-date text-black ms-1'>Criado em:" . $row["dataPost"] . "</span>";
                echo "</ul>";
                echo "<button class='dropbtn text-white' aria-expanded='false'>";
                echo "<a href='index.php' class='deleteButton text-white text-decoration-none' data-post-id='" . $row["codPost"] . "'><i class='bi bi-trash '></i></a>";
                echo "</button>";
                echo "<ul class='dropdown-menu dropdown-content post-dropdown'>";
                echo "</ul>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "<p class='text-light-emphasis ms-5'>Você não possui tarefas pendentes! :)</p>";
        }
    }
    public function exibirDeletePosts() {
        $conexao = new Conexao();
        $conn = $conexao->getConexao();
        
        $username = $_SESSION['username'];
    
        $sql = "SELECT * FROM deleteposts WHERE autorPost = '$username' ORDER BY codPost DESC";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<div class='post mx-2 my-2 pe-1 py-2'>";
                echo "<div class='bg-transparent text-end'>";

                echo "<div class='post-content text-light fw-bold text-start p-2'>" . $row["textPost"] . "</div>";

                echo "<div class='dropdwn'>";
                echo "<button class='dropdown dropbtn1 text-white' type='button' data-bs-toggle='dropdown' aria-expanded='false'>";
                echo "<i class='bi bi-info-circle'></i>";
                echo "</button>";
                echo "<ul class='dropdown-menu dropdown-content post-dropdown'>";
                echo "<span class='post-date text-black ms-1'>Criado em:" . $row["dataPost"] . "</span>";
                echo "</ul>";
                echo "<button class='dropbtn text-white' aria-expanded='false'>";
                echo "<a href='trash.php' class='deleteButtonTrash text-white text-decoration-none' data-post-id='" . $row["codPost"] . "'><i class='bi bi-trash '></i></a>";
                echo "</button>";
                echo "<ul class='dropdown-menu dropdown-content post-dropdown'>";
                echo "</ul>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "<p class='text-light-emphasis ms-5'>Você não possui tarefas deletadas.</p>";
        }
    }

    public function inserirPost($content, $autor) {
         if (empty($content)) {
            echo "Erro: O conteúdo do post está vazio.";
            return;
        }
        $conexao = new Conexao();
        $conn = $conexao->getConexao();
        $sql = "INSERT INTO posts (textPost, autorPost, dataPost) VALUES (?, ?, CURRENT_TIMESTAMP)";
        
        $stmt = $conn->prepare($sql);
    
        $stmt->bind_param("ss", $content, $autor);
        
        if ($stmt->execute()) {
            
        } else {
            echo "Erro ao inserir post: " . $conn->error;
        }
    
        $stmt->close();
    }

    
    public function deletarPost($codPost){
        $conexao = new Conexao();
        $conn = $conexao->getConexao();
        
        // Buscar o post na tabela tbposts
        $sqlSelectPost = "SELECT * FROM posts WHERE codPost = ?";
        $stmtSelectPost = $conn->prepare($sqlSelectPost);
        $stmtSelectPost->bind_param("i", $codPost);
        $stmtSelectPost->execute();
        $result = $stmtSelectPost->get_result();
        $post = $result->fetch_assoc();
        
        if ($post) {
            // Inserir o post na tabela tbdeleteposts
            $sqlInsertDeletePost = "INSERT INTO deleteposts (codPost, textPost, autorPost, dataPost) VALUES (?, ?, ?, ?)";
            $stmtInsertDeletePost = $conn->prepare($sqlInsertDeletePost);
            $stmtInsertDeletePost->bind_param("isss", $post['codPost'], $post['textPost'], $post['autorPost'], $post['dataPost']);
            $stmtInsertDeletePost->execute();
            
            if ($stmtInsertDeletePost->affected_rows > 0) {
                // Excluir o post da tabela tbposts
                $sqlDeletePost = "DELETE FROM posts WHERE codPost = ?";
                $stmtDeletePost = $conn->prepare($sqlDeletePost);
                $stmtDeletePost->bind_param("i", $codPost);
                $stmtDeletePost->execute();
                
                if ($stmtDeletePost->affected_rows > 0) {
                    echo "Post deletado com sucesso!";
                } else {
                    echo "Erro ao deletar o post da tabela original: " . $stmtDeletePost->error;
                }
                $stmtDeletePost->close();
            } else {
                echo "Erro ao inserir o post na tabela de deletados: " . $stmtInsertDeletePost->error;
            }
            $stmtInsertDeletePost->close();
        } else {
            echo "Post não encontrado.";
        }
        
        $stmtSelectPost->close();
    }
    
    public function deletarPostTrash($codPost){
        $conexao = new Conexao();
        $conn = $conexao->getConexao();
        
        $sqlDeletePost = "DELETE FROM deleteposts WHERE codPost = ?";
        $stmtDeletePost = $conn->prepare($sqlDeletePost);
        $stmtDeletePost->bind_param("i", $codPost);
        $stmtDeletePost->execute();
        
        if ($stmtDeletePost->affected_rows > 0) {
            echo "Post deletado com sucesso!";
        } else {
            echo "Erro ao deletar post: " . $stmtDeletePost->error;
        }
        
        $stmtDeletePost->close();
    }
}
?>