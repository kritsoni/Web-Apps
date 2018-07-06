<?php
$json=file_get_contents('countries.json');
$list=json_decode($json, true);
echo json_encode($list);
?>
