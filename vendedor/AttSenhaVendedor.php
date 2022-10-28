<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estilo/cadastroEstilo.css">
    <link rel="shortcut icon" href="icones/oie_7TZtpCUaslPH.jpg" type="image/x-icon">
    <title>Timeup - Alterar sua senha</title>
</head>
<body>
    <?php
    require_once("../Dados.php");
    require_once("../BDConector.php");
    require_once("../Utilidades.php");
    session_start();

    function AllVarsSet(){
        $res = true;
        $errMsg = "Erro no preenchimento do formulário de atualização cadastral\\n";
        if(!isset($_POST["senha-atual"]) || strlen($_POST["senha-atual"]) <= 0){
            $errMsg .= "O campo 'Digite a sua senha atual' não está válido\\n";
            $res = false;
        }
        if(!isset($_POST["senha-nova"]) || strlen($_POST["senha-nova"]) <= 0){
            $errMsg .= "O campo 'Digite a sua senha nova' não está válido\\n";
            $res = false;
        }
        if(!isset($_POST["senha-nova-confirma"]) || strlen($_POST["senha-nova-confirma"]) <= 0){
            $errMsg .= "O campo 'Repita a senha nova' não está válido\\n";
            $res = false;
        }
        if(!$res)
            JSAlert($errMsg);
        
        return $res;
    }

    if(isset($_POST["attsenha"])){
        if(AllVarsSet())
            Cadastrar();
        else echo("Todos os campos devem estar validamente preenchidos para que a senha seja atualizada");
    }

    function Cadastrar(){
        $dadosVendedor = $_SESSION["dadosVendedor"];
        
        // Verifica se as senhas estão preenchidas corretamente
        $senhaAtual = $_POST["senha-atual"];
        $senhaNova = $_POST["senha-nova"];
        $senhaNovaConfirma = $_POST["senha-nova-confirma"];

        // Emite uma menssagem de erro caso algum campo esteja preenchido incorretamente
        $err = false;
        $errMsg = "";
        if($senhaAtual != $dadosVendedor->Senha){
            $errMsg .= "O campo 'Digite a sua senha atual' precisa conter a senha atual";
            $err = true;
        }
        if($senhaNova != $senhaNovaConfirma){
            $errMsg .= "Os campos 'Digite a sua senha nova' e 'Repita a senha nova' precisam ser iguais";
            $err = true;
        }
        if($err)
            JSAlert($errMsg);

        $dadosVendedor->Senha = $senhaNova;
        if(!BDAtualizarVendedor($dadosVendedor->CNPJ, DadosVendedor::Senha, $dadosVendedor->Senha)){
            JSAlert("Houve um erro ao atualizar a senha, tente novamente");
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
        <h1 style="color: white;" href="PerfilVendedor.php">Trocar de senha</h1>
        <div class="textfield">
            <label for="senha-atual">Senha atual</label><br>
            <input type="password" name="senha-atual" placeholder="Digite a sua senha atual">
        </div>
        <div class="textfield">
            <label for="senha-nova">Senha nova</label><br>
            <input type="password" name="senha-nova" placeholder="Digite a sua senha nova">
        </div>
        <div class="textfield">
            <label for="senha-nova-confirma">Repita a senha nova</label><br>
            <input type="password" name="senha-nova-confirma" placeholder="Repita a senha nova">
        </div>
        <button type="submit" class="Button" name="attsenha">Alterar</button>
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