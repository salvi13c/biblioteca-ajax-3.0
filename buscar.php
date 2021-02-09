<html>
<html>
<head>
	<title>Detalle libro</title>
	      <meta name="viewport" content="width=device-width, initial-scale=1">
	      <meta charset="utf-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container-fluid">
<?php 
session_start();
if(!isset($_SESSION['login'])){
    echo "no se ha iniciado sesion";
    header ("Location: login.php");
}else{
    imprimirMenu();
    busqueda();
    ImprimirBotonAtras();
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

function busqueda(){
echo "<h2> Resultados del la busqueda </h2>";
    $parametro=$_POST['parametros'];
    $campo=$_POST['busqueda'];
    $userId=$_POST['UserId'];
    
    
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
    
    //busca segun tipo de dato que queremos buscar
    if ($parametro==0){
        echo "Se ha seleccionado busqueda por autor";
        $consulta = autor($campo);
    }else if ($parametro==1){
        echo "Se ha seleccionado busqueda por titulo";
        $consulta = titulo($campo);
    }else if ($parametro==2){
        echo "Se ha seleccionado busqueda por editorial";
        $consulta = editorial($campo);
        
    }else if ($parametro==3){
        echo "Se ha seleccionado busqueda por sinopsis";
        $consulta = sinopsis($campo);
    }
    $resultado = $conexion->query($consulta);
    
    
    //nos dibuja la tabla entera.
        echo "<h2> Tabla de libros</h2>";
        echo "<br>";
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
                echo "<td>".'<img src="data:image/jpeg;base64,'.base64_encode( $fila[4] ).'" width="50" height="50" />'. "</td>";
                echo "<td>". $fila[5] ."</td>";
                echo "<td>". $fila[6] ."</td>";
                echo "<td>". $fila[7] ."</td>";
                echo "<FORM ACTION='DetalleLibro.php' METHOD='POST'>";
                echo "<input type='hidden' name='Autor' value='$fila[0]'>";
                echo "<input type='hidden' name='Titulo' value='$fila[1]'>";
                echo "<input type='hidden' name='Editorial' value='$fila[2]'>";
                echo "<input type='hidden' name='Sinopsis' value='$fila[3]'>";
                $base64=base64_encode( $fila[4] );
                echo "<input type='hidden' name='ImagenPortada' value='$base64'>";
                echo "<input type='hidden' name='Disponible' value='$fila[5]'>";
                echo "<input type='hidden' name='Reservado' value='$fila[6]'>";
                echo "<input type='hidden' name='Id' value='$fila[7]'>";
                echo "<input type='hidden' name='userId' value='$userId'>";
                echo "<td><INPUT TYPE='submit' VALUE='Mostrar Detalles' class='btn btn-outline-primary'></td>";
                echo "</form>";
                echo "</tr>";
            }
            echo "</table>";
        
        
    }




function autor($campo){
    return "select * from Libros where Autor='".$campo."'";

}
function titulo($campo){
    return "select * from Libros where Titulo='".$campo."'";
}

function editorial($campo){
    return "select * from Libros where Editorial='".$campo."'";
}

function sinopsis($campo){
    return "select * from Libros where Sinopsis='".$campo."'";
}

function ImprimirBotonAtras(){
    $userId=$_POST['UserId'];
    if ($userId=="bibliotecario"){
        echo "<INPUT TYPE='button' VALUE='Atras' class='btn btn-danger' onClick=window.location.href='http://localhost/biblioteca%20ajax%203.0/paginaPrincipalBibliotecario.php'>";
    }else{
        echo "<INPUT TYPE='button' VALUE='Atras' class='btn btn-danger' onClick=window.location.href='http://localhost/biblioteca%20ajax%203.0/paginaPrincipal.php'>";
    }
}
?>
</div>
</body>
</html>