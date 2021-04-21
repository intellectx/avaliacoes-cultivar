<?php

	function __autoload($class) {
		include_once("classes/class-{$class}.php");   
	}

	function load_head($titulo) {
		require 'view/_includes/head.php';
	}

	if(empty($_GET['path'])) {
		$nome_include_file = 'view/home.php';
	} else {
		if(file_exists('view/'.$_GET['path'].'.php') AND $_GET['path']<>'index' AND $_GET['path']<>'pag_index') {
			$nome_include_file = 'view/'.$_GET['path'].'.php';
		} else {
			if(file_exists('view/'.$_GET['path'].'/home.php')) {
				$nome_include_file = 'view/'.$_GET['path'].'/home.php';
			} else {
				$nome_include_file = 'view/404.php';
			}
		}
	}

	include $nome_include_file;
	