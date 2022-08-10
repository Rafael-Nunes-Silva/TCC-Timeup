<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo/cadastro.css">
    <link rel="shortcut icon" href="icones/oie_7TZtpCUaslPH.jpg" type="image/x-icon">
    <title>Timeup - Alterar sua senha</title>
</head>
<body>
    <?php
    require_once("dados.php");
    require_once("utilidades.php");
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
        // Inicia conexão com o banco de dados
        $connection = new mysqli("localhost", "root", "", "timeupdb");

        $dadosUsuario = $_SESSION["dadosUsuario"];
            
        // Verifica se as senhas estão preenchidas corretamente
        $senhaAtual = $_POST["senha-atual"];
        $senhaNova = $_POST["senha-nova"];
        $senhaNovaConfirma = $_POST["senha-nova-confirma"];

        // Emite uma menssagem de erro caso algum campo esteja preenchido incorretamente
        $err = false;
        $errMsg = "";
        if($senhaAtual != $dadosUsuario->Senha){
            $errMsg .= "O campo 'Digite a sua senha atual' precisa conter a senha atual";
            $err = true;
        }
        if($senhaNova != $senhaNovaConfirma){
            $errMsg .= "Os campos 'Digite a sua senha nova' e 'Repita a senha nova' precisam ser iguais";
            $err = true;
        }
        if($err)
            JSAlert($errMsg);

        // Efetua a atualização no banco de dados
        $dadosUsuario->Senha = $senhaNova;
        $updateQuery = "UPDATE Cliente SET Senha = '$senhaNova' WHERE CPF = '$dadosUsuario->CPF'";
        $updateQueryRes = $connection->query($updateQuery);
        if ($updateQueryRes === TRUE){
            JSAlert("Senha atualizada com sucesso");
            header("Location: perfil.php");
            exit();
        }
        else JSAlert("Erro ao atualizar a senha: ".$connection->error);
    }
    ?>

    <div class="painel-cadastro">
        <div class="cadastro">
            <form class="card-cadastro" method="post">
                <a href="perfil.php">Trocar de senha</a>
                <p>Altere a sua senha !</p>
                <div class="textfield">
                    <label for="telefone">Senha</label>
                    <input type="text" name="senha-atual" placeholder="Digite a sua senha atual">
                </div>
                <div class="textfield">
                    <label for="email">Senha nova</label>
                    <input type="text" name="senha-nova" placeholder="Digite a sua senha nova">
                </div>
                <div class="textfield">
                    <label for="rua">Repita a senha nova</label>
                    <input type="text" name="senha-nova-confirma" placeholder="Repita a senha nova">
                </div>
                <button type="submit" class="btn-attsenha" name="attsenha">Alterar</button>
            </form>
        </div>
    </div>
</body>
</html>