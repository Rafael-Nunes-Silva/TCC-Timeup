<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estilo/cadastroEstilo.css">
    <link rel="shortcut icon" href="icones/oie_7TZtpCUaslPH.jpg" type="image/x-icon">
    <script src="../scripts/mascaras.js"></script>
    <title>Timeup - cadastro cliente</title>
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
        if($_FILES["foto"]["size"] == 0 || $_FILES["foto"]["error"] != 0){
            $errMsg .= "O campo 'Foto' não está válido\\n";
            $res = false;
        }
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
        if(BDClienteExiste($_POST["cpf"])){
            JSAlert("Usuário já existe, faça login");
            header("Location: LoginCliente.php");
            exit();
        }

        $fotoID = BDRegistrarFoto(basename($_FILES["foto"]["name"]), $_FILES["foto"]["tmp_name"], "../uploads/cliente/".$_POST["nome"]."/foto_perfil/");
        if($fotoID == 0){
            JSAlert("Erro ao inserir foto no banco de dados");
            return;
        }

        $dadosCliente = new ObjCliente();
        $dadosCliente->Foto_ID = $fotoID;
        $dadosCliente->Nome = $_POST["nome"];
        $dadosCliente->Data_Nascimento = $_POST["data_nascimento"];
        $dadosCliente->CPF = $_POST["cpf"];
        $dadosCliente->Telefone = $_POST["telefone"];
        $dadosCliente->Email = $_POST["email"];
        $dadosCliente->Senha = $_POST["senha"];
        $dadosCliente->Rua = $_POST["rua"];
        $dadosCliente->Numero = $_POST["numero"];
        $_SESSION["dadosCliente"] = $dadosCliente;

        if(!BDRegistrarCliente($dadosCliente)){
            JSAlert("Houve um erro na hora do cadastro, tente novamente");
            return;
        }

        header("Location: PerfilCliente.php");
        exit();
    }
    ?>
    <header>
        <a class="Title" href="../index.php">TimeUp</a>
    </header>
    <form class="cadForm" method="post" enctype="multipart/form-data">
        <h1 style="color: white;">Cadastro</h1>
        <div class="textfield">
            <label for="foto">Foto</label><br>
            <input type="file" name="foto" accept="image/*">
        </div>
        <div class="textfield">
            <label for="nome">Nome</label><br>
            <input type="text" name="nome" maxlength="50" value="<?php echo(isset($_SESSION["dadosCliente"]) ? $_SESSION["dadosCliente"]->Nome : '')?>" placeholder="Nome">
        </div>
        <div class="textfield">
            <label for="data_nascimento">Data de Nascimento</label><br>
            <input type="date" name="data_nascimento" value="<?php echo(isset($_SESSION["dadosCliente"]) ? $_SESSION["dadosCliente"]->Data_Nascimento : '')?>" placeholder="dd/mm/aaaa">
        </div>
        <div class="textfield">
            <label for="cpf">CPF</label><br>
            <input type="text" name="cpf" maxlength="14" value="<?php echo(isset($_SESSION["dadosCliente"]) ? $_SESSION["dadosCliente"]->CPF : '')?>" placeholder="111.222.333-44" onload="ReporCPF(this)" oninput="MascaraCPF(this)">
        </div>
        <div class="textfield">
            <label for="telefone">Telefone</label><br>
            <input type="text" name="telefone" maxlength="13" value="<?php echo(isset($_SESSION["dadosCliente"]) ? $_SESSION["dadosCliente"]->Telefone : '')?>" placeholder="10 12345-6789" oninput="MascaraTelefone(this)">
        </div>
        <div class="textfield">
            <label for="email">Email</label><br>
            <input type="email" name="email" maxlength="50" value="<?php echo(isset($_SESSION["dadosCliente"]) ? $_SESSION["dadosCliente"]->Email : '')?>" placeholder="Email">
        </div>
        <div class="textfield">
            <label for="senha">Senha (minimo 8 caracteres)</label><br>
            <input type="password" name="senha" maxlength="20" value="<?php echo(isset($_SESSION["dadosCliente"]) ? $_SESSION["dadosCliente"]->Senha : '')?>" placeholder="">
        </div>
        <div class="textfield">
            <label for="rua">Rua</label><br>
            <input type="text" name="rua" maxlength="100" value="<?php echo(isset($_SESSION["dadosCliente"]) ? $_SESSION["dadosCliente"]->Rua : '')?>" placeholder="Rua">
        </div>
        <div class="textfield">
            <label for="numero">Numero</label><br>
            <input type="number" name="numero" value="<?php echo(isset($_SESSION["dadosCliente"]) ? $_SESSION["dadosCliente"]->Numero : '')?>" placeholder="">
        </div>
        <button type="submit" class="Button" name="cadastrar">cadastro</button>
    </form>
    <footer>
        <div>
            <label for="devs">Desenvolvedores</label>
            <ul name="devs">
                <li><a href="https://github.com/Rafael-Nunes-Silva">Rafael Nunes de Farias Silva</a></li>
                <li><a href="https://github.com/Lincolnlau12">Lincoln Emanuel Rangel dos Santos</a></li>
                <li><a href="https://github.com/Rodrianjos">Rodrigo Ezequiel Silva dos Anjos</a></li>
                <li><a href="https://github.com/mauricio-goulart">Mauricio Azevedo Goulart</a></li>
            </ul>
        </div>
    </footer>
</body>
</html>