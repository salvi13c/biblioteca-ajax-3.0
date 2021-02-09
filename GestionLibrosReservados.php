<!DOCTYPE html>
<html>
<head>
	<title>Biblioteca</title>
	<script type = "text/javascript" src = "script.js"></script>
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
      <li class="active"><a href="/biblioteca%20ajax%203.0/GestionLibrosReservados.php">Gestion de libros</a></li>
      <li><a href="/biblioteca%20ajax%203.0/GestionUsuarios.php">Gestion de usuarios</a></li>
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
    mostrarListaReservas();
}
function mostrarListaReservas(){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "biblioteca";
    
    // Crear la conexión
    $conexion = mysqli_connect($servername, $username, $password, $database);
    // Se comprueba la conexion
    if (!$conexion) {
        die("Fallo al conectarse a la base de datos: " . mysqli_connect_error()); //comprobamos si no hay conexión. Si no hay, identificamos el error y terminanos la ejecución del código.
    }
    
    //imprime la tabla de coje prestado
    $consulta = "SELECT Cogen_Prestado.IdUser, Cogen_Prestado.IdLibro, Usuarios.Nombre, Usuarios.Apellidos, Cogen_Prestado.EstadoLibro, Cogen_Prestado.FechaDevolucion
FROM Cogen_Prestado 
INNER JOIN Usuarios ON Cogen_Prestado.IdUser=Usuarios.ID"; //se realiza un inner oin para poder cojer el nombre y los apellidos de un determinado prestamo
    $resultado = $conexion->query($consulta);
    echo "<h2> Lista de reservas</h2>";
    echo "<br>";
    echo "<div class='tableSquare'>";
    echo "<table class='table table-striped'>";
    echo "<tr>";
    echo "<th>Id usuario</th>";
    echo "<th>Id libro</th>";
    echo "<th>Nombre y apellidos</th>";
    echo "<th>Estado del libro</th>";
    echo "<th>Fecha de devolucion</th>";
    while($fila = $resultado->fetch_array()) {
        echo "<tr>";
        echo "<td>". $fila[0] ."</td>";
        echo "<td>". $fila[1]."</td>";
        echo "<td>". $fila[2] ." ".$fila[3] ."</td>";
        echo "<td>". $fila[4]."</td>";
        echo "<input type='hidden' name='idLibro' id='idLibro'  value='$fila[1]'>";
        echo "<input type='hidden' name='user' id='user'  value='$fila[0]'>";
        echo "<td><button TYPE='button' onClick='recojerDevolverLibro()' class='btn btn-outline-primary'>Prestar / Devolver Libro</button></td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "</div>";
    echo "<INPUT TYPE='button' class='btn btn-danger'  VALUE='Atras' onClick=window.location.href='http://localhost/biblioteca%20ajax%203.0/paginaPrincipalBibliotecario.php'>";
}
?></div>
</body>
</html>