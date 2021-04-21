<?php
  require('php-excel/excel_reader2.php');

	Login::verificaLogin(2);

	$coordenador = Coordenador::getCoordenadorById($_SESSION['iduser']);


  if(isset($_FILES['fileAlunos']) AND $_FILES['fileAlunos']['tmp_name']) {
    if(!$_FILES['fileAlunos']['error']) {
      $inputFile = $_FILES['fileAlunos']['name'];

      $extension = strtoupper(pathinfo($inputFile, PATHINFO_EXTENSION));
      if($extension == 'XLS'){



        $data = new Spreadsheet_Excel_Reader($_FILES['fileAlunos']['tmp_name']);

        //echo($data->val(1, 'A'));

        //echo $data->sheets[0]['numRows'];

        //print_r($data->sheets[0]);

        //print_r(get_object_vars($data));




      } else {
        echo 'NENHUM ARQUIVO ENCONTRADO OU FORMATO INCORRETO<BR>';
        echo '<a href="../">VOLTAR</a>';       
        exit();
      }
    }else {
      echo 'NENHUM ARQUIVO ENCONTRADO OU FORMATO INCORRETO<BR>';
      echo '<a href="../">VOLTAR</a>';
      exit();
    }
  } else {
    echo 'NENHUM ARQUIVO ENCONTRADO OU FORMATO INCORRETO<BR>';
    echo '<a href="../">VOLTAR</a>';
    exit();
  }

?>
<!DOCTYPE html>
<html>
<?php
	load_head("Coordenador");
?>
<body>
  <nav class="navbar navbar-default">
      <div class="container-fluid">
        <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo HOME_URI; ?>/coordenador">Coordenador</a>
          </div>
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          </ul>
          <ul class="nav navbar-nav navbar-right">
                <li><a href="'.HOME_URI.'/_forms/logout">Sair</a></li>
              </ul>
            </div>
      </div>
    </div>
  </nav>
	<div class='container-fluid'>
		<div class='container'>
      <h1>Importar Alunos</h1>
			<table class='table'>
				<thead>
					<tr>
						<th>Nome</th>
						<th>Email</th>
            <th>Data de nascimento</th>
					</tr>
				</thead>
				<tbody>

          <?php

            for ($i=0; $i < $data->sheets[0]['numRows']-1; $i++) { 
              $nome = utf8_encode($data->val($i+2, 'A'));
              $idade = utf8_encode($data->val($i+2, 'B'));
              $nascimento = $data->val($i+2, 'C');


              echo '
                <tr>
                  <td><input type="text" class="form-control" name="name" value="'.$nome.'" required></td>
                  <td><input type="email" class="form-control" name="name" value="'.$idade.'" required></td>
                  <td><input type="date" class="form-control" name="name" value="'.$nascimento.'" required></td>
                </tr>
              ';

            }

          ?>

          
				</tbody>
			</table>
      <p>Atenção! Antes de salvar confira todos os dados!</p>
			<button type="submit" class="btn btn-success btn-md letra-guarani"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Salvar</button>
			<button type="button" class="btn btn-danger btn-md letra-guarani"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Cancelar</button>

		</div>
	</div>
</body>
</html>
