<?php
session_start();

$emailPost = $_POST['email'];
$senhaPost = $_POST['senha'];

$db = new ConexaoDB();
$mysqli = $db->conexao;

$db->verifica_erro_conexao();

if ($sql = $mysqli->prepare("SELECT * FROM usuario WHERE email='".$emailPost."'")) {

  	$sql->execute();
  	$sql->bind_result($id_usuario, $email, $senha, $tipo, $codigo);
  	$sql->fetch();

    if($id_usuario>0 AND $senhaPost == $senha) {
        $_SESSION['iduser'] = $id_usuario;
    		switch ($tipo) {
    			case 1:
    				header('Location: '.HOME_URI.'/administrador');
    				break;
    			case 2:
    				header('Location: '.HOME_URI.'/coordenador');
    				break;
    			case 3:
    				header('Location: '.HOME_URI.'/professor');
    				break;
    			case 4:
    				header('Location: '.HOME_URI.'/aluno');
    				break;
    		}
    } else {
      $_SESSION['return_erro_login'] = true;
      header('Location: '.HOME_URI);
    }

  	$sql->close();
}

$mysqli->close();
