<?php
require_once "header.html";

$bdname = "Рейтинг";
echo "<hr  color='green'>";
///Connection
$link = mysqli_connect('localhost', 'root', '', $bdname);
if (!$link) {
    die("Не удалось подключиться к БД: " . $bdname . " : " . mysqli_connect_error() . "<br>");
}
echo "Соединение с БД: " . $bdname . " ,успешно установлено!!!" . "<br>";
echo "<hr  color='green'>";
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$query = "SELECT * FROM `Students`";
$result = mysqli_query($link, $query);

$list = array();
$newlist = array();
$i = 0;

// Spisok subjects
echo "<pre style='font-size: 15px;'>";
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
	if (!$i) {
		foreach ($row as $key => $value) {
			echo sprintf("    %-13s", $key);
		}
		echo "<br>";
	}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	foreach ($row as $value) {
		echo sprintf("    %-15s", $value);
	}
	echo "<br>";
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	$list[$i] = array('Student' => $row['Name']);
	$newlist[$i] = array('Student' => $row['Name']);

	$newrow = $row;
	unset($newrow['Name']);

	$sredmark = 0;
	foreach ($newrow as $value) {
		$sredmark = $sredmark + $value;
	}
	$sredmark = $sredmark / count($newrow);
	$list[$i]['Average mark'] = $sredmark;

	$minmark = min($newrow);
	$maxmark = max($newrow);
	$list[$i]['Minimal mark'] = $minmark;
	$list[$i]['Maximal mark'] = $maxmark;

	$list[$i]['Minimal mark subjects'] = array_keys($newrow, $minmark);
	$list[$i]['Maximal mark subjects'] = array_keys($newrow, $maxmark);
	
	$sredmark = round($sredmark);
	foreach ($newrow as $key => $value) {
		if ($value < $sredmark) {
			$newlist[$i][$key] = $value . " change to " . $sredmark;
		}
	}

	$i++;
}
echo "</pre>"; 
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/// Info
echo "<hr color='green'>";

echo "Информация по отметкам:<br>";
echo "<hr color='green'>";
foreach ($list as $value) {
	foreach ($value as $key => $val) {
		if (is_array($val)) {
			echo $key . " - ";
			foreach ($val as $val1)
				echo $val1 . "; ";
			echo "<br>";
		} else {
			echo $key . " - " . $val . ";<br>";
		}
	}
	echo "<br>";
}

/// Сorreсt
echo "<hr  color='red'>";
echo "Корректировка по отметкам:<br>";
echo "<hr  color='red'>";
foreach ($newlist as $value) {
	foreach ($value as $key => $val) {		
		echo $key . " : " . $val . "<br>";
	}
	echo "<br>";
}

mysqli_close($link);
?>

<?php
require_once "footer.html";  ?>
