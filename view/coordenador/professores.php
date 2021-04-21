<?php
	Login::verificaLogin(2);

	$coordenador = Coordenador::getCoordenadorById($_SESSION['iduser']);

	$db = new ConexaoDB();
	$mysqli = $db->conexao;

	$sql = "SELECT * FROM `usuario_professor` WHERE excluido='0' AND escola='$coordenador->id_escola'";

	if (isset($_GET['b'])) {
		$sql .= " AND nome LIKE '%".utf8_decode($_GET['b'])."%'";
	}

	$sql .= "  ORDER BY nome ASC";

	if(!$result = $mysqli->query($sql)){
    	die('Erro no banco de dados:( [' . $mysqli->error . ']');
	}

	$listaProfessores = array();

	while($row = $result->fetch_assoc()) {
		array_push($listaProfessores, $row);
	}
?>
<!DOCTYPE html>
<html>
<?php
	load_head("Coordenador");
?>
<body>
	<?php View::menu_coordenador('professores'); ?>
	<div class='container-fluid'>
		<div class='container'>
			<?php
				if(isset($_SESSION['retornoCrud'])) {
					switch ($_SESSION['retornoCrud']) {
						case 1:
							Utils::alertSucesso("Professor cadastrado");
						break;
						case 2:
							Utils::alertSucesso("Professor alterado");
						break;
						case 3:
							Utils::alertSucesso("Professor excluído");
						break;
					}
					unset($_SESSION['retornoCrud']);
				}
			?>
			<form action="" method="GET">
			 	<div class="input-group">
		      		<input type="text" class="form-control" placeholder="Pesquisar professores..." name="b" <?php if(isset($_GET['b'])) { View::input_value_getBusca($_GET['b']); } ?>>
		      		<span class="input-group-btn">
		        		<button class="btn btn-default btn-info letra-guarani" type="button"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Buscar!</button>
		      		</span>
			    </div>
		    </form>
			<table class='table'>
				<thead>
					<tr>
						<th>Nome</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php
						$i = 0;
						foreach ($listaProfessores as $key) {
								echo '<tr>';
								echo '<td>'.utf8_encode($key['nome']).'</td>';
								echo '
								<td style="text-align:right;">
									<div class="btn-group" role="group" aria-label="...">
										<button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#editar'.$i.'"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>
										<button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#excluir"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
									</div>
									<div style="text-align:left" class="modal fade" id="excluir" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								  		<div class="modal-dialog">
												<form action="'.HOME_URI.'/_forms/coo_excluirProfessor" method="post">
													<input type="hidden" name="id_professor" value="'.$key['id'].'">
									    		<div class="modal-content">
									      			<div class="modal-header">
											        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											        	<h4 class="modal-title" id="myModalLabel">Confirmar</h4>
											      	</div>
											      	<div class="modal-body">
											        	Você tem certeza que deseja excluir o professor '.utf8_encode($key['nome']).'?
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
											<form action="'.HOME_URI.'/_forms/coo_updateProfessor" method="post" class="form-horizontal">
												<input type="hidden" name="id_professor" value="'.$key['id'].'">
								    		<div class="modal-content">
								      		<div class="modal-header">
								        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									        	<h4 class="modal-title" id="myModalLabel">Editar professor</h4>
									      	</div>
									      	<div class="modal-body">
											  		<div class="form-group">
										    			<label for="inputEmail3" class="col-sm-2 control-label">Nome</label>
										    			<div class="col-sm-10">
										      			<input type="text" class="form-control" id="inputEmail3" placeholder="" value="'.utf8_encode($key['nome']).'" name="nome" required maxlength="30">
										    			</div>
											  		</div>
														<input type="hidden" name="escola" value="'.$coordenador->id_escola.'">
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
			        <h4 class="modal-title" id="myModalLabel">Cadastro de professor</h4>
			      </div>
			      <div class="modal-body">
			       	<form class="form-horizontal" method='post' action='<?php echo HOME_URI."/_forms/coo_criaProfessor"; ?>'>
					  <div class="form-group">
					    <label for="inputEmail3" class="col-sm-2 control-label">Nome</label>
					    <div class="col-sm-10">
					      <input class="form-control" id="inputEmail3" placeholder="" name='nome' required maxlength="30">
					    </div>
					  </div>
						<div class="form-group">
					    <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
					    <div class="col-sm-10">
					      <input class="form-control" id="inputEmail3" placeholder="" name='email' type="email" required>
					    </div>
					  </div>
						<input type="hidden" name="escola" value="<?php echo $coordenador->id_escola; ?>">
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
