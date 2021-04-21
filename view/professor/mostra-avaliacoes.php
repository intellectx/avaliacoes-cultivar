<?php
	Login::verificaLogin(3);
	$professor = Professor::getProfessorById($_SESSION['iduser']);


		//busca avaliacoes
		$db = new ConexaoDB();
		$mysqli = $db->conexao;

		$sql = "SELECT * FROM `avaliacoes` WHERE idprofessor = '".$professor->id_usuario."'";

		//if (isset($_GET['b'])) {
			//$sql .= " AND nome LIKE '%".$_GET['b']."%'";
		//}

		$sql .= "  ORDER BY id DESC";

		if(!$result = $mysqli->query($sql)){
	    	die('Erro no banco de dados:( [' . $mysqli->error . ']');	}

		$listaAvaliacoes = array();
		while($row = $result->fetch_assoc()) {
			array_push($listaAvaliacoes, $row);
		}
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
			<h3 style='margin-top:0px;' class='letra-guarani'>Minhas Avaliações</h3><hr>
			<form action='<?php echo HOME_URI; ?>/professor/busca-alunos'>
				<div class="input-group">
					<input type="text" class="form-control" placeholder="Pesquisar avaliações por aluno..." id="autocomplete" >
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
						<th>Data</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php
						$i = 0;
						foreach ($listaAvaliacoes as $a) {
							$aluno = Aluno::getAlunoById($a['idaluno']);
							$dataAvaliacao = Utils::dateMysqlToPHP($a['date']);

							echo '<tr>
								<td>'.$aluno->nome.'</td>
								<td>'.$dataAvaliacao.'</td>
								<td style="text-align:right;">
									<div class="btn-group" role="group" aria-label="...">
										<button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#alterarAvaliacao'.$i.'"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>
										<button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#excluirAvaliacao'.$i.'"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
									</div>
									<div style="text-align:left" class="modal fade" id="alterarAvaliacao'.$i.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
											<div class="modal-dialog modal-sm">
												<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
															<h4 class="modal-title" id="myModalLabel">Alterar Avaliação</h4>
															<h5>'.$aluno->nome.', '.$dataAvaliacao.'</h5>
														</div>
														<div class="modal-body">
															<form class="form-horizontal" method="POST" action="'.HOME_URI.'/_forms/prof_updateAvaliacao">
															<input type="hidden" name="id_avaliacao" value="'.$a['id'].'">
															<div class="form-group">
																<label for="inputEmail3" class="col-sm-5 control-label">Massa:</label>
																<div class="col-sm-7">
																		<div class="input-group">
																			<input type="text" class="form-control" placeholder="" value="'.$a['massa'].'" name="massa">
																			<div class="input-group-addon">kg</div>
																	</div>
																</div>
															</div>
															<div class="form-group">
																<label for="inputEmail3" class="col-sm-5 control-label">Altura:</label>
																<div class="col-sm-7">
																		<div class="input-group">
																			<input type="text" class="form-control" placeholder="" value="'.$a['altura'].'" name="altura">
																			<div class="input-group-addon">cm</div>
																	</div>
																</div>
															</div>
															<div class="form-group">
																<label for="inputEmail3" class="col-sm-5 control-label">Flexibilidade:</label>
																<div class="col-sm-7">
																	<div class="input-group">
																		<select name="flexibilidade" class="form-control">
																		'; 
																		$flex = $a['flexibilidade'];
																		echo '
																			<option value="0">Não avaliar</option>
																			<option '; echo ($flex == 1) ? "selected" : ""; echo ' value="1">Regular</option>
																			<option '; echo ($flex == 2) ? "selected" : ""; echo ' value="2">Bom</option>
																			<option '; echo ($flex == 3) ? "selected" : ""; echo ' value="3">Ótimo</option>
																		</select>
																	</div>
																</div>
															</div>
															<div class="form-group">
																<label for="inputEmail3" class="col-sm-5 control-label">Resistência Abdominal:</label>
																<div class="col-sm-7">
																	<div class="input-group">
																		<select name="resistenciaAbdominal" class="form-control">
																		'; 
																		$rAbdom = $a['resistenciaAbdominal'];
																		echo '
																			<option value="0">Não avaliar</option>
																			<option '; echo ($rAbdom == 1) ? "selected" : ""; echo ' value="1">Regular</option>
																			<option '; echo ($rAbdom == 2) ? "selected" : ""; echo ' value="2">Bom</option>
																			<option '; echo ($rAbdom == 3) ? "selected" : ""; echo ' value="3">Ótimo</option>
																		</select>
																	</div>
																</div>
															</div>
														</div>
														<div class="modal-footer">
															<button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Salvar</button>
														</div>
														</form>
												</div>
											</div>
									</div>
									<div style="text-align:left" class="modal fade" id="excluirAvaliacao'.$i.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
										<form method="POST" action="'.HOME_URI.'/_forms/prof_excluirAvaliacao">
											<input type="hidden" name="id_avaliacao" value="'.$a['id'].'">
											<div class="modal-dialog modal-sm">
												<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
															<h4 class="modal-title" id="myModalLabel">Excluir Avaliação</h4>
														</div>
														<div class="modal-body">
															Deseja realmente excluir a avaliação do aluno '.$aluno->nome.'?
														</div>
														<div class="modal-footer">
															<button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Excluir</button>
														</div>
												</div>
											</div>
										</form>
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
</body>
</html>
