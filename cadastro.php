<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo/cadastro.css">
    <link rel="shortcut icon" href="icones/oie_7TZtpCUaslPH.jpg" type="image/x-icon">
    <title>Timeup - cadastro</title>
</head>
<body>
    <?php
        function allVarsSet(){
            return (isset($_POST["usuario"]) && isset($_POST["data_nascimento"]) && isset($_POST["cpf"]) &&
            isset($_POST["telefone"]) && isset($_POST["email"]) && isset($_POST["senha"]) &&
            isset($_POST["rua"]) && isset($_POST["numero"]));
        }

        if(isset($_POST["cadastrar"])){
            Cadastrar();
        }

        function Cadastrar(){ // if(allVarsSet()){
            $connection = new mysqli("localhost", "root", "", "timeupdb");
            $usuario = $_POST["usuario"];
            $data_nascimento = $_POST["data_nascimento"];
            $cpf = $_POST["cpf"];
            $telefone = $_POST["telefone"];
            $email = $_POST["email"];
            $senha = $_POST["senha"];
            $rua = $_POST["rua"];
            $numero = $_POST["numero"];

            $query = "INSERT INTO Cliente (Nome, Data_Nascimento, CPF, Telefone, Email, Senha, Rua, Numero) VALUES ('$usuario', '$data_nascimento', '$cpf', '$telefone', '$email', '$senha', '$rua', '$numero')";
            $queryRes = $connection->query($query);

            //TODO: verificar se o cadastro foi realizado com sucesso

            $connection->close();
        }
    ?>

    <div class="painel-cadastro">
        <div class="cadastro">
            <form class="card-cadastro" method="post">
                <h1>cadastro</h1>
                <div class="textfield">
                    <label for="usuario">Usuário</label>
                    <input type="text" name="usuario" placeholder="Nome">
                </div>
                <div class="textfield">
                    <label for="data_nascimento">Data de Nascimento</label>
                    <input type="date" name="data_nascimento" placeholder="dd/mm/aaaa">
                </div>
                <div class="textfield">
                    <label for="cpf">CPF</label>
                    <input type="text" name="cpf" placeholder="CPF">
                </div>
                <div class="textfield">
                    <label for="telefone">Telefone</label>
                    <input type="text" name="telefone" placeholder="Telefone">
                </div>
                <div class="textfield">
                    <label for="email">Email</label>
                    <input type="text" name="email" placeholder="Email">
                </div>
                <div class="textfield">
                    <label for="senha">Senha</label>
                    <input type="text" name="senha" placeholder="Senha">
                </div>
                <div class="textfield">
                    <label for="rua">Rua</label>
                    <input type="text" name="rua" placeholder="Rua">
                </div>
                <div class="textfield">
                    <label for="numero">Numero</label>
                    <input type="number" name="numero" placeholder="Numero">
                </div>
                <button type="submit" class="btn-cadastro" value="cadastrar">cadastro</button>
            </form>
        </div>
    </div>
</body>
</html>