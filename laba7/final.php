<?php

session_start();

if ($_SESSION['talon']=="" or $_POST["ФИО"]=="")
{
    exit ("<body><div align='center'><h1>Форма заполнена некорректно!</h1></div></body>");
}
?>
<!DOCTYPE HTML >
<html>
<head>
    <title>финал</title>
    <meta name="keywords" content="интернет, магазин, картины, прдаем, продажа, картин">
    <meta name="description" content="интернет магазин">
</head>
<body>

<div align="center">
    <h1>Заказ принят. Мы Вам перезвоним в течение 24-часов</h1>
    <?php

    $mail=$_POST["mail"];
    $fio=$_POST["ФИО"];
    $tel=$_POST["телефон"];
    //$adres=$_POST["adres"];
    $com=$_POST["Ком"];
    $summa=$_GET["summa"];
    $talon=$_SESSION['talon'];

    echo "<b>ФИО: </b><font color='seagreen'>". $fio."</font><br>";
    //echo "<b>Адрес: </b><font color='seagreen'>".$adres."</font><br>";
    echo "<b>Телефон: </b><font color='seagreen'>".$tel."</font><br>";
    echo "<b>e-mail: </b><font color='seagreen'>".$mail."</font><br>";
    echo "<b>Стоимость заказа: </b><font color='seagreen'>".$summa ."</font> р <br>";
    echo "<b>Номер заказа: </b><font color='red'>".$talon."</font><br>";
    echo "<b>Дата: </b><font color='seagreen'>".date('y/n/d')."</font>";

    $to = $mail;
    $subject = $fio;
    $message = "Номер сесии: ".$talon."<br>".
        "ФИО: ".$fio."<br>".
        "Стоимость заказа: ".$summa." р<br>".
        //"Адрес: ".$adres."<br>".
        "Телефон: ".$tel."<br>".
        "e-mail: ".$mail."<br>".
        "Дата: ".date('d/n/y')."<br>".
        "Комментарии: ".$com;
    $headers  = "Content-Type: text/html; charset=utf-8 \r\n";

    mail($to, $subject, $message, $headers);

    session_unset();
    ?>
    <br><br><br><a href="magazin.php"><b>На главную</b></a>
</div>
</body>
</html>