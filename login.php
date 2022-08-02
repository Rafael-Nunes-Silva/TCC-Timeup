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
        if(isset($_POST["usuario"]) && isset($_POST["senha"])){
            $connection = new mysqli("localhost", "root", "", "timeupdb");
            $usuario = $_POST["usuario"];
            $senha = $_POST["senha"];

            $query = "SELECT * FROM Cliente WHERE Nome = '$usuario'";
            $queryRes = $connection->query($query);
            if($queryRes->num_rows > 0){
                $dados = $queryRes->fetch_assoc();
                if($senha == $dados["Senha"]){
                    echo("Usuario $usuario esta cadastrado e senha fornecida esta correta<br>");
                    echo("Dados adicionais:<br>");
                    echo("<ul>");
                    echo("<li>ID: ". $dados["ID"]. "</li>");
                    echo("<li>Nome: ". $dados["Nome"]. "</li>");
                    echo("<li>Data de Nascimento: ". $dados["Data_Nascimento"]. "</li>");
                    echo("<li>CPF: ". $dados["CPF"]. "</li>");
                    echo("<li>Telefone: ". $dados["Telefone"]. "</li>");
                    echo("<li>Email: ". $dados["Email"]. "</li>");
                    echo("<li>Rua: ". $dados["Rua"]. "</li>");
                    echo("<li>Numero: ". $dados["Numero"]. "</li>");
                    echo("</ul>");
                }
                else echo("Senha incorreta");
            }
            else echo("Usuario $usuario não esta cadastrado<br>");
            
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
                    <label for="usuario">Usuário</label>
                    <input type="text" name="usuario" placeholder="Usuário">
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