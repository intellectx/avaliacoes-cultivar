<?php
Login::verificaLogin(1);

$db = new ConexaoDB();
$mysqli = $db->conexao;

$db->verifica_erro_conexao();

if ($sql = $mysqli->prepare("UPDATE `escola` SET
  `nome` = '".utf8_decode($_POST['nome'])."', `cidade` = '".utf8_decode($_POST['cidade'])."',
  `estado` = '".$_POST['estado']."', `responsavel` = '".utf8_decode($_POST['responsavel'])."'
  WHERE `id` = '".$_POST['id_escola']."';"
  )) {
  	$sql->execute();
}

$_SESSION['retornoCrud'] = 2;
header('Location: '.HOME_URI.'/administrador/escolas');
