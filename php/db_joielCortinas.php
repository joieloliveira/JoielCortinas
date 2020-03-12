<?php

$servidor = "localhost";
$usuario = "root";
$senha = "";
$dbname = "joielcortinas";
$porta = 3308;
//Criar a conexao
$conn = mysqli_connect($servidor, $usuario, $senha, $dbname, $porta);
	
$altura = $_REQUEST["altura"];
$largura = $_REQUEST["largura"];
$cortina = $_REQUEST["cortina"];

if($cortina=="ilhoes"||$cortina=="americana"){
	$radioTecido = $_REQUEST["radioTecido"];
	$radioBlackout = $_REQUEST["radioBlackout"];

	//Pega o lucro por usuário
	$result_usuario_lucro= "SELECT lucro FROM usuarios where nome='joiel'";
	$resultado_usuario_lucro = mysqli_query($conn, $result_usuario_lucro);
	$row_usuario_lucro = mysqli_fetch_assoc($resultado_usuario_lucro); 
	//com blackout sem blackout
	if($radioBlackout=="comBlackout"){
		$result_usuario_blackout = "SELECT valor FROM tecidos where nome='blackout'";
	}if($radioBlackout=="semBlackout"){
		$result_usuario_blackout = "SELECT valor FROM tecidos where nome='microfibra'";
	}
	$resultado_usuario_blackout = mysqli_query($conn, $result_usuario_blackout);
	$row_usuario_blackout = mysqli_fetch_assoc($resultado_usuario_blackout);
	//pega o tecido escolhido
	if($radioTecido=="voal"){
		$result_usuario_tecido = "SELECT valor FROM tecidos where nome='voal'";
	}if($radioTecido=="linho"){
		$result_usuario_tecido = "SELECT valor FROM tecidos where nome='linho'";
	}
	$resultado_usuario_tecido = mysqli_query($conn, $result_usuario_tecido);
	$row_usuario_tecido = mysqli_fetch_assoc($resultado_usuario_tecido);
	//pega peças da cortina escolhida americana
	if($cortina=="americana"){
		$result_usuario_deslizante = "SELECT valor FROM pecas where nome='deslizante'";
		$resultado_usuario_deslizante = mysqli_query($conn, $result_usuario_deslizante);
		$row_usuario_deslizante = mysqli_fetch_assoc($resultado_usuario_deslizante);
		
		$result_usuario_entretela = "SELECT valor FROM pecas where nome='entretela'";
		$resultado_usuario_entretela = mysqli_query($conn, $result_usuario_entretela);
		$row_usuario_entretela = mysqli_fetch_assoc($resultado_usuario_entretela);
		
		$result_usuario_trilho = "SELECT valor FROM pecas where nome='trilho'";
		$resultado_usuario_trilho = mysqli_query($conn, $result_usuario_trilho);
		$row_usuario_trilho = mysqli_fetch_assoc($resultado_usuario_trilho);
		
		echo (($largura*3*$row_usuario_tecido['valor'])+($largura*3*$row_usuario_entretela['valor'])+($row_usuario_deslizante['valor']*$largura*3*10)+($row_usuario_trilho['valor']*$largura)+($row_usuario_blackout['valor']*$largura*3)+$row_usuario_lucro['lucro']);
	//pega peças da cortina escolhida ilhoes	
	}if($cortina=="ilhoes"){
		$result_usuario_ilhoes = "SELECT valor FROM pecas where nome='ilhoes'";
		$resultado_usuario_ilhoes = mysqli_query($conn, $result_usuario_ilhoes);
		$row_usuario_ilhoes = mysqli_fetch_assoc($resultado_usuario_ilhoes);
		
		$result_usuario_entretela = "SELECT valor FROM pecas where nome='entretela'";
		$resultado_usuario_entretela = mysqli_query($conn, $result_usuario_entretela);
		$row_usuario_entretela = mysqli_fetch_assoc($resultado_usuario_entretela);
		
		if($largura<=1.5){$result_usuario_kite = "SELECT valor FROM pecas where nome='kite 1.5m'";}
		if($largura>1.5){$result_usuario_kite = "SELECT valor FROM pecas where nome='kite 2m'";}
		$resultado_usuario_kite = mysqli_query($conn, $result_usuario_kite);
		$row_usuario_kite = mysqli_fetch_assoc($resultado_usuario_kite);
		
		echo (($largura*3*$row_usuario_tecido['valor'])+($largura*3*$row_usuario_entretela['valor'])+($row_usuario_ilhoes['valor']*$largura*3*10)+($row_usuario_kite['valor'])+($row_usuario_blackout['valor']*$largura*3)+$row_usuario_lucro['lucro']);	
	}
}


if($cortina=="horizontal"){
	$result_usuario_tecido = "SELECT valor FROM tecidos where nome='horizontal'";
	$resultado_usuario_tecido = mysqli_query($conn, $result_usuario_tecido);
	$row_usuario_tecido = mysqli_fetch_assoc($resultado_usuario_tecido);
	echo(($altura*$largura*$row_usuario_tecido['valor'])+150);
		
}if($cortina=="verticalTecido"){
	$result_usuario_tecido = "SELECT valor FROM tecidos where nome='verticalTecido'";
	$resultado_usuario_tecido = mysqli_query($conn, $result_usuario_tecido);
	$row_usuario_tecido = mysqli_fetch_assoc($resultado_usuario_tecido);
	echo(($altura*$largura*$row_usuario_tecido['valor'])+150);
		
}if($cortina=="verticalPvc"){
	$result_usuario_tecido = "SELECT valor FROM tecidos where nome='verticalPvc'";
	$resultado_usuario_tecido = mysqli_query($conn, $result_usuario_tecido);
	$row_usuario_tecido = mysqli_fetch_assoc($resultado_usuario_tecido);
	echo(($altura*$largura*$row_usuario_tecido['valor'])+150);
		
}if($cortina=="rolo"){
	$radioRolo = $_REQUEST["radioRolo"];
	if($radioRolo=="bk"){
		$result_usuario_tecido = "SELECT valor FROM tecidos where nome='roloBk'";
	}else if($radioRolo=="tela"){
		$result_usuario_tecido = "SELECT valor FROM tecidos where nome='roloTela'";
	}	
	$resultado_usuario_tecido = mysqli_query($conn, $result_usuario_tecido);
	$row_usuario_tecido = mysqli_fetch_assoc($resultado_usuario_tecido);
	echo(($altura*$largura*$row_usuario_tecido['valor'])+200);		
}