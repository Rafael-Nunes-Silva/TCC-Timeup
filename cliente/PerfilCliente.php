<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo/perfil.css">
    <link rel="shortcut icon" href="icones/oie_7TZtpCUaslPH.jpg" type="image/x-icon">
    <title>Timeup - Perfil</title>
</head>
<body>
    <?php
    require_once("dados.php");
    session_start();

    $dadosUsuario = $_SESSION["dadosUsuario"];
    if($dadosUsuario){
        echo("Nome: ".$dadosUsuario->Nome."<br>");
        echo("Data de Nascimento: ".$dadosUsuario->Data_Nascimento."<br>");
        echo("CPF: ".$dadosUsuario->CPF."<br>");
        echo("Telefone: ".$dadosUsuario->Telefone."<br>");
        echo("Email: ".$dadosUsuario->Email."<br>");
        echo("Senha: ".$dadosUsuario->Senha."<br>");
        echo("Rua: ".$dadosUsuario->Rua."<br>");
        echo("Número: ".$dadosUsuario->Numero."<br>");
    }
    ?>
    
    <nav>
        <a href="index.html" class="time">Timeup</a>
    </nav>

    <nav>
        <a href="attcadastro.php">Atualizar Cadastro</a>
        <a href="attsenha.php">Mudar Senha</a>
        <a href="delcadastro.php">Deletar Cadastro</a>
    </nav>
    
</body>
</html>
