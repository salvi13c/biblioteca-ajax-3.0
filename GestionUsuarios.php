<!DOCTYPE html>
<html>
<head>
	<title>Biblioteca</title>
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <meta charset="utf-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container-fluid">
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="/biblioteca%20ajax%203.0/paginaPrincipal.php">Biblioteca salvi</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="/biblioteca%20ajax%203.0/paginaPrincipal.php">Pagina Principal</a></li>
      <li><a href="/biblioteca%20ajax%203.0/GestionLibrosReservados.php">Gestion de libros</a></li>
      <li class="active"><a href="/biblioteca%20ajax%203.0/GestionUsuarios.php">Gestion de usuarios</a></li>
      <li><a href="/biblioteca%20ajax%203.0/logout.php">Cerrar sesion</a></li>
    </ul>
  </div>
</nav>
<?php
session_start();
if(!isset($_SESSION['login'])){
    echo "no se ha iniciado sesion";
    header ("Location: login.php");
}else{
    mostrarListaUsuarios();
}
function mostrarListaUsuarios(){
    
    //datos de conextion
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "biblioteca";
    
    // Crear la conexión
    $conexion = mysqli_connect($servername, $username, $password, $database);
    // Se comprueba la conexion
    if (!$conexion) {
        die("Fallo al conectarse a la base de datos: " . mysqli_connect_error()); //comprobamos si no hay conexión. Si no hay, identificamos el error y terminanos la ejecución del código.
    }else{
        
        //realiza un select sobre la tabla de usuarios
        $consulta = "SELECT * FROM Usuarios";
        $resultado = $conexion->query($consulta);
        echo "<h2> Lista de usuarios</h2>";
        echo "<br>";
        echo "<div class='tableSquare' >";
        echo "<table class='table table-striped'>";
        echo "<tr>";
        echo "<th>Apellidos</th>";
        echo "<th>Nombre</th>";
        echo "<th>Fecha de nacimiento</th>";
        echo "<th>Direccion</th>";
        echo "<th>Email</th>";
        echo "<th>Poblacion</th>";
        echo "<th>Codigo Postal</th>";
        echo "<th>Usuario</th>";
        echo "<th>Id</th>";
        while($fila = $resultado->fetch_array()) {
            echo "<tr>";
            echo "<td>". $fila[0] ."</td>";
            echo "<td>". $fila[1]."</td>";
            echo "<td>". $fila[2] ."</td>";
            echo "<td>". $fila[3] ."</td>";
            echo "<td>". $fila[4] ."</td>";
            echo "<td>". $fila[5] ."</td>";
            echo "<td>". $fila[7] ."</td>";
            echo "<td>". $fila[8] ."</td>";
            echo "<td>". $fila[9] ."</td>";
            echo "<FORM ACTION='DetalleUsuario.php' METHOD='POST'>";
            echo "<input type='hidden' name='Apellidos' value='$fila[0]'>";
            echo "<input type='hidden' name='Nombre' value='$fila[1]'>";
            echo "<input type='hidden' name='FechaNac' value='$fila[2]'>";
            echo "<input type='hidden' name='Direccion' value='$fila[3]'>";
            //echo "<input type='hidden' name='ImagenPortada' value='$base64'>";
            echo "<input type='hidden' name='Email' value='$fila[4]'>";
            echo "<input type='hidden' name='Poblacion' value='$fila[5]'>";
            echo "<input type='hidden' name='CodigoPostal' value='$fila[7]'>";
            echo "<input type='hidden' name='Usuario' value='$fila[8]'>";
            echo "<input type='hidden' name='Id' value='$fila[9]'>";
            $nombreUsuario=$_SESSION['login'];
            echo "<input type='hidden' name='userId' value='$nombreUsuario'>";
            echo "<td><INPUT TYPE='submit' VALUE='Mostrar Detalles' class='btn btn-outline-primary' ></td>";
            echo "</form>";
            
            //formulario oculto para editar o eliminar el usuario
            echo "<FORM ACTION='EditarEliminarUsuario.php' METHOD='POST'>";
            echo "<input type='hidden' name='Apellidos' value='$fila[0]'>";
            echo "<input type='hidden' name='Nombre' value='$fila[1]'>";
            echo "<input type='hidden' name='FechaNac' value='$fila[2]'>";
            echo "<input type='hidden' name='Direccion' value='$fila[3]'>";
            //echo "<input type='hidden' name='ImagenPortada' value='$base64'>";
            echo "<input type='hidden' name='Email' value='$fila[4]'>";
            echo "<input type='hidden' name='Poblacion' value='$fila[5]'>";
            echo "<input type='hidden' name='CodigoPostal' value='$fila[7]'>";
            echo "<input type='hidden' name='Usuario' value='$fila[8]'>";
            echo "<input type='hidden' name='Id' value='$fila[9]'>";
            $nombreUsuario=$_SESSION['login'];
            echo "<input type='hidden' name='userId' value='$nombreUsuario' >";
            echo "<td><INPUT TYPE='submit' VALUE='Editar / Eliminar usuario' class='btn btn-outline-primary' ></td>";
            echo "</form>";
            
            
            echo "</tr>";
        }
        echo "</table>";
        echo "</div>";
        
        //nos permite volver atras
        echo "<INPUT TYPE='button' VALUE='Atras' class='btn btn-danger' onClick=window.location.href='http://localhost/biblioteca%20ajax%203.0/paginaPrincipalBibliotecario.php'>";
    }
}
?>
</body>
</html>