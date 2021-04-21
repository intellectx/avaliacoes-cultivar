<?php

class Utils
{
	public static function geraCodigo() {
		$cod = "";
		for ($i=0; $i < 64; $i++) {
			$aux = rand(0, 9);
			$cod.=$aux;
		}
		return $cod;
  }

	public static function alertSucesso($msg) {
		echo '
			<div class="alert alert-success" role="alert">
			<span class="glyphicon glyphicon-ok" aria-hidden="true"> </span>
			 '.$msg.'
		</div>';
 	}

	public static function alertErro($msg) {
		echo '
			<div class="alert alert-danger" role="alert">
				<span class="glyphicon glyphicon-remove" aria-hidden="true"> </span>
				 '.$msg.'
			</div>';
	}

	public static function dateMysqlToPHP($date) {
		return date('d/m/Y', strtotime($date));
	}

	public static function dateMysqlToPHPMesAno($date) {
		return date('m/y', strtotime($date));
	}

	public static function calcIMC($peso, $altura) {
		if($peso>0 && $altura>0) {
			return number_format(($peso/(($altura/100)*($altura/100))), 2, ',', '');
		} else {
			return 0;
		}
	}

	public static function calcIMCponto($peso, $altura) {
		if($peso>0 && $altura>0) {
			return number_format(($peso/(($altura/100)*($altura/100))), 2, '.', '');
		} else {
			return 0;
		}
	}

	public static function getStringMedida($intMedida) {
		switch ($intMedida) {
			case '1':
				return "Regular";
				break;
			case '2':
				return "Bom";
				break;
			case '3':
				return "Ótimo";
				break;
			default:
				return "Não avaliado";
				break;
		}
	}
}
