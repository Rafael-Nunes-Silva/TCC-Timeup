<?php
// Verifica se o CPF é válido
function ValidarCPF($CPF){
    $CPF = DesformatarCPF($CPF);

    $sum1 = 0;
    $sum2 = 0;
    for($i = 0, $j = 1; $i<9 && $j<10; $i++, $j++){
        $sum1 += $CPF[$i]*(10-$i);
        $sum2 += $CPF[$j]*(10-$i);
    }
    $r = $sum1%11;
    $s = $sum2%11;
    $d1 = ($r <= 1 ? 0 : 11-$r);
    $d2 = ($s <= 1 ? 0 : 11-$s);

    return ($CPF[9] == $d1 && $CPF[10] == $d2);
}
// Formata o CPF de um formato como 11122233344 para 111.222.333-44
function FormatarCPF($CPF){
    if(strlen($CPF) == 14) return $CPF;
    $novoCPF = $CPF[0].$CPF[1].$CPF[2].".".$CPF[3].$CPF[4].$CPF[5].".".$CPF[6].$CPF[7].$CPF[8]."-".$CPF[9].$CPF[10];
    return $novoCPF;
}
// Desformata o CPF de um formato como 111.222.333-44 para 11122233344
function DesformatarCPF($CPF){
    if(strlen($CPF) == 11) return $CPF;
    $novoCPF = $CPF[0].$CPF[1].$CPF[2].$CPF[4].$CPF[5].$CPF[6].$CPF[8].$CPF[9].$CPF[10].$CPF[12].$CPF[13];
    return $novoCPF;
}

// Verifica se o CNPJ é válido
function ValidarCNPJ($CNPJ){
    $CNPJ = DesformatarCNPJ($CNPJ);

    $sum1 = $CNPJ[0]*5 + $CNPJ[1]*4 + $CNPJ[2]*3 + $CNPJ[3]*2 + $CNPJ[4]*9 + $CNPJ[5]*8 + $CNPJ[6]*7 + $CNPJ[7]*6 + $CNPJ[8]*5 + $CNPJ[9]*4 + $CNPJ[10]*3 + $CNPJ[11]*2;
    $sum2 = $CNPJ[0]*6 + $CNPJ[1]*5 + $CNPJ[2]*4 + $CNPJ[3]*3 + $CNPJ[4]*2 + $CNPJ[5]*9 + $CNPJ[6]*8 + $CNPJ[7]*7 + $CNPJ[8]*6 + $CNPJ[9]*5 + $CNPJ[10]*4 + $CNPJ[11]*3 + $CNPJ[12]*2;
    $r = $sum1%11;
    $s = $sum2%11;
    $d1 = ($r <= 2 ? 0 : 11-$r);
    $d2 = ($s <= 2 ? 0 : 11-$s);

    return ($CNPJ[12] == $d1 && $CNPJ[13] == $d2);
}
// Formata o CNPJ de um formato como 11222333444455 para 11.222.333/4444-55
function FormatarCNPJ($CNPJ){
    if(strlen($CNPJ) == 18) return $CNPJ;
    $novoCNPJ = $CNPJ[0].$CNPJ[1].".".$CNPJ[2].$CNPJ[3].$CNPJ[4].".".$CNPJ[5].$CNPJ[6].$CNPJ[7]."/".$CNPJ[8].$CNPJ[9].$CNPJ[10].$CNPJ[11]."-".$CNPJ[12].$CNPJ[13];
    return $novoCNPJ;
}
// Desformata o CNPJ de um formato como 11.222.333/4444-55 para 11222333444455
function DesformatarCNPJ($CNPJ){
    if(strlen($CNPJ) == 14) return $CNPJ;
    $novoCNPJ = $CNPJ[0].$CNPJ[1].$CNPJ[3].$CNPJ[4].$CNPJ[5].$CNPJ[7].$CNPJ[8].$CNPJ[9].$CNPJ[11].$CNPJ[12].$CNPJ[13].$CNPJ[14].$CNPJ[16].$CNPJ[17];
    return $novoCNPJ;
}

