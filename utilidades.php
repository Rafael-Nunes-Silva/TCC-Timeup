<?php
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
function ValidadeTelefone(){
    //TODO: Verificar se o numero de telefone inserido no campo 'Telefone' é valido enviando uma
    //menssagem de verificação
    return true;
}
function ValidadeEmail(){
    //TODO: Verificar se o email inserido no campo 'Email' é valido enviando um email de verificação
    return true;
}

function JSAlert($msg){
    echo("<script type='text/javascript'>alert(\"".$msg."\")</script>");
}
?>