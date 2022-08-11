<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo/login.css">
    <link rel="shortcut icon" href="icones/oie_7TZtpCUaslPH.jpg" type="image/x-icon">
    <title>Timeup - Login</title>
</head>
<body>
    <?php
    require_once("dados.php");
    require_once("utilidades.php");
    session_start();

    if(isset($_POST["nome"]) && strlen($_POST["nome"]) > 0 && isset($_POST["senha"]) && strlen($_POST["senha"]) > 0){
        $nome = $_POST["nome"];
        $senha = $_POST["senha"];

        if(!DBCadastroExiste($nome)){
            JSAlert("Usuario ".$nome." não esta cadastrado<br>");
            exit();
        }

        $dadosUsuario = DBRecuperarUsuario($nome);

        if($dadosUsuario->Senha != $senha){
            JSAlert("Senha incorreta");
            exit();
        }

        $_SESSION["dadosUsuario"] = $dadosUsuario;
        header("Location: perfil.php");
        exit();
    }
    ?>
    
    <nav>
        <a href="index.html" class="time">Timeup</a>
    </nav>
    <div class="painel-login">
        <div class="esquerda-login">
            <h1>Faça login<br>E entre para o nosso site</h1>
            <img src="estilo/ecommerce-campaign-animate.svg" class="esquerda-login-image" alt="logo">
        </div>
        <div class="direita-login">
            <form class="card-login" method="post">
                <h1>LOGIN</h1>
                <div class="textfield">
                    <label for="nome">Nome</label>
                    <input type="text" name="nome" placeholder="Nome">
                </div>
                <div class="textfield">
                    <label for="senha">Senha</label>
                    <input type="password" name="senha" placeholder="Senha">
                </div>
                <button class="btn-login">Login</button>
            </form>
        </div>
    </div>
</body>
</html>