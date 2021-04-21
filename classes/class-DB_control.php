<?php 

class DB_control
{
	static function buildAlunoById($id) {
		return new Aluno("João Matheus", "Centro Educacional Roda Pião");
	}
}