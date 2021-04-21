<?php
	Login::verificaLogin(4);

	$aluno = Aluno::getAlunoById($_SESSION['iduser']);

	$db = new ConexaoDB();
	$mysqli = $db->conexao;

	$sql = "SELECT * FROM `avaliacoes` WHERE idaluno = '".$aluno->id_usuario."' ORDER BY id DESC LIMIT 10";

	if(!$result = $mysqli->query($sql)){
		die('Erro no banco de dados:( [' . $mysqli->error . ']');
	}

	$ultimaMedicao = "Aluno não avaliado";

	$stringMassas = "";
	$stringAlturas = "";
	$stringFlexibilidades = "";
	$stringResistenciaAbdominal = "";
	$stringIMC = "";
	$stringLabels = "";
	$primeiro = false;
	$massaFinal = '';
	$alturaFinal = '';
	$flexibilidadeFinal = '';
	$resistenciaAbdominalFinal = '';
	$primeiro = false;
	while($row = $result->fetch_assoc()) {
		if($primeiro == false) {
			$ultimaMedicao = $row['date'];
			$massaFinal = $row['massa'];
			$alturaFinal = $row['altura'];
			$flexibilidadeFinal = $row['flexibilidade'];
			$resistenciaAbdominalFinal = $row['resistenciaAbdominal'];
			$primeiro = true;
		}

		$stringMassas = $row['massa'].', '.$stringMassas;
		$stringAlturas = $row['altura'].', '.$stringAlturas;
		$stringFlexibilidades = $row['flexibilidade'].', '.$stringFlexibilidades;
		$stringResistenciaAbdominal = $row['resistenciaAbdominal'].', '.$stringResistenciaAbdominal;
		$stringIMC = Utils::calcIMCponto($row['massa'], $row['altura']).', '.$stringIMC;
		$stringLabels = '"'.Utils::dateMysqlToPHPMesAno($row['date']).'"'.', '.$stringLabels;
	}
	$stringMassas = substr($stringMassas, 0, -2);
	$stringAlturas = substr($stringAlturas, 0, -2);
	$stringFlexibilidades = substr($stringFlexibilidades, 0, -2);
	$stringResistenciaAbdominal = substr($stringResistenciaAbdominal, 0, -2);	
	$stringIMC = substr($stringIMC, 0, -2);
	$stringLabels = substr($stringLabels, 0, -2);


	//STATUS IMC CALCULO
	function calcStatus($baixopeso, $sobrepeso, $obesidade, $imc) {
		if($imc < $baixopeso) {
			return 'Baixo Peso';
		}
		if($imc < $sobrepeso) {
			return 'Normal';
		}
		if($imc < $obesidade) {
			return 'Sobrepeso';
		}
		if($imc >= $obesidade) {
			return 'Obesidade';
		}
		return 'Indefinido';
	}
	function getStatusImc($idade, $imc, $sexo) {
		switch ($sexo) {
			case 'm':
				switch ($idade) {
					case 6:
						return calcStatus(13, 17.7, 21.1, $imc);
						break;
					case 7:
						return calcStatus(12.9, 17.8, 21.8, $imc);
						break;
					case 8:
						return calcStatus(12.9, 18.1, 22.6, $imc);
						break;
					case 9:
						return calcStatus(12.9, 18.5, 23.6, $imc);
						break;
					case 10:
						return calcStatus(12.9, 19, 24.6, $imc);
						break;
					case 11:
						return calcStatus(13.3, 19.6, 25.5, $imc);
						break;
					case 12:
						return calcStatus(13.6, 20.3, 26.3, $imc);
						break;
					case 13:
						return calcStatus(14, 20.9, 26.9, $imc);
						break;
					case 14:
						return calcStatus(14.4, 21.6, 27.5, $imc);
						break;
					case 15:
						return calcStatus(15, 22.3, 27.9, $imc);
						break;
					case 16:
						return calcStatus(15.5, 22.9, 28.3, $imc);
						break;
					case 17:
						return calcStatus(16.1, 23.5, 28.7, $imc);
						break;
				}
				break;
			case 'f':
				switch ($idade) {
					case 6:
						return calcStatus(13.2, 17, 19.3, $imc);
						break;
					case 7:
						return calcStatus(13.1, 17.2, 19.8, $imc);
						break;
					case 8:
						return calcStatus(13.0, 17.4, 20.4, $imc);
						break;
					case 9:
						return calcStatus(13.1, 17.9, 21.2, $imc);
						break;
					case 10:
						return calcStatus(13.4, 18.6, 22.3, $imc);
						break;
					case 11:
						return calcStatus(13.8, 19.5, 23.5, $imc);
						break;
					case 12:
						return calcStatus(14.3, 20.5, 24.8, $imc);
						break;
					case 13:
						return calcStatus(15, 21.6, 26.2, $imc);
						break;
					case 14:
						return calcStatus(15.7, 22.7, 27.5, $imc);
						break;
					case 15:
						return calcStatus(16.3, 23.7, 28.5, $imc);
						break;
					case 16:
						return calcStatus(16.8, 24.4, 29.2, $imc);
						break;
					case 17:
						return calcStatus(17.2, 24.8, 29.5, $imc);
						break;
				}
				break;
		}
		return 'Indefinido';
	}


