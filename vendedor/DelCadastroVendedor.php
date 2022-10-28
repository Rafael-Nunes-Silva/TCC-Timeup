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
    
    if(isset($_POST["delcadastro"])){
        $dadosVendedor = $_SESSION["dadosVendedor"];

        if($_POST["senha"] != $dadosVendedor->Senha){
            JSAlert("A senha está incorreta");
            exit();
        }
        
        BDDeletarVendedor($dadosVendedor->CNPJ);

        $dadosVendedor->Nome = "";
        $dadosVendedor->Data_Nascimento = "";
        $dadosVendedor->CPF = "";
        $dadosVendedor->Telefone = "";
        $dadosVendedor->Email = "";
        $dadosVendedor->Senha = "";
        $dadosVendedor->Rua = "";
        $dadosVendedor->Numero = "";
        
        header("Location: ../index.php");
        exit();
    }
    ?>
    <header>
        <a class="Title" href="PerfilVendedor.php">TimeUp</a>
    </header>
    <form class="cadForm" method="post">
        <h1 style="color: white;" href="PerfilVendedor.php">Deletar Cadastro</h1>
        <p>Tem certeza que deseja deletar seu cadastro?</p>
        <div class="textfield">
            <label for="senha">Senha Atual</label><br>
            <input type="password" name="senha" placeholder="Senha">
        </div>
        <button style="background-color: red;" type="submit" class="Button" name="delcadastro">Excluir cadastro</button>
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