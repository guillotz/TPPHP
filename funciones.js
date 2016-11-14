
function ingresar()
{
	var f=$.ajax({
		url:"nexo.php",
		type:"post",
		data:{
			boton: "ingresar",
			patente: $("#patente").val(),
		}});
	//success: alert("GESTIONANDO AUTO");
	//success: swal("Gestionando auto");

	f.done (function(resultado)
		{
			if (resultado=="ingresar")
			{
				swal("Auto ingresado exitosamente", "", "success");
				//alert("Auto Ingresado Exitosamente");
				estacionados();
			}
			else if (resultado=="vacio")
			{
				
				swal("Ingrese una patente");
				//alert("Ingrese una patente");
			}
			else
			{
				swal("A facturar: $" + resultado, "" ,"success");
				//alert("A facturar: $" + resultado);
				estacionados();
			}
			
		});

	//por si quiero imprimir la tabla grilla
	/*f.done (function()
			{
				var d=$.ajax({
				url:"grilla.php",
				type:"get",
				data:{
				}});
				d.done(function(resultado)
					{
						$("#tabla").val(resultado);
					}
				);
			}
		);*/

}


function login()
{
	var f=$.ajax(
		{
			url: "nexo.php",
			type: "post",
			data:
			{
				boton: "login",
				usuario: $("#usuario").val(),
				pass: $("#pass").val()
			}

		}
	);
	f.done (function(resultado)
		{
			if (resultado=="ok")
			{
				window.location.href = "estacionamiento.php";
			}
			else
			{
				swal("Usuario o contraseña inexistentes");
				//alert("Usuario o contraseña inexistentes");
			}
			
		});
}

function salir()
{
	var f=$.ajax(
		{
			url: "nexo.php",
			type: "post",
			data:
			{
				boton: "salir"
			}

		}
	);
	f.done (function(salir)
		{
			if (salir=="salir")
			{
				window.location.href = "index.html";
			}

			
		});
}

function tabla()
{
	var f=$.ajax
	(
		{
			url:"nexo.php",
			type:"post",
			data:
			{
				boton:"tabla"
			}
		}
	);
	f.done
	(
		function(algo) 
		{
			$("#tabla").html(algo);
		}
	);	
}

function tablaUsuarios()
{
	var f=$.ajax
	(
		{
			url:"nexo.php",
			type:"post",
			data:
			{
				boton:"tablaUsuarios"
			}
		}
	);
	f.done
	(
		function(algo) 
		{
			$("#tabla").html(algo);
		}
	);	
}

function estacionados()
{
	var f=$.ajax
	(
		{
			url:"nexo.php",
			type:"post",
			data:
			{
				boton:"estacionados"
			}
		}
	);
	f.done
	(
		function(algo) 
		{
			$("#tabla").html(algo);
		}
	);	
}

function testAdministrador()
{
	var f=$.ajax
	({}	);

	f.done
	(
		function() 
		{
			$("#usuario").val("admin");
			$("#pass").val("admin");
		}
	);	
}

function testUsuario()
{
	var f=$.ajax
	({}	);

	f.done
	(
		function() 
		{
			$("#usuario").val("usuario");
			$("#pass").val("usuario");
		}
	);	
}