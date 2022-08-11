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
    require_once("dados.php");
    require_once("utilidades.php");
    session_start();
        
    function AllVarsSet(){
        $res = true;
        $errMsg = "Erro no preenchimento do formulário de cadastro\\n";
        if(!isset($_POST["nome"]) || strlen($_POST["nome"]) <= 0){
            $errMsg .= "O campo 'Nome' não está válido\\n";
            $res = false;
        }
        if(!isset($_POST["data_nascimento"])){
            $errMsg .= "O campo 'data de nascimento' não está válido\\n";
            $res = false;
        }
        if(!isset($_POST["cpf"]) || strlen($_POST["cpf"]) != 11 || !ValidateCPF()){
            $errMsg .= "O campo 'CPF' não está válido\\n";
            $res = false;
        }
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
        if(!$res)
            JSAlert($errMsg);
        
        return $res;
    }

    if(isset($_POST["cadastrar"])){
        if(AllVarsSet())
            Cadastrar();
        else JSAlert("Todos os campos devem estar validamente preenchidos para que o cadastro seja realizado");
    }

    function Cadastrar(){
        if(DBCadastroExiste($_POST["nome"])){
            JSAlert("Usuário já existe, faça login");
            exit();
        }

        $dadosUsuario = new UserData();
        $dadosUsuario->Nome = $_POST["nome"];
        $dadosUsuario->Data_Nascimento = $_POST["data_nascimento"];
        $dadosUsuario->CPF = $_POST["cpf"];
        $dadosUsuario->Telefone = $_POST["telefone"];
        $dadosUsuario->Email = $_POST["email"];
        $dadosUsuario->Senha = $_POST["senha"];
        $dadosUsuario->Rua = $_POST["rua"];
        $dadosUsuario->Numero = $_POST["numero"];
        if(!DBRegistrarUsuario($dadosUsuario)){
            JSAlert("Houve um erro na hora do cadastro, tente novamente");
            exit();
        }

        $_SESSION["dadosUsuario"] = $dadosUsuario;
        header("Location: perfil.php");
        exit();
    }
    ?>

    <nav>
        <a href="index.html" class="time">Timeup</a>
    </nav>
    <div class="painel-cadastro">
        <div class="cadastro">
            <form class="card-cadastro" method="post">
                <h1>Cadastro</h1>
                <div class="textfield">
                    <label for="nome">Nome</label>
                    <input type="text" name="nome" maxlength="50" placeholder="Nome">
                </div>
                <div class="textfield">
                    <label for="data_nascimento">Data de Nascimento</label>
                    <input type="date" name="data_nascimento" placeholder="dd/mm/aaaa">
                </div>
                <div class="textfield">
                    <label for="cpf">CPF</label>
                    <input type="text" name="cpf" maxlength="11" placeholder="CPF">
                </div>
                <div class="textfield">
                    <label for="telefone">Telefone</label>
                    <input type="text" name="telefone" maxlength="11" placeholder="Telefone">
                </div>
                <div class="textfield">
                    <label for="email">Email</label>
                    <input type="email" name="email" maxlength="50" placeholder="Email">
                </div>
                <div class="textfield">
                    <label for="senha">Senha</label>
                    <input type="password" name="senha" maxlength="20" placeholder="Senha">
                </div>
                <div class="textfield">
                    <label for="rua">Rua</label>
                    <input type="text" name="rua" maxlength="30" placeholder="Rua">
                </div>
                <div class="textfield">
                    <label for="numero">Numero</label>
                    <input type="number" name="numero" placeholder="Numero">
                </div>
                <button type="submit" class="btn-cadastro" name="cadastrar">cadastro</button>
            </form>
        </div>
    </div>
</body>
</html>