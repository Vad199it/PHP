<?php

$page_template = 'templates/main.tpl';
//require_once("cfg.php");


$page_data = file_get_contents($page_template);

/*function process_cfg($x)
{
	$cfg = $GLOBALS['config'];
	
	if (isset($cfg[$x[1]])) {
		return $cfg[$x[1]];
	}
	else
	{
		return 'Error! CFG parameter [' . $x[1] . '] not found!';
	}
}
*/
function process_file($x)
{
	$fn = 'templates/'.$x[1];
	
	if (is_file($fn)) {
		return file_get_contents($fn);
	}
	else
	{
		return 'Error! Template [' . $fn . '] not found!';
	}
}
$page_data = preg_replace_callback("/{File=\"(.*)\"}/U", 'process_file', $page_data);
//$page_data = preg_replace_callback("/{CFG=\"(.*)\"}/U", 'process_cfg', $page_data);


echo $page_data;