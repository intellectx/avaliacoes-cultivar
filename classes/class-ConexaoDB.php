<?php 

class ConexaoDB
{
	protected $servidor = HOSTNAME;
	protected $usuario  = DB_USER;
	protected $senha    = DB_PASSWORD;
	protected $banco    = DB_NAME;

	public $conexao;

	function __construct() {
		$this->conexao = new mysqli($this->servidor, $this->usuario, $this->senha, $this->banco);
	}

	public function verifica_erro_conexao() {
		if (mysqli_connect_errno()) {
			die('Não foi possível conectar-se ao banco de dados: ' . mysqli_connect_error());
			exit();
		}
	}
}