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
    const Valor = "Valor";
    const Categoria = "Categoria";
    const Vendedor_ID = "Vendedor_ID";
}
class ObjProduto{
    public $ID;
    public $Foto_ID;
    public $Nome;
    public $Valor;
    public $Categoria;
    public $Vendedor_ID;
}
abstract class DadosOrcamento{
    const ID = "ID";
    const Nome = "Nome";
    const Cliente_ID = "Cliente_ID";
    const Produtos_IDs = "Produtos_IDs";
    const Quantidades = "Quantidades";
    const Data_Orcamento = "Data_Orcamento";
}
class ObjOrcamento{
    public $ID;
    public $Nome;
    public $Cliente_ID;
    public $Produtos_IDs; // array
    public $Quantidades; // array
    public $Data_Orcamento;
}
abstract class DadosFiltro{
    const Nome = "Nome";
    const Categoria = "Categoria";
    const OrdemValor = "OrdemValor";
    const MinVal = "MinVal";
    const MaxVal = "MaxVal";
    const QtdPage = "QtdPage";
    const Page = "Page";
}
class ObjFiltro{
    public $Nome;
    public $Categoria;
    public $OrdemValor;
    public $MinVal;
    public $MaxVal;
    public $QtdPage;
    public $Page;
}
?>