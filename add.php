<?php
require_once "connect.php";
$top_menu_id    =  Filtrele($_POST['topMenuSelect']);
$menu_name    =  Filtrele($_POST['menuName']);

if (isset($top_menu_id) and $menu_name){
    $add    =   $db_connect->prepare('INSERT INTO menuler (ustid,menuadi) values (?,?)');
    $add->execute([$top_menu_id,$menu_name]);

    $menu_count =   $add->rowCount();
    $menus      =   $add->fetchAll(PDO::FETCH_ASSOC);

    if ($menu_count>0){
        header('Location: index.php');
        exit();
    }else{
        echo "<h3>Hata</h3>";
        echo "İşlem Sırasında Beklenmeyen Hata Oluştu <br/>";
        echo "<a href='index.php'>Anasayfaya Dön</a>";
    }

}else{
    echo "<h3>Hata</h3>";
    echo "Boş Alan Burakmayınız <br>";
    echo "<a href='index.php'>Anasayfaya Dön</a>";
}

