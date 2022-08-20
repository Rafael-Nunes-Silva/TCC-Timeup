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
    require_once("../Utilidades.php");
    session_start();
        
    function AllVarsSet(){
        $res = true;
        $errMsg = "Erro no preenchimento do formulário de cadastro\\n";
        if(!isset($_POST["nome"]) || strlen($_POST["nome"]) <= 0){
            $errMsg .= "O campo 'Nome' não está válido\\n";
            $res = false;
        }
        if(!isset($_POST["data_nascimento"])){
            $errMsg .= "O campo 'data de nascimento' não está válido\\n";
            $res = false;
        }
        if(!isset($_POST["cpf"]) || strlen($_POST["cpf"]) != 14 || !ValidarCPF($_POST["cpf"])){
            $errMsg .= "O campo 'CPF' não está válido\\n";
            $res = false;
        }
        if(!isset($_POST["telefone"]) || strlen($_POST["telefone"]) != 13 || !ValidarTelefone()){
            $errMsg .= "O campo 'Telefone' não está válido\\n";
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

    if(isset($_SESSION["dadosCliente"]) && strlen($_SESSION["dadosCliente"]->CPF) == 14){
        header("Location: PerfilCliente.php");
        exit();
    }

    if(isset($_POST["cadastrar"])){
        if(AllVarsSet())
            Cadastrar();
        else JSAlert("Todos os campos devem estar validamente preenchidos para que o cadastro seja realizado");
    }

    function Cadastrar(){
        if(DBClienteExiste($_POST["cpf"])){
            JSAlert("Usuário já existe, faça login");
            header("Location: LoginCliente.php");
            exit();
        }

        $dadosCliente = new ObjCliente();
        $dadosCliente->Nome = $_POST["nome"];
        $dadosCliente->Data_Nascimento = $_POST["data_nascimento"];
        $dadosCliente->CPF = $_POST["cpf"];
        $dadosCliente->Telefone = $_POST["telefone"];
        $dadosCliente->Email = $_POST["email"];
        $dadosCliente->Senha = $_POST["senha"];
        $dadosCliente->Rua = $_POST["rua"];
        $dadosCliente->Numero = $_POST["numero"];
        $_SESSION["dadosCliente"] = $dadosCliente;

        if(!DBRegistrarCliente($dadosCliente)){
            JSAlert("Houve um erro na hora do cadastro, tente novamente");
            return;
        }

        header("Location: PerfilCliente.php");
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
                    <input type="text" name="nome" maxlength="50" value="<?php echo(isset($_SESSION["dadosCliente"]) ? $_SESSION["dadosCliente"]->Nome : '')?>" placeholder="Nome">
                </div>
                <div class="textfield">
                    <label for="data_nascimento">Data de Nascimento</label>
                    <input type="date" name="data_nascimento" value="<?php echo(isset($_SESSION["dadosCliente"]) ? $_SESSION["dadosCliente"]->Data_Nascimento : '')?>" placeholder="dd/mm/aaaa">
                </div>
                <div class="textfield">
                    <label for="cpf">CPF</label>
                    <input type="text" name="cpf" maxlength="14" value="<?php echo(isset($_SESSION["dadosCliente"]) ? $_SESSION["dadosCliente"]->CPF : '')?>" placeholder="111.222.333-44" onload="ReporCPF(this)" oninput="MascaraCPF(this)">
                </div>
                <div class="textfield">
                    <label for="telefone">Telefone</label>
                    <input type="text" name="telefone" maxlength="13" value="<?php echo(isset($_SESSION["dadosCliente"]) ? $_SESSION["dadosCliente"]->Telefone : '')?>" placeholder="10 12345-6789" oninput="MascaraTelefone(this)">
                </div>
                <div class="textfield">
                    <label for="email">Email</label>
                    <input type="email" name="email" maxlength="50" value="<?php echo(isset($_SESSION["dadosCliente"]) ? $_SESSION["dadosCliente"]->Email : '')?>" placeholder="Email">
                </div>
                <div class="textfield">
                    <label for="senha">Senha</label>
                    <input type="password" name="senha" maxlength="20" value="<?php echo(isset($_SESSION["dadosCliente"]) ? $_SESSION["dadosCliente"]->Senha : '')?>" placeholder="">
                </div>
                <div class="textfield">
                    <label for="rua">Rua</label>
                    <input type="text" name="rua" maxlength="30" value="<?php echo(isset($_SESSION["dadosCliente"]) ? $_SESSION["dadosCliente"]->Rua : '')?>" placeholder="Rua">
                </div>
                <div class="textfield">
                    <label for="numero">Numero</label>
                    <input type="number" name="numero" value="<?php echo(isset($_SESSION["dadosCliente"]) ? $_SESSION["dadosCliente"]->Numero : '')?>" placeholder="">
                </div>
                <button type="submit" class="btn-cadastro" name="cadastrar">cadastro</button>
            </form>
        </div>
    </div>
</body>
</html>