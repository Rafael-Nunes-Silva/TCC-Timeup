<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estilo/cadastroEstilo.css">
    <link rel="shortcut icon" href="icones/oie_7TZtpCUaslPH.jpg" type="image/x-icon">
    <title>Timeup - Atualizar Informações</title>
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
        if(!isset($_POST["email"]) || strlen($_POST["email"]) <= 0 || !ValidarEmail()){
            $errMsg .= "O campo 'Email' não está válido\\n";
            $res = false;
        }
        if(!isset($_POST["senha"]) || strlen($_POST["senha"]) <= 0){
            $errMsg .= "O campo 'Senha' não está válido\\n";
            $res = false;
        }
        if(!isset($_POST["rua"]) || strlen($_POST["rua"]) <= 0){
            $errMsg .= "O campo 'Rua' não está válido\\n";
            $res = false;
        }
        if(!isset($_POST["numero"]) || strlen($_POST["numero"]) <= 0){
            $errMsg .= "O campo 'Número' não está válido\\n";
            $res = false;
        }
        return $res;
    }

    if(isset($_POST["attcadastro"])){
        if(AllVarsSet())
            AtualizarCadastro();
        else JSAlert("Todos os campos devem estar validamente preenchidos para que o cadastro seja realizado");
    }

    function AtualizarCadastro(){
        $dadosVendedor = $_SESSION["dadosVendedor"];

        if(BDRecuperarVendedor($dadosVendedor->CNPJ)->Senha != $_POST["senha"]){
            JSAlert("Senha incorreta");
            exit();
        }
        
        $dadosVendedor->Email = $_POST["email"];
        $dadosVendedor->Rua = $_POST["rua"];
        $dadosVendedor->Numero = $_POST["numero"];

        if(!BDAtualizarVendedor($dadosVendedor->CNPJ, DadosVendedor::Email, $dadosVendedor->Email)
        || !BDAtualizarVendedor($dadosVendedor->CNPJ, DadosVendedor::Rua, $dadosVendedor->Rua)
        || !BDAtualizarVendedor($dadosVendedor->CNPJ, DadosVendedor::Numero, $dadosVendedor->Numero)){
            JSAlert("Houve um erro ao realizar a atualização do cadastro, tente novamente");
            exit();
        }
        
        header("Location: PerfilVendedor.php");
        exit();
    }
    ?>
    <header>
        <a class="Title" href="PerfilVendedor.php">TimeUp</a>
    </header>
    <form class="cadForm" method="post">
        <h1 style="color: white;" href="PerfilVendedor.php">Atualizar dados</h1>
        <div class="textfield">
            <label for="email">Email</label><br>
            <input type="email" name="email" maxlength="50" value="<?php echo($_SESSION["dadosVendedor"]->Email)?>" oninput="MascaraTelefone(this)">
        </div>
        <div class="textfield">
            <label for="rua">Rua</label><br>
            <input type="text" name="rua" maxlength="30" value="<?php echo($_SESSION["dadosVendedor"]->Rua)?>">
        </div>
        <div class="textfield">
            <label for="numero">Numero</label><br>
            <input type="number" name="numero" value="<?php echo($_SESSION["dadosVendedor"]->Numero)?>">
        </div>
        <br>
        <div class="textfield">
            <label for="senha">Senha Atual</label><br>
            <input type="password" name="senha" placeholder="Senha">
        </div>
        <button type="submit" class="Button" name="attcadastro">Atualizar</button>
    </form>
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