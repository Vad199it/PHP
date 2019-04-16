<?php

session_start();

if (isset($_POST['pereschiot']) == "пересчитать")
{
    $conn = mysqli_connect("localhost", "root", "") or die ("Could not connect: " . mysqli_connect_error());
    mysqli_select_db($conn,"cortini");

    foreach($_REQUEST as $key => $value)

    {
        if (strpos($key,"Q") === 0 )
        {

            $id_tovara = substr($key,1);
            $colichestvo = $value;

            if (is_numeric($colichestvo))
            {
                if ($colichestvo == 0)
                {
                    $sqlCartUpdate = mysqli_query($conn,"DELETE FROM vibranie_tovari WHERE talon='$_SESSION[talon]' AND id_tovara='$id_tovara'");
                }
                else
                {
                    $sqlCartUpdate = mysqli_query( $conn,"UPDATE vibranie_tovari SET colichestvo='$colichestvo' WHERE talon='$_SESSION[talon]' 
          AND id_tovara='$id_tovara'");
                }
            }
        }
    }
    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>моя корзина</title>
    <meta name="keywords" content="интернет, магазин, картины, прдаем, продажа, картин">
    <meta name="description" content="интернет магазин">

    <script type="text/javascript">
        function checkform(f) {
            var errMSG = "";
            // цикл ниже перебирает все элементы в объекте f,
            // переданном в качестве параметра
            // функции, в данном случае - наша форма.
            for (var i = 0; i<f.elements.length; i++)
                // если текущий элемент имеет атрибут required
                // т.е. обязательный для заполнения
                if (null!=f.elements[i].getAttribute("required"))
                // проверяем, заполнен ли он в форме
                    if (isEmpty(f.elements[i].value)) // пустой
                        errMSG += "  " + f.elements[i].name + "\n"; // формируем сообщение
            // об ошибке, перечисляя
            // незаполненные поля
            // если сообщение об ошибке не пусто,
            // выводим его, и возвращаем false
            if ("" != errMSG) {
                alert("Не заполнены обязательные поля:\n" + errMSG);
                return false;
            }
        }
        function isEmpty(str) {
            for (var i = 0; i < str.length; i++)
                if (" " != str.charAt(i))
                    return false;
            return true;
        }
    </script>
</head>
<body>

<h1 align="center">Ваша корзина</h1>

<form action="corzina.php" method="post">
    <table cellpadding=5 cellspacing=1 border=1 width=75% align="center">
        <tr bgcolor="#FFEBCD">
            <th height="10" width=5%>код продукта</th>
            <th width=10%>фото</th>
            <th width=45%>описание продукции</th>
            <th width=10%>кол.</th>
            <th width=10%>цена $.</th>
            <th width=10%>всего $.</th>
        </tr>
        <?php
        $conn = mysqli_connect("localhost", "root", "") or die ("Could not connect: " . mysqli_connect_error());
        mysqli_select_db($conn,"cortini");
        $sqlCart = mysqli_query($conn,"SELECT id_tovara, colichestvo FROM vibranie_tovari WHERE talon = '$_SESSION[talon]'");

        $OrderTotal=0;
        while($row = mysqli_fetch_array($sqlCart))
        {
            $colichestvo = $row["colichestvo"];
            $id_tovara = $row["id_tovara"];

            $sqlProd = mysqli_query( $conn,"SELECT opisanie, prise FROM tovari WHERE id = '$id_tovara'");
            $row2 = mysqli_fetch_array($sqlProd);
            $talon = $_SESSION['talon'];
            $opisanie = $row2["opisanie"];
            $prise = $row2["prise"];
            $rezulitat = ($prise*$colichestvo);
            $OrderTotal = $OrderTotal + $rezulitat;

            echo "<tr>
    <td align='center'>$id_tovara</td>
	<td><img src='foto/$id_tovara.jpg' align='center' alt='product' height='120' width='160' border='0'></td>
    <td>$opisanie</td>
    <td><input type=\"text\" name=\"Q$id_tovara\" size=\"2\" class=\"qtybox\" 
         value=\"$colichestvo\"></td>
    <td style=\"text-align:right\">$prise.00</td>
    <td style=\"text-align:right\">$rezulitat.00</td>
  </tr>";
        }
        mysqli_close($conn);
        ?>
        <tr bgcolor="#FFEBCD">
            <th colspan="4" style="text-align:right">и того </th>
            <td colspan="2" align="center" style="border-style:solid"><b><?php echo number_format($OrderTotal,2) ?> $.</b></td>
        </tr>
    </table></div><br><br>

    <?php if($OrderTotal != 0) { ?>
    <div style="width:1000px; line-height:15pt">
        <input type="submit" name="pereschiot" style="float:left; margin-right:5px" value="пересчитать">
        <span><b> Щелкните, чтобы обновить  измененные количества.<br/><br/>
  Введите новое количество или введите 0, чтобы отменить покупку товара.</b></span></div>
</form><br><br>
<?php } ?>

<h1 align="center">Оформить заказ</h1>

<form onSubmit = "return checkform(this)" action="final.php?summa=<?php echo $OrderTotal; ?>" method="post">
    <table align="center">
        <tr>
            <td><span class="head4"> ФИО</span><font color="red">*</font></td>
            <td><input type="text" name="ФИО" size="50" required></td>
        </tr>
        <tr>
            <td><span class="head4">Телефон</span><font color="red">*</font></td>
            <td><input type="number" name="телефон" size="50" required></td>
        </tr>
        <tr>
            <td><span class="head4">e-mail</span></td>
            <td><input type="text" name="mail" size="50"></td>
        </tr>

        <tr>
            <td> </td>
            <td><input type="reset" value="Сброс"><input type="submit" value="Отправить" ></td>
        </tr>
    </table>
</form>
<br>
<h4 align="center">Поля отмеченные эвездочкой (<font color="red">*</font>) обязательны для заполнения.</h4><br>

<h4 align="center"><a href="product.php">в магазин</a></h4>

</body>
</html>