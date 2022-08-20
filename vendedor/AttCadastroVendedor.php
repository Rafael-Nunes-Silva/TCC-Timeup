<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estilo/cadastro.css">
    <link rel="shortcut icon" href="icones/oie_7TZtpCUaslPH.jpg" type="image/x-icon">
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
        $dadosVendedor = $_SESSION["dadosVendedor"];

        if(DBRecuperarVendedor($dadosVendedor->CNPJ)->Senha != $_POST["senha"]){
            JSAlert("Senha incorreta");
            exit();
        }
        
        $dadosVendedor->Email = $_POST["email"];
        $dadosVendedor->Rua = $_POST["rua"];
        $dadosVendedor->Numero = $_POST["numero"];

        if(!DBAtualizarVendedor($dadosVendedor->CNPJ, DadosVendedor::Email, $dadosVendedor->Email)
        || !DBAtualizarVendedor($dadosVendedor->CNPJ, DadosVendedor::Rua, $dadosVendedor->Rua)
        || !DBAtualizarVendedor($dadosVendedor->CNPJ, DadosVendedor::Numero, $dadosVendedor->Numero)){
            JSAlert("Houve um erro ao realizar a atualização do cadastro, tente novamente");
            exit();
        }
        
        header("Location: PerfilVendedor.php");
        exit();
    }
    ?>

    <div class="painel-cadastro">
        <div class="cadastro">
            <form class="card-cadastro" method="post">
                <a href="PerfilVendedor.php">Atualizar Dados</a>
                <p>Atualize seus dados!</p>
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
                    <input type="password" name="senha" placeholder="Senha">
                </div>
                <button type="submit" class="btn-attcadastro" name="attcadastro">Atualizar</button>
            </form>
        </div>
    </div>
</body>
</html>