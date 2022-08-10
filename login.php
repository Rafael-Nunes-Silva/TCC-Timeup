<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo/login.css">
    <link rel="shortcut icon" href="icones/oie_7TZtpCUaslPH.jpg" type="image/x-icon">
    <title>Timeup - Login</title>
</head>
<body>
    <?php
    require_once("dados.php");
    require_once("utilidades.php");
    session_start();

    if(isset($_POST["nome"]) && isset($_POST["senha"])){
        $connection = new mysqli("localhost", "root", "", "timeupdb");
        $nome = $_POST["nome"];
        $senha = $_POST["senha"];

        $query = "SELECT * FROM Cliente WHERE Nome = '$nome'";
        $queryRes = $connection->query($query);
        if($queryRes->num_rows > 0){
            $dados = $queryRes->fetch_assoc();
            if($senha == $dados["Senha"]){
                $dadosUsuario = new UserData();
                $dadosUsuario->Nome = $dados["Nome"];
                $dadosUsuario->Data_Nascimento = $dados["Data_Nascimento"];
                $dadosUsuario->CPF = $dados["CPF"];
                $dadosUsuario->Telefone = $dados["Telefone"];
                $dadosUsuario->Email = $dados["Email"];
                $dadosUsuario->Senha = $dados["Senha"];
                $dadosUsuario->Rua = $dados["Rua"];
                $dadosUsuario->Numero = $dados["Numero"];
                $_SESSION["dadosUsuario"] = $dadosUsuario;
                // echo('<script>window.location.href = "perfil.php";</script>');
                header("Location: perfil.php");
                exit();
            }
            else JSAlert("Dados incorretos");
        }
        else JSAlert("Usuario ".$nome." não esta cadastrado<br>");
            
        $connection->close();
    }
    ?>
    
    <nav>
        <a href="index.html" class="time">Timeup</a>
    </nav>
    <div class="painel-login">
        <div class="esquerda-login">
            <h1>Faça login<br>E entre para o nosso site</h1>
            <img src="estilo/ecommerce-campaign-animate.svg" class="esquerda-login-image" alt="logo">
        </div>
        <div class="direita-login">
            <form class="card-login" method="post">
                <h1>LOGIN</h1>
                <div class="textfield">
                    <label for="nome">Nome</label>
                    <input type="text" name="nome" placeholder="Nome">
                </div>
                <div class="textfield">
                    <label for="senha">Senha</label>
                    <input type="password" name="senha" placeholder="Senha">
                </div>
                <button class="btn-login">Login</button>
            </form>
        </div>
    </div>
</body>
</html>