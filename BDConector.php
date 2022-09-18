<?php
require_once("Utilidades.php");
// Inicia e retorna uma conexão com o banco de dados
function BDconnect(){
    return new mysqli("localhost", "id19569475_timeupadmin", "jsW*zpzX]=NY02~4", "id19569475_timeupbd");
}


// Verifica se a Foto com o ID especificado existe no banco de dados
function BDFotoExiste($ID){
    $connection = BDconnect();
    $queryRes = $connection->query("SELECT * FROM Foto_ID WHERE ID = '$ID'");
    BDdisconnect($connection);
    return ($queryRes->num_rows > 0);
}
// Insere uma Foto no banco de dados
function BDRegistrarFoto($Nome, $Caminho, $Diretorio){
    $connection = BDconnect();

    if(!file_exists($Diretorio))
        mkdir($Diretorio, 0755, true);

    if(!move_uploaded_file($Caminho, $Diretorio.$Nome)){
        JSAlert("Erro ao fazer upload da Foto");
        return 0;
    }
    
    $insertQueryRes = $connection->query("INSERT INTO Foto (Nome) VALUES ('$Nome')");
    if(!$insertQueryRes){
        JSAlert("Erro ao inserir Foto no banco de dados");
        BDdisconnect($connection);
        return 0;
    }
    
    $selectQueryRes = $connection->query("SELECT * FROM Foto WHERE Nome = '$Nome'")->fetch_assoc();
    BDdisconnect($connection);
    return $selectQueryRes["ID"];
}
// Recupera o nome de uma Foto com o ID especificado
function BDRecuperarFoto($ID){
    $connection = BDconnect();
    $queryRes = $connection->query("SELECT * FROM Foto WHERE ID = '$ID'")->fetch_assoc();
    BDdisconnect($connection);
    return $queryRes["Nome"];
}
// Atualiza o nome de uma Foto com o ID especificado
function BDAtualizarFoto($ID, $Nome, $Caminho, $Diretorio){
    $connection = BDconnect();
    if(!rename($Diretorio.BDRecuperarFoto($ID), $Diretorio.$Nome)){
        JSAlert("Erro ao atualizar Foto_ID de perfil");
        BDdisconnect($connection);
        return false;
    }
    move_uploaded_file($Caminho, $Diretorio.$Nome);
    $queryRes = $connection->query("UPDATE Foto SET Nome = $Nome WHERE ID = '$ID'");
    BDdisconnect($connection);
    return $queryRes;
}
// Deleta a Foto com o ID especificado
function BDDeletarFoto($ID){
    $connection = BDconnect();
    $queryRes = $connection->query("DELETE FROM Foto WHERE ID = '$ID'");
    BDdisconnect($connection);
    return $queryRes;
}


