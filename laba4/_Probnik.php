
<?php
require_once "header.html";
?>

<form method="POST">
    От (дата): <input type="datetime-local" name="data1" value=""><br>
    До (дата): <input type="datetime-local" name="data2" value=""><br>
    Файл (название): <input type="text" name="name1" value=""><br>
    <br>
    <input type="submit" name="click" value="Найти"><br>
    <?php
    //горизонтальная полоса
    echo "<HR NOSHADE align=left WIDTH='50%'>";
    ?>
</form>


<?php
function pc_process_dir($dir_name,$max_depth = 10,$depth = 0) {
    if ($depth >= $max_depth) {
        error_log("Reached max depth $max_depth in $dir_name.");
        return false;
    }
    $subdirectories = array();
    $files = array();
    if (is_dir($dir_name) && is_readable($dir_name)) {
        $d = dir($dir_name);
        while (false !== ($f = $d->read())) {
// пропускаем . и ..
            if (('.' == $f) || ('..' == $f)) {
                continue;
            }
            if (is_dir("$dir_name/$f")) {
                array_push($subdirectories,"$dir_name/$f");
            } else {
                array_push($files,"$dir_name/$f");
            }
        }
        $d->close();
        foreach ($subdirectories as $subdirectory) {
            $files = array_merge($files,pc_process_dir($subdirectory,
                $max_depth,$depth+1));
        }
    }
    return $files;

}

?>


<?php
$data1= (int)(strtotime($_POST["data1"]));
$data2=(int)(strtotime($_POST["data2"]));
$slovo=$_POST["name1"];
if(isset($_REQUEST['click'])) {
     $files = pc_process_dir('\Web\OSPanel\domains\localhost\laby');
     //echo $data1;
     foreach ($files as $file) {
        $time=(int)strftime(fileatime($file));

         $path_parts = pathinfo($file);

         if (($time>$data1) && ($time<$data2)) {
             $text= $path_parts['filename']."<br>";
             $tslovo = "/$slovo/iU";
                 if (preg_match($tslovo, $text)) {
                     print "$file was last accessed at ".strftime('%c',fileatime($file))."<br>";
                 }
         }
     }
 }

require_once "footer.html";
?>