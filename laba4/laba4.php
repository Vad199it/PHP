<?php
require_once "header.html";
$frtext=$_POST['intext'];

print " 
<div class=\"body_date_calc\"><br><br> 
<form method=POST> 
<b>Исходный текст:</b> <br><br> 
<textarea cols=55 rows=10 name=intext >$frtext</textarea><br><br>";

$pattern1='((^|\s+)[\+](?:375|7|8)? ?[-]\(?(\d{2})\)? ?[-]?(\d{3})[ -]?(\d{2})[ -]?(\d{2}(\s+|$)))';
$pattern2='([\+](?:375|7|8)? ?[-]\(?(\d{2})\)? ?[-]?(\d{3})[ -]?(\d{2})[ -]?(\d{2})(\s|$))';
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$pattern3='(\b((^|\s+)(\d[-]?){5}\d(|\s+|$))\b)';
$pattern4='((^|\s+)(\d[-]?){5}\d(\s|$))';
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$pattern5 = '((\D|^)(\d[-]?){5}\d(\D|$))';
$pattern6='((^[0-9]|^)(\d[-]?){5}\d(^-|^[0-9]|$))';

if (preg_match($pattern1, $frtext))
    $frtext = preg_replace($pattern2, '<span style="text-decoration:underline" >$0</span>', $frtext);

if (preg_match($pattern3, $frtext))
    $frtext = preg_replace($pattern4, '<span style="color:green">$0</span>', $frtext);




print "$frtext<br><br> 
<input type=submit value='Принять' class=button > 
</form> 
</div> ";?>
<?php
require_once "footer.html";  ?>