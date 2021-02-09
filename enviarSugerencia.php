<html>
<html>
<head>
	<title>Enviar sugerencia al bibliotecario</title>
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <meta charset="utf-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container-fluid">
<?php

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


// Esto si lo has instalado con composer
require 'vendor/autoload.php';
imprimirMenu();
session_start();
if(!isset($_SESSION['login'])){
    echo "no se ha iniciado sesion";
    //header ("Location: login.php");
}else{
    imprimirCamposSugerencia();
}


//imprime el menu principal
function imprimirMenu(){
    echo "<nav class='navbar navbar-inverse'>";
    echo  "<div class='container-fluid'>";
    echo  "<div class='navbar-header'>";
    echo   "<a class='navbar-brand' href='/biblioteca%20ajax%203.0/paginaPrincipal.php'>Biblioteca salvi</a>";
    echo  "</div>";
    echo  "<ul class='nav navbar-nav'>";
    echo   "<li><a href='/biblioteca%20ajax%203.0/paginaPrincipal.php'>Pagina Principal</a></li>";
    echo   "<li class='active'><a href='/biblioteca%20ajax%203.0/enviarSugerencia.php'>Enviar Sugerencia</a></li>";
    echo    "<li><a href='/biblioteca%20ajax%203.0/logout.php'>Cerrar sesion</a></li>";
    echo   "</ul>";
    echo  "</div>";
    echo "</nav>";
}
//imprime el formulario de la sugerencia
function imprimirCamposSugerencia(){
echo "<h1>Sugerencia</h1>";
echo "<form action='enviarSugerencia.php' method='post'>";
  echo "<div class='form-group col-md-6'>";
echo "<label for='motivo'><b>Motivo:</b></label>";
  echo "<input type='text' name='motivo' id='motivo' class='form-control' required>";
  echo "</div>";
  echo "<div class='form-group col-md-6'>";
  echo "<label for='sugerencia'><b>Escriba su sugerencia:</b></label>";
  echo "<input type='text' name='sugerencia' id='sugerencia' class='form-control' required>";
  echo "</div>";
    echo "<br>";
    echo "<button type='submit' name='submit' id='submit' class='btn btn-primary' >Enviar</button>";
echo "</form>";
}


// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);
if(isset($_POST["submit"])){
try {
    //Server settings
    $mail->SMTPDebug = 0;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->SMTPSecure = 'tls';
    $mail->SMTPOptions = array(                                 //añadido porqué daba error al conectarse al host
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'pruebabiblioteca478@gmail.com';                     // SMTP username
    $mail->Password   = 'pruebabiblioteca';                               // SMTP password
    //$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
    
    //Recipients
    $mail->setFrom('pruebabiblioteca478@gmail.com', 'Biblioteca');
    $mail->addAddress('pruebabiblioteca478@gmail.com', 'Biblioteca');     // Add a recipient
   // $mail->addAddress('ellen@example.com');               // Name is optional
    //$mail->addReplyTo('info@example.com', 'Information');
   // $mail->addCC('cc@example.com');
   // $mail->addBCC('bcc@example.com');
    
    // Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
    
    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Sugerencia enviada';
    $mail->Body    = 'Motivo: '.$_POST['motivo'].' <br> Sugerencia: '.$_POST['sugerencia'];
    $mail->AltBody = 
    
    $mail->send();
    echo 'Message has been sent';
    echo "<br>";
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
}
?>
<INPUT TYPE="button" VALUE="Volver Atras" class="btn btn-danger" onClick="window.location.href='/biblioteca%20ajax%203.0/paginaPrincipal.php'">
</div>
</body>
</html>

