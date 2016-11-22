<?php 
	session_start();
	if(!isset($_SESSION))
	{
		header("Location: index.html");
	}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Estacionamiento</title>
	<!-- jQuery -->
	<script src="https://code.jquery.com/jquery-3.1.1.js"></script>
	<!-- Bootstrap -->
	<link rel="stylesheet" href="normalize.css">
	<link rel="stylesheet" href="./assets/css/bootstrap.min.css">
	<script type="text/javascript" src="./assets/js/bootstrap.min.js"></script>
	<!-- Font -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:500|Ubuntu" rel="stylesheet">
	<!-- SweetAlert -->
	<link rel="stylesheet" type="text/css" href="./assets/dist/sweetalert.css">
	<script src="./assets/dist/sweetalert.min.js"></script>
	<!-- Ajax -->
	<script src="ajax.js"></script>
	<style>
	body {
		background-color: #4E9DF5;
	}
		#top
		{
			height: 80px;
			background-color: #4F5BF6;
			display: flex;
			align-items: center;
			justify-content: center;			
		}
		#top h1
		{
			font-family: "Roboto";
			color: black;
		}
		#avatar-container
		{
			align-items: center;
			justify-content: center;
			text-decoration: none;
		}
		#avatar
		{
			width: 190px;
			height: 190px;
			margin: auto;
			border-radius: 80px;
			-webkit-border-radius: 80px;
			-moz-border-radius: 80px;
			background: url(./images/menem3.jpg) no-repeat;
		}
	</style>
	  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	  <script>
	  $(document).ready(function() {
	  	$("#tabs").tabs();
	  	$("#btn-ing-patente").click(function(event) {
	  		/* Act on the event */
	  		event.preventDefault();
	  	});
	  });
	  </script>
</head>
<body>
<div id="top">
	<h1>Estacionamiento "El Turco"</h1>
</div>
	<div class="container">
		<div class="row"><strong>BIENVENIDO <?php echo strtoupper($_SESSION['usuario']);  ?></strong></div>
		<div class="pull-right"><a href="./logout.php" style="text-decoration: none"><button class="btn btn-info">Cerrar Sesion</button></a></div>
		<div id="avatar-container"class="text-center"><a href="./logout.php"><div id="avatar"></div></a></div>
	</div>	
	<div class="container">
		<div id="tabs">
		  <ul>
		    <li><a href="#tabs-1">Estacionados</a></li>
		    <li><a href="#tabs-2">Salidos y Montos</a></li>
		    <?php  if($_SESSION['admin'] == 1) echo '<li><a href="#tabs-3">Usuarios</a></li>'; ?>
		  </ul>
  <div id="tabs-1">
  <div class="container row">
   <form class="form-inline" id="form-ingresar-patente" autocomplete="off" style="margin:auto">
  <div class="form-group">
    <label for="pating"></label>
    <input type="text" class="form-control" id="pating" required="true" minlength="5">
  </div>
  <button id="btn-ing-patente" onclick="CargarPatente()" class="btn btn-default">Ingresar Patente</button>
  <br><br>
</form>
  </div>
    <table class="table table-bordered">
    	<thead>
    		<th class="text-center">Patente</th>
    		<th class="text-center">Ingreso</th>
    		<th class="text-center">Accion</th>
    	</thead>
    	<tbody class="text-center">
    		<?php 
    			require_once './Clases/autos.php';
    			$datos = Auto::TraerAutosEstacionados();
    			foreach ( $datos as $auto ) 
    			{
    				echo '<tr><td><label class="label label-info">'.strtoupper($auto["pat"]).'</label></td><td><label class="label label-default">'.date("Y-m-d H:i:s",$auto["ingreso"]).'</label></td><td><button class="btn btn-danger" onclick="SacarPatente(\''.$auto["pat"].'\')">Salida</button></td></tr>';
    			}
    		?>
    	</tbody>
    </table>
  </div>
  <div id="tabs-2">
    <table class="table table-bordered text-center">
    	<thead class="text-center">
    		<th class="text-center">Patente</th>
    		<th class="text-center">Entrada</th>
    		<th class="text-center">Salida</th>
    		<th class="text-center">Cobrado</th>
    	</thead>
    	<tbody>
    		<?php 

    		$salida = Auto::TraerAutosSalida();

			foreach ($salida as $value) 
			{
				$esta = $value["fechaOut"] - $value["fechaIn"];


				 echo "<tr><td><label class='label label-info'>".strtoupper($value["pat"])."</label></td><td>".date("Y-m-d H:i:s",$value["fechaIn"])."</td><td>".date("Y-m-d H:i:s",$value["fechaOut"])."</td><td> $ ".$value["cobrado"].".00 </td></tr>";
			}
    		?>
    	</tbody>
    </table>
  </div>
  <?php 
  	if($_SESSION['admin'] == 1)
  	{
  		require './Clases/usuario.php';
  		echo '<div id="tabs-3">

			    <table class="table table-bordered text-center">
    			<thead>
    		<th class="text-center">ID</th>
    		<th class="text-center">Nombre</th>
    		<th class="text-center">Tipo</th>
    			</thead>
    			<tbody>';

    		//echo $_SESSION['admin'];

    		$usuarios = Usuario::TraerUsuarios();

			foreach ($usuarios as $value) 
			{
				$tipo = ($value['admin'] == 1) ? '<label class="label label-warning"> Administrador </label>' : '<label class="label label-success"> Usuario </label>';
				echo '<tr><td>'.$value['id'].'</td><td>'.$value['nombre'].'</td><td>'.$tipo.'</td></tr>';
			}
    		echo '
    	</tbody>
    	</table>
  		</div>';
	} ?>
</div>
	</div>
</body>
</html>