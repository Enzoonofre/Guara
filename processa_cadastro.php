<?php

require "pessoa.php";


$nome = $_POST["nome"] ?? "";
$nivel = $_POST['nivel'];
$sexo = $_POST['sexo'];


$novaPessoa = new Pessoa($nome, $nivel, $sexo);

if ($novaPessoa->salvaEmArquivo()) {
    echo "Cadastro realizado com sucesso!";
} else {
    echo "Erro ao cadastrar a pessoa. Tente novamente.";
}

 

?>
