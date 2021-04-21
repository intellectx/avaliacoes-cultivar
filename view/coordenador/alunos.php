<?php
  Login::verificaLogin(2);

  $coordenador = Coordenador::getCoordenadorById($_SESSION['iduser']);

  $db = new ConexaoDB();
  $mysqli = $db->conexao;

  $sql = "SELECT * FROM `usuario_aluno` WHERE excluido='0' AND idescola='".$coordenador->id_escola."'";

  if (isset($_GET['b'])) {
    $sql .= " AND nome LIKE '%".utf8_decode($_GET['b'])."%'";
  }

  $sql .= "  ORDER BY nome ASC";

  if(!$result = $mysqli->query($sql)){
      die('Erro no banco de dados:( [' . $mysqli->error . ']');
  }

  $listaAlunos = array();

  while($row = $result->fetch_assoc()) {
    array_push($listaAlunos, $row);
  }

?>
<!DOCTYPE html>
<html>
<?php
  load_head("Coordenador");
?>
<body>
  <?php View::menu_coordenador('alunos'); ?>
  <div class='container-fluid'>
    <div class='container'>
      <?php
        if(isset($_SESSION['retornoCrud'])) {
          switch ($_SESSION['retornoCrud']) {
            case 1:
              Utils::alertSucesso("Aluno cadastrado");
            break;
            case 2:
              Utils::alertSucesso("Aluno alterado");
            break;
            case 3:
              Utils::alertSucesso("Aluno excluído");
            break;
          }
          unset($_SESSION['retornoCrud']);
        }
      ?>
      <form action="" method="GET">
         <div class="input-group">
              <input type="text" class="form-control" placeholder="Pesquisar alunos..." name="b" <?php if(isset($_GET['b'])) { View::input_value_getBusca($_GET['b']); } ?>>
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
            foreach ($listaAlunos as $key) {
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
                        <form action="'.HOME_URI.'/_forms/coo_excluirAluno" method="post">
                          <input type="hidden" name="id_aluno" value="'.$key['id'].'">
                          <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Confirmar</h4>
                              </div>
                              <div class="modal-body">
                                Você tem certeza que deseja excluir o aluno '.utf8_encode($key['nome']).'?
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
                      <form action="'.HOME_URI.'/_forms/coo_updateAluno" method="post" class="form-horizontal">
                        <input type="hidden" name="id_aluno" value="'.$key['id'].'">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Editar aluno</h4>
                          </div>
                          <div class="modal-body">
                            <div class="form-group">
                              <label for="inputEmail3" class="col-sm-2 control-label">Nome</label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputEmail3" placeholder="" value="'.utf8_encode($key['nome']).'" name="nome" maxlenght="30" required>
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
      <!--<button type="button" class="btn btn-danger btn-md letra-guarani"  data-toggle="modal" data-target="#importarAlunos"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Importar</button>-->

      <div style='text-align:left' class="modal fade" id="cadastroEscola" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">Cadastro de aluno</h4>
            </div>
            <div class="modal-body">
               <form class="form-horizontal" method='post' action='<?php echo HOME_URI."/_forms/coo_criaAluno"; ?>'>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Nome</label>
              <div class="col-sm-10">
                <input class="form-control" id="inputEmail3" placeholder="" name='nome' required maxlength="30">
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
              <div class="col-sm-10">
                <input class="form-control" id="inputEmail3" placeholder="" name='email' required type="email">
              </div>
            </div>
          <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Data de nascimento</label>
              <div class="col-sm-10">
                <input class="form-control" id="inputEmail3" placeholder="" name='nascimento' type='date'>
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Sexo</label>
              <div class="col-sm-10">
                <select class='form-control' name="sexo">
                  <option value="m">Masculino</option>
                  <option value="f">Femininno</option>
                </select>
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

      <div style='text-align:left' class="modal fade" id="importarAlunos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">Importar tabela de alunos</h4>
            </div>
            <div class="modal-body">
               <form class="form-horizontal" method='post' action='<?php echo HOME_URI."/coordenador/importar-alunos"; ?>' enctype="multipart/form-data" >
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label"></label>
                <div class="col-sm-10">
                  Para importar alunos, é preciso utilizar o nosso modelo.<br><br>
                  <a href="<?php echo HOME_URI.'/etc/modelo-importar.xls' ?>"><button type="button" class="btn btn-info btn-md letra-guarani"><span class="glyphicon glyphicon-download" aria-hidden="true"></span> download do modelo</button></a>
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Alunos</label>
                <div class="col-sm-10">
                  <input class="form-control" id="inputEmail3" placeholder="" name='fileAlunos' type="file">
                  <!-- <span style='color:red'>Utilize o modelo com o formato .xls</span> -->
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Importar</button>
            </div>
          </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
