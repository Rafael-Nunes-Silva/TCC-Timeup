<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estilo/perfilEstilo.css">
    <link rel="shortcut icon" href="icones/oie_7TZtpCUaslPH.jpg" type="image/x-icon">
    <title>Timeup - Perfil</title>
</head>
<body>
    <?php
    require_once("../Dados.php");
    require_once("../BDConector.php");
    require_once("../Utilidades.php");
    session_start();

    $dadosVendedor = $_SESSION["dadosVendedor"];
    if($dadosVendedor){
        echo("
            <nav>
                <a href='../index.php' class='time'>Timeup</a>
            </nav>
            <div class='label'>
                <img src='../uploads/vendedor/".$dadosVendedor->Nome."/foto_perfil/".BDRecuperarFoto($dadosVendedor->Foto_ID)."' id='foto' height='300px' width='300px'>
                <h2 id='nome'>Nome: $dadosVendedor->Nome</h2>
                <h2 id='email'>Email: $dadosVendedor->Email</h2>
                <h2 id='rua'>Rua: $dadosVendedor->Rua</h2>
                <h2 id='numero'>Número: $dadosVendedor->Numero</h2>
            </div>
        ");
    }

    if(isset($_POST["sair"])){
        $_SESSION["dadosVendedor"] = new ObjVendedor();
        unset($_SESSION["dadosVendedor"]);
        header("Location: ../index.php");
        exit();
    }
    ?>
    
    <nav>
        <a href="../index.php" class="time">Timeup</a>
    </nav>

    <nav>
        <a href="AttCadastroVendedor.php">Atualizar Cadastro</a>
        <a href="AttSenhaVendedor.php">Mudar Senha</a>
        <a href="DelCadastroVendedor.php">Deletar Cadastro</a>
        <a href="CadastroProduto.php">Cadastrar Produto</a>
    </nav>
    <form method="post">
        <button type="submit" class="btn-sair" name="sair">Sair</button>
    </form>
</body>
</html>