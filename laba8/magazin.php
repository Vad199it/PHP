<?php
session_start();
require_once "header.html";

if (isset($_SESSION['talon']) == "") {
    $conn = mysqli_connect("localhost", "root", "") or die ("Could not connect: " . mysqli_connect_error());
    mysqli_select_db($conn, "cortini");
    $result = mysqli_query($conn, "SELECT counter FROM posetiteli");
    if (!$result) {
        echo "zapros na viborcu ne proshol.";
        mysqli_connect_error();
    }
    $x = mysqli_fetch_array($result);

    $_SESSION['talon'] = $x["counter"] + 1;

    $result = mysqli_query($conn, "UPDATE posetiteli SET counter = counter + 1");
    if (!$result) {
        echo "zapros na viborcu ne proshol.";
        mysqli_connect_error();
    }

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
    <body style="background: floralwhite">
    <div class="color">
        <img id="train" src="./image/dvig.jpg">
        <script>
            train.onclick = function() {
                animate(function(timePassed) {
                    train.style.left = timePassed / 5 + 'px';
                }, 5815);
            };

            // Рисует функция draw
            // Продолжительность анимации duration
            function animate(draw, duration) {
                var start = performance.now();

                requestAnimationFrame(function animate(time) {
                    // определить, сколько прошло времени с начала анимации
                    var timePassed = time - start;

                    console.log(time, start);
                    // возможно небольшое превышение времени, в этом случае зафиксировать конец
                    if (timePassed > duration) timePassed = duration;

                    // нарисовать состояние анимации в момент timePassed
                    draw(timePassed);

                    // если время анимации не закончилось - запланировать ещё кадр
                    if (timePassed < duration) {
                        requestAnimationFrame(animate);
                    }

                });
            }
        </script>
    </div>

    <div class="container_name">
        <h1 class="tovary" align="center"><a href="product.php">Наши товары.</a></h1>

        <h3 align="center"><?php echo "Вы являетесь: " . $_SESSION['talon'] . " посетителем! <br/>Номер Вашей покупки: " . $_SESSION['talon'] ?></h3>
    </div>
    <div class="color">
        <img id="heart" src="./image/heart.png">
        <script>
            heart.onclick = function() {
                animate(function(timePassed) {
                    heart.style.left = timePassed / 5 + 'px';
                }, 5650);
                    };

            // Рисует функция draw
            // Продолжительность анимации duration
            function animate(draw, duration) {
                var start = performance.now();

                requestAnimationFrame(function animate(time) {
                    // определить, сколько прошло времени с начала анимации
                    var timePassed = time - start;

                    console.log(time, start);
                    // возможно небольшое превышение времени, в этом случае зафиксировать конец
                    if (timePassed > duration) timePassed = duration;

                    // нарисовать состояние анимации в момент timePassed
                    draw(timePassed);

                    // если время анимации не закончилось - запланировать ещё кадр
                    if (timePassed < duration) {
                        requestAnimationFrame(animate);
                    }

                });
            }
        </script>

    </div>
    </body>
    </html>

<?php
require_once "footer.html";
?>