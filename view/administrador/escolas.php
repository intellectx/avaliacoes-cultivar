<?php
	Login::verificaLogin(1);

	$db = new ConexaoDB();
	$mysqli = $db->conexao;

	$sql = "SELECT * FROM `escola` WHERE excluido='0' ";

	if (isset($_GET['b'])) {
		$sql .= " AND (nome
		LIKE '%".utf8_decode($_GET['b'])."%'
		OR cidade LIKE '%".utf8_decode($_GET['b'])."%'
		OR responsavel LIKE '%".utf8_decode($_GET['b'])."%')";
	}

	$sql .= "  ORDER BY nome ASC";

	if(!$result = $mysqli->query($sql)){
    	die('Erro no banco de dados:( [' . $mysqli->error . ']');
	}

	$listaEscolas = array();

	while($row = $result->fetch_assoc()) {
		array_push($listaEscolas, $row);
	}

?>
<!DOCTYPE html>
<html>
<?php
	load_head("Escolas");
?>
<body>
	<?php View::menu_adm('escolas'); ?>
	<div class='container-fluid'>
		<div class='container'>
			<?php
				if(isset($_SESSION['retornoCrud'])) {
					switch ($_SESSION['retornoCrud']) {
						case 1:
							Utils::alertSucesso("Escola cadastrada");
						break;
						case 2:
							Utils::alertSucesso("Escola alterada");
						break;
						case 3:
							Utils::alertSucesso("Escola excluída");
						break;
					}
					unset($_SESSION['retornoCrud']);
				}
			?>
			<form action="" method="GET">
			 	<div class="input-group">
		      		<input type="text" class="form-control" placeholder="Pesquisar escolas..." name="b" <?php if(isset($_GET['b'])) { View::input_value_getBusca($_GET['b']); } ?>>
		      		<span class="input-group-btn">
		        		<button class="btn btn-default btn-info letra-guarani" type="button"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Buscar!</button>
		      		</span>
			    </div>
		    </form>
			<table class='table'>
				<thead>
					<tr>
						<th>Escola</th>
						<th>Cidade</th>
						<th>Estado</th>
						<th>Responsável</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php
						$i = 0;
						foreach ($listaEscolas as $key) {
								echo '<tr>';
								echo '<td>'.utf8_encode($key['nome']).'</td>';
								echo '<td>'.utf8_encode($key['cidade']).'</td>';
								echo '<td>'.$key['estado'].'</td>';
								echo '<td>'.utf8_encode($key['responsavel']).'</td>';
								echo '
								<td style="text-align:right;">
									<div class="btn-group" role="group" aria-label="...">
										<button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#editarEscola'.$i.'"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>
										<button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#excluirEscola'.$i.'"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
									</div>
									<div style="text-align:left" class="modal fade" id="excluirEscola'.$i.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								  		<div class="modal-dialog">
												<form action="'.HOME_URI.'/_forms/adm_excluirEscola" method="post">
													<input type="hidden" name="id_escola" value="'.$key['id'].'">
									    		<div class="modal-content">
									      			<div class="modal-header">
											        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											        	<h4 class="modal-title" id="myModalLabel">Confirmar</h4>
											      	</div>
											      	<div class="modal-body">
											        	Você tem certeza que deseja excluir a escola '.utf8_encode($key['nome']).'?
											       	</div>
											      	<div class="modal-footer">
											        	<button type="submit" class="btn btn-danger letra-guarani"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Excluir</button>
											      	</div>
										    	</div>
												</form>
								  		</div>
									</div>
									<div style="text-align:left" class="modal fade" id="editarEscola'.$i.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							  		<div class="modal-dialog">
											<form action="'.HOME_URI.'/_forms/adm_updateEscola" method="post" class="form-horizontal">
												<input type="hidden" name="id_escola" value="'.$key['id'].'">
								    		<div class="modal-content">
								      		<div class="modal-header">
								        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									        	<h4 class="modal-title" id="myModalLabel">Editar escola</h4>
									      	</div>
									      	<div class="modal-body">
											  		<div class="form-group">
										    			<label for="inputEmail3" class="col-sm-2 control-label">Escola</label>
										    			<div class="col-sm-10">
										      			<input type="text" class="form-control" id="inputEmail3" placeholder="" value="'.utf8_encode($key['nome']).'" name="nome">
										    			</div>
											  		</div>
											  		<div class="form-group">
												    	<label for="inputEmail3" class="col-sm-2 control-label">Responsável</label>
												    	<div class="col-sm-10">
											      		<input class="form-control" id="inputEmail3" placeholder="" value="'.utf8_encode($key['responsavel']).'" name="responsavel">
												    	</div>
												  	</div>
											  		<div class="form-group">
												    	<label for="inputPassword3" class="col-sm-2 control-label">Cidade</label>
												    	<div class="col-sm-10">
										    	  		<input class="form-control" placeholder="" value="'.utf8_encode($key['cidade']).'" name="cidade">
												    	</div>
											  		</div>
											  		<div class="form-group">
												    	<label for="inputPassword3" class="col-sm-2 control-label">Estado</label>
													    	<div class="col-sm-10">
													      	<select class="form-control" name="estado">
																		';
																			$estados = array("SC", "RS", "PR", "SP", "RJ");
																			foreach ($estados as $e) {
																				$selected = '';
																				if($e == $key['estado']) {
																						$selected = 'selected';
																				}
																				echo "<option ".$selected." value='".$e."'>".$e."</option>";
																			}
																		echo '
																</select>
													    </div>
											  		</div>
								      		</div>
							      			<div class="modal-footer">
						        				<button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Salvar</button>
							      			</div>
							    			</div>
											</form>
					  				</div>
									</div>
								</td>';
							echo '</tr>';

							$i++;
						}
					?>
				</tbody>
			</table>
			<button type="button" class="btn btn-info btn-md letra-guarani" data-toggle="modal" data-target="#cadastroEscola"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Novo</button>

			<div style='text-align:left' class="modal fade" id="cadastroEscola" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        <h4 class="modal-title" id="myModalLabel">Cadastro de escola</h4>
			      </div>
			      <div class="modal-body">
			       	<form class="form-horizontal" method='post' action='<?php echo HOME_URI."/_forms/adm_criaEscola"; ?>'>
					  <div class="form-group">
					    <label for="inputEmail3" class="col-sm-2 control-label">Escola</label>
					    <div class="col-sm-10">
					      <input class="form-control" id="inputEmail3" placeholder="" name='nome'>
					    </div>
					  </div>
					  <div class="form-group">
					    <label for="inputEmail3" class="col-sm-2 control-label">Responsável</label>
					    <div class="col-sm-10">
					      <input class="form-control" id="inputEmail3" placeholder="" name='responsavel'>
					    </div>
					  </div>
					  <div class="form-group">
					    <label for="inputPassword3" class="col-sm-2 control-label">Cidade</label>
					    <div class="col-sm-10">
					      <input class="form-control" id="inputPassword3" placeholder="" name='cidade'>
					    </div>
					  </div>
					  <div class="form-group">
					    <label for="inputPassword3" class="col-sm-2 control-label">Estado</label>
					    <div class="col-sm-10">
					      <select class="form-control" name='estado'>
							  <option value='SC'>SC</option>
							  <option value='RS'>RS</option>
								<option value='PR'>PR</option>
							  <option value='SP'>SP</option>
							  <option value='RJ'>RJ</option>
							</select>
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


		</div>
	</div>
</body>
</html>
