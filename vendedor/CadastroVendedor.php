<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estilo/cadastro.css">
    <link rel="shortcut icon" href="icones/oie_7TZtpCUaslPH.jpg" type="image/x-icon">
    <script src="../scripts/mascaras.js"></script>
    <title>Timeup - cadastro</title>
</head>
<body>
    <?php
    require_once("../Dados.php");
    require_once("../BDConector.php");
    require_once("../Utilidades.php");
    session_start();
        
    function AllVarsSet(){
        $res = true;
        $errMsg = "Erro no preenchimento do formulário de cadastro\\n";
        if(!isset($_POST["nome"]) || strlen($_POST["nome"]) <= 0){
            $errMsg .= "O campo 'Nome' não está válido\\n";
            $res = false;
        }
        if(!isset($_POST["cnpj"]) || strlen($_POST["cnpj"]) != 18 || !ValidarCNPJ($_POST["cnpj"])){
            $errMsg .= "O campo 'CNPJ' não está válido\\n";
            $res = false;
        }
        if(!isset($_POST["email"]) || strlen($_POST["email"]) <= 0 || !ValidarEmail()){
            $errMsg .= "O campo 'Email' não está válido\\n";
            $res = false;
        }
        if(!isset($_POST["senha"]) || strlen($_POST["senha"]) <= 0){
            $errMsg .= "O campo 'Senha' não está válido\\n";
            $res = false;
        }
        if(!isset($_POST["rua"]) || strlen($_POST["rua"]) <= 0){
            $errMsg .= "O campo 'Rua' não está válido\\n";
            $res = false;
        }
        if(!isset($_POST["numero"]) || strlen($_POST["numero"]) <= 0){
            $errMsg .= "O campo 'Número' não está válido\\n";
            $res = false;
        }
        if(!$res)
            JSAlert($errMsg);
        
        return $res;
    }

    if(isset($_SESSION["dadosVendedor"]) && strlen($_SESSION["dadosVendedor"]->CNPJ) == 18){
        header("Location: PerfilVendedor.php");
        exit();
    }

    if(isset($_POST["cadastrar"])){
        if(AllVarsSet())
            Cadastrar();
        else JSAlert("Todos os campos devem estar validamente preenchidos para que o cadastro seja realizado");
    }

    function Cadastrar(){
        if(BDVendedorExiste($_POST["cnpj"])){
            JSAlert("Usuário já existe, faça login");
            return;
        }

        $dadosVendedor = new ObjVendedor();
        $dadosVendedor->Nome = $_POST["nome"];
        $dadosVendedor->CNPJ = $_POST["cnpj"];
        $dadosVendedor->Email = $_POST["email"];
        $dadosVendedor->Senha = $_POST["senha"];
        $dadosVendedor->Rua = $_POST["rua"];
        $dadosVendedor->Numero = $_POST["numero"];
        if(!BDRegistrarVendedor($dadosVendedor)){
            JSAlert("Houve um erro na hora do cadastro, tente novamente");
            return;
        }

        $_SESSION["dadosVendedor"] = $dadosVendedor;
        header("Location: PerfilVendedor.php");
        exit();
    }
    ?>

    <nav>
        <a href="../index.html" class="time">Timeup</a>
    </nav>
    <div class="painel-cadastro">
        <div class="cadastro">
            <form class="card-cadastro" method="post">
                <h1>Cadastro</h1>
                <div class="textfield">
                    <label for="nome">Nome</label>
                    <input type="text" name="nome" maxlength="50" value="<?php echo(isset($_SESSION["dadosVendedor"]) ? $_SESSION["dadosVendedor"]->Nome : '')?>" placeholder="Nome">
                </div>
                <div class="textfield">
                    <label for="cnpj">CNPJ</label>
                    <input type="text" name="cnpj" maxlength="18" value="<?php echo(isset($_SESSION["dadosVendedor"]) ? $_SESSION["dadosVendedor"]->CNPJ : '')?>" placeholder="11.222.333/4444-55" oninput="MascaraCNPJ(this)">
                </div>
                <div class="textfield">
                    <label for="email">Email</label>
                    <input type="email" name="email" maxlength="50" value="<?php echo(isset($_SESSION["dadosVendedor"]) ? $_SESSION["dadosVendedor"]->Email : '')?>" placeholder="Email">
                </div>
                <div class="textfield">
                    <label for="senha">Senha</label>
                    <input type="password" name="senha" maxlength="20" value="<?php echo(isset($_SESSION["dadosVendedor"]) ? $_SESSION["dadosVendedor"]->Senha : '')?>" placeholder="">
                </div>
                <div class="textfield">
                    <label for="rua">Rua</label>
                    <input type="text" name="rua" maxlength="30" value="<?php echo(isset($_SESSION["dadosVendedor"]) ? $_SESSION["dadosVendedor"]->Rua : '')?>" placeholder="Rua">
                </div>
                <div class="textfield">
                    <label for="numero">Numero</label>
                    <input type="number" name="numero" value="<?php echo(isset($_SESSION["dadosVendedor"]) ? $_SESSION["dadosVendedor"]->Numero : '')?>" placeholder="">
                </div>
                <button type="submit" class="btn-cadastro" name="cadastrar">cadastro</button>
            </form>
        </div>
    </div>
</body>
</html>