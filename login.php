<!DOCTYPE html>
<html>
<head>
	<title>Biblioteca</title>
	<meta charset="utf-8">
	<script type = "text/javascript" src = "script.js"></script>
          <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>	
</head>
<body>
<div class="container-fluid">
<div id="cuerpo">
    <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="/biblioteca%20ajax%203.0/login.php">Biblioteca salvi</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="/biblioteca%20ajax%203.0/login.php">Login</a></li>
      <li><a href="/biblioteca%20ajax%203.0/registro.php">Registro</a></li>
    </ul>
  </div>
</nav>
<h2>Inicio de sesion</h2>
<br>

<!--
    <label for="nombre"><b>Nombre:</b></label>
    <input type="text" name="usuario" id="usuario" required>
    <br>
    <label for="contraseña"><b>Contraseña:</b></label>
    <input type="password" name="pass" id="pass" required>
    <br>
    <button id="loginbutton" type="button" onClick="login()">Login</button>
-->

<div class="row">
    <aside class="col-sm-4">
<div class="card">
<article class="card-body">
    <div class="form-group">
        <label>Usuario</label>
        <input type="text" name="usuario" id="usuario" class="form-control" placeholder="Usuario" maxlength='19'  required>
    </div> <!-- form-group// -->
    <div class="form-group">
        <label>Contraseña</label>
        <input type="password" name="pass" id="pass" class="form-control" placeholder="******" maxlength='19' required>
    </div> <!-- form-group// -->
    <div class="form-group">
        <button type="submit" class="btn btn-primary btn-block" onClick="login()"> Login  </button>
        <button TYPE="button" class="btn btn-primary btn-block" onClick="registro()">Crear nuevo usuario</button>
    </div> <!-- form-group// -->                                                           
</article>
</div> <!-- card.// -->
<br>
<p id="mensaje"></p>
</aside>
</div>
</div>
</body>
</html>
<?php 

//si ya hay una session iniciada nos salta directamente a la pagina principal
session_start();
if(isset($_SESSION['login'])){
    if ($_SESSION['login']=="bibliotecario"){
        header ("Location: paginaPrincipalBibliotecario.php");
    }else{
        header ("Location: paginaPrincipal.php");
    }
}?>