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
try{
    $db_connect =   new PDO('mysql:dbname=egtim;host=localhost;charset=UTF8','root','');
}catch (PDOException $exception){
    echo "Bağlantı Hatası <br/>".$exception->getMessage();
    die();
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
                echo $menu_id_." | ".$menu_top_id." | ".$menu_name."<br/>";
                MenuWirite($menu_id_,$space_value+5);
            }
        }
}
MenuWirite();
?>
</body>
</html>