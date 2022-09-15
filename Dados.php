<?php
abstract class DadosCliente{
    const Foto = "Foto";
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
    public $Foto;
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
    const Foto = "Foto";
    const Nome = "Nome";
    const CNPJ = "CNPJ";
    const Email = "Email";
    const Senha = "Senha";
    const Rua = "Rua";
    const Numero = "Numero";
}
class ObjVendedor{
    public $Foto;
    public $Nome;
    public $CNPJ;
    public $Email;
    public $Senha;
    public $Rua;
    public $Numero;
}
?>