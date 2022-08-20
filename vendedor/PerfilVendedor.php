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
    session_start();

    $dadosVendedor = $_SESSION["dadosVendedor"];
    if($dadosVendedor){
        echo("Nome: ".$dadosVendedor->Nome."<br>");
        echo("CNPJ: ".$dadosVendedor->CNPJ."<br>");
        echo("Email: ".$dadosVendedor->Email."<br>");
        echo("Senha: ".$dadosVendedor->Senha."<br>");
        echo("Rua: ".$dadosVendedor->Rua."<br>");
        echo("Número: ".$dadosVendedor->Numero."<br>");
    }

    if(isset($_POST["sair"])){
        $_SESSION["dadosVendedor"] = new ObjVendedor();
        unset($_SESSION["dadosVendedor"]);
        header("Location: ../index.html");
        exit();
    }
    ?>
    
    <nav>
        <a href="../index.html" class="time">Timeup</a>
    </nav>

    <nav>
        <a href="AttCadastroVendedor.php">Atualizar Cadastro</a>
        <a href="AttSenhaVendedor.php">Mudar Senha</a>
        <a href="DelCadastroVendedor.php">Deletar Cadastro</a>
    </nav>
    <form method="post">
        <button type="submit" class="btn-sair" name="sair">Sair</button>
    </form>
</body>
</html>