<?php
	Login::verificaLogin(3);

	$professor = Professor::getProfessorById($_SESSION['iduser']);

	//busca alunos by escolas
	$db = new ConexaoDB();
	$mysqli = $db->conexao;

	$sql = "SELECT * FROM `usuario_aluno` WHERE idescola = '".$professor->id_escola."'";

	if (isset($_GET['b'])) {
		$sql .= " AND nome LIKE '%".utf8_decode($_GET['b'])."%'";
	}

	$sql .= "  ORDER BY nome ASC";

	if(!$result = $mysqli->query($sql)){
    	die('Erro no banco de dados:( [' . $mysqli->error . ']');	}

 	$stringAlunos = "";
	$listaAlunos = array();

	while($row = $result->fetch_assoc()) {
		array_push($listaAlunos, $row);
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
	<?php View::menu_professor($professor->nome) ?>
	<div class='container-fluid'>
		<div class='container container-professor' style='max-width:550px;'>
			<?php View::container_title("Meus alunos") ?>
			<form action='<?php echo HOME_URI; ?>/professor/busca-alunos' method='GET'>
				<div class="input-group">
					<input type="text" class="form-control" placeholder="Pesquisar alunos..." id="autocomplete" name='b'>
		      		<span class="input-group-btn">
		        		<button class="btn btn-default btn-info letra-guarani" type="submit"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> <span class='hidden-xs'>Buscar!</span></button>
		      		</span>
		    	</div>
		    </form>
		    <br>
			<table class='table table-striped'>
				<thead>
					<tr>
						<th>Aluno</th>
						<th>Última Av.</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php
						$i = 0;
						foreach ($listaAlunos as $a) {
							$sql = "SELECT * FROM `avaliacoes` WHERE idaluno = '".$a['id']."' ORDER BY id DESC";

							if(!$result = $mysqli->query($sql)){
									die('Erro no banco de dados:( [' . $mysqli->error . ']');	}

							$row = $result->fetch_assoc();

							$ultimaAv = Utils::dateMysqlToPHP($row['date']);
							if($ultimaAv == "01/01/1970") {
								$ultimaAv = ' - ';
							}
								echo '<tr>
										<td><a href="'.HOME_URI.'/professor/aluno?a='.$a['id'].'">'.utf8_encode($a['nome']).'</a></td>
										<td>'.$ultimaAv.'</td>
										<td style="text-align:right">
												<div class="btn-group" role="group" aria-label="...">
													<a href="'.HOME_URI.'/professor/aluno?a='.$a['id'].'" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></a>
												</div>
										</td>
								</tr>';
								$i++;
						}
					 ?>
				</tbody>
			</table>
			<a href="home"><button class='btn btn-info letra-guarani'><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Voltar</button></a>
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
