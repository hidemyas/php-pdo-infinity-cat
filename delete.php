<?php
require_once "connect.php";
$menu_id = Filtrele($_REQUEST['id']);

$menu_archive_id    =   array($menu_id);
function MenuArchive($menu_id)
{
    global $db_connect;
    global $menu_archive_id;

    $menu_query =   $db_connect->prepare("SELECT * FROM menuler WHERE ustid = ?");
    $menu_query->execute([$menu_id]);

    $menu_count =   $menu_query->rowCount();
    $menus      =   $menu_query->fetchAll(PDO::FETCH_ASSOC);

    if ($menu_count>0){
        foreach ($menus as $menu){
            $menu_id_   =   $menu['id'];
            $menu_archive_id[] = $menu_id_;
            MenuArchive($menu_id_);
        }
    }
    return $menu_archive_id;
}
$deletes_menu   =   MenuArchive($menu_id);
if (isset($menu_id)) {
    foreach ($deletes_menu as $menu){
        $del = $db_connect->prepare('DELETE FROM menuler WHERE id = ? LIMIT 1');
        $del->execute([$menu]);
        $menu_count = $del->rowCount();
        if ($menu_count<1){
            echo "<h3>Hata</h3>";
            echo "İşlem Sırasında Beklenmeyen Hata Oluştu <br/>";
            echo "<a href='index.php'>Anasayfaya Dön</a>";
        }
    }
    header('Location: index.php');


} else {
    echo "<h3>Hata</h3>";
    echo "Boş Alan Burakmayınız <br>";
    echo "<a href='index.php'>Anasayfaya Dön</a>";
}

$db_connect =   null;