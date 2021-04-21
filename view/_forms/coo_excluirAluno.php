<?php
Login::verificaLogin(2);

$db = new ConexaoDB();
$mysqli = $db->conexao;

$db->verifica_erro_conexao();

if ($sql = $mysqli->prepare("UPDATE `usuario_aluno` SET
  `excluido` = '1'
  WHERE `id` = '".$_POST['id_aluno']."';"
  )) {
  	$sql->execute();
}

$_SESSION['retornoCrud'] = 3;
header('Location: '.HOME_URI.'/coordenador/alunos');
