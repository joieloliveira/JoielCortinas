<?php

abstract class cortinaFabricaAbstrata{
	//variaveis das cortinas
	public $cortina;//escolhido(a)
	public $altura;//escolhido(a)
	public $largura;//escolhido(a)
	//public $lucro;//escolhido(a)
	
	function cortina($cortina){		
		$this->cortina=$cortina;
	}
	
	function medidas($largura,$altura){
		$this->altura=$altura;
		$this->largura=$largura;
	}
	
	abstract function montaCortina();
}
