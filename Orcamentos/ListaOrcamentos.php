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

    $listaOrcamentos = null;

    if(isset($_SESSION["dadosCliente"]) && strlen($_SESSION["dadosCliente"]->CPF) == 14){
        echo("<a href='../index.php' class='time'>Timeup</a>
            <nav>
                <a href='#'>Inicio</a>
                <a href='#'>Menu</a>
                <a href='#'>Contato</a>
                <form action='../cliente/PerfilCliente.php'>
                    <input class='botaoPerfil' width='50px' height='50px' type='image' src='".ClienteFotoCaminho($_SESSION["dadosCliente"]->Nome, $_SESSION["dadosCliente"]->Foto_ID)."'></input>
                </form>
            </nav>
            <main>");
        $listaOrcamentos = BDListarOrcamentos($_SESSION["dadosCliente"]->ID);
        for($i = 0; $i < count($listaOrcamentos); $i++){
            $total = 0;
            for($j = 0; $j < count($listaOrcamentos[$i]->Produtos_IDs); $j++){
                $total += BDRecuperarProduto($listaOrcamentos[$i]->Produtos_IDs[$j])->Valor * $listaOrcamentos[$i]->Quantidades[$j];
            }
            echo("<div>
                    <p>".$listaOrcamentos[$i]->Nome."<p>
                    <p>Total: ".$total."</p>
                    <form method='post'>
                        <input type='hidden' name='idOrcamento' value='".$i."'/>
                        <button type='submit' name='abrir'>Abrir</button>
                    </form>
                </div>");
        }
        echo("</main>");
    }
    
    if(isset($_POST["abrir"])){
        $_SESSION["dadosOrcamento"] = $listaOrcamentos[$_POST["idOrcamento"]];
        
        header("Location: Orcamento.php");
        exit();
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