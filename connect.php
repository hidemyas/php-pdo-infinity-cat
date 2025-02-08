<?php

try{
    $db_connect =   new PDO('mysql:dbname=egtim;host=localhost;charset=UTF8','root','');
}catch (PDOException $exception){
    echo "Bağlantı Hatası <br/>".$exception->getMessage();
    die();
}

function Filtrele($Deger)
{
    $step_one   =   trim($Deger);
    $step_two   =   strip_tags($step_one);
    $step_trhee =   htmlspecialchars($step_two,ENT_QUOTES);
    return $step_trhee;
}