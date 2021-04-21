<?php 
/**

class EnvioEmail
{
  public static function configEmail() {
    $mail = new PHPMailer();
    $mail->setLanguage('pt');

    $from = 'naoresponda@avaliacoescultivar.com.br';
    $fromName = 'Avaliações Guarani Sport';

    $mail->isSMTP();
    $mail->Host = 'email-ssl.com.br';
    $mail->SMTPAuth = true;
    $mail->Username = 'naoresponda@avaliacoescultivar.com.br';
    $mail->Password = 'Guarani4312!@#';
    $mail->Port = 465;
    $mail->SMTPSecure = false;    

    $mail->From = $from;
    $mail->FromName = $fromName;

    return $mail;

  }


  public static function emailNovoUsuario($email, $tipo, $codigo, $nome) {
    $mail = EnvioEmail::configEmail();

    $nomeTipo = "";

    switch ($tipo) {
      case '1':
        $nomeTipo = "Administrador";
      break;
      case '2':
        $nomeTipo = "Coordenador";
        break;
      case '3':
        $nomeTipo = "Professor";
        break;
      case '4':
        $nomeTipo = "Aluno";
        break;
      default:
        $nomeTipo = "Sem tipo";
        break;
    }

    $emailUsuario = $email;

    $mail->addAddress($emailUsuario, '');

    $mail->isHTML(true);
    $mail->CharSet = 'utf-8';
    $mail->WordWrap = 70;

    $mail->Subject = '[Guarani Avaliações] Sua conta foi criada!';
    $mail->Body = 'Olá '.$nome.', sua conta no Sistema de Avaliações Guarani Sport foi criada 
    <br><br> <a href="'.HOME_URI.'/gerar-senha?k='.$codigo.'">Clique aqui para gerar sua senha</a>';
    $mail->AltBody = '';

    $send = $mail->Send();

  }

  public static function emailEsqueceuSenha($email, $codigo) {
    $mail = EnvioEmail::configEmail();

    $emailUsuario = $email;

    $mail->addAddress($emailUsuario, '');

    $mail->isHTML(true);
    $mail->CharSet = 'utf-8';
    $mail->WordWrap = 70;

    $mail->Subject = '[Guarani Avaliações] Recuperação de senha!';
    $mail->Body = 'Olá, a recuperação de senha foi acionada. 
    <br><br> <a href="'.HOME_URI.'/gerar-senha?k='.$codigo.'">Clique aqui para gerar uma nova senha</a>';
    $mail->AltBody = '';

    $send = $mail->Send();

  }
  
}
 
*/
  
class EnvioEmail {
  
  public static function emailNovoUsuario($email, $tipo, $codigo, $nome) {
    
    $nomeTipo = "";
    switch ($tipo) {
      case '1':
        $nomeTipo = "Administrador";
      break;
      case '2':
        $nomeTipo = "Coordenador";
        break;
      case '3':
        $nomeTipo = "Professor";
        break;
      case '4':
        $nomeTipo = "Aluno";
        break;
      default:
        $nomeTipo = "Sem tipo";
        break;
    }

    $quebra_linha = "\n"; //Se for Linux
        
    // Passando os dados obtidos pelo formulário para as variáveis abaixo
    $emailsender       = "adminavaliacoescultivar@avaliacoescultivar.com.br";
    $nomeremetente     = "Guarani Sport";
    $emailremetente    = trim("adminavaliacoescultivar@avaliacoescultivar.com.br");
    $emaildestinatario = trim($email);
    $assunto           = "[Guarani Avaliações] Sua conta foi criada!";
    $mensagem          = 'Olá '.$nome.', sua conta no Sistema de Avaliações Guarani Sport foi criada 
    <br><br> <a href="'.HOME_URI.'/gerar-senha?k='.$codigo.'">Clique aqui para gerar sua senha</a>';
    $mail->AltBody = '';
    
    
    /* Montando a mensagem a ser enviada no corpo do e-mail. */
    $mensagemHTML = 'Olá '.$nome.', sua conta no Sistema de Avaliações Guarani Sport foi criada 
    <br><br> <a href="'.HOME_URI.'/gerar-senha?k='.$codigo.'">Clique aqui para gerar sua senha</a>';
    $mail->AltBody = '';
    
    
    
    /* Montando o cabeçalho da mensagem */
    $headers = "MIME-Version: 1.1".$quebra_linha;
    $headers .= "Content-type: text/html; charset=iso-8859-1".$quebra_linha;
    // Perceba que a linha acima contém "text/html", sem essa linha, a mensagem não chegará formatada.
    $headers .= "From: ".$emailsender.$quebra_linha;
    $headers .= "Return-Path: " . $emailsender . $quebra_linha;
    // Esses dois "if's" abaixo são porque o Postfix obriga que se um cabeçalho for especificado, deverá haver um valor.
    // Se não houver um valor, o item não deverá ser especificado.
    $headers .= "Reply-To: ".$emailremetente.$quebra_linha;
    // Note que o e-mail do remetente será usado no campo Reply-To (Responder Para)
    
    /* Enviando a mensagem */
    mail($emaildestinatario, $assunto, $mensagemHTML, $headers, "-r". $emailsender);
  
  }
  
    public static function emailEsqueceuSenha($email, $codigo) {
     
      $quebra_linha = "\n"; //Se for Linux

      $emailsender       = "adminavaliacoescultivar@avaliacoescultivar.com.br";
      $nomeremetente     = "Guarani Sport";
      $emailremetente    = trim("adminavaliacoescultivar@avaliacoescultivar.com.br");
      $emaildestinatario = trim($email);
      $assunto           = '[Guarani Avaliações] Recuperação de senha!';
      $mensagemHTML          = 'Olá, a recuperação de senha foi acionada. 
      <br><br> <a href="'.HOME_URI.'/gerar-senha?k='.$codigo.'">Clique aqui para gerar uma nova senha</a>';
     
      /* Montando o cabeçalho da mensagem */
      $headers = "MIME-Version: 1.1".$quebra_linha;
      $headers .= "Content-type: text/html; charset=iso-8859-1".$quebra_linha;
      // Perceba que a linha acima contém "text/html", sem essa linha, a mensagem não chegará formatada.
      $headers .= "From: ".$emailsender.$quebra_linha;
      $headers .= "Return-Path: " . $emailsender . $quebra_linha;
      // Esses dois "if's" abaixo são porque o Postfix obriga que se um cabeçalho for especificado, deverá haver um valor.
      // Se não houver um valor, o item não deverá ser especificado.
      $headers .= "Reply-To: ".$emailremetente.$quebra_linha;
      // Note que o e-mail do remetente será usado no campo Reply-To (Responder Para)
      
      /* Enviando a mensagem */
      mail($emaildestinatario, $assunto, $mensagemHTML, $headers, "-r". $emailsender);
   

  }
  
}