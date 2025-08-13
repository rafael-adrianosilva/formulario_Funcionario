<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="formulario_Funcionario.css">
</head>

<body>
    <h1>Cadastro de Funcionário</h1>

    <fieldset>
        <form method="post" enctype="multipart/form-data">
            <div class="didi">
                <div class="nome">
                    Nome:
                    <input type="text" name="nomeFuncionario" placeholder="Nome do Funcionário" required> <!-- Está solicitando ao cadastrante, seu nome -->
                </div>
                <div class="mail">
                    Email:
                    <input type="email" name="emailFuncionario" placeholder="Email do Funcionário" required> <!-- Está solicitando ao cadastrante, seu Email -->
                </div>
                <div>
                    Telefone:
                    <input type="tel" name="telFuncionario" placeholder="Telefone do Funcionário" required> <!-- Está solicitando ao cadastrante, seu telefone -->
                </div>
                <div>
                    RG:
                    <input type="number" maxlength="15" name="rgFuncionario" placeholder="CPF do Funcionário" required> <!-- Está solicitando ao cadastrante, seu CPF -->
                </div>
                <div class="trabalhada">
                    Horas Trabalhadas:
                    <div class="horaTrabalhada">
                    <input type="number" name="horasTrabalhada" placeholder="Horas trabalhada no mês" class="horaTrabalhada" required> <!-- Está solicitando ao cadastrante, quantas horas ela trabalha no mês -->
                    </div>
                </div>
                <div class="renda">
                    Renda por Hora Trabalhada:
                    <input type="number" name='recebePerhora' placeholder="Quanto você recebe por hora?" required> <!-- Está solicitando ao cadastrante, quanto ele recebe por hora -->
                </div>
                <div>
                    Insira seu currículo:
                    <input type="file" name="arquivo" required>
                </div>
                <div>
                    <input type="submit" name="cadastro" value="Cadastrar">
                </div>
            </div>
    </fieldset>
    </form>

    <?php

    if ($_SERVER["REQUEST_METHOD"] == 'POST') { // Este if está solicitando o método POST (puxando as info do HTML)
        $nomeF = $_POST["nomeFuncionario"];
        $emailF = $_POST["emailFuncionario"];
        $telF = $_POST["telFuncionario"];
        $rgF = $_POST["rgFuncionario"];
        $horaF = $_POST["horasTrabalhada"];
        $ganhoF = $_POST["recebePerhora"];


        
        
        $pasta_destino = "pasta/";
        $curriculo = $_FILES["arquivo"];
        $toDoc = "$nomeF | $emailF | $telF | $rgF | $horaF | $ganhoF | $curriculo \n"; // Esse $toDoc é o nome da variável que vai jogar as info pro documento que eu pedir exemplo (Roberto Fagundes | robertolover@gmail.com | 4002-8922 | 444.444.333-22 | etc)  
        file_put_contents("arquivos/registroFuncionario.txt", $toDoc, FILE_APPEND);
        
        if($curriculo["error"] === UPLOAD_ERR_OK) {
            $nome_temp = $curriculo["tmp_name"];
            $nome_final = $pasta_destino . basename($curriculo["name"]);
            
            if(!file_exists($pasta_destino)) {
                mkdir($pasta_destino, 0755, true); //Cria pasta se não existir
            }
            
            if (move_uploaded_file($nome_temp, $nome_final)) {
                echo "Arquivo enviado com sucesso!";
            } else {
                echo "Falha ao mover o arquivo.";
            }
        } else {
            echo "✖️ erro ao fazer upload";
        }
    }

    
       
    
    ?>
</body>

</html>