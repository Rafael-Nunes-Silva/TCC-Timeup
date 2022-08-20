<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estilo/login.css">
    <link rel="shortcut icon" href="icones/oie_7TZtpCUaslPH.jpg" type="image/x-icon">
    <script src="../scripts/mascaras.js"></script>
    <title>Timeup - Login</title>
</head>
<body>
    <?php
    require_once("../Dados.php");
    require_once("../Utilidades.php");
    session_start();

    if($_SESSION["dadosVendedor"] && strlen($_SESSION["dadosVendedor"]->CNPJ) == 18){
        header("Location: PerfilVendedor.php");
        exit();
    }

    if(isset($_POST["cnpj"]) && strlen($_POST["cnpj"]) == 18 && isset($_POST["senha"]) && strlen($_POST["senha"]) > 0){
        $cnpj = $_POST["cnpj"];
        $senha = $_POST["senha"];

        if(!DBVendedorExiste($cnpj)){
            JSAlert("O CNPJ ".$cnpj." não esta cadastrado<br>");
            return;
        }

        $dadosVendedor = DBRecuperarVendedor($cnpj);

        if($dadosVendedor->Senha != $senha){
            JSAlert("Senha incorreta");
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
    <div class="painel-login">
        <div class="esquerda-login">
            <h1>Faça login<br>E entre para o nosso site</h1>
            <img src="../estilo/ecommerce-campaign-animate.svg" class="esquerda-login-image" alt="logo">
        </div>
        <div class="direita-login">
            <form class="card-login" method="post">
                <h1>LOGIN</h1>
                <div class="textfield">
                    <label for="cnpj">CNPJ</label>
                    <input type="text" name="cnpj" placeholder="11.222.333/4444-55" oninput="MascaraCNPJ(this)">
                </div>
                <div class="textfield">
                    <label for="senha">Senha</label>
                    <input type="password" name="senha" placeholder="">
                </div>
                <button class="btn-login">Login</button>
                <p>Caso não tenha, <a href="CadastroVendedor.php">clique aqui</a></p>
            </form>
        </div>
    </div>
</body>
</html>