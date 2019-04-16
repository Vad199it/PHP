<?php

session_start();
include_once "CCheckMail.php";
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
    $com=$_POST["Ком"];
    $summa=$_GET["summa"];
    $talon=$_SESSION['talon'];

    echo "<b>ФИО: </b><font color='seagreen'>". $fio."</font><br>";
    echo "<b>Телефон: </b><font color='seagreen'>".$tel."</font><br>";
    echo "<b>e-mail: </b><font color='seagreen'>".$mail."</font><br>";
    echo "<b>Стоимость заказа: </b><font color='seagreen'>".$summa ."</font> р <br>";
    echo "<b>Номер заказа: </b><font color='red'>".$talon."</font><br>";
    echo "<b>Дата: </b><font color='seagreen'>".date('y/n/d')."</font><br>";

    function CheckEmail($Email){
        if(!preg_match("/^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/", $Email)) return 1;
        list($Username, $Domain) =explode("@",$Email);
        if(@getmxrr($Domain,$MXHost)) return 0;
        else
        {
            $f=@fsockopen($Domain, 465, $errno, $errstr, 30);
            if($f)
            {
                fclose($f);
                return 0;
            }
            else return 1;
        }

    }

    $to = $mail;
    $subject = $fio;
    $message = "Номер сесии: ".$talon."<br>".
        "ФИО: ".$fio."<br>".
        "Стоимость заказа: ".$summa." р<br>".
        "e-mail: ".$mail."<br>".
        "Дата: ".date('d/n/y')."<br>".
        "Телефон: ".$tel;
    $headers  = "Content-Type: text/html; charset=utf-8 \r\n";
/////////////////////////////////////////////////////////////////
    if(CheckEmail($to)==0) {
        $str = "$to";
        $alter = new CCheckMail();
        if ($alter->execute($str)) {
            echo "<font size='50px' color='green'>Письмо отправлено вам на почту </font>";
            mail($to, $subject, $message, $headers);
        } else {

            echo "<font size='50px' color='red'>Почты не существует или она была введена не правильно </font>";
        }
    }
    else {
        echo "<font size='50px' color='red'>Почты не существует или она была введена не правильно </font>";
    }

    session_unset();
    ?>
    <br><br><br><a href="magazin.php"><b>На главную</b></a>
</div>
</body>
</html>