<?php
require_once("clases/AccesoDatos.php");

class usuario
{
	public $usuario;
	public $pass;
	public $administrador;

	public static function login($usuario, $pass)
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("
				select * 
				from login 
				where usuario = :usuario 
				and 
				pass = :pass" 
				);
			$consulta->bindValue(':usuario',$usuario, PDO::PARAM_STR);
			$consulta->bindValue(':pass',$pass, PDO::PARAM_STR);
			$consulta->execute();
			$resultado = $consulta->fetchAll();
			return $resultado;
	}

	public static function TraerTodosLosUsuarios()
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("select * from login");
		$consulta->execute();			
		$arrHistorial= $consulta->fetchAll(PDO::FETCH_CLASS, "usuario");	
		return $arrHistorial;
	}

	public static function ConstruirTabla()
	{
		$ArrayDePersonas = usuario::TraerTodosLosUsuarios();

		$tabla= "<table class='table table-hover table-responsive'>
				<thead>
					<tr>
						<th>  Usuario   </th>
						<th>  Password   </th>				
						<th>  Admin     </th>
					</tr> 
				</thead>";   	

			foreach ($ArrayDePersonas as $personaAux)
			{
				if ($personaAux->admin==1)
				{
					$tipo="administrador";
				}
				else
				{
					$tipo="usuario";
				}
				$tabla.= " 	<tr>
							<td>".$personaAux->usuario."</td>
							<td>".$personaAux->pass."</td>
							<td>".$tipo."</td>
						</tr>";
			}	
		$tabla.= "</table>";

		return $tabla;
	}
}


?>
