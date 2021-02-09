<?php



$Resultados = BuscarPorTipo();

// obtener consulta 
$q = $_REQUEST['q'];

$sugerencia = "";

// obtener sugerencias
if($q !== ""){
    $q = strtolower($q); //nos pasa todas las letras a mínusculas
    $len = strlen($q); //nos devuelve la longitud del string
    foreach($Resultados as $resultado){
        if(stristr($q, substr($resultado, 1, $len))){ //es una función que sirve para buscar un string dentro de un string, sin importar si es mayúsculas o no. Dentro tiene la función substr que nos devuelve parte de una cadena. 
            if($sugerencia === ""){ //si de momento no hay ninguna sugerencia, nos enseñará la primera. 
                $sugerencia = "Resultados de la Busqueda: ".$resultado;
            } else {
                $sugerencia .= ", $resultado"; //si ya hay alguna sugerencia, nos concatenará con la siguiente. 
            }
        }
    }
}
if ($sugerencia === ""){
    echo "No hay sugerencias";
}else{
    echo $sugerencia; //imprime la sugerencia
}


function BuscarPorTipo(){
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
    
    //realiza la consulta de los libros
    $consulta = "SELECT * FROM Libros";
    $resultado= $conexion->query($consulta);
    while($fila = $resultado->fetch_array()) {
    $lista[] = $fila[TipoDeDato()];
    }
    return $lista;
    }
    
function TipoDeDato(){
    //consulta de tipo de dato a buscar segun la columna que queremos de la base de datos sobre la tabla
    $t = $_REQUEST['t'];
    
    if ($t==0){
        return 0;
    }else if ($t==1){
        return 1;
    }else if ($t==2){
        return 2;
    }else if ($t==3){
        return 3;
    }
}
    


?>