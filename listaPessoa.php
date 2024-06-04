<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Página Dinâmica - Listagem de Pessoas</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<body>

<div class="container">
  
  <h3>Pessoas Carregadas do Arquivo <i>pessoas.txt</i></h3>

  <table class="table table-striped">
    <thead>
      <tr>
        <th>Nome</th>
        <th>Nível</th>
        <th>Sexo</th>
      </tr>
    </thead>
    
    <tbody>
        <?php
        require "pessoa.php";
        $arrayPessoas = carregaPessoasDeArquivo();    
        if ($arrayPessoas != NULL)
        {
          foreach ($arrayPessoas as $pessoa)
          {    
            $nome = htmlspecialchars($pessoa->nome);
            $nivel = htmlspecialchars($pessoa->nivel);
            $sexo = htmlspecialchars($pessoa->sexo);

            echo <<<HTML
            <tr>
              <td>$nome</td>
              <td>$nivel</td>
              <td>$sexo</td>
            </tr>
            HTML;
          }
        }       
        ?>
    </tbody>
  </table>
  <a href="home.html">Voltar à página inicial</a>
</div>

</body>
</html>