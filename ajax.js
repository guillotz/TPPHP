
function CargarPatente()
{
	var a =$.ajax
	(
	{
		type: "POST",
		url: "nexoadministrador.php",
		data:
		{
			patente: $("#pating").val(),
			cargar: 1
		},
		dataType: 'json',
		success:function(respuestaPHP)
		{
			if(typeof respuestaPHP.error === "undefined")
			{
				swal("Muy Bien!", "Se agregó la patente!", "success");
				setTimeout(function() {
					location.reload(true);
				}, 1500);
			}
			else
			{
				swal(respuestaPHP.error);
				//$("#form-ingresar-patente").reset();
				//location.reload(); 
			}
		}

	});


}

function SacarPatente(patenteid)
{
	var idpatente = patenteid;

	swal({
			title: "Esta seguro?",
			text: "Se marcará la salida del vehiculo",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Si",
			cancelButtonText: "No",
			closeOnConfirm: false,
			closeOnCancel: false
		},
		function(isConfirm) {
			if (isConfirm) {
					var x = $.ajax({
					type: "POST",
					url: "nexoadministrador.php",
					data: {
						patente: idpatente,
						sacar: 1
					},
					dataType: 'json',
					success: function(respuestaPHP) {
						if (typeof respuestaPHP.error === "undefined") {

							swal("Hecho!", "Tiempo: "+respuestaPHP.horas + " y Cobrado: " + respuestaPHP.costo , "success");
							setTimeout(function() {
								location.reload(true);
							}, 1500);
						}
					}
					});


				//swal("Deleted!", "Your imaginary file has been deleted.", "success");
			} else {
				swal("Cancelado", "No hubo cambios rufian", "error");
			}
		});
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
