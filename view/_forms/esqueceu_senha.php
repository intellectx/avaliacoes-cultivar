<?php
	$db = new ConexaoDB();
	$mysqli = $db->conexao;
	$db->verifica_erro_conexao();

	if ($sql = $mysqli->prepare("SELECT * FROM usuario WHERE email='".$_POST['email-rec']."'")) {
			$sql->execute();
			$sql->bind_result($id_usuario, $email, $senha, $tipo, $codigo);
			$sql->fetch();
	}
	$sql->close();

	session_start();

	if($email == $_POST['email-rec']) {
		$codigoDeNovaSenha = Utils::geraCodigo();

		if ($sql = $mysqli->prepare("UPDATE `usuario` SET
		  `senha` = '', `codigo` = '".$codigoDeNovaSenha."'
		  WHERE `iduser` = '".$id_usuario."';"
		  )) {
		  	$sql->execute();
		}

		EnvioEmail::emailEsqueceuSenha($email, $codigoDeNovaSenha);

		$_SESSION['return_sucesso_esqueceu_senha'] = true;
	} else {
		$_SESSION['return_erro_esqueceu_senha'] = true;
	}

	header('Location: '.HOME_URI);
