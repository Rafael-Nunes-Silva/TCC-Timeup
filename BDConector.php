<?php
require_once("Utilidades.php");
// Inicia e retorna uma conexão com o banco de dados
function BDconnect(){
    return new mysqli("localhost", "id19569475_timeupadmin", "jsW*zpzX]=NY02~4", "id19569475_timeupbd");
}

// Verifica se a foto com o ID especificado existe no banco de dados
function BDFotoExiste($ID){
    $connection = BDconnect();
    $queryRes = $connection->query("SELECT * FROM Foto WHERE ID = '$ID'");
    BDdisconnect($connection);
    return ($queryRes->num_rows > 0);
}
// Verifica se o usuário portador do CPF especificado já está cadastrado e retorna verdadeiro ou falso, os dados devem estar corretamente formatados
function BDClienteExiste($CPF){
    $CPF = DesformatarCPF($CPF);
    $connection = BDconnect();
    $queryRes = $connection->query("SELECT * FROM Cliente WHERE CPF = '$CPF'");
    BDdisconnect($connection);
    return ($queryRes->num_rows > 0);
}
// Verifica se o vendedor portador do CNPJ especificado já está cadastrado e retorna verdadeiro ou falso, os dados devem estar corretamente formatados
function BDVendedorExiste($CNPJ){
    $CNPJ = DesformatarCNPJ($CNPJ);
    $connection = BDconnect();
    $queryRes = $connection->query("SELECT * FROM Vendedor WHERE CNPJ = '$CNPJ'");
    BDdisconnect($connection);
    return ($queryRes->num_rows > 0);
}

// Insere uma foto no banco de dados
function BDRegistrarFoto($Nome, $Caminho, $Diretorio){
    $connection = BDconnect();

    if(!file_exists($Diretorio))
        mkdir($Diretorio, 0777, true);

    if(!move_uploaded_file($Caminho, $Diretorio.$Nome)){
        return 0;
    }
    
    $insertQueryRes = $connection->query("INSERT INTO Foto (Nome) VALUES ('$Nome')");
    if(!$insertQueryRes){
        BDdisconnect($connection);
        return 0;
    }
    
    $selectQueryRes = $connection->query("SELECT * FROM Foto WHERE Nome = '$Nome'")->fetch_assoc();
    BDdisconnect($connection);
    return $selectQueryRes["ID"];
}
// Insere os dados de um usuário no banco de dados, os dados devem estar corretamente formatados
function BDRegistrarCliente($dadosCliente){
    $dadosCliente->CPF = DesformatarCPF($dadosCliente->CPF);
    $dadosCliente->Telefone = DesformatarTelefone($dadosCliente->Telefone);
    $connection = BDconnect();
    JSAlert($dadosCliente->Foto);
    $queryRes = $connection->query("INSERT INTO Cliente (Nome, Foto, Data_Nascimento, CPF, Telefone, Email, Senha, Rua, Numero) VALUES ('$dadosCliente->Nome', '$dadosCliente->Foto', '$dadosCliente->Data_Nascimento', '$dadosCliente->CPF', '$dadosCliente->Telefone', '$dadosCliente->Email', '$dadosCliente->Senha', '$dadosCliente->Rua', '$dadosCliente->Numero')");
    BDdisconnect($connection);
    return $queryRes;
}
// Insere os dados de um vendedor no banco de dados, os dados devem estar corretamente formatados
function BDRegistrarVendedor($dadosVendedor){
    $dadosVendedor->CNPJ = DesformatarCNPJ($dadosVendedor->CNPJ);
    $connection = BDconnect();
    $queryRes = $connection->query("INSERT INTO Vendedor (Nome, Foto, CNPJ, Email, Senha, Rua, Numero) VALUES ('$dadosVendedor->Nome', '(SELECT * FROM OPENROWSET(BULK '$dadosVendedor->Foto', SINGLE_BLOB))', '$dadosVendedor->CNPJ', '$dadosVendedor->Email', '$dadosVendedor->Senha', '$dadosVendedor->Rua', '$dadosVendedor->Numero')");
    BDdisconnect($connection);
    return $queryRes;
}

