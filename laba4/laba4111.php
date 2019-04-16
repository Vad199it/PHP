<?php
require_once "header.html";
function PHNumbers($frtext)
{
    $number = '(\d{3}\d{2}\d{2}|\d{3}\d{2}\d{2}|\d{3}-\d{2}-\d{2})';
    $kod = '(\+\d{1,3} \d{1,3} |\+\d{1,3} ?\(\d{1,3}\) ?)';
    $pattern = '/(\D|^)' . $kod . $number . '(\D|$)/';
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    $frtext = preg_replace_callback($pattern,
        function($matches)
        {
            return $matches[1] . '<span style="text-decoration:underline" >' . $matches[2] . $matches[3] . '</span>' . $matches[4];
        },
        $frtext
    );
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    $pattern = '/(\D|^)' . $number . '(\D|$)/';
    $frtext = preg_replace_callback($pattern,
        function($matches)
        {
            return $matches[1] . '<span style="color:green">' . $matches[2] . '</span>' . $matches[3];
        },
        $frtext
    );
    return $frtext;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Nomera</title>
</head>
<body>

<?php
$frtext=$_POST['intext'];

print " 
<div class=\"body_date_calc\"><br><br> 
<form method=POST> 
<b>Исходный текст:</b> <br><br> 
<textarea cols=55 rows=10 name=intext >$frtext</textarea><br><br>

<input type=submit value='Принять' class=button > 
</form> 
</div> ";
$frtext = PHNumbers($frtext);
echo '<div>' . $frtext . '</div>';

?>

</body>

<?php
require_once "footer.html";  ?>