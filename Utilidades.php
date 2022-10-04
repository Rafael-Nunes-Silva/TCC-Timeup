<?php
require_once("BDConector.php");
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

// Retorna a URL onde está armazenada a foto do cliente
function ClienteFotoCaminho($ClienteNome, $ClienteFoto_ID){
    return "../uploads/cliente/".$ClienteNome."/foto_perfil/".BDRecuperarFoto($ClienteFoto_ID);
}
// Retorna a URL onde está armazenada a foto do vendedor
function VendedorFotoCaminho($VendedorNome, $VendedorFoto_ID){
    return "../uploads/vendedor/".$VendedorNome."/foto_perfil/".BDRecuperarFoto($VendedorFoto_ID);
}
// Retorna a URL onde está armazenada a foto do vendedor
function ProdutoFotoCaminho($VendedorNome, $ProdutoNome, $ProdutoFoto_ID){
    return "../uploads/produto/".$VendedorNome."/".$ProdutoNome."/".BDRecuperarFoto($ProdutoFoto_ID);
}

// Cria uma alert box com javascript
function JSAlert($msg){
    echo("<script type='text/javascript'>alert('".$msg."')</script>");
}
?>