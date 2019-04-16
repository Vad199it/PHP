<?php
session_start();
require_once "header.html";

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
</head>
<body style="background: floralwhite">


    <h1 align="center"><a href="product.php">Наши товары.</a></h1>

    <h3 align="center"><?php echo "Вы являетесь: ".$_SESSION['talon']." посетителем! <br/>Номер Вашей покупки: ".$_SESSION['talon']?></h3>

</body>
</html>

<?php
require_once "footer.html";
?>