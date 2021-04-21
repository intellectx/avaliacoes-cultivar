<?php

class Login
{
	public $email;
	public $senha;

	static function logout() {
		unset($_SESSION['iduser']);
		header('Location: '.HOME_URI);
		exit();
	}

	static function verificaLogin($pag) {
		session_start();
		if(!isset($_SESSION['iduser'])) { Login::logout(); }

		$db = new ConexaoDB();
		$mysqli = $db->conexao;

		$db->verifica_erro_conexao();


		if ($sql = $mysqli->prepare("SELECT * FROM usuario WHERE iduser='".$_SESSION['iduser']."'")) {
		  	$sql->execute();
		  	$sql->bind_result($id_usuario, $email, $senha, $tipo, $codigo);
		  	$sql->fetch();

				if($pag <> $tipo) { Login::logout(); }
			}
		}
}
