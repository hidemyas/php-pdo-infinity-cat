<?php require_once "connect.php"; ?>
<!doctype html>
<html lang="tr-TR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PHP Infinity Category | Sınırsız Kategori</title>
</head>
<body>
<?php


function OpenerList($menu_id=0 , $space_value = 0)
{
        global $db_connect;

        $menu_query =   $db_connect->prepare("SELECT * FROM menuler WHERE ustid = ?");
        $menu_query->execute([$menu_id]);

        $menu_count =   $menu_query->rowCount();
        $menus      =   $menu_query->fetchAll(PDO::FETCH_ASSOC);

        if ($menu_count>0){
            foreach ($menus as $menu){
                $menu_id_   =   $menu['id'];
                $menu_name      =   $menu['menuadi'];
                echo "<option value='$menu_id_'>".str_repeat('&nbsp;',$space_value).$menu_name."</option>";
                OpenerList($menu_id_,$space_value+5);
            }
        }
}
function MenuWirite($menu_id=0 , $space_value = 0)
{
        global $db_connect;

        $menu_query =   $db_connect->prepare("SELECT * FROM menuler WHERE ustid = ?");
        $menu_query->execute([$menu_id]);

        $menu_count =   $menu_query->rowCount();
        $menus      =   $menu_query->fetchAll(PDO::FETCH_ASSOC);

        if ($menu_count>0){
            foreach ($menus as $menu){
                $menu_id_   =   $menu['id'];
                $menu_top_id    =   $menu['ustid'];
                $menu_name      =   $menu['menuadi'];
                echo str_repeat('&nbsp;',$space_value);
                $update_link =  " [<a href='update.php?id=$menu_id_' style='text-decoration: none'>Güncelle</a>] ";
                $delete_link =  " [<a href='delete.php?id=$menu_id_' style='text-decoration: none;color: brown'>Sil</a>] ";
//                echo $menu_id_." | ".$menu_top_id." | ".$menu_name."<br/>";
                echo $menu_name . $update_link  . $delete_link ."<br/>";
                MenuWirite($menu_id_,$space_value+5);
            }
        }
}

// Yeni Menü Ekleme
?>
<h3>Menü Ekleme Formu</h3>
<form action="add.php" method="post">
    Üst Menü    : <select name="topMenuSelect" id="">
        <option value="0">Ana Menü Yap</option>
        <?php OpenerList(); ?>
    </select><br/>
    Menü Adı    : <input type="text" name="menuName"><br/>
    <input type="submit" value="Menü Ekle">
</form>
<br/><br/>
<?php

MenuWirite();
?>
</body>
</html>
<?php $db_connect=null; ?>