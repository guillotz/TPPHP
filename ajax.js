function EnviarLogin()
{
	var q = $.ajax
	(
		{
			type: "POST",
			url:  "nexoadministrador.php",
			data: 
				{
					usuario: $("#username").val(),
					password: $("#password").val()
				},
			success:function(respuestaPHP)
			{
				if(respuestaPHP == "REGISTRADO")
				{
					alert("CORRECTO");
					window.location.href ="paneladministrador.php"; //redireccionar a la pagina de administracion
				}
				else
				{
					alert("Usuario Incorrecto");
				}
			}
			//error:alert("no anda")
		}	
	);
}
function CargarPatente()
{
	var a =$.ajax
	(
	{
		type: "POST",
		url: "nexoadministrador.php",
		data:
		{
			patente: $("#texto_patente").val(),
			cargar: 1
		},
		success:function(respuestaPHP)
		{
			ObtenerTabla();
			ObtenerTablaPagos();
		   	alert(respuestaPHP);
		}

	});


}

function SacarPatente()
{
	var x =$.ajax
	({
		type: "POST",
		url:"nexoadministrador.php",
		data:
		{
			patente: $("#texto_patente").val(),
			sacar: 1
		},
		success:function(respuestaPHP)
		{
			ObtenerTablaPagos();
			ObtenerTabla();
		   	alert(respuestaPHP);
		}
	});
}

function loginUser()
{
		$("#username").val("user");
		$("#password").val("user");	
}
function llenarAdmin()
{
		$("#username").val("admin");
		$("#password").val("admin");	
}
function ObtenerTabla()
{
	var x =$.ajax
	({
		type: "GET",
		url:"nexoadministrador.php",
		data:
		{
			tabla: 1
		},
		success:function(respuestaPHP)
		{
			$('#tablaEstacionados').html(respuestaPHP);
		}
	});
}
function ObtenerTablaPagos()
{
	var x=$.ajax
	({
		type:"GET",
		url: "nexoadministrador.php",
		data:
		{
			tabla2: 1
		},
		sucess:function(respuestaPHP)
		{
			$('#tablaSalida').html(respuestaPHP);
		}
	});
}
/*
	q.done(function(respuestaPHP)
	{
		debugger;
		if(respuestaPHP == "REGISTRADO")
		{
			alert("CORRECTO");
			window.location.href ="www.google.com";
		}
		else
		{
			alert("Usuario Incorrecto");
		}
	});

/*	q.done(function() {});
	q.error(function() {});
	*/

