<?php

require_once "connect.php";




if (isset($_REQUEST['id']) and isset($_REQUEST['menuName']) and  isset($_REQUEST['topMenuSelect'])):
    $menu_id    =   Filtrele($_REQUEST['id']);
    $menu_name    =   Filtrele($_REQUEST['menuName']);
    $menu_top_id    =   Filtrele($_REQUEST['topMenuSelect']);

    echo $menu_id ." | ". $menu_name . " | " . $menu_top_id ;

    $update =   $db_connect->prepare('UPDATE menuler SET ustid=? ,menuadi=?  WHERE id=? LIMIT 1');
    $update->execute([$menu_top_id,$menu_name,$menu_id]);


    $db_connect =   null;
    header('Location: index.php');
    exit();

else:
    echo "<h3>Hata !</h3>";
    echo "İlgili Değerler BoŞ Gönderilemez !<br/>";
    echo "<a href='index.php'>Anasayfaya Dön</a>";

endif;