// Verifica se o usuário portador do CPF especificado já está cadastrado e retorna verdadeiro ou falso
function BDClienteExiste($CPF){
    $CPF = DesformatarCPF($CPF);
    $connection = BDconnect();
    $queryRes = $connection->query("SELECT * FROM Cliente WHERE CPF = '$CPF'");
    BDdisconnect($connection);
    return ($queryRes->num_rows > 0);
}
// Insere os dados de um usuário no banco de dados
function BDRegistrarCliente($dadosCliente){
    $dadosCliente->CPF = DesformatarCPF($dadosCliente->CPF);
    $dadosCliente->Telefone = DesformatarTelefone($dadosCliente->Telefone);
    $connection = BDconnect();
    JSAlert($dadosCliente->Foto_ID);
    $queryRes = $connection->query("INSERT INTO Cliente (Nome, Foto_ID, Data_Nascimento, CPF, Telefone, Email, Senha, Rua, Numero) VALUES ('$dadosCliente->Foto_ID', '$dadosCliente->Nome', '$dadosCliente->Data_Nascimento', '$dadosCliente->CPF', '$dadosCliente->Telefone', '$dadosCliente->Email', '$dadosCliente->Senha', '$dadosCliente->Rua', '$dadosCliente->Numero')");
    BDdisconnect($connection);
    return $queryRes;
}
// Recupera os dados de um usuário com o nome CPF
function BDRecuperarCliente($CPF){
    $CPF = DesformatarCPF($CPF);
    $connection = BDconnect();
    $queryRes = $connection->query("SELECT * FROM Cliente WHERE CPF = '$CPF'")->fetch_assoc();
    $dadosCliente = new ObjCliente();
    $dadosCliente->ID = $queryRes["ID"];
    $dadosCliente->Foto_ID = $queryRes["Foto_ID"];
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
// Atualiza os dados do usuário especificado no banco de dados
function BDAtualizarCliente($CPF, $dado, $valor){
    $CPF = DesformatarCPF($CPF);
    if($dado == DadosCliente::CPF)
        $valor = DesformatarCPF($valor);
    else if($dado == DadosCliente::Telefone)
        $valor = DesformatarTelefone($valor);
    $connection = BDconnect();
    $queryRes = $connection->query("UPDATE Cliente SET $dado = '$valor' WHERE CPF = '$CPF'");
    BDdisconnect($connection);
    return $queryRes;
}
// Deleta o usuário especificado do banco de dados
function BDDeletarCliente($CPF){
    $CPF = DesformatarCPF($CPF);
    $connection = BDconnect();
    $queryRes = $connection->query("DELETE FROM Cliente WHERE CPF = '$CPF'");
    return $queryRes;
}


// Verifica se o vendedor portador do CNPJ especificado já está cadastrado e retorna verdadeiro ou falso
function BDVendedorExiste($CNPJ){
    $CNPJ = DesformatarCNPJ($CNPJ);
    $connection = BDconnect();
    $queryRes = $connection->query("SELECT * FROM Vendedor WHERE CNPJ = '$CNPJ'");
    BDdisconnect($connection);
    return ($queryRes->num_rows > 0);
}
// Insere os dados de um vendedor no banco de dados
function BDRegistrarVendedor($dadosVendedor){
    $dadosVendedor->CNPJ = DesformatarCNPJ($dadosVendedor->CNPJ);
    $connection = BDconnect();
    $queryRes = $connection->query("INSERT INTO Vendedor (Foto_ID, Nome, CNPJ, Email, Senha, Rua, Numero) VALUES ('$dadosVendedor->Foto_ID', '$dadosVendedor->Nome', '$dadosVendedor->CNPJ', '$dadosVendedor->Email', '$dadosVendedor->Senha', '$dadosVendedor->Rua', '$dadosVendedor->Numero')");
    BDdisconnect($connection);
    return $queryRes;
}
// Recupera os dados de um vendedor com o nome CNPJ
function BDRecuperarVendedor($CNPJ){
    $CNPJ = DesformatarCNPJ($CNPJ);
    $connection = BDconnect();
    $queryRes = $connection->query("SELECT * FROM Vendedor WHERE CNPJ = '$CNPJ'")->fetch_assoc();
    $dadosVendedor = new ObjVendedor();
    $dadosVendedor->ID = $queryRes["ID"];
    $dadosVendedor->Foto_ID = $queryRes["Foto_ID"];
    $dadosVendedor->Nome = $queryRes["Nome"];
    $dadosVendedor->CNPJ = FormatarCNPJ($queryRes["CNPJ"]);
    $dadosVendedor->Email = $queryRes["Email"];
    $dadosVendedor->Senha = $queryRes["Senha"];
    $dadosVendedor->Rua = $queryRes["Rua"];
    $dadosVendedor->Numero = $queryRes["Numero"];
    BDdisconnect($connection);
    return $dadosVendedor;
}
// Atualiza os dados do vendedor especificado no banco de dados
function BDAtualizarVendedor($CNPJ, $dado, $valor){
    $CNPJ = DesformatarCNPJ($CNPJ);
    if($dado == DadosVendedor::CNPJ)
        $valor = DesformatarCNPJ($valor);
    $connection = BDconnect();
    $queryRes = $connection->query("UPDATE Vendedor SET $dado = '$valor' WHERE CNPJ = '$CNPJ'");
    BDdisconnect($connection);
    return $queryRes;
}
// Deleta o vendedor especificado do banco de dados
function BDDeletarVendedor($CNPJ){
    $CNPJ = DesformatarCNPJ($CNPJ);
    $connection = BDconnect();
    $queryRes = $connection->query("DELETE FROM Vendedor WHERE CNPJ = '$CNPJ'");
    return $queryRes;
}


// Verifica se o produto com o ID especificado já está cadastrado e retorna verdadeiro ou falso
function BDProdutoExiste($ID){
    $connection = BDconnect();
    $queryRes = $connection->query("SELECT * FROM Produto WHERE ID = '$ID'");
    BDdisconnect($connection);
    return ($queryRes->num_rows > 0);
}
// Registra um produto no banco de dados
function BDRegistrarProduto($dadosProduto){
    $connection = BDconnect();
    $queryRes = $connection->query("INSERT INTO Produto (Foto_ID, Nome, Codigo, Categoria, Quantidade, Vendedor_ID) VALUES ('$dadosProduto->Foto_ID', '$dadosProduto->Nome', '$dadosProduto->Codigo', '$dadosProduto->Categoria', '$dadosProduto->Quantidade', '$dadosProduto->Vendedor_ID')");
    BDdisconnect($connection);
    return $queryRes;
}
// Recupera os dados de um produto com o ID
function BDRecuperarProduto($ID){
    $connection = BDconnect();
    $queryRes = $connection->query("SELECT * FROM Produto WHERE ID = '$ID'")->fetch_assoc();
    $dadosProduto = new ObjProduto();
    $dadosProduto->ID = $queryRes["ID"];
    $dadosProduto->Foto_ID = $queryRes["Foto_ID"];
    $dadosProduto->Nome = $queryRes["Nome"];
    $dadosProduto->Codigo = $queryRes["Codigo"];
    $dadosProduto->Categoria = $queryRes["Categoria"];
    $dadosProduto->Quantidade = $queryRes["Quantidade"];
    $dadosProduto->Vendedor_ID = $queryRes["Vendedor_ID"];
    BDdisconnect($connection);
    return $dadosProduto;
}
// Atualiza os dados do produto com o ID especificado no banco de dados
function BDAtualizarProduto($ID, $dado, $valor){
    $connection = BDconnect();
    $queryRes = $connection->query("UPDATE Produto SET $dado = '$valor' WHERE ID = '$ID'");
    BDdisconnect($connection);
    return $queryRes;
}
// Deleta o produto especificado do banco de dados
function BDDeletarProduto($ID){
    $connection = BDconnect();
    $queryRes = $connection->query("DELETE FROM Produto WHERE ID = '$ID'");
    return $queryRes;
}


// Registra uma compra no banco de dados
function BDRegistrarCompra($ClienteID, $ProdutoID){
    $connection = BDconnect();
    $compraQueryRes = $connection->query("INSERT INTO Compra (Cliente_ID, Produto_ID, Data_Compra) VALUES ('$ClienteID', '$ProdutoID', '".date("Y-m-d")."')");
    if(!$compraQueryRes){
        JSAlert("Erro ao registrar compra | não foi possivel registrar a compra");
        BDdisconnect($connection);
        return false;
    }
    $produto = BDRecuperarProduto($ProdutoID);
    if(!BDAtualizarProduto($produto->ID, DadosProduto::Quantidade, $produto->Quantidade-1))
        JSAlert("Erro ao atualizar quantidade de produtos após a compra |$ClienteID, $ProdutoID|");
    BDdisconnect($connection);
    return $compraQueryRes;
}
// Recupera os dados da compra com o ID especificado
function BDConsultarCompra($ID){
    $connection = BDconnect();
    $queryRes = $connection->query("SELECT * FROM Foto_ID WHERE ID='$ID'")->fetch_assoc();
    $dadosCompra = new ObjCompra();
    $dadosCompra->ID = $queryRes["ID"];
    $dadosCompra->Cliente_ID = $queryRes["Cliente_ID"];
    $dadosCompra->Vendedor_ID = $queryRes["Vendedor_ID"];
    $dadosCompra->Data_Compra = $queryRes["Data_Compra"];
    BDdisconnect($connection);
    return $queryRes;
}


// Termina a conexão com o banco de dados
function BDdisconnect($connection){
    $connection->close();
}
?>