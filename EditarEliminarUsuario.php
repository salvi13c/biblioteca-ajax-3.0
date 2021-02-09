<!DOCTYPE html>
<html>
<head>
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <meta charset="utf-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<title>Biblioteca</title>
</head>
<body>
<div class="container-fluid">


<!--CREATE TABLE Usuarios
(
  Apellidos VARCHAR(20) ,
  Nombre VARCHAR(20) ,
  Fecha_nacimiento DATE ,
  Direccion VARCHAR(20) ,
  Email VARCHAR(20) ,
  Poblacion VARCHAR(20) ,
  Contraseña VARCHAR(200) ,
  Codigo_Postal INT(8) ,
  Usuario VARCHAR(20) ,
  ID INT (20) NOT NULL,
  PRIMARY KEY (ID)
);
-->
<?php
session_start();
if(!isset($_SESSION['login'])){
    echo "no se ha iniciado sesion";
    header ("Location: login.php");
}else{
    imprimirMenu();
    imprimirFormularioEdicionUsuario();
}

//imprime el formulario del usuario pasando los datos que ya estan el la base de datos por un post.


function imprimirFormularioEdicionUsuario(){
    echo "<h2>Editar Usuario</h2>";
    echo "<form action='EditarEliminarUsuario.php' method='post'>";
    echo "<div class='form-row'>";
    echo "<div class='form-group col-md-6'>";
    echo "<label for='Apellidos'><b>Apellidos:</b></label>";
    echo "<input type='text' name='Apellidos' id='Apellidos' value='".$_POST['Apellidos']."' maxlength='19' class='form-control' required>";
    echo "</div>";


    echo "<div class='form-group col-md-6'>";
    echo "<label for='Nombre'><b>Nombre:</b></label>";
    echo "<input type='text' name='Nombre' id='Nombre' value='".$_POST['Nombre']."' maxlength='19'  class='form-control'  required>";
    echo "</div>";
    echo "</div>";

    echo "<div class='form-group col-md-4'>";
    echo "<label for='Fecha_nacimiento'><b>Fecha_nacimiento:</b></label>";
    echo "<input type='date' name='FechaNac' id='FechaNac' value='".$_POST['FechaNac']."' maxlength='19' class='form-control' required>";
    echo "</div>";

    echo "<div class='form-group col-md-4'>";
    echo "<label for='Direccion'><b>Direccion:</b></label>";
    echo "<input type='text' name='Direccion' id='Direccion' value='".$_POST['Direccion']."' maxlength='19' class='form-control' required>";
    echo "</div>";

    echo "<div class='form-group col-md-4'>";
    echo "<label for='Email'><b>Email:</b></label>";
    echo "<input type='text' name='Email' id='Email' value='".$_POST['Email']."' maxlength='19' class='form-control' required>";
    echo "</div>";

    echo "<div class='form-group col-md-4'>";
    echo "<label for='Poblacion'><b>Poblacion:</b></label>";
    echo "<input type='text' name='Poblacion' id='Poblacion' value='".$_POST['Poblacion']."' maxlength='19' class='form-control'  required>";
    echo "</div>";

    echo "<div class='form-group col-md-4'>";
    echo "<label for='Codigo_Postal'><b>Codigo_Postal:</b></label>";
    echo "<input type='text' name='CodigoPostal' id='CodigoPostal' value='".$_POST['CodigoPostal']."' maxlength='19' class='form-control'  required>";
    echo "</div>";

    echo "<div class='form-group col-md-4'>";
    echo "<label for='Usuario'><b>Usuario:</b></label>";
    echo "<input type='text' name='Usuario' id='Usuario' value='".$_POST['Usuario']."' maxlength='19' class='form-control'  required>";
    echo "</div>";


    echo "<input type='text' name='Id' id='Id' value='".$_POST['Id']."' maxlength='19' required hidden>";


    echo "<div class='form-group col-md-1'>";
    echo "<button type='submit' id='submitEdit' name='submitEdit' class='btn btn-primary'>Editar</button>";
    echo "</div>";

    echo "<div class='form-group col-md-1'>";
    echo "<button type='submit' id='submitRemove' name='submitRemove' class='btn btn-danger'>Eliminar</button>";
    echo "</div>";
    echo "</form>";



    echo "<div class='form-group col-md-1'>";
    echo "<INPUT TYPE='button' VALUE='Volver Atras' class='btn btn-danger' onClick=window.location.href='/biblioteca%20ajax%203.0/GestionUsuarios.php'>";
    echo "</div>";


    echo "</div>";
    echo "</body>";
    echo "</html>";
    
}
//formulario sin bootstrap (por si no funciona).
/*
function imprimirFormularioEdicionUsuario(){
    echo "<h2>Editar Usuario</h2>";
    echo "<form action='EditarEliminarUsuario.php' method='post'>";
    
    echo "<label for='Apellidos'><b>Apellidos:</b></label>";
    echo "<input type='text' name='Apellidos' id='Apellidos' value='".$_POST['Apellidos']."' maxlength='19' required>";
    echo "<br>";
    echo "<label for='Nombre'><b>Nombre:</b></label>";
    echo "<input type='text' name='Nombre' id='Nombre' value='".$_POST['Nombre']."' maxlength='19' required>";
    echo "<br>";
    echo "<label for='Fecha_nacimiento'><b>Fecha_nacimiento:</b></label>";
    echo "<input type='date' name='FechaNac' id='FechaNac' value='".$_POST['FechaNac']."' maxlength='19' required>";
    echo "<br>";
    echo "<label for='Direccion'><b>Direccion:</b></label>";
    echo "<input type='text' name='Direccion' id='Direccion' value='".$_POST['Direccion']."' maxlength='19' required>";
    echo "<br>";
    echo "<label for='Email'><b>Email:</b></label>";
    echo "<input type='text' name='Email' id='Email' value='".$_POST['Email']."' maxlength='19' required>";
    echo "<br>";
    echo "<label for='Poblacion'><b>Poblacion:</b></label>";
    echo "<input type='text' name='Poblacion' id='Poblacion' value='".$_POST['Poblacion']."' maxlength='19' required>";
    echo "<br>";
    echo "<label for='Codigo_Postal'><b>Codigo_Postal:</b></label>";
    echo "<input type='text' name='CodigoPostal' id='CodigoPostal' value='".$_POST['CodigoPostal']."' maxlength='19' required>";
    echo "<br>";
    echo "<label for='Usuario'><b>Usuario:</b></label>";
    echo "<input type='text' name='Usuario' id='Usuario' value='".$_POST['Usuario']."' maxlength='19' required>";
    echo "<br>";
    echo "<input type='text' name='Id' id='Id' value='".$_POST['Id']."' maxlength='19' required hidden>";
    echo "<button type='submit' id='submitEdit' name='submitEdit' class='btn btn-primary'>Editar</button>";
    echo "<button type='submit' id='submitRemove' name='submitRemove' class='btn btn-danger'>Eliminar</button>";
    echo "</form>";
    echo "<INPUT TYPE='button' VALUE='Volver Atras' class='btn btn-danger' onClick=window.location.href='/biblioteca%20ajax%203.0/GestionUsuarios.php'>";
    echo "</div>";
    echo "</body>";
    echo "</html>";
    
}*/

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


    
if(isset($_POST["submitEdit"])){
    editarUsuario();
}
    
    
if(isset($_POST["submitRemove"])){
   eliminarUsuario();
}
function editarUsuario(){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "biblioteca";
    $conexion = mysqli_connect($servername, $username, $password, $database);
    if (!$conexion) {
        die("Fallo al conectarse a la base de datos: " . mysqli_connect_error()); //comprobamos si no hay conexión. Si no hay, identificamos el error y terminanos la ejecución del código.
    }
    echo "<br>";
    echo "Se ha conectado a la base de datos";
    
    
    //$sql="INSERT INTO Usuarios (Apellidos, Nombre, Fecha_nacimiento, Direccion, Email, Poblacion, Contraseña, Codigo_Postal, Usuario, ID) VALUES ('dsdskklds', 'dskldkls', '2020-11-18', 'sdnnds', 'saklnklds', 'oksdlñds', 'sklklds', '4332', 'xavi456', '38943')";
    $sql="update Usuarios set Apellidos='".$_POST['Apellidos']."', Nombre='".$_POST['Nombre']."', Fecha_nacimiento='".$_POST['FechaNac']."', Direccion='".$_POST['Direccion']."',  Email='".$_POST['Email']."',  Poblacion='".$_POST['Poblacion']."',  Codigo_Postal='".$_POST['CodigoPostal']."', Usuario='".$_POST['Usuario']."' where id='".$_POST['Id']."'";
    //$fila = $resultado->fetch_array();
    if (mysqli_query($conexion, $sql)) {
        echo "<br> Usuario Editado Con exito";
        header ("Location: GestionUsuarios.php");
    } else {
        echo "<br>";
        echo "Error: " . mysqli_error($conexion);
        echo "Error: error al editar usuario";
    }
}

function eliminarUsuario(){
    
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "biblioteca";
    $conexion = mysqli_connect($servername, $username, $password, $database);
    if (!$conexion) {
        die("Fallo al conectarse a la base de datos: " . mysqli_connect_error()); //comprobamos si no hay conexión. Si no hay, identificamos el error y terminanos la ejecución del código.
    }
    echo "<br>";
    echo "Se ha conectado a la base de datos";
    
    
    //$sql="INSERT INTO Usuarios (Apellidos, Nombre, Fecha_nacimiento, Direccion, Email, Poblacion, Contraseña, Codigo_Postal, Usuario, ID) VALUES ('dsdskklds', 'dskldkls', '2020-11-18', 'sdnnds', 'saklnklds', 'oksdlñds', 'sklklds', '4332', 'xavi456', '38943')";
    $sql="DELETE FROM Usuarios WHERE id='".$_POST['Id']."'";
    //$fila = $resultado->fetch_array();
    if (mysqli_query($conexion, $sql)) {
        echo "<br> Usuario Editado Con exito";
        header ("Location: GestionUsuarios.php");
    } else {
        echo "<br>";
        echo "Error: " . mysqli_error($conexion);
        echo "Error: error al editar usuario";
    }
}
?>