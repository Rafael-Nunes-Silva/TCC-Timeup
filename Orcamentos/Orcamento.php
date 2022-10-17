<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estilo/produtosEstilo.css">
    <link rel="shortcut icon" href="icones/oie_7TZtpCUaslPH.jpg" type="image/x-icon">
    <title>Timeup</title>
</head>
<body>
    <?php
    require_once("../Dados.php");
    require_once("../BDConector.php");
    session_start();

    if(isset($_SESSION["dadosCliente"]) && strlen($_SESSION["dadosCliente"]->CPF) == 14 && isset($_SESSION["dadosOrcamento"])){
        echo("<a href='../index.php' class='time'>Timeup</a>
            <nav>
                <a href='#'>Inicio</a>
                <a href='#'>Menu</a>
                <a href='#'>Contato</a>
                <form action='../cliente/PerfilCliente.php'>
                    <input class='botaoPerfil' width='50px' height='50px' type='image' src='".ClienteFotoCaminho($_SESSION["dadosCliente"]->Nome, $_SESSION["dadosCliente"]->Foto_ID)."'></input>
                </form>
            </nav>
            <main>
                <div class='orcamento'>
                    <p class='orcamento_nome'>".$_SESSION["dadosOrcamento"]->Nome."</p>");
        foreach($_SESSION["dadosOrcamento"]->Produtos_IDs as $id){
            $produto = BDRecuperarProduto($id);
            // ProdutoFotoCaminho($VendedorNome, $ProdutoNome, $ProdutoFoto_ID)
            echo("<div class='produto'>
                    <img class='produto_img' width='50px' height='50px' src='".ProdutoFotoCaminho(BDRecuperarVendedorID($produto->Vendedor_ID)->Nome, $produto->Nome, $produto->Foto_ID)."'>
                    <p class='produto_nome'>".$produto->Nome."</p>
                    <p class='produto_valor' value='".$produto->Valor."'>R$ ".$produto->Valor."</p>
                </div>");
        }
                    
                    
        echo("</main>");
    }
    ?>
    <!--
    <header>
        <a href="../index.php" class="time">Timeup</a>

        <nav>
            <a href="#">Inicio</a>
            <a href="#">Menu</a>
            <a href="#">Contato</a>
        </nav>
    </header>
    <main>
        <div>
            <p>Total: R$ 0,00</p>
            <p>Nome: Teste</p>
        </div>
    </main>
    -->
</body>
</html>