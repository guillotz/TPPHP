<?php
	require_once('clases/historial.php');

	session_start();
	if (!isset($_SESSION['usuario']))
	{
	  header("Location: index.html");
	  exit;
	}

	$ArrayDePersonas = historial::TraerTodosLosMontos();

	echo "<table class='table table-hover table-responsive'>
			<thead>
				<tr>
					<th>  Patente   </th>
					<th>  Tiempo   </th>				
					<th>  Monto     </th>
					<th>  Dia   </th>
				</tr> 
			</thead>";   	

		foreach ($ArrayDePersonas as $personaAux)
		{
			echo " 	<tr>
						<td>".$personaAux->patente."</td>
						<td>".$personaAux->tiempo."</td>
						<td>".$personaAux->monto."</td>
						<td>".$personaAux->dia."</td>
					</tr>";
		}	
	echo "</table>";	
//var_dump($ArrayDePersonas);


?>