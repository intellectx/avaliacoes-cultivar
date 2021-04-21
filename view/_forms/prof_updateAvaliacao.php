<?php
	Login::verificaLogin(3);

	$db = new ConexaoDB();
	$mysqli = $db->conexao;
	$db->verifica_erro_conexao();

	if ($sql = $mysqli->prepare("UPDATE `avaliacoes` SET
	  `massa` = '".$_POST['massa']."',
		`altura` = '".$_POST['altura']."',
		`flexibilidade` = '".$_POST['flexibilidade']."',
		`resistenciaAbdominal` = '".$_POST['resistenciaAbdominal']."'
	  WHERE `id` = '".$_POST['id_avaliacao']."';"
	  )) {
	  	$sql->execute();
	}

	header('Location: '.HOME_URI.'/professor/mostra-avaliacoes');
?>
