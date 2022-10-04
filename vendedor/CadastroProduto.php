<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estilo/cadastroEstilo.css">
    <link rel="shortcut icon" href="icones/oie_7TZtpCUaslPH.jpg" type="image/x-icon">
    <script src="../scripts/mascaras.js"></script>
    <title>Timeup - cadastro produto</title>
</head>
<body>
    <?php
    require_once("../Dados.php");
    require_once("../BDConector.php");
    require_once("../Utilidades.php");
    session_start();
    
    function AllVarsSet(){
        $res = true;
        $errMsg = "Erro no preenchimento do formulário de cadastro\\n";
        if($_FILES["foto"]["size"] == 0 || $_FILES["foto"]["error"] != 0){
            $errMsg .= "O campo 'Foto' não está válido\\n";
            $res = false;
        }
        if(!isset($_POST["nome"]) || strlen($_POST["nome"]) <= 0){
            $errMsg .= "O campo 'Nome' não está válido\\n";
            $res = false;
        }
        if(!isset($_POST["valor"]) || strlen($_POST["valor"]) <= 0){
            $errMsg .= "O campo 'Valor' não está válido\\n";
            $res = false;
        }
        if(!isset($_POST["categoria"]) || strlen($_POST["categoria"]) <= 0){
            $errMsg .= "O campo 'Categoria' não está válido\\n";
            $res = false;
        }
        if(!$res)
            JSAlert($errMsg);
        
        return $res;
    }

    if(isset($_POST["cadastrar"])){
        if(AllVarsSet())
            Cadastrar();
        else JSAlert("Todos os campos devem estar validamente preenchidos para que o cadastro seja realizado");
    }

    function Cadastrar(){
        $fotoID = BDRegistrarFoto(basename($_FILES["foto"]["name"]), $_FILES["foto"]["tmp_name"], "../uploads/produto/".$_SESSION["dadosVendedor"]->Nome."/".$_POST["nome"]."/");
        if($fotoID == 0){
            JSAlert("Erro ao inserir foto no banco de dados");
            return;
        }
        
        $dadosProduto = new ObjProduto();
        $dadosProduto->Foto_ID = $fotoID;
        $dadosProduto->Nome = $_POST["nome"];
        $dadosProduto->Valor = $_POST["valor"];
        $dadosProduto->Categoria = $_POST["categoria"];
        $dadosProduto->Vendedor_ID = $_SESSION["dadosVendedor"]->ID;
        if(!BDRegistrarProduto($dadosProduto)){
            JSAlert("Houve um erro na hora do cadastro, tente novamente");
            return;
        }

        header("Location: PerfilVendedor.php");
        exit();
    }
    ?>

    <nav>
        <a href="../index.php" class="time">Timeup</a>
    </nav>
    <div class="painel-cadastro">
        <div class="cadastro">
            <form class="card-cadastro" method="post" enctype="multipart/form-data">
                <h1>Cadastro</h1>
                <div class="textfield">
                    <label for="foto">Foto</label>
                    <input type="file" name="foto" accept="image/jpeg">
                </div>
                <div class="textfield">
                    <label for="nome">Nome</label>
                    <input type="text" name="nome" maxlength="50" value="<?php echo(isset($_SESSION["dadosProduto"]) ? $_SESSION["dadosProduto"]->Nome : '')?>" placeholder="Nome">
                </div>
                <div class="textfield">
                    <label for="valor">Valor</label>
                    <input type="number" name="valor" value="<?php echo(isset($_SESSION["dadosProduto"]) ? $_SESSION["dadosProduto"]->Valor : '')?>" placeholder="R$ 0,00">
                </div>
                <div class="textfield">
                    <label for="categoria">Categoria</label>
                    <select name="categoria">
                        <option value="metais">Metais</option>
                        <option value="ceramicos">Cerâmicos</option>
                        <option value="polimeros">Polímeros</option>
                        <option value="compositos">Compósitos</option>
                    </select>
                </div>
                <button type="submit" class="btn-cadastro" name="cadastrar">cadastro</button>
            </form>
        </div>
    </div>
</body>
</html>