?>
<!DOCTYPE html>
<html>
<?php
	load_head("Aluno");
?>
<body class='body-azul'>
	<script type="text/javascript">
		$('document').ready(function() {
			$('#grafico_imc').fadeOut(1);
			$('#grafico_massa').fadeOut(1);
			$('#grafico_envergadura').fadeOut(1);
			$('#grafico_altura').fadeOut(1);

			$('#grafico_resistenciaAbdominal').fadeOut(1);
			$('#grafico_flexibilidade').fadeOut(1);
			$('#legenda_resistenciaAbdominal').fadeOut(1);
			$('#legenda_flexibilidade').fadeOut(1);

			//$('.toggle-span1').toggleClass("glyphicon-triangle-top");

			$('#toggle_imc').click(function() {
				$('#grafico_imc').slideToggle();
				$('.toggle-span1').toggleClass("glyphicon-triangle-top");
			});
			$('#toggle_massa').click(function() {
				$('#grafico_massa').slideToggle();
				$('.toggle-span2').toggleClass("glyphicon-triangle-top");
			});
			$('#toggle_flexibilidade').click(function() {
				$('#grafico_flexibilidade').slideToggle();
				$('#legenda_flexibilidade').slideToggle();
				$('.toggle-span4').toggleClass("glyphicon-triangle-top");
			});
			$('#toggle_resistenciaAbdominal').click(function() {
				$('#grafico_resistenciaAbdominal').slideToggle();
				$('#legenda_resistenciaAbdominal').slideToggle();
				$('.toggle-span4').toggleClass("glyphicon-triangle-top");
			});
			$('#toggle_altura').click(function() {
				$('#grafico_altura').slideToggle();
				$('.toggle-span3').toggleClass("glyphicon-triangle-top");
			});


		});
	</script>
	<?php View::menu_aluno($aluno->nome) ?>
	<div class='container-fluid'>
		<div class='container container-aluno' style='max-width:550px;'>
			<?php
			if (isset($_SESSION['verificaAvaliacao'])) {
				if($_SESSION['verificaAvaliacao'] == true) {
					Utils::alertSucesso("Aluno avaliado!");
				} else {
					Utils::alertErro("Ocorreu um erro na avaliação!");
				}
				unset($_SESSION['verificaAvaliacao']);
			}
			View::container_title('Medidas de Crescimento Corporal'); ?>
			<div id='menu-pag-avaliacao'>
				<!-- <h4>Medidas de crescimento corporal</h4> -->
				<table style='width:100%;'>
					<tr>
						<td><h3 align="center">Classificação do IMC</h3></td>
					</tr>
					<tr>
						<td style='text-align:center'>
							<?php 
								$statusAluno = getStatusImc($aluno->getIdade(), Utils::calcIMC($massaFinal, $alturaFinal), $aluno->sexo);

								$corStatus = 'black';
								switch ($statusAluno) {
									case 'Baixo Peso':
									case 'Sobrepeso':
									case 'Obesidade':
										$corStatus = '#ff4444';
										break;
									case 'Normal':
										$corStatus = 'green';
										break;
									default:
										$corStatus = 'black';
										break;
								}
							?>
							<h3 class='letra-guarani' style='color:<?php echo $corStatus; ?>;'><?php echo $statusAluno; ?></h3>
						</td>
					</tr>
					<tr>
						<td><a href="<?php echo HOME_URI.'/view/_img/valores-criticos-imc.png'; ?>" target="_blank">Quadro de Valores Críticos do IMC</a></td>
					</tr>
				</table>
				<br><br>
				<div class='toggle-graficos' id='toggle_imc'><span style='background:#a13bb7; color:#a13bb7; border-radius:3px;'>---</span> IMC <span style='color:#a13bb7;'> <?php echo Utils::calcIMC($massaFinal, $alturaFinal); ?></span>
					<button class='toggle-button btn btn-default btn-sm'><span class="toggle-span1 glyphicon glyphicon-triangle-bottom" aria-hidden="true"></span></button></div>
				<canvas id="grafico_imc"></canvas>
				<hr>
				<div class='toggle-graficos' id='toggle_massa'><span style='background:#009933; color:#009933; border-radius:3px;'>---</span> Massa corporal <span style='color:#009933;'> <?php echo $massaFinal; ?> kg</span>
					<button class='toggle-button btn btn-default btn-sm'><span class="toggle-span2 glyphicon glyphicon-triangle-bottom" aria-hidden="true"></span></button></div>
				<canvas id="grafico_massa"></canvas>
				<hr>
				<div class='toggle-graficos' id='toggle_altura'><span style='background:#ff6666; color:#ff6666; border-radius:3px;'>---</span> Altura <span style='color:#ff6666;'> <?php echo $alturaFinal; ?> cm</span>
					<button class='toggle-button btn btn-default btn-sm'><span class="toggle-span3 glyphicon glyphicon-triangle-bottom" aria-hidden="true"></span></button></div>
				<canvas id="grafico_altura"></canvas>
				<hr>
				<div class='toggle-graficos' id='toggle_flexibilidade'><span style='background:#ff9933; color:#ff9933; border-radius:3px;'>---</span> Flexibilidade <span style='color:#ff9933;'> <?php echo Utils::getStringMedida($flexibilidadeFinal);?></span>
					<button class='toggle-button btn btn-default btn-sm'><span class="toggle-span4 glyphicon glyphicon-triangle-bottom" aria-hidden="true"></span></button></div>
				<canvas id="grafico_flexibilidade"></canvas>
				<ul id="legenda_flexibilidade">
					<li><b>Legenda:</b></li>
					<li>3 - Ótimo</li>
					<li>2 - Bom</li>
					<li>1 - Regular</li>
					<li>0 - Não avaliado</li>
				</ul>
				<hr>
				<div class='toggle-graficos' id='toggle_resistenciaAbdominal'><span style='background:#1EC4D6; color:#1EC4D6; border-radius:3px;'>---</span> Resistência Abdominal <span style='color:#1EC4D6;'> <?php echo Utils::getStringMedida($resistenciaAbdominalFinal); ?></span>
					<button class='toggle-button btn btn-default btn-sm'><span class="toggle-span4 glyphicon glyphicon-triangle-bottom" aria-hidden="true"></span></button></div>
				<canvas id="grafico_resistenciaAbdominal"></canvas>
				<ul id="legenda_resistenciaAbdominal">
					<li><b>Legenda:</b></li>
					<li>3 - Ótimo</li>
					<li>2 - Bom</li>
					<li>1 - Regular</li>
					<li>0 - Não avaliado</li>
				</ul>
				<hr>
				<span style='margin-left:10px;'>Última medição: <?php echo Utils::dateMysqlToPHP($ultimaMedicao); ?></span>
			</div>
		</div>
	</div>
	<?php View::rodape(); ?>
	<script>
		$(function() {
		    'use strict';

		    var line_chart_options = {
		        scaleGridLineColor : "rgba(0,0,0,.05)",
		        responsive: true
		    };

		    var grafico_imc = {
				labels : [<?php echo $stringLabels; ?>],
				datasets : [
					{
						label: "Gráfico IMC",
						fillColor : "rgba(220,220,220,0)",
						strokeColor : "#a13bb7",
						pointColor : "#a13bb7",
						pointStrokeColor : "#a13bb7",
						data : [<?php echo $stringIMC; ?>]
					}
				]
			}
			var grafico_massa = {
				labels : [<?php echo $stringLabels; ?>],
				datasets : [
					{
						label: "Gráfico IMC",
						fillColor : "rgba(220,220,220,0)",
						strokeColor : "#009933",
						pointColor : "#009933",
						pointStrokeColor : "#009933",
						data : [<?php echo $stringMassas; ?>]
					}
				]
			}
			var grafico_altura = {
				labels : [<?php echo $stringLabels; ?>],
				datasets : [
					{
						label: "Gráfico IMC",
						fillColor : "rgba(220,220,220,0)",
						strokeColor : "#ff6666",
						pointColor : "#ff6666",
						pointStrokeColor : "#ff6666",
						data : [<?php echo $stringAlturas; ?>]
					}
				]
			}
			var grafico_flexibilidade = {
				labels : [<?php echo $stringLabels; ?>],
				datasets : [
					{
						label: "Gráfico IMC",
						fillColor : "rgba(220,220,220,0)",
						strokeColor : "#ff9933",
						pointColor : "#ff9933",
						pointStrokeColor : "#ff9933",
						data : [<?php echo $stringFlexibilidades; ?>]
					}
				]
			}
			var grafico_resistenciaAbdominal = {
				labels : [<?php echo $stringLabels; ?>],
				datasets : [
					{
						label: "Gráfico IMC",
						fillColor : "rgba(220,220,220,0)",
						strokeColor : "#1EC4D6",
						pointColor : "#1EC4D6",
						pointStrokeColor : "#1EC4D6",
						data : [<?php echo $stringResistenciaAbdominal; ?>]
					}
				]
			}


	    var ctx_imc = $("#grafico_imc").get(0).getContext("2d");
	    var m_grafico_imc = new Chart(ctx_imc).Line(grafico_imc, line_chart_options);

			var ctx_massa = $("#grafico_massa").get(0).getContext("2d");
			var m_grafico_massa = new Chart(ctx_massa).Line(grafico_massa, line_chart_options);

			var ctx_altura =  $("#grafico_altura").get(0).getContext("2d");
			var m_grafico_altura = new Chart(ctx_altura).Line(grafico_altura, line_chart_options);

			var ctx_flexibilidade = $("#grafico_flexibilidade").get(0).getContext("2d");
			var m_grafico_flexibilidade = new Chart(ctx_flexibilidade).Line(grafico_flexibilidade, line_chart_options);

			var ctx_resistenciaAbdominal = $("#grafico_resistenciaAbdominal").get(0).getContext("2d");
			var m_grafico_resistenciaAbdominal = new Chart(ctx_resistenciaAbdominal).Line(grafico_resistenciaAbdominal, line_chart_options);
	    
	    });


	</script>
	<script src="<?php echo HOME_URI; ?>/view/_js/Chart.min.js"></script>
</body>
</html>













