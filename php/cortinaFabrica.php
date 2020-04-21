<?php
require './cortinaFabricaAbstrata.php';

class cortinaFabrica extends cortinaFabricaAbstrata{
	//variaveis da conexão 
	private $servidor = "localhost";
	private $usuario = "root";
	private $senha = "";
	private $dbname = "joielcortinas";
	private $porta = 3308;
	//variaveis das cortinas
	private $tecido;//escolhido(a)
	private $forro;//escolhido(a)
	private $roloBkTs;//escolhido(a)
	private $lucro;//escolhido(a)
	//public $conn = mysqli_connect($servidor, $usuario, $senha, $dbname, $porta);
	
	function tecido($tecido){		
		$this->tecido=$tecido;
	}
	
	function forro($forro){
		$this->forro=$forro;
	}
	
	function roloBkTs($roloBkTs){
		$this->roloBkTs=$roloBkTs;
	}
	
	function lucro($lucro){
		$this->lucro=$lucro;
	}
	
	function montaCortina(){
		//cria conexão
		$conn = mysqli_connect($this->servidor, $this->usuario, $this->senha, $this->dbname, $this->porta);
		//Pega lucro no BD
		$result_usuario_lucro= "SELECT lucro FROM usuarios where nome='joiel'";
		$resultado_usuario_lucro = mysqli_query($conn, $result_usuario_lucro);
		$row_usuario_lucro = mysqli_fetch_assoc($resultado_usuario_lucro); 
		
		// montaCortina Horizontal
		if($this->cortina=="horizontal"){
			$result_usuario_tecido = "SELECT valor FROM tecidos where nome='horizontal'";
			$resultado_usuario_tecido = mysqli_query($conn, $result_usuario_tecido);
			$row_usuario_tecido = mysqli_fetch_assoc($resultado_usuario_tecido);
			return(($this->altura*$this->largura*$row_usuario_tecido['valor'])+150);
		}
		
		// montaCortina vertical tecido
		if($this->cortina=="verticalTecido"){
			$result_usuario_tecido = "SELECT valor FROM tecidos where nome='verticalTecido'";
			$resultado_usuario_tecido = mysqli_query($conn, $result_usuario_tecido);
			$row_usuario_tecido = mysqli_fetch_assoc($resultado_usuario_tecido);
			return(($this->altura*$this->largura*$row_usuario_tecido['valor'])+150);
		}
		
		// montaCortina vertical pvc
		if($this->cortina=="verticalPvc"){
			$result_usuario_tecido = "SELECT valor FROM tecidos where nome='verticalPvc'";
			$resultado_usuario_tecido = mysqli_query($conn, $result_usuario_tecido);
			$row_usuario_tecido = mysqli_fetch_assoc($resultado_usuario_tecido);
			return(($this->altura*$this->largura*$row_usuario_tecido['valor'])+150);
		}
		
		// montaCortina rolô
		if($this->cortina=="rolo"){
			if($this->roloBkTs=="bk"){
				$result_usuario_tecido = "SELECT valor FROM tecidos where nome='roloBk'";
			}else if($this->roloBkTs=="tela"){
				$result_usuario_tecido = "SELECT valor FROM tecidos where nome='roloTela'";
			}	
			$resultado_usuario_tecido = mysqli_query($conn, $result_usuario_tecido);
			$row_usuario_tecido = mysqli_fetch_assoc($resultado_usuario_tecido);
			return(($this->altura*$this->largura*$row_usuario_tecido['valor'])+250);
		}
		
		// montaCortina ilhoes
		if($this->cortina=="ilhoes"){
			if($this->tecido=="voal"){
				$result_usuario_tecido = "SELECT valor FROM tecidos where nome='voal'";
			}else if($this->tecido=="linho"){
				$result_usuario_tecido = "SELECT valor FROM tecidos where nome='linho'";
			}
			if($this->forro=="blackout"){
				$result_usuario_forro = "SELECT valor FROM tecidos where nome='blackout'";
			}else if($this->forro=="microfibra"){
				$result_usuario_forro = "SELECT valor FROM tecidos where nome='microFibra'";
			}
			//pega tecido escolhido
			$resultado_usuario_tecido = mysqli_query($conn, $result_usuario_tecido);
			$row_usuario_tecido = mysqli_fetch_assoc($resultado_usuario_tecido);
			//pega forro escolhido
			$resultado_usuario_forro = mysqli_query($conn, $result_usuario_forro);
			$row_usuario_forro = mysqli_fetch_assoc($resultado_usuario_forro);
			//pega ilhoes na tabela peças
			$result_usuario_ilhoes = "SELECT valor FROM pecas where nome='ilhoes'";
			$resultado_usuario_ilhoes = mysqli_query($conn, $result_usuario_ilhoes);
			$row_usuario_ilhoes = mysqli_fetch_assoc($resultado_usuario_ilhoes);
			//pega entretela na tabela peças
			$result_usuario_entretela = "SELECT valor FROM pecas where nome='entretela'";
			$resultado_usuario_entretela = mysqli_query($conn, $result_usuario_entretela);
			$row_usuario_entretela = mysqli_fetch_assoc($resultado_usuario_entretela);
			//pega kite de montagem na tabela peças
			//if($this->largura<=1.5){$result_usuario_kite = "SELECT valor FROM pecas where nome='kite 1.5m'";}
			//else if($this->largura>1.5){$result_usuario_kite = "SELECT valor FROM pecas where nome='kite 2m'";}
			//$resultado_usuario_kite = mysqli_query($conn, $result_usuario_kite);
			//$row_usuario_kite = mysqli_fetch_assoc($resultado_usuario_kite);
			//lucro
			if($this->largura<=2){$lucro=180;}
			if(($this->largura>2) && ($this->largura<=2.5)){$lucro=205;}
			if(($this->largura>2.5) && ($this->largura<=3)){$lucro=230;}
			if(($this->largura>3) && ($this->largura<=3.5)){$lucro=255;}
			if($this->largura>3.5){$lucro=280;}
			//valor da cortina montada
			return(($this->largura*3*$row_usuario_tecido['valor'])+($this->largura*3*$row_usuario_entretela['valor'])+($row_usuario_ilhoes['valor']*$this->largura*3*10)+($row_usuario_forro['valor']*$this->largura*3)+$lucro);
		}
		
		// montaCortina americana
		if($this->cortina=="americana"){
			if($this->tecido=="voal"){
				$result_usuario_tecido = "SELECT valor FROM tecidos where nome='voal'";
			}else if($this->tecido=="linho"){
				$result_usuario_tecido = "SELECT valor FROM tecidos where nome='linho'";
			}	
			$result_usuario_forro = "SELECT valor FROM tecidos where nome='microFibra'";
			//pega tecido escolhido
			$resultado_usuario_tecido = mysqli_query($conn, $result_usuario_tecido);
			$row_usuario_tecido = mysqli_fetch_assoc($resultado_usuario_tecido);
			//pega forro escolhido
			$resultado_usuario_forro = mysqli_query($conn, $result_usuario_forro);
			$row_usuario_forro = mysqli_fetch_assoc($resultado_usuario_forro);
			//pega trilho na tabela peças
			//$result_usuario_trilho = "SELECT valor FROM pecas where nome='trilho'";
			//$resultado_usuario_trilho = mysqli_query($conn, $result_usuario_trilho);
			//$row_usuario_trilho = mysqli_fetch_assoc($resultado_usuario_trilho);
			//pega entretela na tabela peças
			$result_usuario_entretela = "SELECT valor FROM pecas where nome='entretela'";
			$resultado_usuario_entretela = mysqli_query($conn, $result_usuario_entretela);
			$row_usuario_entretela = mysqli_fetch_assoc($resultado_usuario_entretela);
			//pega deslizantes na tabela peças
			$result_usuario_deslizante = "SELECT valor FROM pecas where nome='deslizante'";
			$resultado_usuario_deslizante = mysqli_query($conn, $result_usuario_deslizante);
			$row_usuario_deslizante = mysqli_fetch_assoc($resultado_usuario_deslizante);
			//lucro
			if($this->largura<=2){$lucro=180;}
			if(($this->largura>2) && ($this->largura<=2.5)){$lucro=205;}
			if(($this->largura>2.5) && ($this->largura<=3)){$lucro=230;}
			if(($this->largura>3) && ($this->largura<=3.5)){$lucro=255;}
			if($this->largura>3.5){$lucro=280;}
			//valor da cortina montada
			return(($this->largura*3*$row_usuario_tecido['valor'])+($this->largura*3*$row_usuario_entretela['valor'])+($row_usuario_deslizante['valor']*$this->largura*3*10)+($row_usuario_forro['valor']*$this->largura*3)+$lucro);
		}
	}
}
