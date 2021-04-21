<?php

class Coordenador extends Usuario
{
	public $nome;
	public $nome_escola;
	public $id_escola;

	function __construct($id_usuario, $email, $senha, $tipo, $codigo, $nome, $nome_escola, $id_escola) {
			parent::__construct($id_usuario, $email, $senha, $tipo, $codigo);
      $this->nome = $nome;
      $this->nome_escola = $nome_escola;
			$this->id_escola = $id_escola;
   }

	 public static function getCoordenadorById($iduser) {
		 $u = Usuario::getUsuarioById($iduser);

		 $db = new ConexaoDB();
		 $mysqli = $db->conexao;

		 $db->verifica_erro_conexao();

		 if ($sql = $mysqli->prepare("SELECT * FROM usuario_coordenador WHERE id='".$u->id_usuario."'")) {
				 $sql->execute();
				 $sql->bind_result($id, $nome, $idescola, $excluido);
				 $sql->fetch();
		 }

		 $coordenador = new Coordenador($u->id_usuario, $u->email, $u->senha, $u->tipo, $u->codigo, utf8_encode($nome), $idescola, $idescola);

		 return $coordenador;
	 }
}
