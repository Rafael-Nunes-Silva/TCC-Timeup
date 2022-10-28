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
            <header>
                <a class='Title' href='../index.php'>TimeUp</a>
            </header>
            <div class='perfPanel'>
                <img src='../uploads/vendedor/".$dadosVendedor->Nome."/foto_perfil/".BDRecuperarFoto($dadosVendedor->Foto_ID)."' id='foto' height='300px' width='300px'>
                <br>
                <nav>
                    <a class='Button' href='CadastroProduto.php'>Cadastrar Produto</a>
                    <a class='Button' href='AttCadastroVendedor.php'>Atualizar Cadastro</a>
                    <a class='Button' href='AttSenhaVendedor.php'>Mudar Senha</a>
                    <a class='Button' href='DelCadastroVendedor.php'>Deletar Cadastro</a>
                </nav>
                <form method='post'>
                    <button type='submit' class='Button' name='sair'>Sair</button>
                </form>
                <br>
                <label for='nome'>Nome</label><br>
                <h2 name='nome'>$dadosVendedor->Nome</h2>
                <label for='nome'>Email</label><br>
                <h2 name='email'>$dadosVendedor->Email</h2>
                <label for='nome'>Rua</label><br>
                <h2 name='rua'>$dadosVendedor->Rua</h2>
                <label for='nome'>Número</label><br>
                <h2 name='numero'>$dadosVendedor->Numero</h2>
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