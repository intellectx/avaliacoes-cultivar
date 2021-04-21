<?php
Login::verificaLogin(1);

$db = new ConexaoDB();
$mysqli = $db->conexao;

$db->verifica_erro_conexao();

if ($sql = $mysqli->prepare("INSERT INTO `escola` (`nome`, `cidade`, `estado`, `responsavel`)
  VALUES ('".utf8_decode($_POST['nome'])."', '".utf8_decode($_POST['cidade'])."', '".$_POST['estado']."', '".utf8_decode($_POST['responsavel'])."');"
)) {
  	$sql->execute();
}

$_SESSION['retornoCrud'] = 1;
header('Location: '.HOME_URI.'/administrador/escolas');
