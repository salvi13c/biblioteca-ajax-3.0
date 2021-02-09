<html>
<html>
<head>
	<title>Detalle usuario</title>
	<script type = "text/javascript" src = "script.js"></script>
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <meta charset="utf-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<?php
echo "<body>";
echo "<div class='container-fluid'>";
session_start();
if(!isset($_SESSION['login'])){
    echo "no se ha iniciado sesion";
    header ("Location: login.php");
}else{
    imprimirMenu();
    imprimirDetallesUsuario();
}
//imprime el menu segun sea usuario o bibliotecario
function imprimirMenu(){
    if ($_SESSION['login']!="bibliotecario"){
        echo "<nav class='navbar navbar-inverse'>";
        echo  "<div class='container-fluid'>";
        echo  "<div class='navbar-header'>";
        echo   "<a class='navbar-brand' href='/biblioteca%20ajax%203.0/paginaPrincipal.php'>Biblioteca salvi</a>";
        echo  "</div>";
        echo  "<ul class='nav navbar-nav'>";
        echo   "<li><a href='/biblioteca%20ajax%203.0/paginaPrincipal.php'>Pagina Principal</a></li>";
        echo   "<li><a href='/biblioteca%20ajax%203.0/enviarSugerencia.php'>Enviar Sugerencia</a></li>";
        echo    "<li><a href='/biblioteca%20ajax%203.0/logout.php'>Cerrar sesion</a></li>";
        echo   "</ul>";
        echo  "</div>";
        echo "</nav>";
    }else if ($_SESSION['login']=="bibliotecario"){
        echo "<nav class='navbar navbar-inverse'>";
        echo "<div class='container-fluid'>";
        echo "<div class='navbar-header'>";
        echo   "<a class='navbar-brand' href='/biblioteca%20ajax%203.0/paginaPrincipal.php'>Biblioteca salvi</a>";
        echo"</div>";
        echo "<ul class='nav navbar-nav'>";
        echo "<li class='active'><a href='/biblioteca%20ajax%203.0/paginaPrincipal.php'>Pagina Principal</a></li>";
        echo "<li><a href='/biblioteca%20ajax%203.0/GestionLibrosReservados.php'>Gestion de libros</a></li>";
        echo "<li><a href='/biblioteca%20ajax%203.0/GestionUsuarios.php'>Gestion de usuarios</a></li>";
        echo "<li><a href='/biblioteca%20ajax%203.0/logout.php'>Cerrar sesion</a></li>";
        echo "</ul>";
        echo"</div>";
        echo"</nav>";
    }
}

//imprime los detalles del usuario a traves de post y los formularios ocultos
function imprimirDetallesUsuario(){
    echo "<h2>".$_POST['Apellidos']." ".$_POST['Nombre']."</h2>";
    echo "<br>";
    echo "<br>";
    echo "<b>Fecha nacimiento: </b>".$_POST['FechaNac'];
    echo "<br>";
    echo "<b>Direccion: </b>".$_POST['Direccion'];
    echo "<br>";
    echo "<b>Email: </b>".$_POST['Email'];
    echo "<br>";
    echo "<b>Poblacion: </b>".$_POST['Poblacion'];
    echo "<br>";
    echo "<b>Codigo Postal: </b>".$_POST['CodigoPostal'];
    echo "<br>";
    echo "<b>Usuario: </b>".$_POST['Usuario'];
    echo "<br>";
    echo "<b>Id: </b>".$_POST['Id'];
    echo "<br>";
    echo "<INPUT TYPE='button' VALUE='Atras' class='btn btn-danger' onClick=window.location.href='http://localhost/biblioteca%20ajax%203.0/GestionUsuarios.php'>";
}

?>
<br>
</div>
</body>
</html>