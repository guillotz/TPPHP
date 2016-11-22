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
			{"data": "codigo", "render": function(data){ idV = data; return data}}, 
			{"data": "nombre"},
			{"data": "porcentaje"},
			{"defaultContent": "<button type='button' class='checkout btn btn-success'><li class='glyphicon glyphicon-trash'></li> </button>"}
		],
		"language": {
			"url": "./assets/js/Spanish.json"
		},
		"aoColumnDefs": [{'bSortable': false, 'aTargets': [3]}]
				
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

		$('#form-editar-producto input#nombre').val(patente);
		$('#form-editar-producto input#porcentaje').val(estadia);
		$('#form-editar-producto input#idv').val(id);

		$('#form-editar-producto').on('submit', function(event) {
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
		var id = data.codigo;
		swal({
		  title: "Aviso",
		  text: "Se borrará el producto.",
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
			datos.append('action', 'borrarProducto')
			datos.append('id', id);
			$.ajax({
			url: 'nexo.php',
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
			swal("Hecho!", "Se ha borrado el producto.", "success");
		  } else {
			    swal("Cancelado", "No hubo cambios.", "error");
		  }
		});	
	});
}