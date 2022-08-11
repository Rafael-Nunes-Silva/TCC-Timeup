<?php
// Verifica se o CPF é válido
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

    return ($cpf[9] == $d1 && $cpf[10] == $d2);
}
// Faz a verificação por Telefone
function ValidadeTelefone(){
    //TODO: Verificar se o numero de telefone inserido no campo 'Telefone' é valido enviando uma
    //menssagem de verificação
    return true;
}
// Faz a verificação por Email
function ValidadeEmail(){
    //TODO: Verificar se o email inserido no campo 'Email' é valido enviando um email de verificação
    return true;
}

// Cria uma alert box com javascript
function JSAlert($msg){
    echo("<script type='text/javascript'>alert(\"".$msg."\")</script>");
}

// Inicia e retorna uma conexão com o banco de dados
function DBconnect(){
    return new mysqli("localhost", "root", "", "timeupdb");
}
/////////////////////////////////////////////////USUÁRIO/////////////////////////////////////////////////////
// Verifica se o usuário portador do nome especificado já esta cadastrado e retorna verdadeiro ou falso
function DBCadastroExiste($nome){
    $connection = DBconnect();
    $queryRes = $connection->query("SELECT * FROM Cliente WHERE Nome = '$nome'");
    DBdisconnect($connection);
    return ($queryRes->num_rows > 0);
}
// Insere os dados de um usuário no banco de dados
function DBRegistrarUsuario($dadosUsuario){
    $connection = DBconnect();
    $queryRes = $connection->query("INSERT INTO Cliente (Nome, Data_Nascimento, CPF, Telefone, Email, Senha, Rua, Numero) VALUES ('$dadosUsuario->Nome', '$dadosUsuario->Data_Nascimento', '$dadosUsuario->CPF', '$dadosUsuario->Telefone', '$dadosUsuario->Email', '$dadosUsuario->Senha', '$dadosUsuario->Rua', '$dadosUsuario->Numero')");
    DBdisconnect($connection);
    return $queryRes;
}
// Recupera os dados de um usuário com o nome especificado
function DBRecuperarUsuario($nome){
    $connection = DBconnect();
    $queryRes = $connection->query("SELECT * FROM Cliente WHERE Nome = '$nome'")->fetch_assoc();
    $dadosUsuario = new UserData();
    $dadosUsuario->Nome = $queryRes["Nome"];
    $dadosUsuario->Data_Nascimento = $queryRes["Data_Nascimento"];
    $dadosUsuario->CPF = $queryRes["CPF"];
    $dadosUsuario->Telefone = $queryRes["Telefone"];
    $dadosUsuario->Email = $queryRes["Email"];
    $dadosUsuario->Senha = $queryRes["Senha"];
    $dadosUsuario->Rua = $queryRes["Rua"];
    $dadosUsuario->Numero = $queryRes["Numero"];
    DBdisconnect($connection);
    return $dadosUsuario;
}
// Atualiza os dados do usuário especificado no banco de dados
function DBAtualizarUsuario($dadosUsuario){
    $connection = DBconnect();
    $queryRes = $connection->query("UPDATE Cliente SET Telefone = '$dadosUsuario->Telefone', Email = '$dadosUsuario->Email', Rua = '$dadosUsuario->Rua', Numero = '$dadosUsuario->Numero' WHERE CPF = '$dadosUsuario->CPF'");
    DBdisconnect($connection);
    return $queryRes;
}
// Atualiza a senha do usuário especificado no banco de dados
function DBAtualizarSenha($dadosUsuario){
    $connection = DBconnect();
    $queryRes = $connection->query("UPDATE Cliente SET Senha = '$dadosUsuario->Senha' WHERE CPF = '$dadosUsuario->CPF'");
    return $queryRes;
}
// Delete o usuário especificado do banco de dados
function DBDeletarUsuario($dadosUsuario){
    $connection = DBconnect();
    $queryRes = $connection->query("DELETE FROM Cliente WHERE CPF = '$dadosUsuario->CPF'");
    return $queryRes;
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Termina a conexão com o banco de dados
function DBdisconnect($connection){
    $connection->close();
}
?>