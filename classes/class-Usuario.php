<?php

class Usuario
{
	public $id_usuario;
	public $email;
	public $senha;
	public $tipo;
	public $codigo;

	function __construct($id_usuario, $email, $senha, $tipo, $codigo) {
   		$this->id_usuario = $id_usuario;
   		$this->email = $email;
    	$this->senha = $senha;
    	$this->tipo = $tipo;
    	$this->codigo = $codigo;
   	}

		public static function getUsuarioById($iduser) {
			$db = new ConexaoDB();
			$mysqli = $db->conexao;

			$db->verifica_erro_conexao();

			if ($sql = $mysqli->prepare("SELECT * FROM usuario WHERE iduser='".$iduser."'")) {
			  	$sql->execute();
			  	$sql->bind_result($id_usuario, $email, $senha, $tipo, $codigo);
			  	$sql->fetch();
			}

			return new Usuario($id_usuario, $email, $senha, $tipo, $codigo);
		}
}
