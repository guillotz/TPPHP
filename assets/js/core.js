

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
			"url": "listarv.php"
		},
		"columns": [
			{"data": "vehiculoId", "render": function(data){ idV = data; return data}}, 
			{"data": "patente",
			"render": function ( data, type, full, meta ) {
              return '<strong>'+data+'</strong>';
            }}, 
			{"data": "tipo",
			"render": function(data)
			{
				var t;
				switch(data)
				{
					case 0:
						t = 'Moto';
					break;
					case 1:
						t = 'Auto';
					break;
					case 2:
						t = 'Camioneta';
					break;

				}
				return t;
			}}, 
			{"data": "tarifa", "render" : function(data) { return "$ "+data+".00"; }}, 
			{"data": "fingreso"},
			{"data": "estadia"}, 
			{"data": "estado"},
			{"defaultContent": "<button type='button' class='editar btn btn-primary' data-toggle='modal' data-target='#editar-vehiculo' data-backdrop='true'><li class='glyphicon glyphicon-pencil'></li> </button> <button type='button' class='checkout btn btn-success'><li class='glyphicon glyphicon-ok'></li>  </button>"}
		],
		"aoColumnDefs": [{'bSortable': false, 'aTargets': [7]}]
		,
		"language": {
			"url": "./assets/js/Spanish.json"
		},
		"order": [
					[0, "desc"]
				]		
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
/*
function TraerVehiculos() {
	var datos = new FormData();
	datos.append('action', 'listVehiculos');
	$.ajax({
		url: 'Proxy.php',
		type: 'post',
		data: datos,
		processData: false,
		contentType: false,
		cache: false,
		dataType: 'json',
		beforeSend: function() {
			//console.log('Enviando...');
		},
		success: function(data) {
			//console.log('sdfsdf');
			//alert(JSON.stringify(data));
			$("#resumen > tbody").empty();
			var tam = data.length;
			var vehiculo;
			//alert(tam);
			for (var i = 0; i < tam; i++) {
				vehiculo = data[i];
				var gen = '';
				switch (vehiculo.tipo) {
					case 0:
						gen = 'Moto';
						break;
					case 1:
						gen = 'Auto';
						break
					default:
						gen = 'Camioneta';
						// statements_def
						break;
				}
				var estado = (vehiculo.estado == 1) ? 'Esta' : 'No esta';
				$('#resumen tbody').append('<tr><td>' + (vehiculo.vehiculoId) + '</td><td>' + vehiculo.patente + '</td><td>' + gen + '</td><td>' + vehiculo.tarifa + '</td><td>' + vehiculo.fingreso + '</td><td>' + vehiculo.estadia + '</td><td>' + estado + '</td><td class="col-md-1 text-center"><a href="#" class="editar" onclick="Modificar(' + vehiculo.vehiculoId + ')"><span class="glyphicon glyphicon-edit"></span></a></td><td class="col-md-1 text-center"><a href="#" class="eliminar" onclick="Eliminar(' + vehiculo.vehiculoId + ')"><span class="glyphicon glyphicon-remove"></span></a></td></tr>');				

			}
			$('#resumen').DataTable({
				"destroy" : true,
				"order": [
					[0, "desc"]
				],
				"language": {
					"url": "./assets/js/Spanish.json"
				}
			});
		},
		complete: function()
		{
			
		}
	});

} 

function Eliminar(id)
{
	swal({
		  title: "Estas seguro?",
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
		    var	indice = id;
			//console.log(indice);
			var datos = new FormData();
			datos.append('action', 'sacVehiculo')
			datos.append('vehiculoId', indice);
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
				//$('#resumen').fnDestroy();
				$('#resumen tbody').children('tr').remove();				
				TraerVehiculos();
			}
			});
			swal("Hecho!", "Se marcó la salida correctamente.", "success");
		  } else {
			    swal("Cancelado", "No hubo cambios.", "error");
		  }
		});	
}
*/