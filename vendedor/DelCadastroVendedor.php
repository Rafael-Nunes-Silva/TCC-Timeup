<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estilo/cadastroEstilo.css">
    <link rel="shortcut icon" href="icones/oie_7TZtpCUaslPH.jpg" type="image/x-icon">
    <title>Timeup - Atualizar Informações</title>
</head>
<body>
    <?php
    require_once("../Dados.php");
    require_once("../BDConector.php");
    require_once("../Utilidades.php");
    session_start();
    
    if(isset($_POST["delcadastro"])){
        $dadosVendedor = $_SESSION["dadosVendedor"];

        if($_POST["senha"] != $dadosVendedor->Senha){
            JSAlert("A senha está incorreta");
            exit();
        }
        
        BDDeletarVendedor($dadosVendedor->CNPJ);

        $dadosVendedor->Nome = "";
        $dadosVendedor->Data_Nascimento = "";
        $dadosVendedor->CPF = "";
        $dadosVendedor->Telefone = "";
        $dadosVendedor->Email = "";
        $dadosVendedor->Senha = "";
        $dadosVendedor->Rua = "";
        $dadosVendedor->Numero = "";
        
        header("Location: ../index.php");
        exit();
    }
    ?>

    <div class="painel-cadastro">
        <div class="cadastro">
            <form class="card-cadastro" method="post">
                <a href="PerfilVendedor.php">Deletar Cadastro</a>
                <p>Tem certeza que deseja deletar seu cadastro?</p>
                <div class="textfield">
                    <label for="senha">Senha Atual</label>
                    <input type="password" name="senha" placeholder="Senha">
                </div>
                <button type="submit" class="btn-delcadastro" name="delcadastro">Deletar</button>
            </form>
        </div>
    </div>
</body>
</html>