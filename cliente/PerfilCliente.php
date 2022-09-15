<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estilo/perfil.css">
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
        echo("Foto: <img src='../uploads/cliente/".$dadosCliente->Nome."/foto_perfil/".BDRecuperarFoto($dadosCliente->Foto)."' height='200px' width='200px'><br>");
        echo("Nome: ".$dadosCliente->Nome."<br>");
        echo("Data de Nascimento: ".$dadosCliente->Data_Nascimento."<br>");
        echo("CPF: ".FormatarCPF($dadosCliente->CPF)."<br>");
        echo("Telefone: ".FormatarTelefone($dadosCliente->Telefone)."<br>");
        echo("Email: ".$dadosCliente->Email."<br>");
        echo("Senha: ".$dadosCliente->Senha."<br>");
        echo("Rua: ".$dadosCliente->Rua."<br>");
        echo("Número: ".$dadosCliente->Numero."<br>");
    }

    if(isset($_POST["sair"])){
        $_SESSION["dadosCliente"] = new ObjCliente();
        unset($_SESSION["dadosCliente"]);
        header("Location: ../index.html");
        exit();
    }
    ?>
    
    <nav>
        <a href="../index.html" class="time">Timeup</a>
    </nav>

    <nav>
        <a href="AttCadastroCliente.php">Atualizar Cadastro</a>
        <a href="AttSenhaCliente.php">Mudar Senha</a>
        <a href="DelCadastroCliente.php">Deletar Cadastro</a>
    </nav>

    <form method="post">
        <button type="submit" class="btn-sair" name="sair">Sair</button>
    </form>
    
</body>
</html>