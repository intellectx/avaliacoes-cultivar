<?php

class View
{
	public static function index_menu($index, $resposta) {
		if($index == $resposta) {
			return ' class="active" ';
		}
	}

	public static function menu_adm($index) {
		if(empty($index)) {
			$index = '';
		}

		echo '
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
					    	<a class="navbar-brand" href="'.HOME_URI.'/administrador">Administrador</a>
					    </div>
	  					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	     					<ul class="nav navbar-nav">
								<li '.View::index_menu($index, 'escolas').'><a href="'.HOME_URI.'/administrador/escolas">Escolas</a></li>
								<li '.View::index_menu($index, 'coordenadores').'><a href="'.HOME_URI.'/administrador/coordenadores">Coordenadores</a></li>
							</ul>
							<ul class="nav navbar-nav navbar-right">
		        				<li><a href="'.HOME_URI.'/_forms/logout">Sair</a></li>
		        			</ul>
	        			</div>
					</div>
				</div>
			</nav>
		';
	}

	public static function menu_coordenador($index) {
		if(empty($index)) {
			$index = '';
		}

		echo '
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
					    	<a class="navbar-brand" href="'.HOME_URI.'/coordenador">Coordenador</a>
					    </div>
	  					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	     					<ul class="nav navbar-nav">
								<li '.View::index_menu($index, 'professores').'><a href="'.HOME_URI.'/coordenador/professores">Professores</a></li>
								<li '.View::index_menu($index, 'alunos').'><a href="'.HOME_URI.'/coordenador/alunos">Alunos</a></li>
							</ul>
							<ul class="nav navbar-nav navbar-right">
		        				<li><a href="'.HOME_URI.'/_forms/logout">Sair</a></li>
		        			</ul>
	        			</div>
					</div>
				</div>
			</nav>
		';
	}


	public static function menu_professor($nome = "") {
		echo '
			<nav class="navbar navbar-preta letra-guarani">
				<div class="container-fluid">
					<div class="container">
						<div class="navbar-header">
					   		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" style="background:white;">
						    	<span class="sr-only">Toggle navigation</span>
						    	<span class="icon-bar" style="background:black"></span>
						    	<span class="icon-bar" style="background:black"></span>
						    	<span class="icon-bar" style="background:black"></span>
					    	</button>
					    	<a class="navbar-brand navbar-preta-link" id="brand_dourado" href="'.HOME_URI.'/professor"><span class="hidden-xs">Professor(a)</span> '.$nome.'</a>
					    </div>
						<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
							<ul class="nav navbar-nav navbar-right">
		    					<li><a href="'.HOME_URI.'/_forms/logout">Sair</a></li>
		    				</ul>
						</div>
					</div>
				</div>
			</nav>
		';
	}

	public static function menu_aluno($nome = "") {
		echo '
			<nav class="navbar navbar-preta letra-guarani">
				<div class="container-fluid">
					<div class="container">
						<div class="navbar-header">
					   		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" style="background:white;">
						    	<span class="sr-only">Toggle navigation</span>
						    	<span class="icon-bar" style="background:black"></span>
						    	<span class="icon-bar" style="background:black"></span>
						    	<span class="icon-bar" style="background:black"></span>
					    	</button>
					    	<a class="navbar-brand navbar-preta-link" id="brand_dourado" href="'.HOME_URI.'/aluno"><span class="hidden-xs">Aluno(a)</span> '.$nome.'</a>
					    </div>
						<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
							<ul class="nav navbar-nav navbar-right">
		    					<li><a href="'.HOME_URI.'/_forms/logout">Sair</a></li>
		    				</ul>
						</div>
					</div>
				</div>
			</nav>
		';
	}

	public static function rodape() {
		echo '
			<div class="container-fluid">
				<div class="container" style="text-align:center; margin-top:25px;"">
					<a href="http://guaranisport.com.br/" target="_blank"><img src="'.HOME_URI.'/view/_img/logo-rodape.png"></a>
				</div>
			</div>
		';
	}

	public static function container_title($title) {
		echo '<h3 style="margin-top:0px;" class="letra-guarani">'.$title.'</h3><hr>';
	}

	public static function input_value_getBusca($getBusca) {
		echo " value='".$getBusca."'";
	}
}
