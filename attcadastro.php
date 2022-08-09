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

        function allVarsSet(){
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

        if(isset($_POST["cadastrar"])){
            if(AllVarsSet())
                Cadastrar();
            else JSAlert("Todos os campos devem estar validamente preenchidos para que o cadastro seja realizado");
        }

        function Cadastrar(){
            $connection = new mysqli("localhost", "root", "", "timeupdb");

            session_start();
            $dadosUsuario = $_SESSION["userData"];

            $checkQuery = "SELECT * FROM Cliente WHERE Nome = '$dadosUsuario->Nome'";
            $checkQueryRes = $connection->query($checkQuery);
            if($checkQueryRes->num_rows > 0){
                $updateQuery = "UPDATE Cliente SET Nome = '$dadosUsuario->Nome', Data_Nascimento = '$dadosUsuario->Data_Nascimento', CPF = '$dadosUsuario->CPF', Telefone = '$dadosUsuario->Telefone', Email = '$dadosUsuario->Email', Senha = '$dadosUsuario->Senha', Rua = '$dadosUsuario->Rua', Numero = '$dadosUsuario->Numero'";
                $updateQueryRes = $connection->query($updateQuery);
                if ($updateQueryRes === TRUE)
                    JSAlert("Cadastro atualizado com sucesso");
                else JSAlert("Erro ao atualizar cadastro: " . $connection->error);
            }
            
            $connection->close();
        }
    ?>

    <div class="painel-cadastro">
        <div class="cadastro">
            <form class="card-cadastro" method="post">
                <a href="index.html">Atualizar Dados</a>
                <p>Altere os seus dados!</p>
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
                <button type="submit" class="btn-cadastro" name="cadastrar">Atualizar</button>
            </form>
        </div>
    </div>
</body>
</html>