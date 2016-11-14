<?php
require_once("clases/AccesoDatos.php");

class historial
{
	public $patente;
	public $tiempo;
	public $monto;
	public $dia;

	public static function TraerTodosLosMontos()
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("select * from historial");
		$consulta->execute();			
		$arrHistorial= $consulta->fetchAll(PDO::FETCH_CLASS, "historial");	
		return $arrHistorial;
	}

	public static function ConstruirTabla()
	{
		$ArrayDePersonas = historial::TraerTodosLosMontos();

		$tabla= "<table class='table table-hover table-responsive'>
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
				$tabla.= " 	<tr>
							<td>".$personaAux->patente."</td>
							<td>".$personaAux->tiempo."</td>
							<td>".$personaAux->monto."</td>
							<td>".$personaAux->dia."</td>
						</tr>";
			}	
		$tabla.= "</table>";

		return $tabla;
	}
}


?>