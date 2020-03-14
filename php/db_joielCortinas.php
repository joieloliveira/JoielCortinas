<?php

require './cortinaFabrica.php';

$altura = $_REQUEST["altura"];
$largura = $_REQUEST["largura"];
$cortina = $_REQUEST["cortina"];

if($cortina=="horizontal"){
	$horizontal = new cortinaFabrica();
	$horizontal->cortina($cortina);
	$horizontal->medidas($largura,$altura);
	echo $horizontal->montaCortina();
}else if($cortina=="verticalTecido"){
	$verticalTecido = new cortinaFabrica();
	$verticalTecido->cortina($cortina);
	$verticalTecido->medidas($largura,$altura);
	echo $verticalTecido->montaCortina();
}else if($cortina=="verticalPvc"){
	$verticalPvc = new cortinaFabrica();
	$verticalPvc->cortina($cortina);
	$verticalPvc->medidas($largura,$altura);
	echo $verticalPvc->montaCortina();
}else if($cortina=="rolo"){
	$roloBkTs = $_REQUEST["radioRolo"];
	$rolo = new cortinaFabrica();
	$rolo->cortina($cortina);
	$rolo->medidas($largura,$altura);
	$rolo->roloBkTs($roloBkTs);
	echo $rolo->montaCortina();
}else if($cortina=="ilhoes"){
	$tecido = $_REQUEST["radioTecido"];
	$forro = $_REQUEST["radioBlackout"];
	$ilhoes = new cortinaFabrica();
	$ilhoes->cortina($cortina);
	$ilhoes->medidas($largura,$altura);
	$ilhoes->tecido($tecido);
	$ilhoes->forro($forro);
	echo $ilhoes->montaCortina();
}else if($cortina=="americana"){
	$tecido = $_REQUEST["radioTecido"];
	$forro = $_REQUEST["radioBlackout"];
	$americana = new cortinaFabrica();
	$americana->cortina($cortina);
	$americana->medidas($largura,$altura);
	$americana->tecido($tecido);
	$americana->forro($forro);
	echo $americana->montaCortina();
}