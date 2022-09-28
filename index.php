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
    session_start();

    if(isset($_SESSION["dadosCliente"]) && strlen($_SESSION["dadosCliente"]->CPF) == 14){
        header("Location: Produtos.php");
        exit();
    }
    ?>
    <header>
        <h1>Timeup</h1>

        <nav>
            <a href="#">Inicio</a>
            <a href="#">Menu</a>
            <a href="#">Contato</a>
            <a href="cliente/LoginCliente.php">Login Cliente</a>
            <a href="cliente/CadastroCliente.php">Cadastro Cliente</a>
            <a href="vendedor/LoginVendedor.php">Login Vendedor</a>
            <a href="vendedor/CadastroVendedor.php">Cadastro Vendedor</a>
        </nav>
    </header>
    <main>
        <div class="section">
            <h1>Timeup 100% Digital <br>economize o seu tempo</h1>
            <p>Com o Timeup Online você se torna realizador.<br>faça seu orçamento no seu ritmo e de onde estiver.</p>

            <button type="submit" class="btn-attcadastro" name="attcadastro">Comece Agora</button>

        </div>
    </main>
</body>
</html>