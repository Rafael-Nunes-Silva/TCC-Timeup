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
        function ValidateCPF(){
            $cpf = $_POST["cpf"];

            $sum1 = 0;
            $sum2 = 0;
            for($i = 0, $j = 1; $i<9 && $j<10; $i++, $j++){
                $sum1 += $cpf[$i]*(10-$i);
                $sum2 += $cpf[$j]*(10-$i);
            }
            $r = $sum1%11;
            $s = $sum2%11;
            $d1 = ($r <= 1 ? 0 : 11-$r);
            $d2 = ($s <= 1 ? 0 : 11-$s);

            echo("CPF: ".$cpf."<br>");
            echo($cpf[9]." == ".$d1."<br>");
            echo($cpf[10]." == ".$d2."<br>");

            return ($cpf[9] == $d1 && $cpf[10] == $d2);
        }
        function ValidadeTelefone(){
            //TODO: Verificar se o numero de telefone inserido no campo 'Telefone' é valido enviando uma
            //menssagem de verificação
            return true;
        }
        function ValidadeEmail(){
            //TODO: Verificar se o email inserido no campo 'Email' é valido enviando um email de verificação
            return true;
        }
        function allVarsSet(){
            $res = true;
            if(!isset($_POST["nome"]) || strlen($_POST["nome"]) <= 0){
                echo("O campo 'Nome' não esta valido<br>");
                $res = false;
            }
            if(!isset($_POST["data_nascimento"])){
                echo("O campo 'data de nascimento' não esta valido<br>");
                $res = false;
            }
            if(!isset($_POST["cpf"]) || strlen($_POST["cpf"]) != 11 || !ValidateCPF()){
                echo("O campo 'CPF' não esta valido<br>");
                $res = false;
            }
            if(!isset($_POST["telefone"]) || strlen($_POST["telefone"]) != 11 || !ValidadeTelefone()){
                echo("O campo 'Telefone' não esta valido<br>");
                $res = false;
            }
            if(!isset($_POST["email"]) || strlen($_POST["email"]) <= 0 || !ValidadeEmail()){
                echo("O campo 'Email' não esta valido<br>");
                $res = false;
            }
            if(!isset($_POST["senha"])){
                echo("O campo 'Senha' não esta valido<br>");
                $res = false;
            }
            if(!isset($_POST["rua"])){
                echo("O campo 'Rua' não esta valido<br>");
                $res = false;
            }
            if(!isset($_POST["numero"])){
                echo("O campo 'Número' não esta valido<br>");
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
            $dadosUsuario->Nome = $_POST["nome"];
            $dadosUsuario->Data_Nascimento = $_POST["data_nascimento"];
            $dadosUsuario->CPF = $_POST["cpf"];
            $dadosUsuario->Telefone = $_POST["telefone"];
            $dadosUsuario->Email = $_POST["email"];
            $dadosUsuario->Senha = $_POST["senha"];
            $dadosUsuario->Rua = $_POST["rua"];
            $dadosUsuario->Numero = $_POST["numero"];

            $existCheck = "SELECT CPF FROM Cliente WHERE Nome = '$dadosUsuario->Nome'";
            $checkRes = $connection->query($existCheck);

            if($checkRes->num_rows > 0){
                if($checkRes->fetch_assoc()["CPF"] == $dadosUsuario->CPF)
                    echo("Usuário já existe, faça login");
                $connection->close();
                return;
            }

            $insertQuery = "INSERT INTO Cliente (Nome, Data_Nascimento, CPF, Telefone, Email, Senha, Rua, Numero) VALUES ('$dadosUsuario->Nome', '$dadosUsuario->Data_Nascimento', '$dadosUsuario->CPF', '$dadosUsuario->Telefone', '$dadosUsuario->Email', '$dadosUsuario->Senha', '$dadosUsuario->Rua', '$dadosUsuario->Numero')";
            $connection->query($insertQuery);

            $checkQuery = "SELECT * FROM Cliente WHERE Nome = '$dadosUsuario->Nome'";
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
                <h1>cadastro</h1>
                <div class="textfield">
                    <label for="nome">Nome</label>
                    <input type="text" name="nome" placeholder="Nome">
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
                <button type="submit" class="btn-cadastro" name="cadastrar">cadastro</button>
            </form>
        </div>
    </div>
</body>
</html>