<?php
abstract class DadosCliente{
    const ID = "ID";
    const Foto_ID = "Foto_ID";
    const Nome = "Nome";
    const Data_Nascimento = "Data_Nascimento";
    const CPF = "CPF";
    const Telefone = "Telefone";
    const Email = "Email";
    const Senha = "Senha";
    const Rua = "Rua";
    const Numero = "Numero";
}
class ObjCliente{
    public $ID;
    public $Foto_ID;
    public $Nome;
    public $Data_Nascimento;
    public $CPF;
    public $Telefone;
    public $Email;
    public $Senha;
    public $Rua;
    public $Numero;
}
abstract class DadosVendedor{
    const ID = "ID";
    const Foto_ID = "Foto_ID";
    const Nome = "Nome";
    const CNPJ = "CNPJ";
    const Email = "Email";
    const Senha = "Senha";
    const Rua = "Rua";
    const Numero = "Numero";
}
class ObjVendedor{
    public $ID;
    public $Foto_ID;
    public $Nome;
    public $CNPJ;
    public $Email;
    public $Senha;
    public $Rua;
    public $Numero;
}
abstract class DadosProduto{
    const ID = "ID";
    const Foto_ID = "Foto_ID";
    const Nome = "Nome";
    const Codigo = "Codigo";
    const Categoria = "Categoria";
    const Quantidade = "Quantidade";
    const Vendedor_ID = "Vendedor_ID";
}
class ObjProduto{
    public $ID;
    public $Foto_ID;
    public $Nome;
    public $Codigo;
    public $Categoria;
    public $Quantidade;
    public $Vendedor_ID;
}
abstract class DadosCompra{
    const ID = "ID";
    const Cliente_ID = "Cliente_ID";
    const Vendedor_ID = "Vendedor_ID";
    const Data_Compra = "Data_Compra";
}
class ObjCompra{
    public $ID;
    public $Cliente_ID;
    public $Prodto_ID;
    public $Data_Compra;
}
?>