<?php
    if(!isset($_POST['submit']))
    {
    echo "erro; É preciso submeter o formulário!!!";
    }
        $name = $_POST['name'];
        $visitor_email = $_POST['email'];
        $message = $_POST['message'];
    if(empty($name)){
        echo "Inserir o Nome!";
        exit;
    }
    if(empty($visitor_email)){
        echo "Inserir o Email!";
        exit;
    }
    if(IsInjected($visitor_email)){
        echo "Email inserido incorretamente!";
        exit;
    }
    $email_from = 'Joaoandremoura@Curriculum-Vitae.com';
    $email_subject = "Novo Formulario de Contacto";
    $email_body = "Recebeste um email do utilizador $name.\n".
        "A mensagem é esta : \n $message".
    $to = 'joaoandremoura@gmail.com';
    $headers = "From: $email_from \r\n";
    $headers .= "Reply-To: $visitor_email \r\n";
    mail($to,$email_subject,$email_body,$headers);
    header('Location: thankYou.html');
    
    function IsInjected($str){
      $injections = array('(\n+)',
                  '(\r+)', 
                  '(\t+)',
                  '(%0A+)',
                  '(%0D+)',
                  '(%08+)',
                  '(%09+)'
                  );
      $inject = join('|', $injections);
      $inject = "/$inject/i";
      if(preg_match($inject,$str))
        {
        return true;
      }
      else
        {
        return false;
      }
    }
   
?> 