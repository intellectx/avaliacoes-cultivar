<?php
	Login::verificaLogin(1);

	$db = new ConexaoDB();
	$mysqli = $db->conexao;

	$sql = "SELECT * FROM `usuario_coordenador` WHERE excluido='0' ";

	if (isset($_GET['b'])) {
		$sql .= " AND nome LIKE '%".utf8_decode($_GET['b'])."%'";
	}

	$sql .= "  ORDER BY nome ASC";

	if(!$result = $mysqli->query($sql)){
    	die('Erro no banco de dados:( [' . $mysqli->error . ']');
	}

	$listaCoordenadores = array();

	while($row = $result->fetch_assoc()) {
		array_push($listaCoordenadores, $row);
	}

	$sql = "SELECT * FROM `escola` ORDER BY nome ASC";

	if(!$result = $mysqli->query($sql)){
    	die('Erro no banco de dados:( [' . $mysqli->error . ']');	}

 	$listaEscolas = array();

	while($row = $result->fetch_assoc()) {
		array_push($listaEscolas, $row);
	}

?>
<!DOCTYPE html>
<html>
<?php
	load_head("Coordenadores");
?>
<body>
	<?php View::menu_adm('coordenadores'); ?>
	<div class='container-fluid'>
		<div class='container'>
			<?php
				if(isset($_SESSION['retornoCrud'])) {
					switch ($_SESSION['retornoCrud']) {
						case 1:
							Utils::alertSucesso("Coordenador cadastrado");
						break;
						case 2:
							Utils::alertSucesso("Coordenador alterado");
						break;
						case 3:
							Utils::alertSucesso("Coordenador excluído");
						break;
					}
					unset($_SESSION['retornoCrud']);
				}
			?>
			<form action="" method="GET">
			 	<div class="input-group">
		      		<input type="text" class="form-control" placeholder="Pesquisar coordenadores..." name="b" <?php if(isset($_GET['b'])) { View::input_value_getBusca($_GET['b']); } ?>>
		      		<span class="input-group-btn">
		        		<button class="btn btn-default btn-info letra-guarani" type="button"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Buscar!</button>
		      		</span>
			    </div>
		    </form>
			<table class='table'>
				<thead>
					<tr>
						<th>Nome</th>
						<th>Escola</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php
						$i = 0;
						foreach ($listaCoordenadores as $key) {
								echo '<tr>';
								echo '<td>'.utf8_encode($key['nome']).'</td>';
								$escola = "";
								foreach ($listaEscolas as $e) {
									if($e['id'] == $key['escola']) {
											$escola = utf8_encode($e['nome']);
									}
								}
								echo '<td>'.$escola.'</td>';
								echo '
								<td style="text-align:right;">
									<div class="btn-group" role="group" aria-label="...">
										<button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#editar'.$i.'"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>
										<button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#excluir"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
									</div>
									<div style="text-align:left" class="modal fade" id="excluir" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								  		<div class="modal-dialog">
												<form action="'.HOME_URI.'/_forms/adm_excluirCoordenador" method="post">
													<input type="hidden" name="id_coordenador" value="'.$key['id'].'">
									    		<div class="modal-content">
									      			<div class="modal-header">
											        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											        	<h4 class="modal-title" id="myModalLabel">Confirmar</h4>
											      	</div>
											      	<div class="modal-body">
											        	Você tem certeza que deseja excluir o coordenador '.utf8_encode($key['nome']).'?
											       	</div>
											      	<div class="modal-footer">
											        	<button type="submit" class="btn btn-danger letra-guarani"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Excluir</button>
											      	</div>
										    	</div>
												</form>
								  		</div>
									</div>
									<div style="text-align:left" class="modal fade" id="editar'.$i.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							  		<div class="modal-dialog">
											<form action="'.HOME_URI.'/_forms/adm_updateCoordenador" method="post" class="form-horizontal">
												<input type="hidden" name="id_coordenador" value="'.$key['id'].'">
								    		<div class="modal-content">
								      		<div class="modal-header">
								        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									        	<h4 class="modal-title" id="myModalLabel">Editar escola</h4>
									      	</div>
									      	<div class="modal-body">
											  		<div class="form-group">
										    			<label for="inputEmail3" class="col-sm-2 control-label">Nome</label>
										    			<div class="col-sm-10">
										      			<input type="text" class="form-control" id="inputEmail3" placeholder="" value="'.utf8_encode($key['nome']).'" name="nome" required maxlength="30">
										    			</div>
											  		</div>
											  		<div class="form-group">
												    	<label for="inputPassword3" class="col-sm-2 control-label">Escola</label>
													    	<div class="col-sm-10">
													      	<select class="form-control" name="id_escola">
																		';
																			foreach ($listaEscolas as $e) {
																				$selected = '';
																				if($e['id'] == $key['escola']) {
																						$selected = 'selected';
																				}
																				if($e['excluido'] == 0) {	
																					echo "<option ".$selected." value='".$e['id']."'>".utf8_encode($e['nome'])."</option>";
																				}
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
			        <h4 class="modal-title" id="myModalLabel">Cadastro de coordenador</h4>
			      </div>
			      <div class="modal-body">
			       	<form class="form-horizontal" method='post' action='<?php echo HOME_URI."/_forms/adm_criaCoordenador"; ?>'>
					  <div class="form-group">
					    <label for="inputEmail3" class="col-sm-2 control-label">Nome</label>
					    <div class="col-sm-10">
					      <input class="form-control" id="inputEmail3" placeholder="" name='nome' required maxlength="30">
					    </div>
					  </div>
						<div class="form-group">
					    <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
					    <div class="col-sm-10">
					      <input class="form-control" id="inputEmail3" placeholder="" name='email' required type='email'>
					    </div>
					  </div>

					  <div class="form-group">
					    <label for="inputPassword3" class="col-sm-2 control-label">Escolas</label>
					    <div class="col-sm-10">
					      <select class="form-control" name='escola'>
									<?php
										foreach ($listaEscolas as $e) {
											echo "<option value='".$e['id']."'>".utf8_encode($e['nome'])."</option>";
										}
								 	?>
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
