function login(){
	var user = document.getElementById("usuario").value;
	var pass = document.getElementById("pass").value;
	
var xhttp = new XMLHttpRequest();       
 	xhttp.onreadystatechange = function() {
 	 if (this.readyState == 4 && this.status == 200) {  
	
		var mensaje= this.response;	
		if (mensaje=="Contraseña Incorrecta" || mensaje=="el usuario no existe" ){
			var p = document.getElementById("mensaje");
			p.innerHTML = mensaje;	
		}else{
			if (user=="bibliotecario"){
				window.location.href="paginaPrincipalBibliotecario.php";
			}else{
				window.location.href="paginaPrincipal.php"
			}
			
		}

		
	 }
	};
	xhttp.open("GET", "loginConnect.php?user="+user+"&pass="+pass, true);     
	xhttp.send(); 
	// para que no se siga el link que llama a esta función
	return false;
	
	
}


function registro(){
var xhttp = new XMLHttpRequest();       
 	xhttp.onreadystatechange = function() {
 	 if (this.readyState == 4 && this.status == 200) {  
			var cuerpo = document.getElementById("cuerpo");
			var paginaNueva=this.response;
			cuerpo.innerHTML=paginaNueva;
		
	 }
	};
	xhttp.open("GET", "registro.php", true);     
	xhttp.send(); 
	// para que no se siga el link que llama a esta función
	return false;
	
	
}

function mostrarSugerencias(){
	if(document.getElementById("busqueda").value.length == 0){ //si no hemos escrito nada en el input, las sugerencias nos van a salir vacías.
				document.getElementById('resultados').innerHTML = '';
			} else {
				// AJAX REQ
				var xmlhttp = new XMLHttpRequest();
				xmlhttp.onreadystatechange = function(){
					if(this.readyState == 4 && this.status == 200){
						document.getElementById('resultados').innerHTML = this.responseText; //modificamos la etiqueta con la ID salida para que nos salga la respuesta obtenida
					}
				}
				xmlhttp.open("GET", "sugerencias.php?q="+document.getElementById("busqueda").value+"&t="+document.getElementById("param").value, true);
				xmlhttp.send();
			}
}


function reservar(){
	var user = document.getElementById("user").value;
	var idLibro = document.getElementById("idLibro").value;
	
	var xhttp = new XMLHttpRequest();       
 	xhttp.onreadystatechange = function() {
 	 if (this.readyState == 4 && this.status == 200) {  
	
			var mensaje= this.response;	
			var p = document.getElementById("estadoLibro");
			p.innerHTML = mensaje;	

		
	 }
	};
	xhttp.open("GET", "prestarLibro.php?user="+user+"&idLibro="+idLibro, true);     
	xhttp.send(); 
	// para que no se siga el link que llama a esta función
	return false;
		
}

function recojerDevolverLibro(){
	var user = document.getElementById("user").value;
	var idLibro = document.getElementById("idLibro").value;
	
	var xhttp = new XMLHttpRequest();       
 	xhttp.onreadystatechange = function() {
 	 if (this.readyState == 4 && this.status == 200) {  
	
		window.location.href="GestionLibrosReservados.php"	
	 }
	};
	xhttp.open("GET", "recojerDevolverLibro.php?user="+user+"&idLibro="+idLibro, true);     
	xhttp.send(); 
	// para que no se siga el link que llama a esta función
	return false;
		
}

function estadoReserva(){
		var user = document.getElementById("user").value;
	var idLibro = document.getElementById("idLibro").value;
	
	var xhttp = new XMLHttpRequest();       
 	xhttp.onreadystatechange = function() {
 	 if (this.readyState == 4 && this.status == 200) {  
	
			var mensaje= this.response;	
			var p = document.getElementById("estadoLibro");
			p.innerHTML = mensaje;	

		
	 }
	};
	xhttp.open("GET", "comprovarEstadoLibro.php?user="+user+"&idLibro="+idLibro, true);     
	xhttp.send(); 
	// para que no se siga el link que llama a esta función
	return false;
}
