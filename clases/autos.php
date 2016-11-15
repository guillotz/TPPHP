<?php
require_once "AccesoDatos.php";
	class Auto
	{
		public static function TraerAutosEstacionados()
		{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
			$consulta = $objetoAccesoDato->RetornarConsulta
			("select * from autos LIMIT 5");
			$consulta->execute();
			return $consulta->fetchAll();			
		}
		public static function TraerAutosSalida()
		{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
			$consulta = $objetoAccesoDato->RetornarConsulta
			("
				select * from salio LIMIT 5
			");
			$consulta->execute();
			return $consulta->fetchAll();			
		}

		public static function MostrarTablaEstacionados()
		{
			$autos = Auto::TraerAutosEstacionados();

			$tabla="<table><caption>Estacionados</caption><tr><th>Patente</th><th>Ingreso</th></tr>";

			foreach ($autos as $value) 
				{
					$tabla.="<tr><td>".$value["pat"]."</td><td>".date("Y-m-d H:i:s",$value["ingreso"])."</td>";
				}
			$tabla.="</table>";

			return $tabla;			
		}

		public static function MostrarTablaSalida()
		{
			$salida = Auto::TraerAutosSalida();
			$tabla="<table><caption>Salida</caption><tr><th>Patente</th><th>Estadia</th><th>Monto</th></tr>";

			foreach ($salida as $value) 
			{
				$esta = $value["fechaOut"] - $value["fechaIn"];


				$tabla.="<tr><td>".$value["pat"]."</td>";
				$tabla.="<td>".ceil(($esta/60/60))."</td>";
				$tabla.="<td>".round(ceil($esta/60/60) * 30, 2)."</td></tr>";
			}
			$tabla.="</table>";

			return $tabla;
		}
	}	

?>