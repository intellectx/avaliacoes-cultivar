<?php session_start(); ?>
<!DOCTYPE html>
<html>
<?php
	load_head("Avaliações Guarani Sport");
?>
<body class='body-azul'>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#box-esqueceu-senha').hide();
			$('#esqueceu-senha').click(function() {
				$('#box-esqueceu-senha').slideToggle('fast');
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
			<?php
				if(isset($_SESSION['return_erro_login'])) {
					if($_SESSION['return_erro_login'] == true) {
							Utils::alertErro("Email ou senha não cadastrado.");
							unset($_SESSION['return_erro_login']);
					}
				}

				if(isset($_SESSION['return_sucesso_esqueceu_senha'])) {
					if($_SESSION['return_sucesso_esqueceu_senha'] == true) {
							Utils::alertSucesso("Você receberá um email para gerar uma nova senha.");
							unset($_SESSION['return_sucesso_esqueceu_senha']);
					}
				}

				if(isset($_SESSION['return_erro_esqueceu_senha'])) {
					if($_SESSION['return_erro_esqueceu_senha'] == true) {
							Utils::alertErro("Email não cadastrado.");
							unset($_SESSION['return_erro_esqueceu_senha']);
					}
				}

				if(isset($_SESSION['return_sucesso_cadastro'])) {
					if($_SESSION['return_sucesso_cadastro'] == true) {
							Utils::alertSucesso("Senha gerada com sucesso! <br>Entre com seu email e senha.");
							unset($_SESSION['return_sucesso_cadastro']);
					}
				}
			?>
			<?php View::container_title('Acesse sua conta'); ?>
			<form method='POST' action="<?php echo HOME_URI; ?>/_forms/login">
				Email: <input class='form-control' type='email' required name='email'><br>
				Senha: <input class='form-control' type='password' required name='senha'><br>
				<button type='submit' class='btn btn-info letra-guarani'><span class="glyphicon glyphicon-play hidden-xs" aria-hidden="true"></span> Entrar</button> <a href="#" id='esqueceu-senha'>Esqueceu sua senha?</a><br>
			</form>

			<div id='box-esqueceu-senha'><hr>
				<form method='POST' action="<?php echo HOME_URI; ?>/_forms/esqueceu_senha">
					Email: <input class='form-control' type='email' required placeholder='Digite seu email' name='email-rec'><br>
					<button type='submit' class='btn btn-info letra-guarani'><span class="glyphicon glyphicon-play hidden-xs" aria-hidden="true"></span> Recuperar</button>
				</form>
			</div>
		</div>
	</div>
	<?php View::rodape(); ?>
</body>
</html>
