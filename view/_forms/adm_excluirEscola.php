<?php
Login::verificaLogin(1);

$db = new ConexaoDB();
$mysqli = $db->conexao;

$db->verifica_erro_conexao();

if ($sql = $mysqli->prepare("UPDATE `escola` SET
  `excluido` = '1'
  WHERE `id` = '".$_POST['id_escola']."';"
  )) {
  	$sql->execute();
}

$_SESSION['retornoCrud'] = 3;
header('Location: '.HOME_URI.'/administrador/escolas');
