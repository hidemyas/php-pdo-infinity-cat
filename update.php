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
    function OpenerList($menu_id,$top_id=0, $space_value = 0)
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
                $selected   = $menu_id_ == $top_id ? 'selected' :'';
                echo "<option value='$menu_id_' ".$selected." >".str_repeat('&nbsp;',$space_value).$menu_name."</option>";
                OpenerList($menu_id_,$top_id,$space_value+5);
            }
        }
    }

    $menu_id    =   Filtrele($_REQUEST['id']);
    $query  =   $db_connect->prepare('SELECT * FROM menuler WHERE id=? LIMIT 1');
    $query->execute([$menu_id]);
    $menu   =   $query->fetch(PDO::FETCH_ASSOC);
    $selected   =   $menu['ustid']==0 ? "selected" : "";
    ?>
    <h3>Menü Güncelleme Formu</h3>
    <form action="update-result.php?id=<?php echo $menu['id'];?>" method="post">
        Üst Menü    : <select name="topMenuSelect" id="">
            <option value="0" <?php echo $selected;?>>Ana Menü Yap</option>
            <?php OpenerList(0,$menu['ustid']); ?>
        </select><br/>
        Menü Adı    : <input type="text" name="menuName" value="<?php echo $menu['menuadi'];?>"><br/>
        <input type="submit" value="Menü Güncelle">
    </form>
    <br/><br/>
    <?php

    ?>
    </body>
    </html>
<?php $db_connect=null; ?>