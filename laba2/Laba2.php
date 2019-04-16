

<?php
require_once "header.html";

	function StartArray(&$a)
    {
        for ($i = 0; $i < 2; $i++)
        {

            $a[] = [];
            for ($j = 0; $j < 2; $j++)
            {

                $a[$i][] = [];
                for ($k = 0; $k < 2; $k++)
                {

                    $a[$i][$j][] = [];
                    for ($l = 0; $l < 2; $l++)
                    {

                        $a[$i][$j][$k][] = [];
                        for ($m = 0; $m < 4; $m++)
                        {
                            $a[$i][$j][$k][$l][] = RandomValue();
                        }
                    }
                }
            }
        }
    }

	function RandomValue()
    {

        $numb = rand(0, 3);
        switch ($numb) {
            case 0:
                $result = rand(0, 99);
                break;

            case 1:
                $result = rand(0, 99) + rand() / getrandmax();
                break;

            case 2:
                $result = RandomEng(5);
                break;

            case 3:
                $result = RandomRus(5);
                break;
        }

        return $result;
    }

function RandomRus($mkol)
{
    $chArray = [];
    for ($i = 0; $i < rand(1, $mkol); $i++)
    {
        $char = mb_chr(rand(mb_ord("а"), mb_ord("я")));
        if (rand(0, 1))
        {
            $char = mb_strtoupper($char);
        }
        $chArray[] = $char;
    }

    return implode($chArray);
}

	function RandomEng($mkol)
    {
        $chArray = [];
        for ($i = 0; $i < rand(1, $mkol); $i++)
        {
            $char = chr(rand(ord("a"), ord("z")));
            if (rand(0, 1))
            {
                $char = strtoupper($char);
            }
            $chArray[] = $char;
        }

        return implode($chArray);
    }



// Форматирование значений в массиве
function FormatArrayValues(&$a)
{
    global $engChColor;
    $engChColor = ["red", "orange", "yellow", "green", "aqua", "blue", "purple"];
    $engChColCounter = 0;

    foreach ($a as $i => &$value)
    {
        if (is_array($value))
        {
            FormatArrayValues($value);
        }
        else
        {
            if (is_integer($value))
            {
                unset($a[$i]);
            }
            if (is_double($value))
            {
                $value = round($value, 2);
            }
            if (is_string($value))
            {
                $charArray = StrArray($value);
                foreach ($charArray as &$char)
                {
                    if (Rus($char))
                    {
                        $char = mb_strtoupper($char);
                    }
                }
                $value = implode($charArray);
            }
        }
    }
}

function Rus($char)
{
    return (mb_ord(mb_strtoupper($char)) >= mb_ord("А")) && (mb_ord(mb_strtoupper($char)) <= mb_ord("Я"));
}

function Eng($char)
{
    return (mb_ord(mb_strtoupper($char)) >= mb_ord("A")) && (mb_ord(mb_strtoupper($char)) <= mb_ord("Z"));
}

function StrArray($string, $encoding = 'UTF-8')
{
    $strlen = mb_strlen($string);
    while ($strlen) {
        $array[] = mb_substr($string, 0, 1, $encoding);
        $string = mb_substr($string, 1, $strlen, $encoding);
        $strlen = mb_strlen($string, $encoding);
    }
    return ($array);
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Вывод массива в виде таблицы
function PrintArrayInTable($a)
{
    echo '<table cellpadding="0" cellspacing="0">';

    PrintArrayValues($a);

    echo '</table>';
}


function PrintArrayValues($a)
{
    global $engChColor;
    global $engChColCounter;

    echo '<tr>';

    foreach ($a as $value)
    {
        echo '<td>';

        if (is_array($value))
        {
            PrintArrayInTable($value);
        }
        else
        {

            // Вывод форматированных английских символов
            if (is_string($value) && count($engChColor) > 0)
            {
                $charArray = StrArray($value);
                foreach ($charArray as $char)
                {
                    if (Eng($char))
                    {
                        $curColor = $engChColor[$engChColCounter % count($engChColor)];
                        echo '<font color="', $curColor, '">';
                        echo $char;
                        echo '</font>';
                        $engChColCounter++;
                    }
                    else
                    {
                        echo $char;
                    }
                }
            }
            else
            {
                echo $value;
            }

            echo '</div>';
        }

        echo '</td>';
    }

    echo '</tr>';
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$engChColor = [];	// Массив цветов для английских сиволов
$a = [];			// Исходный массив

StartArray($a);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Massiv</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<?php

PrintArrayInTable($a);	// Вывод исходного массива
FormatArrayValues($a);	// Изменение значений по условию
PrintArrayInTable($a);	// Вывод форматированного массива
require_once "footer.html";
?>

</body>
</html>



</body>
</html>