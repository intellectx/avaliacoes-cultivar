<?php
	if(empty($_GET['k'])) {
		header('Location: '.HOME_URI.'/404');
	}

	$db = new ConexaoDB();
	$mysqli = $db->conexao;
	$db->verifica_erro_conexao();

	if ($sql = $mysqli->prepare("SELECT * FROM usuario WHERE codigo='".$_GET['k']."'")) {
			$sql->execute();
			$sql->bind_result($id_usuario, $email, $senha, $tipo, $codigo);
			$sql->fetch();
	}
	$sql->close();

	if ($_GET['k'] <> $codigo) {
		header('Location: '.HOME_URI.'/404');
	}
?>
<!DOCTYPE html>
<html>
<?php
	load_head("Gerar Senha");
?>
<body class='body-azul'>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#submit-gerar-senha').click(function() {

				if($('#senha').val() == $('#re-senha').val()) {
					if($('#senha').val().length>5) {
						$("button").attr("type","submit");
					} else {
						alert('A senha precisa ter no mínimo 6 caracteres!');
					}
				} else {
					alert('Senhas diferentes!');
					$("button").attr("type","button");
				}

			});
		});
	</script>
	<div class='container-fluid' style='background:#252320;'>
		<div class='container' style='text-align:center;'>
			<h1 style='color:#fade22; margin:10px;' class='letra-guarani'>AVALIAÇÕES</h1>
		</div>
	</div>
	<br>
	<div class='container-fluid'>
		<div class='container container-login'>
			<?php View::container_title('GERAR SENHA DE ACESSO'); ?>
			<form method='POST' action="<?php echo HOME_URI; ?>/_forms/gerar_senha">
				<input type="hidden" name="k" value="<?php echo $_GET['k']; ?>">
				Senha: <input minlength='6' id='senha' class='form-control' type='password' required name='senha'><br>
				Redigite a senha: <input minlength='6' id='re-senha' class='form-control' type='password' required name='re-senha'><br>
				<button id='submit-gerar-senha' type='button' class='btn btn-info letra-guarani'><span class="glyphicon glyphicon-play hidden-xs" aria-hidden="true"></span> Gerar</button><br>
			</form>
		</div>
	</div>
	<?php View::rodape(); ?>
</body>
</html>
