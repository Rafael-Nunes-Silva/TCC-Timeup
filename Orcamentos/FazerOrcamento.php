<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo/orcamentoEstilo.css">
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
                <a href='../index.php' class='time'>Timeup</a>
                <nav>
                    <a href='#'>Inicio</a>
                    <a href='#'>Menu</a>
                    <a href='#'>Contato</a>
                    <form action='../cliente/PerfilCliente.php'>
                        <input class='botaoPerfil' width='50px' height='50px' type='image' src='".ClienteFotoCaminho($_SESSION["dadosCliente"]->Nome, $_SESSION["dadosCliente"]->Foto_ID)."'></input>
                    </form>
                </nav>
            </header>
            <main>
                <div class='cadastro'>
                    <form class='card-cadastro' method='post'>
                        <h1>Orçamento</h1>
                        <label for='nome'>Nome</label>
                        <input type='text' name='nome'></input>");
            
        for($i=0; $i<count($_SESSION["dadosOrcamento"]->Produtos_IDs); $i++){
            $produto = BDRecuperarProduto($_SESSION["dadosOrcamento"]->Produtos_IDs[$i]);
            echo("<div class='produto'>
                    <p class='produto_nome'>".$produto->Nome."</p>
                    <p class='produto_valor' value='".$produto->Valor."'>R$ ".$produto->Valor."</p>
                    <label class='produto_label' for='quantidade'>qtd:</label>
                    <input class='produto_number' type='number' name='quantidade' onchange='attOrcamento()' value='1'></input>
                </div>");
        }
        
        echo("<p id='total'>Total: R$ 0</p>");
        echo("<input type='hidden' id='totalSalvar' name='totalSalvar' value=''></input>
                    <input type='hidden' id='qtdList' name='qtdList' value=''/>
                    <button type='submit' class='btn-salvar' name='salvar-orcamento'>Salvar Orçamendo</button>
                </form>
            </div>
        </main>");
    }
    else{
        header("Location: Produtos.php");
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
        <div class="cadastro">
            <form class="card-cadastro" method="post" enctype="multipart/form-data">
                <h1>Orçamento</h1>
                <div class="produto">
                    <p class="produto_nome">Tijolo</p>
                    <p class="produto_valor">R$ 20</p>
                    <label class="produto_label" for="quantidade">qtd:</label>
                    <input class="produto_number" type="number" name="quantidade"></input>
                </div>
                <p id='total'>Total: R$ 0</p>
                <button type="submit" class="btn-salvar" name="salvar-orcamento">Orçamento</button>
            </form>
        </div>
    </main>
    -->
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