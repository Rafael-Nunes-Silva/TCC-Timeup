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

        if(!BDClienteExiste($cpf)){
            JSAlert("Usuario portador do CPF ".$cpf." não está cadastrado<br>");
            return;
        }

        $dadosCliente = BDRecuperarCliente($cpf);

        if($dadosCliente->Senha != $senha){
            JSAlert("Senha incorreta");
            return;
        }

        $_SESSION["dadosCliente"] = $dadosCliente;
        header("Location: PerfilCliente.php");
        exit();
    }
    ?>
    <header>
        <a class="Title" href="../index.php">TimeUp</a>
    </header>
    <form class="loginForm" method="post">
        <h1 style="color: white;">LOGIN</h1>
        <div class="textfield">
            <label for="cpf">CPF</label><br>
            <input type="text" name="cpf" maxlength="14" placeholder="111.222.333-44" oninput="MascaraCPF(this)">
        </div>
        <div class="textfield">
            <label for="senha">Senha</label><br>
            <input type="password" name="senha" placeholder="Senha">
        </div>
        <button class="Button">Login</button>
        <p>Caso não tenha, <a href="CadastroCliente.php">clique aqui</a></p>
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