<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estilo/perfilEstilo.css">
    <link rel="shortcut icon" href="icones/oie_7TZtpCUaslPH.jpg" type="image/x-icon">
    
    <title>Timeup - Perfil</title>
</head>
<body>
    <?php
    require_once("../Dados.php");
    require_once("../BDConector.php");
    require_once("../Utilidades.php");
    session_start();

    $dadosCliente = $_SESSION["dadosCliente"];
    if($dadosCliente){
        echo("
            <nav>
                <a href='../index.php' class='time'>Timeup</a>
            </nav>
            <div class='label'>
                <img src='../uploads/cliente/".$dadosCliente->Nome."/foto_perfil/".BDRecuperarFoto($dadosCliente->Foto_ID)."' id='foto' height='300px' width='300px'>
                <h2 id='nome'>Nome: $dadosCliente->Nome</h2>
                <h2 id='data'>Data de Nascimento: $dadosCliente->Data_Nascimento</h2>
                <h2 id='cpf'>CPF: $dadosCliente->CPF</h2>
                <h2 id='telefone'>Telefone: $dadosCliente->Telefone</h2>
                <h2 id='email'>Email: $dadosCliente->Email</h2>
                <h2 id='rua'>Rua: $dadosCliente->Rua</h2>
                <h2 id='numero'>Número: $dadosCliente->Numero</h2>
            </div>
        ");
    }
    else{
        $_SESSION["dadosCliente"] = null;
        unset($_SESSION["dadosCliente"]);
        header("Location: LoginCliente.php");
        exit();
    }

    if(isset($_POST["sair"])){
        $_SESSION["dadosCliente"] = null;
        unset($_SESSION["dadosCliente"]);
        header("Location: ../index.php");
        exit();
    }
    ?>
    <!--
    <nav>
        <a href="../index.html" class="time">Timeup</a>
    </nav>
    <div class="label">
        <img src="" alt="" id="foto" height='400px' width='400px'>
        <h2 id="nome">label</h2>
        <h2 id="data">label</h2>
        <h2 id="cpf">label</h2>
        <h2 id="telefone">label</h2>
        <h2 id="email">label</h2>
        <h2 id="rua">label</h2>
        <h2 id="numero">label</h2>
    </div>
    <div class="nav"> 
    -->
    <nav>
        <a href="AttCadastroCliente.php">Atualizar Cadastro</a>
        <a href="AttSenhaCliente.php">Mudar Senha</a>
        <a href="DelCadastroCliente.php">Deletar Cadastro</a>
    </nav>
    </div>
    <form method="post">
        <button type="submit" class="btn-sair" name="sair">Sair</button>
    </form>
</body>
</html>