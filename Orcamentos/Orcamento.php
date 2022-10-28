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
        $total = 0;
        for($j = 0; $j < count($_SESSION["dadosOrcamento"]->Produtos_IDs); $j++){
            $total += BDRecuperarProduto($_SESSION["dadosOrcamento"]->Produtos_IDs[$j])->Valor * $_SESSION["dadosOrcamento"]->Quantidades[$j];
        }
        echo("<header>
                <a class='Title' href='../index.php'>TimeUp</a>
                <a class='ImageButton' href='../cliente/PerfilCliente.php'><img src='".ClienteFotoCaminho($_SESSION["dadosCliente"]->Nome, $_SESSION["dadosCliente"]->Foto_ID)."'></a>
            </header>
            <div class='orcamento'>
                <p style='color: white; font-size: 24px; font-weight: bold;' class='orcamento_nome'>".$_SESSION["dadosOrcamento"]->Nome."</p>
                <p style='color: white; font-size: 18px; font-weight: bold;' class='orcamento_nome'>Total: R$".$total."</p>");
        foreach($_SESSION["dadosOrcamento"]->Produtos_IDs as $id){
            $produto = BDRecuperarProduto($id);
            echo("<div class='produto'>
                    <img width='50px' height='50px' src='".ProdutoFotoCaminho(BDRecuperarVendedorID($produto->Vendedor_ID)->Nome, $produto->Nome, $produto->Foto_ID)."'>
                    <p>".$produto->Nome."</p>
                    <p class='produto_valor' value='".$produto->Valor."'>R$ ".$produto->Valor."</p></h1>
                    <p class='produto_vendedor'>".BDRecuperarVendedorID($produto->Vendedor_ID)->Nome." | ".$produto->Categoria."</p>
                </div>");
        }    
        echo("</div>");
    }
    ?>
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