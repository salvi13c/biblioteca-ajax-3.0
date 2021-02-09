<html>
<html>
<head>
	<title>Detalle libro</title>
	<script type = "text/javascript" src = "script.js"></script>
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <meta charset="utf-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<?php
session_start();
if(!isset($_SESSION['login'])){
    echo "no se ha iniciado sesion";
    header ("Location: login.php");
}else{
    DetalleLibro();
}

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


function DetalleLibro(){
    $nombreUsuario=$_POST['userId'];
    if ($nombreUsuario!="bibliotecario"){
        echo "<body onload='estadoReserva()'>";
        echo "<div class='container-fluid'>";
        imprimirMenu();
    }else{
        echo "<body>";
        echo "<div class='container-fluid'>";
        imprimirMenu();
    }
    imprimirDetallesLibro();
    ImprimirBotonAtras();
}


function imprimirDetallesLibro(){
    echo "<h2>".$_POST['Titulo']."</h2>";
    echo "<br>";
    echo "<b>Autor: </b>".$_POST['Autor'];
    echo "<br>";
    echo "<b>Editorial: </b>".$_POST['Editorial'];
    echo "<br>";
    echo "<b>Sinopsis: </b>".$_POST['Sinopsis'];
    echo "<br>";
    echo "<b>Disponible: </b>".$_POST['Disponible'];
    echo "<br>";
    echo "<b>Reservado: </b>".$_POST['Reservado'];
    echo "<br>";
    echo "<b>Id: </b>".$_POST['Id'];
    echo "<br>";
    echo '<img src="data:image/jpeg;base64,' .$_POST['ImagenPortada'].'" width="150" height="150"/>';
    echo "<br>";
    echo "<p id='estadoLibro'></p>";
    $id=$_POST['Id'];
    $nombreUsuario=$_POST['userId'];
    
    
    //echo $id;
    //echo $nombreUsuario;
    
    //en caso de ser un usauario normal imprime el cuadro de estado de reserva y el boton de reservar
    if ($nombreUsuario!="bibliotecario"){
        echo "<input type='hidden' name='idLibro' id='idLibro'  value='$id'>";
        echo "<input type='hidden' name='user' id='user'  value='$nombreUsuario'>";
        echo "<p onload='estadoReserva()'></p>";
        echo "<td><button TYPE='button' onClick='reservar()' class='btn btn-primary'>Realizar Reserva</button></td>";
    }
}
//imprme un boton de atras o otro segun que tipo de usuario sea
function ImprimirBotonAtras(){
    $userId=$_POST['userId'];
    if ($userId=="bibliotecario"){
        echo "<INPUT TYPE='button' VALUE='Atras' class='btn btn-danger' onClick=window.location.href='http://localhost/biblioteca%20ajax%203.0/paginaPrincipalBibliotecario.php'>";
    }else{
        echo "<INPUT TYPE='button' VALUE='Atras' class='btn btn-danger' onClick=window.location.href='http://localhost/biblioteca%20ajax%203.0/paginaPrincipal.php'>";
    }
}

?>
</div>
<br>
</body>
</html>