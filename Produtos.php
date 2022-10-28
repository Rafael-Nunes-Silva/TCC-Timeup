<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estilo/produtosEstilo.css">
    <link rel="shortcut icon" href="icones/oie_7TZtpCUaslPH.jpg" type="image/x-icon">
    <title>TimeUp</title>
</head>
<body>
    <?php
    require_once("Dados.php");
    require_once("BDConector.php");
    session_start();
    
    function PriceComparator($produto1, $produto2){
        return $produto1->Valor > $produto2->Valor;
    }

    if(isset($_SESSION["dadosCliente"]) && strlen($_SESSION["dadosCliente"]->CPF) == 14){
        $produtos = BDListarProdutos();
        $min = 1000;
        $max = 0;
        for ($i = 0; $i < count($produtos); $i++){
            if($produtos[$i]->Valor < $min)
                $min = $produtos[$i]->Valor;
            else if($produtos[$i]->Valor > $max)
                $max = $produtos[$i]->Valor;
        }
        
        $sortedProds = array();
        if(isset($_SESSION["filtro"])){
            for($i=(isset($_SESSION["filtro"]) ? ($_SESSION["filtro"]->QtdPage * ($_SESSION["filtro"]->Page-1)) : 0); $i<count($produtos); $i++){
                $percent = levenshtein($_SESSION["filtro"]->Nome, $produtos[$i]->Nome, 100, 500, 300);
                if($_SESSION["filtro"]->Categoria == $produtos[$i]->Categoria){
                    foreach($sortedProds as $k => $v){
                        if($percent == $k)
                            $percent--;
                    }
                    
                    if($produtos[$i]->Valor >= $_SESSION["filtro"]->MinVal && $produtos[$i]->Valor <= $_SESSION["filtro"]->MaxVal){
                        $sortedProds += array($percent => $produtos[$i]);
                    }
                }
            }
            
            switch($_SESSION["filtro"]->OrdemValor){
                case "desordenado":
                    ksort($sortedProds);
                    break;
                case "crescente":
                    usort($sortedProds, "PriceComparator");
                    break;
                case "decrescente":
                    usort($sortedProds, "PriceComparator");
                    $sortedProds = array_reverse($sortedProds);
                    break;
            }
        }
        
        echo("<header>
                <h1 class='Title'>TimeUp</h1>
                <a class='ImageButton' href='cliente/PerfilCliente.php'><img src='".ClienteFotoCaminho($_SESSION["dadosCliente"]->Nome, $_SESSION["dadosCliente"]->Foto_ID)."'></a>
            </header>
            <form class='buscaForm' method='post'>");
        
        if(isset($_SESSION["filtro"])){
            if(strlen($_SESSION["filtro"]->Nome) > 0)
                echo("<input type='text' name='buscar' maxlength='50' placeholder='Buscar' class='busca' value='".$_SESSION["filtro"]->Nome."'>");
            else echo("<input type='text' name='buscar' maxlength='50' placeholder='Buscar' class='busca'>");
        }
        else{
            echo("<input type='text' name='buscar' maxlength='50' placeholder='Buscar' class='busca'>");
        }
        
        echo("<br><br><label for='categoria'>Categoria</label><br>
                <select name='categoria'>");
        
        if(isset($_SESSION["filtro"])){
            if($_SESSION["filtro"]->Categoria == "todas")
                echo("<option value='todas' selected>Todas</option>");
            else echo("<option value='todas'>Todas</option>");
            
            if($_SESSION["filtro"]->Categoria == "metais")
                echo("<option value='metais' selected>Metais</option>");
            else echo("<option value='metais'>Metais</option>");
            
            if($_SESSION["filtro"]->Categoria == "ceramicos")
                echo("<option value='ceramicos' selected>Cerâmicos</option>");
            else echo("<option value='ceramicos'>Cerâmicos</option>");
            
            if($_SESSION["filtro"]->Categoria == "polimeros")
                echo("<option value='polimeros' selected>Polímeros</option>");
            else echo("<option value='polimeros'>Polímeros</option>");
            
            if($_SESSION["filtro"]->Categoria == "compositos")
                echo("<option value='compositos' selected>Compósitos</option>");
            else echo("<option value='compositos'>Compósitos</option>");
            
            if($_SESSION["filtro"]->Categoria == "pedras")
                echo("<option value='pedras' selected>pedras</option>");
            else echo("<option value='pedras'>Pedras</option>");
            
            if($_SESSION["filtro"]->Categoria == "telhas")
                echo("<option value='telhas' selected>Telhas</option>");
            else echo("<option value='telhas'>Telhas</option>");
            
            if($_SESSION["filtro"]->Categoria == "tintas")
                echo("<option value='tintas' selected>Tintas</option>");
            else echo("<option value='tintas'>Tintas</option>");
            
            if($_SESSION["filtro"]->Categoria == "blocos/tijolos")
                echo("<option value='blocos/tijolos' selected>Blocos/Tijolos</option>");
            else echo("<option value='blocos/tijolos'>Blocos/Tijolos</option>");
        }
        else{
            echo("<option value='todas'>Todas</option>
                <option value='metais'>Metais</option>
                <option value='ceramicos'>Cerâmicos</option>
                <option value='polimeros'>Polímeros</option>
                <option value='compositos'>Compósitos</option>
                <option value='pedras'>Pedras</option>
                <option value='telhas'>Telhas</option>
                <option value='tintas'>Tintas</option>
                <option value='blocos/tijolos'>Blocos/Tijolos</option>");
        }
        
        echo("</select><br>
            <label for='ordemValor'>Valor</label><br>
            <select name='ordemValor' id='ordemValor'>");
        
        if(isset($_SESSION["filtro"])){
            if($_SESSION["filtro"]->OrdemValor == "desordenado")
                echo("<option value='desordenado' selected>Desordenado</option>");
            else echo("<option value='desordenado'>Desordenado</option>");
            
            if($_SESSION["filtro"]->OrdemValor == "crescente")
                echo("<option value='crescente' selected>Crescente</option>");
            else echo("<option value='crescente'>Crescente</option>");
            
            if($_SESSION["filtro"]->OrdemValor == "decrescente")
                echo("<option value='decrescente' selected>Decrescente</option>");
            else echo("<option value='decrescente'>Decrescente</option>");
        }
        else{
            echo("<option value='desordenado'>Desordenado</option>
                <option value='crescente'>Crescente</option>
                <option value='decrescente'>Decrescente</option>");
        }
        
        echo("</select><br>
                <label for='minVal'>De R$</label><br>
                <input type='number' name='minVal' min='$min' max='$max' maxlength='10' value='".(isset($_SESSION["filtro"]) ? $_SESSION["filtro"]->MinVal : $min)."' class='filt'><br>
                <label for='maxVal'>A R$</label><br>
                <input type='number' name='maxVal' min='$min' max='$max' maxlength='10' value='".(isset($_SESSION["filtro"]) ? $_SESSION["filtro"]->MaxVal : $max)."' class='filt'><br>
                <label for='qtdPage'>Itens por página</label><br>
                <input type='number' name='qtdPage' min='20' max='100' value='".(isset($_SESSION["filtro"]) ? $_SESSION["filtro"]->QtdPage : 40)."'><br>
                <label for='page'>Página</label><br>
                <input style='width: 50px;' type='number' name='page' min='1' max='".(isset($_SESSION["filtro"]) ? (count($produtos) / $_SESSION["filtro"]->QtdPage < 1 ? 1 : count($produtos) / $_SESSION["filtro"]->QtdPage) : 1)."' value='".(isset($_SESSION["filtro"]) ? $_SESSION["filtro"]->Page : (count($produtos)/40 < 1 ? 1 : count($produtos)/40))."'><br>
                <input class='Button' name='fazer-busca' type='submit' value='Buscar'></input>
                <input class='Button' name='limpar-busca' type='submit' value='Limpar'></input><br>
                <input type='hidden' id='idList' name='idList' value=''/>
                <button class='Button' type='submit' name='fazer-orcamento'>Fazer Orçamento</button>
            </form>
            </header>
            <div class='produtosPanel'>");
        
        if(isset($_SESSION["filtro"])){
            $i = 0;
            foreach($sortedProds as $key => $val){
                if($i >= min(count($sortedProds), $_SESSION["filtro"]->QtdPage))
                    break;
                
                $dadosVendedor = BDRecuperarVendedorID($val->Vendedor_ID);
                echo("<div class='produto' type='button' onclick='clicado(".$i.", ".$val->ID.", this)'>
                    <img src='../uploads/produto/".$dadosVendedor->Nome."/".$val->Nome."/".BDRecuperarFoto($val->Foto_ID)."' width='200px' height='200px'>
                    <p class='produto_nome'>".$val->Nome."</p>
                    <p class='produto_valor'>R$ ".$val->Valor."</p>
                    <p class='produto_vendedor'>".$dadosVendedor->Nome." | ".$val->Categoria."</p>
                    </div>");
                $i++;
            }
        }
        else{
            for ($i = 0; $i < min(count($produtos), 25); $i++){
                $dadosVendedor = BDRecuperarVendedorID($produtos[$i]->Vendedor_ID);
                echo("<div class='produto' type='button' onclick='clicado(".$i.", ".$produtos[$i]->ID.", this)'>
                    <img src='../uploads/produto/".$dadosVendedor->Nome."/".$produtos[$i]->Nome."/".BDRecuperarFoto($produtos[$i]->Foto_ID)."' width='200px' height='200px'>
                    <p class='produto_nome'>".$produtos[$i]->Nome."</p>
                    <p class='produto_valor'>R$ ".$produtos[$i]->Valor."</p>
                    <p class='produto_vendedor'>".$dadosVendedor->Nome."</p>
                    </div>");   
            }    
        }
        echo("</div>");
        echo("<script>
                var idList = [];
                for(let i=0; i<".count($produtos)."; i++){
                    idList[i] = 0;
                }
            </script>");
    }
    else{
        header("Location: index.php");
        exit();
    }
    
    if(isset($_POST["fazer-orcamento"])){
        $_SESSION["dadosOrcamento"] = new ObjOrcamento();
        $_SESSION["dadosOrcamento"]->Cliente_ID = $_SESSION["dadosCliente"]->ID;
        $_SESSION["dadosOrcamento"]->Produtos_IDs = array();
        $_SESSION["dadosOrcamento"]->Data_Orcamento = date("Y-m-d");
        
        $idList = json_decode($_POST["idList"], true);
        for($i=0; $i<count($idList); $i++){
            if($idList[$i] > 0)
                array_push($_SESSION["dadosOrcamento"]->Produtos_IDs, $idList[$i]);
        }
        
        header("Location: Orcamentos/FazerOrcamento.php");
        exit();
    }
    
    if(isset($_POST["fazer-busca"])){
        $_SESSION["filtro"] = new ObjFiltro();
        $_SESSION["filtro"]->Nome = $_POST["buscar"];
        $_SESSION["filtro"]->Categoria = $_POST["categoria"];
        $_SESSION["filtro"]->OrdemValor = $_POST["ordemValor"];
        $_SESSION["filtro"]->MinVal = $_POST["minVal"];
        $_SESSION["filtro"]->MaxVal = $_POST["maxVal"];
        $_SESSION["filtro"]->QtdPage = $_POST["qtdPage"];
        $_SESSION["filtro"]->Page = $_POST["page"];
        
        header("Location: Produtos.php");
        exit();
    }
    if(isset($_POST["limpar-busca"]) && isset($_SESSION["filtro"])){
        unset($_SESSION["filtro"]);
        
        header("Location: Produtos.php");
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
    <script>
        function clicado(index, id, obj){
            if(idList[index] == id){
                obj.style.backgroundColor = "#4B0082";
                idList[index] = 0;
            }
            else{
                obj.style.backgroundColor = "#DD00DD";
                idList[index] = id;
            }
            
            document.getElementById("idList").value = JSON.stringify(idList);
        }
        
        function proximaPagina(){
            let num = parseInt(document.getElementById("numPag").value, 10);
            num += 1;
            document.getElementById("numPag").value = num.toString();
        }
        function paginaAnterior(){
            let num = parseInt(document.getElementById("numPag").value, 10);
            num -= 1;
            document.getElementById("numPag").value = num.toString();
        }
    </script>
</body>
</html>