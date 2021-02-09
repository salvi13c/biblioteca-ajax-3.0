<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "biblioteca";
    $conexion = mysqli_connect($servername, $username, $password, $database);
    if (!$conexion) {
        die("Fallo al conectarse a la base de datos: " . mysqli_connect_error()); //comprobamos si no hay conexión. Si no hay, identificamos el error y terminanos la ejecución del código.
    }
    
    $sql="select ID from Usuarios where usuario='". $_GET["user"]."'"; //selecciona el id del usuario
    $resultado=mysqli_query($conexion, $sql);
    $fila = $resultado->fetch_array();
    
    if ($fila!=null){
        $IdUser=$fila[0]; //convierte el idUser del nombre al id de usuario
    }else{
        echo "el usuario no existe";
    }
    
    $sql="select count(*) from Cogen_Prestado where IdUser='". $IdUser."'"; //cuenta todos los libros que tiene epprestado un usuario
    $resultado=mysqli_query($conexion, $sql);
    $fila = $resultado->fetch_array();
    
    
    if ($fila[0]<=1){
        $date=strtotime("+2 Months"); //añade 2 meses de reserva al libro (tiene 2 meses para devolver el libro
        $dateCon=date('Y-m-d', $date);
        
        $sql="select * from Libros where Id='". $_GET["idLibro"]."'";
        $resultado=mysqli_query($conexion, $sql);
        $fila = $resultado->fetch_array();
        $cantidadLibros=$fila[5]-1; //se resta la cantidad de libros
        
        if ($cantidadLibros<0){
            echo "No hay suficientes libros";
        }else{
            
            //nos actualiza la disponibilida de los ibros 
            $sql="update libros set Disponible='".$cantidadLibros."' where Id='".$fila[7]."'";
            $resultado=mysqli_query($conexion, $sql);
            $cantidadLibros=$fila[5];
            $sql="update libros set Reservado='".$cantidadLibros."' where Id='".$fila[7]."'";
            $resultado=mysqli_query($conexion, $sql);
            $sql="INSERT INTO Cogen_Prestado (IdUser,IdLibro,EstadoLibro,FechaDevolucion) VALUES ($IdUser,'$_GET[idLibro]','reservado','$dateCon')"; //inserta los libros prestados
            if (mysqli_query($conexion, $sql)) {
                echo "Se ha reservado del libro de forma correcta";
            } else {
                echo "<br>";
                //echo "Error: " . mysqli_error($conexion);
                echo "Error: ya se ha reservado el libro";
            }
        }
    }else{
        echo "Se ha alcanzado el limite de libros que pueden ser reservados a la vez";
    }



?>