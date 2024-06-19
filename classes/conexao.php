<?php

class Conexao {
    protected $conexao;

    public function __construct() {
        $this->conexao = new mysqli("localhost", "root", "", "dbswiftnote");

        if ($this->conexao->connect_error) {
            die("Erro na conexão: " . $this->conexao->connect_error);
        }
    }
    
    public function getConexao() {
        return $this->conexao;
    }

    protected function query($q) {
        $query = $this->conexao->query($q)
            or die("Erro ao executar a query $q: " . mysqli_error($this->conexao));
        return $query;
    }

    protected function listarDados($d) {
        $dados = mysqli_fetch_assoc($d);
        return $dados;
    }

    protected function contarDados($c) {
        $totalDados = mysqli_num_rows($c);
        return $totalDados;
    }
}

?>
