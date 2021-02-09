<!DOCTYPE html>
<html>
<head>
<script type = "text/javascript" src = "script.js">
</script>
	<title>Biblioteca</title>
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <meta charset="utf-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<br>
<div class="container-fluid">
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="/biblioteca%20ajax%203.0/paginaPrincipal.php">Biblioteca salvi</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="/biblioteca%20ajax%203.0/paginaPrincipal.php">Pagina Principal</a></li>
      <li><a href="/biblioteca%20ajax%203.0/GestionLibrosReservados.php">Gestion de libros</a></li>
      <li><a href="/biblioteca%20ajax%203.0/GestionUsuarios.php">Gestion de usuarios</a></li>
      <li><a href="/biblioteca%20ajax%203.0/logout.php">Cerrar sesion</a></li>
    </ul>
  </div>
</nav>
<?php 
session_start();
$nombreUsuario=$_SESSION['login'];
if(!isset($_SESSION['login'])){
    echo "no se ha iniciado sesion";
    header ("Location: login.php");
}else{
    if ($_SESSION['login']=="bibliotecario"){
        echo "Se ha iniciado sesion con el nombre ".$nombreUsuario." (en modo bibliotecario)";
        MostrarLibros();
        imprimirBusqueda();
    }else{
        header ("Location: paginaPrincipalBibliotecario.php");
    }
}

function MostrarLibros(){
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
        
    }
    
    $consulta = "SELECT * FROM Libros";
    $resultado = $conexion->query($consulta);
    echo "<h2> Tabla de libros</h2>";
    echo "<br>";
    //echo "<div class='tableSquare'>";
    echo "<table class='table table-striped'>";
    echo "<tr>";
    echo "<th>Autor</th>";
    echo "<th>Titlo</th>";
    echo "<th>Editorial</th>";
    echo "<th>Sinopsis</th>";
    echo "<th>Imagen Portada</th>";
    echo "<th>Disponible</th>";
    echo "<th>Reservado</th>";
    echo "<th>Id</th>";
    while($fila = $resultado->fetch_array()) {
        echo "<tr>";
        echo "<td>". $fila[0] ."</td>";
        echo "<td>". $fila[1]."</td>";
        echo "<td>". $fila[2] ."</td>";
        echo "<td>". $fila[3] ."</td>";
        echo "<td>".'<img src="data:image/jpeg;base64,'.base64_encode( $fila[4] ).'" width="50" height="50"/>'. "</td>";
        echo "<td>". $fila[5] ."</td>";
        echo "<td>". $fila[6] ."</td>";
        echo "<td>". $fila[7] ."</td>";
        echo "<form action='DetalleLibro.php' method='POST'>";
        echo "<input type='hidden' name='Autor' value='$fila[0]'>";
        echo "<input type='hidden' name='Titulo' value='$fila[1]'>";
        echo "<input type='hidden' name='Editorial' value='$fila[2]'>";
        echo "<input type='hidden' name='Sinopsis' value='$fila[3]'>";
        $base64=base64_encode( $fila[4] );
        echo "<input type='hidden' name='ImagenPortada' value='$base64'>";
        echo "<input type='hidden' name='Disponible' value='$fila[5]'>";
        echo "<input type='hidden' name='Reservado' value='$fila[6]'>";
        echo "<input type='hidden' name='Id' value='$fila[7]'>";
        $nombreUsuario=$_SESSION['login'];
        echo "<input type='hidden' name='userId' value='$nombreUsuario'>";
        echo "<td><input type='submit' class='btn btn-outline-primary' value='Mostrar Detalles'></td>";
        echo "</form>";
        echo "</tr>";
    }
   echo "</table>";
   //echo "</div>";
   
}

function imprimirBusqueda(){
    $nombreUsuario=$_SESSION['login'];
    echo "<form action='buscar.php' method='post'>";
    echo "<div class='form-group col-md-4'>";
    echo "<input type='text' id='busqueda' name='busqueda' size='30' class='form-control' onkeyup='mostrarSugerencias()' placeholder='Buscar en la biblioteca'>";
    echo "</div>";
    echo "<div class='form-group col-md-6'>";
    echo "<select name='parametros' class='form-control' id='param' onchange='mostrarSugerencias()'>";
    echo "<option value=0>Autor</option>";
    echo "<option value=1>Titulo</option>";
    echo "<option value=2>Editorial</option>";
    echo "<option value=3>Sinopsis</option>";
    echo "</select>";
    echo "</div>";
    echo "<input type='hidden' name='UserId' value='$nombreUsuario'>";
    echo "<div class='col-md-2'>";
    echo "<input type='submit' class='btn btn-primary' value='Enviar'>";
    echo "</div>";
    echo "<br>";
    echo "<div class='form-group col-md-4'>";
    echo "<span id='resultados' style='font-weight:bold'></span></p>";
    echo "</div>";
    echo "</form>";
    echo "<br>";
    echo "<br>";
}

?>

<br>
</div>
</body>
</html>