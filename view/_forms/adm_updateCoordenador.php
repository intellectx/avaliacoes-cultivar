<?php
Login::verificaLogin(1);

$db = new ConexaoDB();
$mysqli = $db->conexao;
$db->verifica_erro_conexao();

if ($sql = $mysqli->prepare("UPDATE `usuario_coordenador` SET
  `nome` = '".utf8_decode($_POST['nome'])."', `escola` = '".$_POST['id_escola']."'
  WHERE `id` = '".$_POST['id_coordenador']."';"
  )) {
  	$sql->execute();
}

$_SESSION['retornoCrud'] = 2;
header('Location: '.HOME_URI.'/administrador/coordenadores');
