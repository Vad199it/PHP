<?php
$day = '(\b(0?[1-9]|[1-2]\d|3[0-1])\b)';
$month = '(\b(0?[1-9]|1[0-2])\b)';
$year = '(\b((\d\d)?\d\d)\b)';
//$datePattern = "/(\b((0?[1-9])|[1-2]\d|3[0-1])\.((0?[1-9])|1[0-2])\.((\d\d)?\d\d))|(\b(0?[1-9]|[1-2]\d|3[0-1])\/(0?[1-9]|1[0-2])\/((\d\d)?\d\d))\b/";
$datePattern = "($day\.$month\.$year|$day\/$month\/$year)";

    $pageName = $_POST['pageName'];
    if ($page = file_get_contents($pageName)) {
        $text = $_POST['text'];
        while (preg_match($datePattern, $text, $date, PREG_OFFSET_CAPTURE)) {
            $pos = $date[0][1];
            echo substr($text, 0, $pos);
            $date = $date[0][0];
            $year = substr($date, (strrpos($date, ".") | strrpos($date, "/")) + 1);
            if (strlen($year) == 2) $year = ($year + 1) % 100;
            else $year = ($year + 1) % 10000;
            $newDate = substr($date, 0, (strrpos($date, ".") | strrpos($date, "/")) + 1) . $year;
            echo "<span style=\"color:red\">$newDate</span>";
            $text = substr($text, $pos + strlen($date));
        }
        echo $text;
        echo $page;
    }
    else echo "Page not found";

