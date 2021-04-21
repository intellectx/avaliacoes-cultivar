<?php
Login::verificaLogin(2);

$db = new ConexaoDB();
$mysqli = $db->conexao;
$db->verifica_erro_conexao();

if ($sql = $mysqli->prepare("UPDATE `usuario_professor` SET
  `nome` = '".utf8_decode($_POST['nome'])."'
  WHERE `id` = '".$_POST['id_professor']."';"
  )) {
  	$sql->execute();
}

$_SESSION['retornoCrud'] = 2;
header('Location: '.HOME_URI.'/coordenador/professores');
