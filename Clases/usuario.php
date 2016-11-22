<?php
require_once "AccesoDatos.php";

class Usuario
{

	public static function TraerUsuarios()
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
		$consulta = $objetoAccesoDato->RetornarConsulta
		("
		select * 
		from usuarios
		");
		$consulta->execute();
		return $consulta->fetchAll();
	}

	public static function TraerTablaUsuarios()
	{
		$usuarios = Usuario::TraerUsuarios();

		$tabla = '<table><caption>Usuarios</caption><tr><th>Usuario</th><th>Admin</th></tr>';

		foreach ($usuarios as $value) 
		{
			$tabla.="<tr><td>".$value["nombre"]."</td><td>".$value["admin"]."</td></tr>";
		}
		$tabla.="</table>";

		return $tabla;
	}
}
?>