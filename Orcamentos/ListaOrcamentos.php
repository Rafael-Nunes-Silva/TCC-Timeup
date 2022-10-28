<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estilo/orcamentosListaEstilo.css">
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
        echo("<header>
                <a class='Title' href='../index.php'>TimeUp</a>
                <a class='ImageButton' href='../cliente/PerfilCliente.php'><img src='".ClienteFotoCaminho($_SESSION["dadosCliente"]->Nome, $_SESSION["dadosCliente"]->Foto_ID)."'></a>
            </header>
            <div class='orcsPanel'>");
        $listaOrcamentos = BDListarOrcamentos($_SESSION["dadosCliente"]->ID);
        for($i = 0; $i < count($listaOrcamentos); $i++){
            $total = 0;
            for($j = 0; $j < count($listaOrcamentos[$i]->Produtos_IDs); $j++){
                $total += BDRecuperarProduto($listaOrcamentos[$i]->Produtos_IDs[$j])->Valor * $listaOrcamentos[$i]->Quantidades[$j];
            }
            echo("<div class='orc'>
                    <p style='font-weight: bold;'>".$listaOrcamentos[$i]->Nome."<p>
                    <p>Total: ".$total."</p>
                    <form method='post'>
                        <input type='hidden' name='idOrcamento' value='".$i."'/>
                        <button type='submit' name='abrir' class='Button'>Abrir</button>
                    </form>
                </div>");
        }
        echo("</div>");
    }
    
    if(isset($_POST["abrir"])){
        $_SESSION["dadosOrcamento"] = $listaOrcamentos[$_POST["idOrcamento"]];
        
        header("Location: Orcamento.php");
        exit();
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