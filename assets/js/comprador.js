

$(document).ready(function() {

	$('registrar').click(function(event) {
		event.preventDefault();
	});
	//FLOW JS
	$('#dheader').flowtype({
		minFont: 20,
		maxFont: 30
	});
	//ALTA VEHICULO
	$('#form-alta-producto').on('submit', function(event) {
		event.preventDefault();
		var datos = new FormData(this);
		$.ajax({
			url: 'nexo.php',
			type: 'post',
			data: datos,
			processData: false,
			contentType: false,
			cache: false,
			dataType: 'json',
			beforeSend: function() {
				//console.log('Enviando...')
			},
			success: function(data) {
				if (typeof data.error === 'undefined') {
					$('#alta-producto').modal('toggle');
					ListarVehiculos();
					swal("Completado!", "El registro se ha completado con éxito.", "success");
				} else {
					swal("Error", data.error , "error");
				}

			},
			complete: function(xhr, status) {
								
			}
		});

	});

	ListarVehiculos();
	
	$('#btn-editar-vehiculo').click(function(event) {
		/* Act on the event */
		$('#editar-vehiculo').modal('toggle');	
	});

});

var ListarVehiculos = function() {
	var idV;
	var miTabla = $('#resumen').DataTable({
		"destroy":true,
		"ajax": {
			"method": "POST",
			"url": "listarp.php"
		},
		"columns": [
			{"data": "codigo"},
			{"data": "nombre"}, 
			{"data": "porcentaje"}			
		],
		"language": {
			"url": "./assets/js/Spanish.json"
		}
				
	});

	obtener_datos_editar($('#resumen tbody'), miTabla);
	obtener_datos_checkout($('#resumen tbody'), miTabla);
}


var obtener_datos_editar = function(tbody, table)
{
	$(tbody).on('click', 'button.editar', function(event) {
		event.preventDefault();
		/* Act on the event */
		var data = table.row($(this).parents("tr")).data();
		//console.log(data);
		var id = data.vehiculoId, patente = data.patente, tipo = data.tipo, estadia = data.estadia;

		$('#form-editar-vehiculo input#patente').val(patente);
		$('#form-editar-vehiculo select#tipo').val(tipo);
		$('#form-editar-vehiculo input#estadia').val(estadia);
		$('#form-editar-vehiculo input#idv').val(id);

		$('#form-editar-vehiculo').on('submit', function(event) {
			event.preventDefault();
				
			var datos = new FormData(this);			
			$.ajax({
			url: 'Proxy.php',
			type: 'post',
			data: datos,
			processData: false,
    		contentType: false,
    		cache: false,
			dataType: 'json',			
			beforeSend: function()
			{							
			},
			success : function(data)
			{
				console.log(data);
				ListarVehiculos();
				//$('#form-editar-vehiculo').reset();
				
			},
			complete: function()
			{
				
			}

			});
		});
	});
}

var obtener_datos_checkout= function(tbody, table)
{
	$(tbody).on('click', 'button.checkout', function(event) {
		event.preventDefault();
		/* Act on the event */
		var data = table.row($(this).parents("tr")).data();
		//console.log(data);
		var id = data.vehiculoId;
		swal({
		  title: "Aviso",
		  text: "Se marcará la salida del vehículo.",
		  type: "warning",
		  showCancelButton: true,
		  confirmButtonColor: "#DD6B55",
		  confirmButtonText: "Si",
		  cancelButtonText: "No, cancelar.",
		  closeOnConfirm: false,
		  closeOnCancel: false
		},
		function(isConfirm){
		  if (isConfirm) {

			var datos = new FormData();
			datos.append('action', 'checkoutVehiculo')
			datos.append('id', id);
			$.ajax({
			url: 'Proxy.php',
			type: 'post',
			data: datos,
			processData: false,
	    	contentType: false,
	    	cache: false,
			dataType: 'json',			
			beforeSend: function()
			{
				//console.log('Enviando datos a eliminar');			
			},
			success : function(data)
			{
				console.log(data);
				ListarVehiculos();
			}
			});
			swal("Hecho!", "Se marcó la salida correctamente.", "success");
		  } else {
			    swal("Cancelado", "No hubo cambios.", "error");
		  }
		});	
	});
}