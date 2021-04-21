<?php
Login::verificaLogin(2);

$db = new ConexaoDB();
$mysqli = $db->conexao;

$db->verifica_erro_conexao();

if ($sql = $mysqli->prepare("UPDATE `usuario_professor` SET
  `excluido` = '1'
  WHERE `id` = '".$_POST['id_professor']."';"
  )) {
  	$sql->execute();
}

$_SESSION['retornoCrud'] = 3;
header('Location: '.HOME_URI.'/coordenador/professores');
