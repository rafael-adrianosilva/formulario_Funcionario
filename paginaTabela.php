<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabela Funcionário</title>
</head>

<body>
    <form method="post" action="paginaTabela.php">
        <input type="text" name="nome" placeholder="Digite o nome do Funcionário" style="align-content: center;">
        <button type="submit">Pesquisar</button>
    </form>

    <?php

    if ($_SERVER["REQUEST_METHOD"] == 'POST') {

        $pesquisa = $_POST["nome"];

        if (file_exists("arquivos/registroFuncionario.txt")) {
            $linhas = file("arquivos/registroFuncionario.txt");
            $dados_linhas = [];
            $max_campos = 0;

            // Processa todas as linhas
            foreach ($linhas as $linha) {
                $dados = explode('|', trim($linha));
                $dados_linhas[] = $dados;
                if (count($dados) > $max_campos) {
                    $max_campos = count($dados);
                }
            }


            // Gera a tabela única
            echo "<table border='1' cellpadding='8' cellspacing='0'>";

            // Cabeçalhos genéricos
            echo "<tr>";
            for ($i = 1; $i <= $max_campos; $i++) {
                echo "<th>Campo $i</th>";
            }
            echo "</tr>";

            // Linha de dados
            foreach ($dados_linhas as $linha_dados) {
                echo "<tr>";
                if ($pesquisa == $linha_dados[0] || $pesquisa == null) {
                    

                    for ($i = 0; $i < $max_campos; $i++) {
                        $valor = isset($linha_dados[$i]) ? htmlspecialchars($linha_dados[$i]) : '';
                        echo "<td>$valor</td>";
                    }
                    echo "</tr>";
                }
            }
            echo "</table>";
        } else {
            echo "Arquivo não encontrado.";
        }
    }
    ?>
</body>

</html>