<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo/cadastro.css">
    <link rel="shortcut icon" href="icones/oie_7TZtpCUaslPH.jpg" type="image/x-icon">
    <title>Timeup - Atualizar Informações</title>
</head>
<body>
    <?php
    require_once("dados.php");
    require_once("utilidades.php");
    session_start();
    
    if(isset($_POST["delcadastro"])){
        $dadosUsuario = $_SESSION["dadosUsuario"];

        if($_POST["senha"] != $dadosUsuario->Senha){
            JSAlert("A senha está incorreta");
            exit();
        }
        
        DBDeletarUsuario($dadosUsuario);

        $dadosUsuario->Nome = "";
        $dadosUsuario->Data_Nascimento = "";
        $dadosUsuario->CPF = "";
        $dadosUsuario->Telefone = "";
        $dadosUsuario->Email = "";
        $dadosUsuario->Senha = "";
        $dadosUsuario->Rua = "";
        $dadosUsuario->Numero = "";
        
        header("Location: index.html");
        exit();
    }
    ?>

    <div class="painel-cadastro">
        <div class="cadastro">
            <form class="card-cadastro" method="post">
                <a href="perfil.php">Deletar Cadastro</a>
                <p>Tem certeza que deseja deletar seu cadastro?</p>
                <div class="textfield">
                    <label for="senha">Senha Atual</label>
                    <input type="password" name="senha" placeholder="Senha">
                </div>
                <button type="submit" class="btn-delcadastro" name="delcadastro">Deletar</button>
            </form>
        </div>
    </div>
</body>
</html>
