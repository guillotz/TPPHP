<?php
require_once("clases/AccesoDatos.php");

class estacionados
{
	public $patente;
	public $ingreso;

	public static function TraerTodosLosEstacionados()
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("select * from autos");
		$consulta->execute();			
		$arrHistorial= $consulta->fetchAll(PDO::FETCH_CLASS, "estacionados");	
		return $arrHistorial;
	}

	public static function ConstruirTabla()
	{
		$ArrayDePersonas = estacionados::TraerTodosLosEstacionados();

		$tabla= "<table class='table table-hover table-responsive'>
				<thead>
					<tr>
						<th>  Patente   </th>
						<th>  Ingreso   </th>				
					</tr> 
				</thead>";   	

			foreach ($ArrayDePersonas as $personaAux)
			{
				$tabla.= " 	<tr>
							<td>".$personaAux->patente."</td>
							<td>".$personaAux->ingreso."</td>
						</tr>";
			}	
		$tabla.= "</table>";

		return $tabla;
	}
}


?>