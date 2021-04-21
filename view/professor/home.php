<?php
	Login::verificaLogin(3);

	$professor = Professor::getProfessorById($_SESSION['iduser']);

	//busca alunos by escolas
	$db = new ConexaoDB();
	$mysqli = $db->conexao;

	$sql = "SELECT * FROM `usuario_aluno` WHERE idescola = '".$professor->id_escola."' ORDER BY nome ASC";

	if(!$result = $mysqli->query($sql)){
    	die('Erro no banco de dados:( [' . $mysqli->error . ']');	}

 	$stringAlunos = "";

	while($row = $result->fetch_assoc()) {
		$stringAlunos .= '"'.utf8_encode($row['nome']).'"'.", ";
	}

	$stringAlunos = substr($stringAlunos, 0, -2);

?>

<!DOCTYPE html>
<html>
<?php
	load_head("Profesor");
?>
<body class='body-azul'>
	<?php View::menu_professor($professor->nome); ?>
	<div class='container-fluid'>
		<div class='container container-professor' style='max-width:550px;'>
			<?php View::container_title('Painel do professor') ?>
                <a href="<?php echo HOME_URI; ?>/professor/busca-alunos" id='link-sem-underline'>
		   		<div class='btn-100-escuro'><span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp&nbsp Meus alunos</div>
		   	</a>
		   	<a href="<?php echo HOME_URI; ?>/professor/mostra-avaliacoes" id='link-sem-underline'>
		   		<div class='btn-100-escuro'><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>&nbsp&nbsp Minhas avaliações</div>
		   	</a>
		</div>
	</div>
	<?php View::rodape(); ?>
	<script type="text/javascript">
		var availableTags = [
			<?php
				echo $stringAlunos;
			?>
		];
		$( "#autocomplete" ).autocomplete({
			source: availableTags
		});
	</script>
</body>
</html>