// Faz a verificação por Telefone
function ValidarTelefone(){
    //TODO: Verificar se o numero de telefone inserido no campo 'Telefone' é valido enviando uma
    //menssagem de verificação
    return true;
}
// Formata o Telefone de um formato como 10123456789 para 10 12345-6789
function FormatarTelefone($Telefone){
    $novoTelefone = $Telefone[0].$Telefone[1]." ".$Telefone[2].$Telefone[3].$Telefone[4].$Telefone[5].$Telefone[6]."-".$Telefone[7].$Telefone[8].$Telefone[9].$Telefone[10];
    return $novoTelefone;
}
// Desformata o CNPJ de um formato como 10 12345-6789 para 10123456789
function DesformatarTelefone($Telefone){
    $novoTelefone = $Telefone[0].$Telefone[1].$Telefone[3].$Telefone[4].$Telefone[5].$Telefone[6].$Telefone[7].$Telefone[9].$Telefone[10].$Telefone[11].$Telefone[12];
    return $novoTelefone;
}

// Faz a verificação por Email
function ValidarEmail(){
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

// Verifica se o usuário portador do CPF especificado já está cadastrado e retorna verdadeiro ou falso
// Os dados devem estar corretamente formatados
function DBClienteExiste($CPF){
    $CPF = DesformatarCPF($CPF);
    $connection = DBconnect();
    $queryRes = $connection->query("SELECT * FROM Cliente WHERE CPF = '$CPF'");
    DBdisconnect($connection);
    return ($queryRes->num_rows > 0);
}
// Verifica se o vendedor portador do CNPJ especificado já está cadastrado e retorna verdadeiro ou falso
// Os dados devem estar corretamente formatados
function DBVendedorExiste($CNPJ){
    $CNPJ = DesformatarCNPJ($CNPJ);
    $connection = DBconnect();
    $queryRes = $connection->query("SELECT * FROM Vendedor WHERE CNPJ = '$CNPJ'");
    DBdisconnect($connection);
    return ($queryRes->num_rows > 0);
}

// Insere os dados de um usuário no banco de dados
// Os dados devem estar corretamente formatados
function DBRegistrarCliente($dadosCliente){
    $dadosCliente->CPF = DesformatarCPF($dadosCliente->CPF);
    $dadosCliente->Telefone = DesformatarTelefone($dadosCliente->Telefone);
    $connection = DBconnect();
    $queryRes = $connection->query("INSERT INTO Cliente (Nome, Data_Nascimento, CPF, Telefone, Email, Senha, Rua, Numero) VALUES ('$dadosCliente->Nome', '$dadosCliente->Data_Nascimento', '$dadosCliente->CPF', '$dadosCliente->Telefone', '$dadosCliente->Email', '$dadosCliente->Senha', '$dadosCliente->Rua', '$dadosCliente->Numero')");
    DBdisconnect($connection);
    return $queryRes;
}
// Insere os dados de um vendedor no banco de dados
// Os dados devem estar corretamente formatados
function DBRegistrarVendedor($dadosVendedor){
    $dadosVendedor->CNPJ = DesformatarCNPJ($dadosVendedor->CNPJ);
    $connection = DBconnect();
    $queryRes = $connection->query("INSERT INTO Vendedor (Nome, CNPJ, Email, Senha, Rua, Numero) VALUES ('$dadosVendedor->Nome', '$dadosVendedor->CNPJ', '$dadosVendedor->Email', '$dadosVendedor->Senha', '$dadosVendedor->Rua', '$dadosVendedor->Numero')");
    DBdisconnect($connection);
    return $queryRes;
}

// Recupera os dados de um usuário com o nome CPF
// Os dados devem estar corretamente formatados
function DBRecuperarCliente($CPF){
    $CPF = DesformatarCPF($CPF);
    $connection = DBconnect();
    $queryRes = $connection->query("SELECT * FROM Cliente WHERE CPF = '$CPF'")->fetch_assoc();
    $dadosCliente = new ObjCliente();
    $dadosCliente->Nome = $queryRes["Nome"];
    $dadosCliente->Data_Nascimento = $queryRes["Data_Nascimento"];
    $dadosCliente->CPF = FormatarCPF($queryRes["CPF"]);
    $dadosCliente->Telefone = FormatarTelefone($queryRes["Telefone"]);
    $dadosCliente->Email = $queryRes["Email"];
    $dadosCliente->Senha = $queryRes["Senha"];
    $dadosCliente->Rua = $queryRes["Rua"];
    $dadosCliente->Numero = $queryRes["Numero"];
    DBdisconnect($connection);
    return $dadosCliente;
}
// Recupera os dados de um vendedor com o nome CNPJ
// Os dados devem estar corretamente formatados
function DBRecuperarVendedor($CNPJ){
    $CNPJ = DesformatarCNPJ($CNPJ);
    $connection = DBconnect();
    $queryRes = $connection->query("SELECT * FROM Vendedor WHERE CNPJ = '$CNPJ'")->fetch_assoc();
    $dadosVendedor = new ObjVendedor();
    $dadosVendedor->Nome = $queryRes["Nome"];
    $dadosVendedor->CNPJ = FormatarCNPJ($queryRes["CNPJ"]);
    $dadosVendedor->Email = $queryRes["Email"];
    $dadosVendedor->Senha = $queryRes["Senha"];
    $dadosVendedor->Rua = $queryRes["Rua"];
    $dadosVendedor->Numero = $queryRes["Numero"];
    DBdisconnect($connection);
    return $dadosVendedor;
}

// Atualiza os dados do usuário especificado no banco de dados
// Os dados devem estar corretamente formatados
function DBAtualizarCliente($CPF, $dado, $valor){
    $CPF = DesformatarCPF($CPF);
    if($dado == DadosCliente::CPF)
        $valor = DesformatarCPF($valor);
    else if($dado == DadosCliente::Telefone)
        $valor = DesformatarTelefone($valor);
    
    $connection = DBconnect();
    $queryRes = $connection->query("UPDATE Cliente SET $dado = '$valor' WHERE CPF = '$CPF'");
    DBdisconnect($connection);
    return $queryRes;
}
// Atualiza os dados do vendedor especificado no banco de dados
// Os dados devem estar corretamente formatados
function DBAtualizarVendedor($CNPJ, $dado, $valor){
    $CNPJ = DesformatarCNPJ($CNPJ);
    if($dado == DadosVendedor::CNPJ)
        $valor = DesformatarCNPJ($valor);
    $connection = DBconnect();
    $queryRes = $connection->query("UPDATE Vendedor SET $dado = '$valor' WHERE CNPJ = '$CNPJ'");
    DBdisconnect($connection);
    return $queryRes;
}

// Deleta o usuário especificado do banco de dados
// Os dados devem estar corretamente formatados
function DBDeletarCliente($CPF){
    $CPF = DesformatarCPF($CPF);
    $connection = DBconnect();
    $queryRes = $connection->query("DELETE FROM Cliente WHERE CPF = '$CPF'");
    return $queryRes;
}
// Deleta o vendedor especificado do banco de dados
// Os dados devem estar corretamente formatados
function DBDeletarVendedor($CNPJ){
    $CNPJ = DesformatarCNPJ($CNPJ);
    $connection = DBconnect();
    $queryRes = $connection->query("DELETE FROM Vendedor WHERE CNPJ = '$CNPJ'");
    return $queryRes;
}

// Termina a conexão com o banco de dados
function DBdisconnect($connection){
    $connection->close();
}
?>