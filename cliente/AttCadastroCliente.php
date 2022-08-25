<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estilo/cadastro.css">
    <link rel="shortcut icon" href="icones/oie_7TZtpCUaslPH.jpg" type="image/x-icon">
    <script src="../scripts/mascaras.js"></script>
    <title>Timeup - Atualizar Informações</title>
</head>
<body>
    <?php
    require_once("../Dados.php");
    require_once("../Utilidades.php");
    session_start();

    function AllVarsSet(){
        $res = true;
        $errMsg = "Erro no preenchimento do formulário de cadastro\\n";
        if(!isset($_POST["telefone"]) || strlen($_POST["telefone"]) != 11 || !ValidarTelefone()){
            $errMsg .= "O campo 'Telefone' não está válido\\n";
            $res = false;
        }
        if(!isset($_POST["email"]) || strlen($_POST["email"]) <= 0 || !ValidarEmail()){
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
            AtualizarCadastro();
        else JSAlert("Todos os campos devem estar validamente preenchidos para que o cadastro seja realizado");
    }

    function AtualizarCadastro(){
        $dadosCliente = $_SESSION["dadosCliente"];

        if(DBRecuperarCliente($dadosCliente->CPF)->Senha != $_POST["senha"]){
            JSAlert("Senha incorreta");
            exit();
        }
        
        $dadosCliente->Telefone = $_POST["telefone"];
        $dadosCliente->Email = $_POST["email"];
        $dadosCliente->Rua = $_POST["rua"];
        $dadosCliente->Numero = $_POST["numero"];

        if(!DBAtualizarCliente($dadosCliente->CPF, DadosCliente::Telefone, $dadosCliente->Telefone)
        || !DBAtualizarCliente($dadosCliente->CPF, DadosCliente::Email, $dadosCliente->Email)
        || !DBAtualizarCliente($dadosCliente->CPF, DadosCliente::Rua, $dadosCliente->Rua)
        || !DBAtualizarCliente($dadosCliente->CPF, DadosCliente::Numero, $dadosCliente->Numero)){
            JSAlert("Houve um erro ao realizar a atualização do cadastro, tente novamente");
            return;
        }
        
        header("Location: PerfilCliente.php");
        exit();
    }
    ?>

    <div class="painel-cadastro">
        <div class="cadastro">
            <form class="card-cadastro" method="post">
                <a href="PerfilCliente.php">Atualizar Dados</a>
                <p>Atualize seus dados!</p>
                <div class="textfield">
                    <label for="telefone">Telefone</label>
                    <input type="text" name="telefone" maxlength="11" value="<?php echo($_SESSION["dadosCliente"]->Telefone)?>" oninput="MascaraTelefone(this)">
                </div>
                <div class="textfield">
                    <label for="email">Email</label>
                    <input type="email" name="email" maxlength="50" value="<?php echo($_SESSION["dadosCliente"]->Email)?>">
                </div>
                <div class="textfield">
                    <label for="rua">Rua</label>
                    <input type="text" name="rua" maxlength="30" value="<?php echo($_SESSION["dadosCliente"]->Rua)?>">
                </div>
                <div class="textfield">
                    <label for="numero">Numero</label>
                    <input type="number" name="numero" value="<?php echo($_SESSION["dadosCliente"]->Numero)?>">
                </div>
                <br><br><br>
                <div class="textfield">
                    <label for="senha">Senha Atual</label>
                    <input type="password" name="senha" placeholder="Senha">
                </div>
                <button type="submit" class="btn-attcadastro" name="attcadastro">Atualizar</button>
            </form>
        </div>
    </div>
</body>
</html>