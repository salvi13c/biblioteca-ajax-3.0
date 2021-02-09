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
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="/biblioteca%20ajax%203.0/login.php">Biblioteca salvi</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="/biblioteca%20ajax%203.0/login.php">Login</a></li>
      <li class="active"><a href="/biblioteca%20ajax%203.0/registro.php">Registro</a></li>
    </ul>
  </div>
</nav>
<h2>Crear Usuario</h2>
<br>
<form action="registro.php" method="post">
    <div class="form-row">
    <div class="form-group col-md-6">
          <label for="Apellidos"><b>Apellidos</b></label>
          <input type="text" class="form-control" name="apellidos" id="apellidos" maxlength="19" required>
    </div>
    <div class="form-group col-md-6">
            <label for="Nombre"><b>Nombre</b></label>
            <input type="text" class="form-control" name="nombre" id="nombre" maxlength="19" required>
    </div>
  </div>

  <div class="form-group col-md-4">
    <label for="Fecha_nacimiento"><b>Fecha de nacimiento:</b></label>
    <input type="date" class="form-control"  name="fecha_nacimiento" id="fecha_nacimiento" maxlength="19" required>
</div>
<div class="form-group col-md-4">
    <label for="Direccion"><b>Direccion:</b></label>
    <input type="text" class="form-control"  name="direccion" id="direccion" maxlength="19" placeholder="Calle 123" required>
</div>
<div class="form-group col-md-4">
    <label for="Email"><b>Email:</b></label>
    <input type="text" class="form-control"  name="email" id="email" maxlength="19" required>
</div>
<div class="form-group col-md-6">
    <label for="Poblacion"><b>Poblacion:</b></label>
    <input type="text" class="form-control" name="poblacion" id="poblacion" maxlength="19" required>
</div>
<div class="form-group col-md-6">
    <label for="Codigo_Postal"><b>Codigo Postal:</b></label>
    <input type="text" class="form-control" name="codigo_postal" id="codigo_postal" maxlength="8" required>
</div>
<div class="form-group col-md-6">
    <label for="Usuario"><b>Usuario:</b></label>
    <input type="text" class="form-control" name="usuario" id="usuario" maxlength="19" placeholder="Usuario" required>
</div>
<div class="form-group col-md-6">
    <label for="contraseña"><b>Contraseña:</b></label>
    <input type="password" class="form-control" name="pass" id="pass" maxlength="19" placeholder="Contraseña" required>
</div>
    <button type="submit" class="btn btn-primary">Crear usuario</button>
    <INPUT TYPE="button" class="btn btn-danger" VALUE="Volver Atras" onClick="window.location.href='/biblioteca%20ajax%203.0/login.php'">
</form>
</div>
</body>
</html>

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
if(isset($_POST['usuario'])){
    
    
    

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
    $password = password_hash($_POST['pass'], PASSWORD_DEFAULT);
    
    
    //$sql="INSERT INTO Usuarios (Apellidos, Nombre, Fecha_nacimiento, Direccion, Email, Poblacion, Contraseña, Codigo_Postal, Usuario, ID) VALUES ('dsdskklds', 'dskldkls', '2020-11-18', 'sdnnds', 'saklnklds', 'oksdlñds', 'sklklds', '4332', 'xavi456', '38943')";
    //inserta los datos del usuario
    $sql="insert into Usuarios  (Apellidos, Nombre, Fecha_nacimiento, Direccion, Email, Poblacion,Contraseña,Codigo_Postal,Usuario,ID) VALUES ('".$_POST['apellidos']."', '".$_POST['nombre']."', '".$_POST['fecha_nacimiento']."', '".$_POST['direccion']."', '".$_POST['email']."', '".$_POST['poblacion']."','".$password."','".$_POST['codigo_postal']."','".$_POST['usuario']."',null);";
    //$fila = $resultado->fetch_array();
    if (mysqli_query($conexion, $sql)) {
        echo "<br> regisrto realizado de forma correcta";
        session_start();
        $_SESSION['login']=$_POST['usuario']; 
        header ("Location: paginaPrincipal.php"); //nos lleva a la pagina principal
    } else {
        echo "<br>";
        echo "Error: " . mysqli_error($conexion);
        echo "Error: usuario ya existente o error al introducir los datos";
    }
}
?>
