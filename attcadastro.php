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
        function allVarsSet(){
            $res = true;
            if(!isset($_POST["usuario"])){
                if(strlen($_POST["usuario"]) <= 0){
                    echo("O campo 'usuario' não esta valido");
                    $res = false;
                }
            }
            if(!isset($_POST["data_nascimento"])){
                echo("O campo 'data_nascimento' não esta valido");
                $res = false;
            }
            if(!isset($_POST["cpf"])){
                if(strlen($_POST["cpf"]) < 14){
                    echo("O campo 'cpf' não esta valido");
                    $res = false;
                }
            }
            if(!isset($_POST["telefone"])){
                if(strlen($_POST["telefone"]) < 11){
                    echo("O campo 'telefone' não esta valido");
                    $res = false;
                }
            }
            if(!isset($_POST["email"])){
                echo("O campo 'email' não esta valido");
                $res = false;
            }
            if(!isset($_POST["senha"])){
                echo("O campo 'senha' não esta valido");
                $res = false;
            }
            if(!isset($_POST["rua"])){
                echo("O campo 'rua' não esta valido");
                $res = false;
            }
            if(!isset($_POST["numero"])){
                echo("O campo 'numero' não esta valido");
                $res = false;
            }
            return $res;
        }

        if(isset($_POST["cadastrar"])){
            if(allVarsSet())
                Cadastrar();
            else echo("Todos os campos devem estar validamente preenchidos para que o cadastro seja realizado");
        }

        function Cadastrar(){
            $connection = new mysqli("localhost", "root", "", "timeupdb");

            $dadosUsuario = new UserData();
            $dadosUsuario->usuario = $_POST["usuario"];
            $dadosUsuario->data_nascimento = $_POST["data_nascimento"];
            $dadosUsuario->cpf = $_POST["cpf"];
            $dadosUsuario->telefone = $_POST["telefone"];
            $dadosUsuario->email = $_POST["email"];
            $dadosUsuario->senha = $_POST["senha"];
            $dadosUsuario->rua = $_POST["rua"];
            $dadosUsuario->numero = $_POST["numero"];

            $insertQuery = "INSERT INTO Cliente (Nome, Data_Nascimento, CPF, Telefone, Email, Senha, Rua, Numero) VALUES ('$dadosUsuario->usuario', '$dadosUsuario->data_nascimento', '$dadosUsuario->cpf', '$dadosUsuario->telefone', '$dadosUsuario->email', '$dadosUsuario->senha', '$dadosUsuario->rua', '$dadosUsuario->numero')";
            $connection->query($insertQuery);

            $checkQuery = "SELECT * FROM Cliente WHERE Nome = '$dadosUsuario->usuario'";
            $queryRes = $connection->query($checkQuery);

            /////////////////////////////
            if($queryRes->num_rows > 0){
                echo("Cadastro feito com sucesso");
                //TODO: ir para a pagina principal
            }
            else echo("Cadastro falhou");
            /////////////////////////////

            $connection->close();
        }
    ?>

    <div class="painel-cadastro">
        <div class="cadastro">
            <form class="card-cadastro" method="post">
                <a href="index.html">Atualizar Dados</a>
                <p>Altere os seus dados !</p>
                <div class="textfield">
                    <label for="telefone">Telefone</label>
                    <input type="text" name="telefone" placeholder="Telefone">
                </div>
                <div class="textfield">
                    <label for="email">Email</label>
                    <input type="text" name="email" placeholder="Email">
                </div>
                <div class="textfield">
                    <label for="rua">Rua</label>
                    <input type="text" name="rua" placeholder="Rua">
                </div>
                <div class="textfield">
                    <label for="numero">Numero</label>
                    <input type="number" name="numero" placeholder="Numero">
                </div>
                <button type="submit" class="btn-cadastro" name="cadastrar">Atualizar</button>
            </form>
        </div>
    </div>
</body>
</html>