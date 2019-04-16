<?php

session_start();

if (isset($_SESSION['talon']) == "" )
{
    $conn = mysqli_connect("localhost", "root", "") or die ("Could not connect: " . mysqli_connect_error());
    mysqli_select_db($conn,"cortini");
    $result = mysqli_query($conn,"SELECT counter FROM posetiteli");
    if (!$result) {echo "zapros na viborcu ne proshol."; mysqli_connect_error();}
    $x = mysqli_fetch_array($result);

    $_SESSION['talon'] = $x["counter"]+1;

    $result = mysqli_query($conn,"UPDATE posetiteli SET counter = counter + 1");
    if (!$result) {echo "zapros na viborcu ne proshol."; mysqli_connect_error();}

    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>интернет магазин</title>
    <meta name="keywords" content="интернет, магазин, картины, прдаем, продажа, картин">
    <meta name="description" content="интернет магазин">
    <link rel="stylesheet" href="css/style_name_shop.css">
</head>
<body>

<div style="position:absolute; top:0px; height:150px; left:0px;width:100%">
    <h1 align="center">Магазин картин</h1>
    <h3 align="center"><a href="magazin.php">Главная</a></h3>
    <h2 align="center"><a href="corzina.php">Моя корзина</a></h2>
</div>

<div style="position:absolute; top:150px; height:1050px; left:0px; width:100%; display: flex; flex-direction: column">
    <div style=" display: flex; flex-direction: column">
        <div align="center" class="picture">
            <div width="250"><img src="foto/1.jpg" alt="картина" height="120" width="160" border="0"><br/>«Королевский красный и синий», Марк Ротко, продана в 2012 году.<form action="zapisi_tovara.php?idtovara=1" method="POST"><input type="submit" value="В корзину" onClick="alert('Товар добавлен в корзину!')"></form></div>
            <div width="250"><img src="foto/2.jpg" alt="картина" height="120" width="160" border="0"><br/>«Избиение младенцев», Питер Пауль Рубенс, создана в 1610 году.<form action="zapisi_tovara.php?idtovara=2" method="POST"><input type="submit" value="В корзину" onClick="alert('Товар добавлен в корзину!')"></form></div>
            <div width="250"><img src="foto/3.jpg" alt="картина" height="120" width="160" border="0"><br/>«Бал в Мулен де ла Галетт», Пьер-Огюст Ренуар, написана в 1876 году.<form action="zapisi_tovara.php?idtovara=3" method="POST"><input type="submit" value="В корзину" onClick="alert('Товар добавлен в корзину!')"></form></div>
            <div width="250"><img src="foto/4.jpg" alt="картина" height="120" width="160" border="0"><br/>«Бирюзовая Мэрилин», Энди Уорхол, написана в 1964 г, продана в 2007 г.<form action="zapisi_tovara.php?idtovara=4" method="POST"><input type="submit" value="В корзину" onClick="alert('Товар добавлен в корзину!')"></form></div>
        </div>
        <div align="center" class="picture">
            <div><img src="foto/5.jpg" alt="картина" height="120" width="160" border="0"><br/>«Фальстарт», Джаспер Джонс, написана в 1959 г.<form action="zapisi_tovara.php?idtovara=5" method="POST"><input type="submit" value="В корзину" onClick="alert('Товар добавлен в корзину!')"></form></div>
            <div><img src="foto/6.jpg" alt="картина" height="120" width="160" border="0"><br/> «Портрет доктора Гаше», Винсент Ван Гог, 1890 год.<form action="zapisi_tovara.php?idtovara=6" method="POST"><input type="submit" value="В корзину" onClick="alert('Товар добавлен в корзину!')"></form></div>
            <div><img src="foto/7.jpg" alt="картина" height="120" width="160" border="0"><br/>«Триптих», Фрэнсис Бэкон, 1976 год.<form action="zapisi_tovara.php?idtovara=7" method="POST"><input type="submit" value="В корзину" onClick="alert('Товар добавлен в корзину!')"></form></div>
            <div><img src="foto/8.jpg" alt="картина" height="120" width="160" border="0"><br/>«Портрет Адель Блох-Бауэр II», Густав Климт, 1912 год.<form action="zapisi_tovara.php?idtovara=8" method="POST"><input type="submit" value="В корзину" onClick="alert('Товар добавлен в корзину!')"></form></div>
        </div>
        <div align="center" class="picture">
            <div><img src="foto/9.jpg" alt="картина" height="120" width="160" border="0"><br/>«Дора Маар с кошкой», Пабло Пикассо, 1941 год.<form action="zapisi_tovara.php?idtovara=9" method="POST"><input type="submit" value="В корзину" onClick="alert('Товар добавлен в корзину!')"></form></div>
            <div><img src="foto/10.jpg" alt="картина" height="120" width="160" border="0"><br/>«Мальчик с трубкой», Пабло Пикассо, 1905 год.<form action="zapisi_tovara.php?idtovara=10" method="POST"><input type="submit" value="В корзину" onClick="alert('Товар добавлен в корзину!')"></form></div>
            <div><img src="foto/11.jpg" alt="картина" height="120" width="160" border="0"><br/>«Авария серебряной машины (двойная катастрофа)», Энди Уорхол, 1932 год.<form action="zapisi_tovara.php?idtovara=11" method="POST"><input type="submit" value="В корзину" onClick="alert('Товар добавлен в корзину!')"></form></div>
            <div><img src="foto/12.jpg" alt="картина" height="120" width="160" border="0"><br/>«Обнажённая, зелёные листья и бюст», Пабло Пикассо, 1932 год.<form action="zapisi_tovara.php?idtovara=12" method="POST"><input type="submit" value="В корзину" onClick="alert('Товар добавлен в корзину!')"></form></div>
        </div>
        <div align="center" class="picture">
            <div><img src="foto/13.jpg" alt="картина" height="120" width="160" border="0"><br/>«Флаг», Джаспер Джонс, 1958 год.<form action="zapisi_tovara.php?idtovara=13" method="POST"><input type="submit" value="В корзину" onClick="alert('Товар добавлен в корзину!')"></form></div>
            <div><img src="foto/14.jpg" alt="картина" height="120" width="160" border="0"><br/>«Крик», Эдвард Мунк, 1895 год.<form action="zapisi_tovara.php?idtovara=14" method="POST"><input type="submit" value="В корзину" onClick="alert('Товар добавлен в корзину!')"></form></div>
            <div><img src="foto/15.jpg" alt="картина" height="120" width="160" border="0"><br/>«Портрет Адели Блох-Бауэр I», Густав Климт.<form action="zapisi_tovara.php?idtovara=15" method="POST"><input type="submit" value="В корзину" onClick="alert('Товар добавлен в корзину!')"></form></div>
            <div><img src="foto/16.jpg" alt="картина" height="120" width="160" border="0"><br/>«Женщина III», Виллем де Кунинг.<form action="zapisi_tovara.php?idtovara=16" method="POST"><input type="submit" value="В корзину" onClick="alert('Товар добавлен в корзину!')"></form></div>
        </div>
        <div align="center" class="picture">
            <div><img src="foto/17.jpg" alt="картина" height="120" width="160" border="0"><br/>«№ 5, 1948», Джексон Поллок.<form action="zapisi_tovara.php?idtovara=17" method="POST"><input type="submit" value="В корзину" onClick="alert('Товар добавлен в корзину!')"></form></div>
            <div><img src="foto/18.jpg" alt="картина" height="120" width="160" border="0"><br/>«Три этюда Люсьена Фрейда», Фрэнсис Бэкон, 1969 год.<form action="zapisi_tovara.php?idtovara=18" method="POST"><input type="submit" value="В корзину" onClick="alert('Товар добавлен в корзину!')"></form></div>
            <div><img src="foto/19.jpg" alt="картина" height="120" width="160" border="0"><br/>«Le Reve» («Мечта» или «Сон»), Пабло Пикассо, 1932 год.<form action="zapisi_tovara.php?idtovara=19" method="POST"><input type="submit" value="В корзину" onClick="alert('Товар добавлен в корзину!')"></form></div>
            <div><img src="foto/20.jpg" alt="картина" height="120" width="160" border="0"><br/>«Игроки в карты», Поль Сезанн, 2011 год.<form action="zapisi_tovara.php?idtovara=20" method="POST"><input type="submit" value="В корзину" onClick="alert('Товар добавлен в корзину!')"></form></div>
        </div>
    </div>
</div>

</body>
</html>