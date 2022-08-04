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
        echo($dadosUsuario->usuario);
        echo($dadosUsuario->data_nascimento);
        echo($dadosUsuario->cpf);
        echo($dadosUsuario->telefone);
        echo($dadosUsuario->email);
        echo($dadosUsuario->senha);
        echo($dadosUsuario->rua);
        echo($dadosUsuario->numero);
    ?>
    
    <nav>
        <a href="index.html" class="time">Timeup</a>
    </nav>
    <h1>Update Perfil</h1>
    
</body>
</html>