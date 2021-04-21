<?php
	Login::verificaLogin(3);

	$db = new ConexaoDB();
	$mysqli = $db->conexao;
	$db->verifica_erro_conexao();

	if ($sql = $mysqli->prepare("DELETE FROM `avaliacoes` WHERE `id` = '".$_POST['id_avaliacao']."'")) {
	  	$sql->execute();
	}

	header('Location: '.HOME_URI.'/professor/mostra-avaliacoes');
