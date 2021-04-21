<?php
Login::verificaLogin(2);

$db = new ConexaoDB();
$mysqli = $db->conexao;
$db->verifica_erro_conexao();

if ($sql = $mysqli->prepare("UPDATE `usuario_aluno` SET
  `nome` = '".utf8_decode($_POST['nome'])."', `idescola` = '".$_POST['id_escola']."'
  WHERE `id` = '".$_POST['id_aluno']."';"
  )) {
  	$sql->execute();
}

$_SESSION['retornoCrud'] = 2;
header('Location: '.HOME_URI.'/coordenador/alunos');
