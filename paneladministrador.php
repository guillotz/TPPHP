
<html>
	<head>
	<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="ajax.js"></script>
	<script src="ajax.js"></script>
	<title>Panel Administrador</title>
	<meta charset="utf-8">
		<link href="css/style.css" rel='stylesheet' type='text/css' />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
		<!--webfonts-->
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:600italic,400,300,600,700' rel='stylesheet' type='text/css'>
		<style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}
</style>
	</head>
		<body>
			
			
				<div class="login-form">
					<div class="head">
						<img src="images/mem3.jpg" alt=""/>
						</div>
						<a href="nexoadministrador.php?logout">Cerrar Sesion</a>
						<form onsubmit = "return false">
							<input type="text" placeholder="Patente" id="texto_patente">
							<li></li>
							<input onclick="CargarPatente()" type="submit" value="Cargar Patente" id="carga_patente">
							<input type="submit" value="Sacar Patente" id="saca_patente" onclick="SacarPatente()">
						</form>

				
				<div id="tablausuarios">
					<?php
						include "/Clases/usuario.php";
						echo Usuario::TraerTablaUsuarios();
					?>
				</div>
				<div id="tablaEstacionados">
					<?php
					include "/Clases/autos.php";
					echo Auto::MostrarTablaEstacionados();
					?>
				</div>
				<div id="tablaSalida">
					<?php
					echo Auto::MostrarTablaSalida();
					?>
				</div>
			</div>
			

		</body>
</html>