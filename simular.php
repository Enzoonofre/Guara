<?php
// Carrega o arquivo PHP com as funções e classes necessárias
require 'pessoa.php';

// Carrega os dados das pessoas do arquivo
$pessoas = carregaPessoasDeArquivo();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style-simular.css">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .btn-cadastrar {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .btn-cadastrar:hover {
            background-color: #45a049;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        select {
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #ccc;
            width: 100%;
            box-sizing: border-box;
        }
        button[type="submit"] {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button[type="submit"]:hover {
            background-color: #45a049;
        }
        .jogo-container {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Cadastro de Jogadores</h2>
    <button class="btn-cadastrar" type="button" onclick="cadastrarJogo()">Cadastrar Jogo</button>
    <div id="jogo-container" class="jogo-container"></div>
</div>

<script>
    // Função para cadastrar o jogo
    function cadastrarJogo() {
        const container = document.getElementById("jogo-container");

        const form = document.createElement("form");

        let html = `
            <table>
                <tr>
                    <td>Equipe A - Jogador 1</td>
                    <td>
                        <select name="equipeA_jogador1" required onchange="updateAttributes(this)">
                        <?php
                            if (!empty($pessoas)) {
                                foreach ($pessoas as $pessoa) {
                                    $sexo = ($pessoa->sexo === 'masculino') ? 'M' : 'F';
                                    echo "<option value='{$pessoa->nome}' data-nivel='{$pessoa->nivel}' data-sexo='{$sexo}'>{$pessoa->nome}</option>";
                                }
                            }
                        ?>
                        </select>
                    </td>
                    <td>Equipe B - Jogador 1</td>
                    <td>
                        <select name="equipeB_jogador1" required onchange="updateAttributes(this)">
                        <?php
                            if (!empty($pessoas)) {
                                foreach ($pessoas as $pessoa) {
                                    $sexo = ($pessoa->sexo === 'masculino') ? 'M' : 'F';
                                    echo "<option value='{$pessoa->nome}' data-nivel='{$pessoa->nivel}' data-sexo='{$sexo}'>{$pessoa->nome}</option>";
                                }
                            }
                        ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Equipe A - Jogador 2</td>
                    <td>
                        <select name="equipeA_jogador2" required onchange="updateAttributes(this)">
                        <?php
                            if (!empty($pessoas)) {
                                foreach ($pessoas as $pessoa) {
                                    $sexo = ($pessoa->sexo === 'masculino') ? 'M' : 'F';
                                    echo "<option value='{$pessoa->nome}' data-nivel='{$pessoa->nivel}' data-sexo='{$sexo}'>{$pessoa->nome}</option>";
                                }
                            }
                        ?>
                        </select>
                    </td>
                    <td>Equipe B - Jogador 2</td>
                    <td>
                        <select name="equipeB_jogador2" required onchange="updateAttributes(this)">
                        <?php
                            if (!empty($pessoas)) {
                                foreach ($pessoas as $pessoa) {
                                    $sexo = ($pessoa->sexo === 'masculino') ? 'M' : 'F';
                                    echo "<option value='{$pessoa->nome}' data-nivel='{$pessoa->nivel}' data-sexo='{$sexo}'>{$pessoa->nome}</option>";
                                }
                            }
                        ?>
                        </select>
                    </td>
                </tr>
            </table>
            <button type="submit">Salvar Jogo</button>
        `;

        form.innerHTML = html;
        container.innerHTML = ''; // Limpa o conteúdo anterior
        container.appendChild(form);
        form.addEventListener("submit", salvarJogo);
    }

    // Função para processar o envio do formulário
    function salvarJogo(event) {
        event.preventDefault(); // Evita o envio padrão do formulário
        const formData = new FormData(event.target);
        const equipeA_jogador1 = formData.get("equipeA_jogador1");
        const equipeA_jogador2 = formData.get("equipeA_jogador2");
        const equipeB_jogador1 = formData.get("equipeB_jogador1");
        const equipeB_jogador2 = formData.get("equipeB_jogador2");
        criarTabelaJogo(equipeA_jogador1, equipeA_jogador2, equipeB_jogador1, equipeB_jogador2);
    }

    function criarTabelaJogo(equipeA_jogador1, equipeA_jogador2, equipeB_jogador1, equipeB_jogador2) {
        const container = document.getElementById("jogo-container");

        const jogoContainer = document.createElement("div");
        jogoContainer.classList.add("jogo-container");

        const table = document.createElement("table");
        table.innerHTML = `
            <thead>
                <tr>
                    <th>Equipe A</th>
                    <th>Equipe B</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>${equipeA_jogador1}</td>
                    <td>${equipeB_jogador1}</td>
                </tr>
                <tr>
                    <td>${equipeA_jogador2}</td>
                    <td>${equipeB_jogador2}</td>
                </tr>
                <tr>
                    <td><input type="number" class="pontosEquipeA" value="0" min="0"></td>
                    <td><input type="number" class="pontosEquipeB" value="0" min="0"></td>
                </tr>
                <tr>
                    <td><div class="resultadoA">Resultado Equipe A: 0</div></td>
                    <td><div class="resultadoB">Resultado Equipe B: 0</div></td>
                </tr>
            </tbody>
        `;

        // Adiciona um botão de remoção de jogo
        const removerBotao = document.createElement("button");
        removerBotao.textContent = "Remover Jogo";
        removerBotao.addEventListener("click", function() {
            jogoContainer.remove();
        });

        jogoContainer.appendChild(table);
        jogoContainer.appendChild(removerBotao);

        container.appendChild(jogoContainer);

        // Adiciona o cálculo de fórmula
        const inputEquipeA = table.querySelector('.pontosEquipeA');
        const inputEquipeB = table.querySelector('.pontosEquipeB');
        const resultadoDivA = table.querySelector('.resultadoA');
        const resultadoDivB = table.querySelector('.resultadoB');

        function calcularFormula() {
            const pontosA = parseFloat(inputEquipeA.value) || 0;
            const pontosB = parseFloat(inputEquipeB.value) || 0;

            const nivelA1 = document.querySelector(`select[name="equipeA_jogador1"] option:checked`).dataset.nivel;
            const sexoA1 = document.querySelector(`select[name="equipeA_jogador1"] option:checked`).dataset.sexo;
            const nivelA2 = document.querySelector(`select[name="equipeA_jogador2"] option:checked`).dataset.nivel;
            const sexoA2 = document.querySelector(`select[name="equipeA_jogador2"] option:checked`).dataset.sexo;
            const nivelB1 = document.querySelector(`select[name="equipeB_jogador1"] option:checked`).dataset.nivel;
            const sexoB1 = document.querySelector(`select[name="equipeB_jogador1"] option:checked`).dataset.sexo;
            const nivelB2 = document.querySelector(`select[name="equipeB_jogador2"] option:checked`).dataset.nivel;
            const sexoB2 = document.querySelector(`select[name="equipeB_jogador2"] option:checked`).dataset.sexo;

            console.log("Níveis e sexos dos jogadores:");
            console.log(`NivelA1: ${nivelA1}, SexoA1: ${sexoA1}`);
            console.log(`NivelA2: ${nivelA2}, SexoA2: ${sexoA2}`);
            console.log(`NivelB1: ${nivelB1}, SexoB1: ${sexoB1}`);
            console.log(`NivelB2: ${nivelB2}, SexoB2: ${sexoB2}`);

            const categoria = { 'A': 1, 'B': 2, 'C': 3, 'D': 4 };
            const sexo = { 'M': 1.3, 'F': 1.9 };

            const fator1 = (categoria[nivelA1] * sexo[sexoA1] + categoria[nivelA2] * sexo[sexoA2]) / (categoria[nivelB1] * sexo[sexoB1] + categoria[nivelB2] * sexo[sexoB2]);
            const fator2 = ((sexo[sexoA1] + 20) * (sexo[sexoA2] + 20)) / ((sexo[sexoB1] + 20) * (sexo[sexoB2] + 20));

            const fatorA = fator1 * fator2;
            const fatorB = 1 / fatorA;

            const resultadoA = pontosA; // Assuming resultadoA is the score inputted
            const resultadoB = pontosB; // Assuming resultadoB is the score inputted

            const pontosEquipeA = 1 + 5 * fatorA * resultadoA / (resultadoA + resultadoB);
            const pontosEquipeB = 1 + 5 * fatorB * resultadoB / (resultadoA + resultadoB);

            console.log(`Fator1: ${fator1}`);
            console.log(`Fator2: ${fator2}`);
            console.log(`FatorA: ${fatorA}`);
            console.log(`FatorB: ${fatorB}`);
            console.log(`PontosEquipeA: ${pontosEquipeA}`);
            console.log(`PontosEquipeB: ${pontosEquipeB}`);

            // Atualizar os resultados na página
            resultadoDivA.innerText = `Resultado Equipe A: ${pontosEquipeA.toFixed(2)}`;
            resultadoDivB.innerText = `Resultado Equipe B: ${pontosEquipeB.toFixed(2)}`;
        }

        inputEquipeA.addEventListener('input', calcularFormula);
        inputEquipeB.addEventListener('input', calcularFormula);
    }

    function updateAttributes(select) {
        const selectedOption = select.options[select.selectedIndex];
        select.dataset.nivel = selectedOption.dataset.nivel;
        select.dataset.sexo = selectedOption.dataset.sexo;
    }
</script>

</body>
</html>