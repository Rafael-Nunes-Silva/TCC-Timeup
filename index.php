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
                <h1>Timeup</h1>
                <nav>
                    <a href='Produtos.php'>Produtos</a>
                    <form action='cliente/PerfilCliente.php'>
                        <input class='botaoPerfil' width='50px' height='50px' type='image' src='".ClienteFotoCaminho($_SESSION["dadosCliente"]->Nome, $_SESSION["dadosCliente"]->Foto_ID)."'></input>
                    </form>
                </nav>
            </header>");
    }
    else if(isset($_SESSION["dadosVendedor"]) && strlen($_SESSION["dadosVendedor"]->CNPJ) == 18){
        echo("<header>
                <h1>Timeup</h1>
                <nav>
                    <form action='cliente/PerfilCliente.php'>
                        <input class='botaoPerfil' width='50px' height='50px' type='image' src='".VendedorFotoCaminho($_SESSION["dadosVendedor"]->Nome, $_SESSION["dadosVendedor"]->Foto_ID)."'></input>
                    </form>
                </nav>
            </header>");
    }
    else{
        echo("<header>
                <h1>Timeup</h1>
                <nav>
                    <a href='cliente/LoginCliente.php'>Login Cliente</a>
                    <a href='cliente/CadastroCliente.php'>Cadastro Cliente</a>
                    <a href='vendedor/LoginVendedor.php'>Login Vendedor</a>
                    <a href='vendedor/CadastroVendedor.php'>Cadastro Vendedor</a>
                </nav>
            </header>");
    }
    ?>
    <!--
    <header>
        <h1>Timeup</h1>
        <nav>
            <a href="Produtos.php">Produtos</a>
            <a href="cliente/LoginCliente.php">Login Cliente</a>
            <a href="cliente/CadastroCliente.php">Cadastro Cliente</a>
            <a href="vendedor/LoginVendedor.php">Login Vendedor</a>
            <a href="vendedor/CadastroVendedor.php">Cadastro Vendedor</a>
        </nav>
    </header>
    -->
    <main>
        <div class="section">
            <h1>Timeup 100% Digital<br>economize o seu tempo</h1>
            <p>Com o Timeup Online você se torna realizador.<br>faça seu orçamento no seu ritmo e de onde estiver.</p>

            <button class="btn-attcadastro">Comece Agora</button>

        </div>
    </main>
</body>
</html>