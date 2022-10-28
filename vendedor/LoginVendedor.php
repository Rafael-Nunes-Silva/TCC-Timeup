<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estilo/loginEstilo.css">
    <link rel="shortcut icon" href="icones/oie_7TZtpCUaslPH.jpg" type="image/x-icon">
    <script src="../scripts/mascaras.js"></script>
    <title>Timeup - Login</title>
</head>
<body>
    <?php
    require_once("../Dados.php");
    require_once("../BDConector.php");
    require_once("../Utilidades.php");
    session_start();

    if(isset($_SESSION["dadosVendedor"]) && strlen($_SESSION["dadosVendedor"]->CNPJ) == 18){
        header("Location: PerfilVendedor.php");
        exit();
    }

    if(isset($_POST["cnpj"]) && strlen($_POST["cnpj"]) == 18 && isset($_POST["senha"]) && strlen($_POST["senha"]) > 0){
        Login();
    }

    function Login(){
        $cnpj = $_POST["cnpj"];
        $senha = $_POST["senha"];

        if(!BDVendedorExiste($cnpj)){
            JSAlert("O CNPJ ".$cnpj." não esta cadastrado<br>");
            return;
        }

        $dadosVendedor = BDRecuperarVendedor($cnpj);

        if($dadosVendedor->Senha != $senha){
            JSAlert("Senha incorreta");
            return;
        }

        $_SESSION["dadosVendedor"] = $dadosVendedor;
        header("Location: PerfilVendedor.php");
        exit();
    }
    ?>
    <header>
        <a class="Title" href="../index.php">TimeUp</a>
    </header>
    <form class="loginForm" method="post">
        <h1 style="color: white;">LOGIN</h1>
        <div class="textfield">
            <label for="cnpj">CNPJ</label><br>
            <input type="text" name="cnpj" maxlength="18" placeholder="11.222.333/4444-55" oninput="MascaraCNPJ(this)">
        </div>
        <div class="textfield">
            <label for="senha">Senha</label><br>
            <input type="password" name="senha" placeholder="">
        </div>
        <button class="Button">Login</button>
        <p>Caso não tenha, <a href="CadastroVendedor.php">clique aqui</a></p>
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