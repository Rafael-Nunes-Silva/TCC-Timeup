<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo/updatePerfil.css">
    <link rel="shortcut icon" href="icones/oie_7TZtpCUaslPH.jpg" type="image/x-icon">
    <title>Timeup - Atualização de Perfil</title>
</head>
<body>
    <?php
        require_once("dados.php");

        // Teste: passando dados de usuário entre páginas com $_SESSION
        session_start();
        $dadosUsuario = $_SESSION["userData"];
        echo($dadosUsuario->Nome."<br>");
        echo($dadosUsuario->Data_Nascimento."<br>");
        echo($dadosUsuario->CPF."<br>");
        echo($dadosUsuario->Telefone."<br>");
        echo($dadosUsuario->Email."<br>");
        echo($dadosUsuario->Senha."<br>");
        echo($dadosUsuario->Rua."<br>");
        echo($dadosUsuario->Numero."<br>");
        ////////////////////////////////////////////////
    ?>
    
    <nav>
        <a href="index.html" class="time">Timeup</a>
    </nav>
    <h1>Update Perfil</h1>
    
</body>
</html>