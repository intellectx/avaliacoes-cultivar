<?php
Login::verificaLogin(1);


$db = new ConexaoDB();
$mysqli = $db->conexao;
$db->verifica_erro_conexao();

$codigoDeSenha = Utils::geraCodigo();

if ($sql = $mysqli->prepare("INSERT INTO `usuario` (`senha`, `email`, `codigo`, `tipo`)
  VALUES ('', '".$_POST['email']."', '".$codigoDeSenha."', '2');"
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

if ($sql3 = $mysqli->prepare("INSERT INTO `usuario_coordenador` (`id`, `nome`, `escola`)
  VALUES ('".$id_usuario."', '".utf8_decode($_POST['nome'])."', '".$_POST['escola']."');"
)) {
    $sql3->execute();
}
$sql3->close();

EnvioEmail::emailNovoUsuario($email, '2', $codigo, $_POST['nome']);

$_SESSION['retornoCrud'] = 1;
header('Location: '.HOME_URI.'/administrador/coordenadores');
