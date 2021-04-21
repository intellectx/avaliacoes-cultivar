<?php
Login::verificaLogin(2);

$db = new ConexaoDB();
$mysqli = $db->conexao;
$db->verifica_erro_conexao();

$codigoDeSenha = Utils::geraCodigo();

if ($sql = $mysqli->prepare("INSERT INTO `usuario` (`senha`, `email`, `codigo`, `tipo`)
  VALUES ('', '".$_POST['email']."', '".$codigoDeSenha."', '4');"
)) {
    $sql->execute();
}
$sql->close();

if ($sql2 = $mysqli->prepare("SELECT * FROM usuario ORDER BY iduser DESC")) {
    $sql2->execute();
    $sql2->bind_result($id_usuario, $email, $senha, $tipo, $codigo);
    $sql2->fetch();
}
$sql2->close();

if ($sql3 = $mysqli->prepare("INSERT INTO `usuario_aluno` (`id`, `idescola`, `nome`, `nascimento`, `sexo`)
  VALUES ('".$id_usuario."', '".$_POST['escola']."', '".utf8_decode($_POST['nome'])."', '".$_POST['nascimento']."', '".$_POST['sexo']."');"
)) {
    $sql3->execute();
}
//$sql3->close();


EnvioEmail::emailNovoUsuario($email, '4', $codigo, $_POST['nome']);

$_SESSION['retornoCrud'] = 1;
header('Location: '.HOME_URI.'/coordenador/alunos');
