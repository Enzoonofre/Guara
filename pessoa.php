<?php

class Pessoa
{
  public $nome;
  public $nivel;
  public $sexo;

  function __construct($nome, $nivel, $sexo)
  {
    $this->nome = $nome;
    $this->nivel = $nivel;
    $this->sexo = $sexo;
  }

  public function SalvaEmArquivo()
  {
    // Abre o arquivo de texto para escrita de conteúdo no final
    $arq = fopen("pessoas.txt", "a");

    if (!$arq) {
        return false;
    }

    // Neste exemplo os dados são armazenados de maneira simplificada,
    // no formato textual com campos separados por ponto-e-vírgula.
    $resultado = fwrite($arq, "\n{$this->nome};{$this->nivel};{$this->sexo}");

    // Fecha o arquivo de texto.
    fclose($arq); 

    return $resultado !== false;
  }
}

function carregaPessoasDeArquivo()
{
    $arrayPessoas = [];
  
    // Abre o arquivo pessoas.txt para leitura
    $arq = fopen("pessoas.txt", "r");
    if (!$arq) {
        return null;
    }

    // Lê os dados do arquivo, linha por linha, e armazena no vetor $arrayPessoas
    while (!feof($arq)) {
        // fgets lê uma linha de texto do arquivo
        $linha = fgets($arq);
        
        // Remove possíveis quebras de linha no final da string
        $linha = trim($linha);
        
        // Se a linha estiver vazia, continua para a próxima iteração
        if (empty($linha)) {
            continue;
        }

        // Separa dados na linha utilizando o ';' como separador
        list($nome, $nivel, $sexo) = array_pad(explode(';', $linha), 3, null);

        // Cria novo objeto representado a pessoa e adiciona no final do array
        $novaPessoa = new Pessoa($nome, $nivel, $sexo);
        $arrayPessoas[] = $novaPessoa;
    }
        
    // Fecha o arquivo
    fclose($arq);  
    return json_encode($arrayPessoas);
}

?>