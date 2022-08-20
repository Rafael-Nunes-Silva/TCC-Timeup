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

    if(isset($_SESSION["dadosCliente"]) && strlen($_SESSION["dadosCliente"]->CPF) == 14){
        header("Location: PerfilCliente.php");
        exit();
    }

    if(isset($_POST["cpf"]) && strlen($_POST["cpf"]) == 14 && isset($_POST["senha"]) && strlen($_POST["senha"]) > 0){
        Login();
    }
    
    function Login(){
        $cpf = $_POST["cpf"];
        $senha = $_POST["senha"];

        if(!DBClienteExiste($cpf)){
            JSAlert("Usuario portador do CPF ".$cpf." não está cadastrado<br>");
            return;
        }

        $dadosCliente = DBRecuperarCliente($cpf);

        if($dadosCliente->Senha != $senha){
            JSAlert("Senha incorreta");
            return;
        }

        $_SESSION["dadosCliente"] = $dadosCliente;
        header("Location: PerfilCliente.php");
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
                    <label for="cpf">CPF</label>
                    <input type="text" name="cpf" maxlength="14" placeholder="111.222.333-44" oninput="MascaraCPF(this)">
                </div>
                <div class="textfield">
                    <label for="senha">Senha</label>
                    <input type="password" name="senha" placeholder="Senha">
                </div>
                <button class="btn-login">Login</button>
                <p>Caso não tenha, <a href="CadastroCliente.php">clique aqui</a></p>
            </form>
        </div>
    </div>
</body>
</html>