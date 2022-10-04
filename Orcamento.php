<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo/produtosEstilo.css">
    <link rel="shortcut icon" href="icones/oie_7TZtpCUaslPH.jpg" type="image/x-icon">
    <title>Timeup</title>
</head>
<body>
    <?php
    require_once("Dados.php");
    require_once("BDConector.php");
    session_start();

    if(isset($_SESSION["dadosCliente"]) && strlen($_SESSION["dadosCliente"]->CPF) == 14 && isset($_SESSION["dadosOrcamento"])){
        /* mostrar o orçamento
        echo("<header>
                <a href='../index.php' class='time'>Timeup</a>
                <nav>
                    <a href='index.php'>Inicio</a>
                    <a href='#'>Menu</a>
                    <a href='#'>Contato</a>
                    <a href='cliente/PerfilCliente.php'>".$_SESSION["dadosCliente"]->Nome."</a>
                </nav>
            </header>
            <main>");
        $produtos = BDListarProdutos();
        for ($i = 0; $i < count($produtos); $i++){
            $dadosVendedor = BDRecuperarVendedorID($produtos[$i]->Vendedor_ID);
            echo("<div class='produto' type='button' onclick='clicado(".$produtos[$i]->ID."-1)'>
                <img src='../uploads/produto/".$dadosVendedor->Nome."/".$produtos[$i]->Nome."/".BDRecuperarFoto($produtos[$i]->Foto_ID)."' width='200px' height='200px'>
                <p class='produto_nome'>".$produtos[$i]->Nome."</p>
                <p class='produto_valor'>R$ ".$produtos[$i]->Valor."</p>
                <p class='produto_vendedor'>".$dadosVendedor->Nome."</p>
                </div>");   
        }
        */
        echo("<form method='post'>
                <button type='submit' name='fazer-orcamento'>Orçamento</button>
            </form>");
        echo("</main>");
    }
    else{
        header("Location: index.php");
        exit();
    }
    
    if(isset($_POST["salvar-orcamento"])){
        
        header("Location: Orcamento.php");
        exit();
    }
    ?>
    <header>
        <a href="../index.php" class="time">Timeup</a>

        <nav>
            <a href="#">Inicio</a>
            <a href="#">Menu</a>
            <a href="#">Contato</a>
        </nav>
    </header>
    <main>
        <div class="produto" type="button" onclick="alert('Tijolo')">
            <img src="" width="200px" height="200px">
            <p class="produto_nome">Tijolo</p>
            <p class="produto_valor">R$ Valor</p>
            <p class="produto_vendedor">Vendedor</p>
        </div>
    </main>
</body>
</html>