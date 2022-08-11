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

    function AllVarsSet(){
        $res = true;
        $errMsg = "Erro no preenchimento do formulário de cadastro\\n";
        if(!isset($_POST["telefone"]) || strlen($_POST["telefone"]) != 11 || !ValidadeTelefone()){
            $errMsg .= "O campo 'Telefone' não está válido\\n";
            $res = false;
        }
        if(!isset($_POST["email"]) || strlen($_POST["email"]) <= 0 || !ValidadeEmail()){
            $errMsg .= "O campo 'Email' não está válido\\n";
            $res = false;
        }
        if(!isset($_POST["senha"]) || strlen($_POST["senha"]) <= 0){
            $errMsg .= "O campo 'Senha' não está válido\\n";
            $res = false;
        }
        if(!isset($_POST["rua"]) || strlen($_POST["rua"]) <= 0){
            $errMsg .= "O campo 'Rua' não está válido\\n";
            $res = false;
        }
        if(!isset($_POST["numero"]) || strlen($_POST["numero"]) <= 0){
            $errMsg .= "O campo 'Número' não está válido\\n";
            $res = false;
        }
        return $res;
    }

    if(isset($_POST["attcadastro"])){
        if(AllVarsSet())
            AtualizarCadastrar();
        else JSAlert("Todos os campos devem estar validamente preenchidos para que o cadastro seja realizado");
    }

    function AtualizarCadastrar(){
        // Inicia conexão com o banco de dados
        $connection = new mysqli("localhost", "root", "", "timeupdb");

        $dadosUsuario = $_SESSION["dadosUsuario"];

        if(DBRecuperarUsuario($dadosUsuario->Nome)->Senha != $_POST["senha"]){
            JSAlert("Senha incorreta");
            exit();
        }
        
        $dadosUsuario->Telefone = $_POST["telefone"];
        $dadosUsuario->Email = $_POST["email"];
        $dadosUsuario->Rua = $_POST["rua"];
        $dadosUsuario->Numero = $_POST["numero"];

        if(!DBAtualizarUsuario($dadosUsuario)){
            JSAlert("Houve um erro ao realizar a atualização do cadastro, tente novamente");
            exit();
        }
        
        header("Location: perfil.php");
        exit();
    }
    ?>

    <div class="painel-cadastro">
        <div class="cadastro">
            <form class="card-cadastro" method="post">
                <a href="perfil.php">Atualizar Dados</a>
                <p>Atualize seus dados!</p>
                <div class="textfield">
                    <label for="telefone">Telefone</label>
                    <input type="text" name="telefone" maxlength="11" placeholder="Telefone">
                </div>
                <div class="textfield">
                    <label for="email">Email</label>
                    <input type="email" name="email" maxlength="50" placeholder="Email">
                </div>
                <div class="textfield">
                    <label for="rua">Rua</label>
                    <input type="text" name="rua" maxlength="30" placeholder="Rua">
                </div>
                <div class="textfield">
                    <label for="numero">Numero</label>
                    <input type="number" name="numero" placeholder="Numero">
                </div>
                <br><br><br>
                <div class="textfield">
                    <label for="senha">Senha Atual</label>
                    <input type="text" name="senha" placeholder="Senha">
                </div>
                <button type="submit" class="btn-attcadastro" name="attcadastro">Atualizar</button>
            </form>
        </div>
    </div>
</body>
</html>