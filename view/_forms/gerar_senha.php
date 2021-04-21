<?php
  $db = new ConexaoDB();
  $mysqli = $db->conexao;
  $db->verifica_erro_conexao();

  if ($sql = $mysqli->prepare("SELECT * FROM usuario WHERE codigo='".$_POST['k']."'")) {
      $sql->execute();
      $sql->bind_result($id_usuario, $email, $senha, $tipo, $codigo);
      $sql->fetch();
  }
  $sql->close();

  if($_POST['senha'] == $_POST['re-senha'] AND $_POST['k'] == $codigo) {
    if ($sql = $mysqli->prepare("UPDATE `usuario` SET
      `senha` = '".utf8_decode($_POST['senha'])."', `codigo` = ''
      WHERE `iduser` = '".$id_usuario."';"
      )) {
      	$sql->execute();
        session_start();
        $_SESSION['return_sucesso_cadastro'] = true;

    		header('Location: '.HOME_URI);
    }
  } else {
    echo "Erro!";
  }
