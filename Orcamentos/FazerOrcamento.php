<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estilo/orcamentoEstilo.css">
    <link rel="shortcut icon" href="icones/oie_7TZtpCUaslPH.jpg" type="image/x-icon">
    <title>Timeup</title>
</head>
<body>
    <?php
    require_once("../Dados.php");
    require_once("../Utilidades.php");
    require_once("../BDConector.php");
    session_start();

    if(isset($_SESSION["dadosCliente"]) && strlen($_SESSION["dadosCliente"]->CPF) == 14 && isset($_SESSION["dadosOrcamento"])){
        echo("<header>
                <a class='Title' href='../index.php'>TimeUp</a>
                <a class='ImageButton' href='../cliente/PerfilCliente.php'><img src='".ClienteFotoCaminho($_SESSION["dadosCliente"]->Nome, $_SESSION["dadosCliente"]->Foto_ID)."'></a>
            </header>
            <form class='orcForm' method='post'>
                <h1 style='color: white;'>Orçamento</h1>
                <label style='font-size: 24px' for='nome'>Nome</label><br>
                <input style='width: 250px; height: 20px;' type='text' name='nome'></input><br><br>");
            
        for($i=0; $i<count($_SESSION["dadosOrcamento"]->Produtos_IDs); $i++){
            $produto = BDRecuperarProduto($_SESSION["dadosOrcamento"]->Produtos_IDs[$i]);
            $dadosVendedor = BDRecuperarVendedorID($produto->Vendedor_ID);
            echo("<div class='produto'>
                    <img src='../uploads/produto/".$dadosVendedor->Nome."/".$produto->Nome."/".BDRecuperarFoto($produto->Foto_ID)."' width='200px' height='200px'>
                    <p class='produto_nome'>".$produto->Nome."</p>
                    <p class='produto_valor' value='".$produto->Valor."'>R$ ".$produto->Valor."</p>
                    <label class='produto_label' for='quantidade'>Quantidade:</label>
                    <input class='produto_number' type='number' name='quantidade' onchange='attOrcamento()' value='1'></input>
                </div>");
        }
        
        echo("<p id='total'>Total: R$ 0</p>");
        echo("<input type='hidden' id='totalSalvar' name='totalSalvar' value=''></input>
                <input type='hidden' id='qtdList' name='qtdList' value=''/>
                <button style='font-size: 24px;' type='submit' class='Button' name='salvar-orcamento'>Salvar Orçamento</button>
            </form>");
    }
    else{
        header("Location: ../Produtos.php");
        exit();
    }
    
    if(isset($_POST["salvar-orcamento"])){
        $_SESSION["dadosOrcamento"]->Nome = $_POST["nome"];
        $_SESSION["dadosOrcamento"]->Quantidades = array();
        
        $qtdList = json_decode($_POST["qtdList"], true);
        for($i=0; $i<count($qtdList); $i++)
            array_push($_SESSION["dadosOrcamento"]->Quantidades, $qtdList[$i]);
        
        if(!BDRegistrarOrcamento($_SESSION["dadosOrcamento"])){
            JSAlert("Falha ao salvar orçamento");
        }
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
    <script>
        var qtdList = [];
        function attOrcamento(){
            let valores = document.getElementsByClassName("produto_valor");
            let quantidades = document.getElementsByClassName("produto_number");
            
            let total = 0;
            for(let i=0; i<Math.min(valores.length, quantidades.length); i++){
                let qtd = quantidades[i].value;
                
                quantidades[i].value = (qtd < 1 ? 1 : (qtd > 999999 ? 999999 : qtd));
                
                total += valores[i].getAttribute("value") * quantidades[i].value;
                qtdList[i] = quantidades[i].value;
            }
            
            document.getElementById("total").innerText = "Total: R$ " + total;
            document.getElementById("totalSalvar").value = total;
            document.getElementById("qtdList").value = JSON.stringify(qtdList);
        }
    </script>
</body>
</html>