// Recupera o nome de uma foto com o ID especificado
function BDRecuperarFoto($ID){
    $connection = BDconnect();
    $queryRes = $connection->query("SELECT * FROM Foto WHERE ID = '$ID'")->fetch_assoc();
    BDdisconnect($connection);
    return $queryRes["Nome"];
}
// Recupera os dados de um usuário com o nome CPF, os dados devem estar corretamente formatados
function BDRecuperarCliente($CPF){
    $CPF = DesformatarCPF($CPF);
    $connection = BDconnect();
    $queryRes = $connection->query("SELECT * FROM Cliente WHERE CPF = '$CPF'")->fetch_assoc();
    $dadosCliente = new ObjCliente();
    $dadosCliente->Foto = $queryRes["Foto"];
    $dadosCliente->Nome = $queryRes["Nome"];
    $dadosCliente->Data_Nascimento = $queryRes["Data_Nascimento"];
    $dadosCliente->CPF = FormatarCPF($queryRes["CPF"]);
    $dadosCliente->Telefone = FormatarTelefone($queryRes["Telefone"]);
    $dadosCliente->Email = $queryRes["Email"];
    $dadosCliente->Senha = $queryRes["Senha"];
    $dadosCliente->Rua = $queryRes["Rua"];
    $dadosCliente->Numero = $queryRes["Numero"];
    BDdisconnect($connection);
    return $dadosCliente;
}
// Recupera os dados de um vendedor com o nome CNPJ, os dados devem estar corretamente formatados
function BDRecuperarVendedor($CNPJ){
    $CNPJ = DesformatarCNPJ($CNPJ);
    $connection = BDconnect();
    $queryRes = $connection->query("SELECT * FROM Vendedor WHERE CNPJ = '$CNPJ'")->fetch_assoc();
    $dadosVendedor = new ObjVendedor();
    $dadosVendedor->Foto = $queryRes["Foto"];
    $dadosVendedor->Nome = $queryRes["Nome"];
    $dadosVendedor->CNPJ = FormatarCNPJ($queryRes["CNPJ"]);
    $dadosVendedor->Email = $queryRes["Email"];
    $dadosVendedor->Senha = $queryRes["Senha"];
    $dadosVendedor->Rua = $queryRes["Rua"];
    $dadosVendedor->Numero = $queryRes["Numero"];
    BDdisconnect($connection);
    return $dadosVendedor;
}

// Atualiza o nome de uma foto com o ID especificado
function BDAtualizarFoto($ID, $Nome, $Caminho, $Diretorio){
    $connection = BDconnect();
    if(!rename($Diretorio.BDRecuperarFoto($ID), $Diretorio.$Nome)){
        JSAlert("Erro ao atualizar foto de perfil");
        BDdisconnect($connection);
        return;
    }
    move_uploaded_file($Caminho, $Diretorio.$Nome);
    $queryRes = $connection->query("UPDATE SET Nome = $Nome WHERE ID = '$ID'");
    BDdisconnect($connection);
    return $queryRes;
}
// Atualiza os dados do usuário especificado no banco de dados, os dados devem estar corretamente formatados
function BDAtualizarCliente($CPF, $dado, $valor){
    $CPF = DesformatarCPF($CPF);
    if($dado == DadosCliente::CPF)
        $valor = DesformatarCPF($valor);
    else if($dado == DadosCliente::Telefone)
        $valor = DesformatarTelefone($valor);
    else if($dado == DadosCliente::Foto)
        $valor = "(SELECT * FROM OPENROWSET(BULK '$valor', SINGLE_BLOB))";
    $connection = BDconnect();
    $queryRes = $connection->query("UPDATE Cliente SET $dado = '$valor' WHERE CPF = '$CPF'");
    BDdisconnect($connection);
    return $queryRes;
}
// Atualiza os dados do vendedor especificado no banco de dados, os dados devem estar corretamente formatados
function BDAtualizarVendedor($CNPJ, $dado, $valor){
    $CNPJ = DesformatarCNPJ($CNPJ);
    if($dado == DadosVendedor::CNPJ)
        $valor = DesformatarCNPJ($valor);
    else if($dado == DadosCliente::Foto)
        $valor = "(SELECT * FROM OPENROWSET(BULK '$valor', SINGLE_BLOB))";
    $connection = BDconnect();
    $queryRes = $connection->query("UPDATE Vendedor SET $dado = '$valor' WHERE CNPJ = '$CNPJ'");
    BDdisconnect($connection);
    return $queryRes;
}

// Deleta a foto com o ID especificado
function BDDeletarFoto($ID){
    $connection = BDconnect();
    $queryRes = $connection->query("DELETE FROM Nome WHERE ID = '$ID'");
    BDdisconnect($connection);
    return $queryRes;
}
// Deleta o usuário especificado do banco de dados, os dados devem estar corretamente formatados
function BDDeletarCliente($CPF){
    $CPF = DesformatarCPF($CPF);
    $connection = BDconnect();
    $queryRes = $connection->query("DELETE FROM Cliente WHERE CPF = '$CPF'");
    return $queryRes;
}
// Deleta o vendedor especificado do banco de dados, os dados devem estar corretamente formatados
function BDDeletarVendedor($CNPJ){
    $CNPJ = DesformatarCNPJ($CNPJ);
    $connection = BDconnect();
    $queryRes = $connection->query("DELETE FROM Vendedor WHERE CNPJ = '$CNPJ'");
    return $queryRes;
}

// Termina a conexão com o banco de dados
function BDdisconnect($connection){
    $connection->close();
}
?>