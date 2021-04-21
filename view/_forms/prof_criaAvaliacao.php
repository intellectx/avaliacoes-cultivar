<?php
Login::verificaLogin(3);

$aluno = Aluno::getAlunoById($_POST['idaluno']);
$professor = Professor::getProfessorById($_SESSION['iduser']);

if ($aluno->id_escola <> $professor->id_escola) {
    $_SESSION['verificaAvaliacao'] = false;
    exit();
}

$db = new ConexaoDB();
$mysqli = $db->conexao;

$db->verifica_erro_conexao();

if ($sql = $mysqli->prepare(
    "INSERT INTO `avaliacoes` (`idaluno`, `idprofessor`, `date`, `massa`, `altura`, `flexibilidade`, `resistenciaAbdominal`)
    VALUES ('".$aluno->id_usuario."', '".$professor->id_usuario."', '".date('Y-m-d H:i:s')."',
    '".$_POST['massa']."', '".$_POST['altura']."', '".$_POST['flexibilidade']."',
    '".$_POST['resistenciaAbdominal']."')")
  ) {
    $sql->execute();
    $_SESSION['verificaAvaliacao'] = true;
  }

  header('Location: '.HOME_URI.'/professor/aluno?a='.$aluno->id_usuario);

?>
