<?php
header('Content-Type : application/json');
$i = 0;
$x = 0;
$min = 0;
$max = 300;
$pas = 20;
while ($i < 100) {
	$t[$i] = $x;
	$x += $pas;
	$t[++$i] = rand($min, $max);
	$i++;
}
echo json_encode($t);