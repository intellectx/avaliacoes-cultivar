<?php
	Login::verificaLogin(2);

	$coordenador = Coordenador::getCoordenadorById($_SESSION['iduser']);

	$db = new ConexaoDB();
	$mysqli = $db->conexao;

	$sql = "SELECT * FROM `usuario_aluno` WHERE idescola='".$coordenador->id_escola."' AND excluido = '0'";
	if(!$result = $mysqli->query($sql)){
    	die('Erro no banco de dados:( [' . $mysqli->error . ']');
	}
	$totalAlunos = $result->num_rows;

	$sql = "SELECT * FROM `usuario_professor` WHERE escola='".$coordenador->id_escola."' AND excluido = '0'";
	if(!$result = $mysqli->query($sql)){
    	die('Erro no banco de dados:( [' . $mysqli->error . ']');
	}
	$totalProfessores = $result->num_rows;

?>
<!DOCTYPE html>
<html>
<?php
	load_head("Coordenador");
?>
<body>
	<?php View::menu_coordenador('adm'); ?>
	<div class='container-fluid'>
		<div class='container'>
		 	<div role="tabpanel">
			  <ul class="nav nav-tabs " role="tablist">
			    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Geral</a></li>
			  </ul>
			  <div class="tab-content">
			    <div role="tabpanel" class="tab-pane active" id="home">
			    	<table class='table table-striped'>
							<tr>
								<td><h4>Alunos</h4></td>
								<td><h4><?php echo $totalAlunos; ?></h4></td>
							</tr>
							<tr>
								<td><h4>Professores</h4></td>
								<td><h4><?php echo $totalProfessores; ?></h4></td>
							</tr>
			    	</table>
			    </div>
			</div>
		</div>
	</div>
</body>
</html>
