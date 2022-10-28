<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo/indexEstilo.css">
    <link rel="shortcut icon" href="icones/oie_7TZtpCUaslPH.jpg" type="image/x-icon">
    <title>Timeup</title>
</head>
<body>
    <?php
    require_once("Dados.php");
    require_once("Utilidades.php");
    session_start();
    
    if(isset($_SESSION["dadosCliente"]) && strlen($_SESSION["dadosCliente"]->CPF) == 14){
        echo("<header>
                <h1 class='Title'>TimeUp</h1>
                <nav>
                    <a class='Button' href='Produtos.php'>Produtos</a>
                    <a class='ImageButton' href='cliente/PerfilCliente.php'><img src='".ClienteFotoCaminho($_SESSION["dadosCliente"]->Nome, $_SESSION["dadosCliente"]->Foto_ID)."'></a>
                </nav>
            </header>");
    }
    else if(isset($_SESSION["dadosVendedor"]) && strlen($_SESSION["dadosVendedor"]->CNPJ) == 18){
        echo("<header>
                <h1 class='Title'>TimeUp</h1>
                <a class='ImageButton' href='vendedor/PerfilVendedor.php'><img src='".VendedorFotoCaminho($_SESSION["dadosVendedor"]->Nome, $_SESSION["dadosVendedor"]->Foto_ID)."'></a>
            </header>");
    }
    else{
        echo("<header>
                <h1 class='Title'>TimeUp</h1>
                <nav>
                    <a class='Button' href='cliente/LoginCliente.php'>Login Cliente</a>
                    <a class='Button' href='cliente/CadastroCliente.php'>Cadastro Cliente</a>
                    <a class='Button' href='vendedor/LoginVendedor.php'>Login Vendedor</a>
                    <a class='Button' href='vendedor/CadastroVendedor.php'>Cadastro Vendedor</a>
                </nav>
            </header>");
    }
    ?>
    <div class="logoPanel">
        <h1>Timeup 100% Digital<br>economize o seu tempo aqui</h1>
        <img src="../estilo/Logo.png">
        <p>Com o Timeup Online você faz orçamentos de forma fácil e rápida.<br>Faça seu orçamento no seu ritmo e de onde estiver.</p>
    </div>
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