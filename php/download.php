<?php
$file = $_GET['file'];
header("Content-disposition: attachment; filename=$file");
header("Content-type: application/octet-stream");
readfile($file);
?>