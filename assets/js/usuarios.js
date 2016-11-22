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
	$('#form-alta-usuario').on('submit', function(event) {
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
			success: function(data) {
				if (typeof data.error === 'undefined') {
					$('#alta-usuario').modal('toggle');
					ListarVehiculos();
					swal("Completado!", "El registro se ha completado con éxito.", "success");
				} else {
					swal("Error", data.error , "error");
				}
			},
			complete: function()
			{
				$('#form-alta-usuario').reset();
			}
		});

	});

	ListarVehiculos();
	
	$('#btn-editar-usuario').click(function(event) {
		/* Act on the event */
		$('#editar-usuario').modal('toggle');	
	});

});

var ListarVehiculos = function() {
	var idV;
	var miTabla = $('#usuarioTab').DataTable({
		"destroy":true,
		"ajax": {
			"method": "POST",
			"url": "listaru.php"
		},
		"columns": [
			{"data": "usuarioId", "render": function(data){ idV = data; return data}}, 
			{"data": "nombre"},
			{"data": "documento"},
			{"data": "email"}, 
			{"data": "tipo",
			"render": function(data)
			{
				var t;
				tip = data;
				switch(data)
				{
					case 1:
						t = '<span class="label label-danger"> Administrador </span>';
					break;
					case 2:
						t = '<span class="label label-info"> Vendedor </span>';
					break;
					case 3:
						t = '<span class="label label-success"> Comprador </span>';
					break;

				}
				return t;
			}}, 
			{"defaultContent": "<button type='button' class='editar btn btn-primary' data-toggle='modal' data-target='#editar-usuario' data-backdrop='true'><li class='glyphicon glyphicon-pencil'></li> </button> <button type='button' class='checkout btn btn-success'><li class='glyphicon glyphicon-remove'></li>  </button>"}
		],
		"language": {
			"url": "./assets/js/Spanish.json"
		},
		"aoColumnDefs": [{'bSortable': false, 'aTargets': [5]}]
				
	});

	editarUsuario($('#usuarioTab tbody'), miTabla);
	eliminarUsuario($('#usuarioTab tbody'), miTabla);
}


var editarUsuario = function(tbody, table)
{
	$(tbody).on('click', 'button.editar', function(event) {
		event.preventDefault();
		/* Act on the event */
		var data = table.row($(this).parents("tr")).data();
		//console.log(data);
		var id = data.usuarioId, nombre = data.nombre, tipo = data.tipo, email = data.email,
		documento = data.documento;

		$('#form-editar-usuario input#nombre').val(nombre);
		$('#form-editar-usuario input#dni').val(documento);
		$('#form-editar-usuario input#email').val(email);
		//console.log(tipo);
		$('#form-editar-usuario select#tipo').val(tipo);

		$('#form-editar-usuario').on('submit', function(event) {
			event.preventDefault();
				
			var datos = new FormData(this);
			datos.append('id', id);			
			$.ajax({
			url: 'nexo.php',
			type: 'post',
			data: datos,
			processData: false,
    		contentType: false,
    		cache: false,
			dataType: 'json',
			success : function(data)
			{
				ListarVehiculos();				
			},
			complete: function()
			{
				$('#form-editar-usuario').reset();
			}
			});
		});
	});
}

var eliminarUsuario= function(tbody, table)
{
	$(tbody).on('click', 'button.checkout', function(event) {
		event.preventDefault();
		/* Act on the event */
		var data = table.row($(this).parents("tr")).data();
		//console.log(data);
		var id = data.usuarioId;
		swal({
		  title: "Aviso",
		  text: "Se eliminará el usuario",
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
			datos.append('action', 'eliminarUsuario')
			datos.append('id', id);
			$.ajax({
			url: 'nexo.php',
			type: 'post',
			data: datos,
			processData: false,
	    	contentType: false,
	    	cache: false,
			dataType: 'json',
			success : function(data)
			{
				ListarVehiculos();
			}
			});
			swal("Hecho!", "Se eliminó al usuario", "success");
		  } else {
			    swal("Cancelado", "No hubo cambios.", "error");
		  }
		});	
	});
}