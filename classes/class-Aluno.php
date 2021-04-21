<?php

class Aluno extends Usuario
{
	public $id_aluno;
	public $nome;
	public $nome_escola;
	public $data_nascimento;
	public $id_escola;
	public $sexo;
	private $idade;

	function __construct($id_usuario, $email, $senha, $tipo, $codigo, $nome, $nome_escola, $data_nascimento, $id_escola, $sexo) {
			parent::__construct($id_usuario, $email, $senha, $tipo, $codigo);
      		$this->nome = $nome;
      		$this->nome_escola = $nome_escola;
			$this->data_nascimento = $data_nascimento;
			$this->id_escola = $id_escola;
			$this->sexo = $sexo;
   }

	 public static function getAlunoById($iduser) {
		 $u = Usuario::getUsuarioById($iduser);

		 $db = new ConexaoDB();
		 $mysqli = $db->conexao;

		 $db->verifica_erro_conexao();

		 if ($sql = $mysqli->prepare("SELECT * FROM usuario_aluno WHERE id='".$u->id_usuario."'")) {
				 $sql->execute();
				 $sql->bind_result($id, $idescola, $nascimento, $nome, $excluido, $sexo);
				 $sql->fetch();
		 }

		 $aluno = new Aluno($u->id_usuario, $u->email, $u->senha, $u->tipo, $u->codigo, utf8_encode($nome), $idescola, $nascimento, $idescola, $sexo);

		 return $aluno;
	 }

	 public function getIdade() {
	    
	    // Separa em dia, mês e ano
	    list($ano, $mes, $dia) = explode('-', $this->data_nascimento);
	    
	    // Descobre que dia é hoje e retorna a unix timestamp
	    $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
	    // Descobre a unix timestamp da data de nascimento do fulano
	    $nascimento = mktime( 0, 0, 0, $mes, $dia, $ano);
	    
	    // Depois apenas fazemos o cálculo já citado :)
	    $idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25);
	 
	    return $idade;
	 }
}
