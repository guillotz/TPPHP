<?php
include("clases/AccesoDatos.php");

class vehiculo
{
	public $id;
	public $patente;
	public $ingreso;

	public function __construct($id, $patente, $ingreso)
	{
		$this->id=$id;
		$this->patente=$patente;
		$this->ingreso=$ingreso;
	}

	public static function ingresar($patente)
	{
		$ingreso=date("Y-m-d H:i:s");

		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("
			INSERT into 
			autos (patente,ingreso)
			values(:patente,:ingreso)"
			);
		$consulta->bindValue(':patente',$patente, PDO::PARAM_STR);
		$consulta->bindValue(':ingreso',$ingreso, PDO::PARAM_STR);
		$consulta->execute();
		return $objetoAccesoDato->RetornarUltimoIdInsertado();
	}

	public static function registrar($patente, $tiempo, $monto)
	{
		$dia=date("Y-m-d H:i:s");

		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("
			INSERT into 
			historial (patente,tiempo,monto,dia)
			values(:patente, :tiempo, :monto, :dia)"
			);
		$consulta->bindValue(':patente',$patente, PDO::PARAM_STR);
		$consulta->bindValue(':tiempo',$tiempo, PDO::PARAM_INT);
		$consulta->bindValue(':monto',$monto, PDO::PARAM_INT);
		$consulta->bindValue(':dia',$dia, PDO::PARAM_STR);		
		$consulta->execute();
		return $objetoAccesoDato->RetornarUltimoIdInsertado();
	}

	public static function retirar($patente)
	{
		$dia=date("Y-m-d H:i:s");

		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("
			DELETE
			from autos
			where patente = :patente"
			);
		$consulta->bindValue(':patente',$patente, PDO::PARAM_STR);	
		$consulta->execute();
		return $objetoAccesoDato->RetornarUltimoIdInsertado();
	}

	public static function TraerUnVehiculo($patente)
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("
			select * 
			from autos 
			where patente = :patente" 
			);
		$consulta->bindValue(':patente',$patente, PDO::PARAM_STR);
		$consulta->execute();
		$resultado = $consulta->fetchAll();
		$auto = new vehiculo($resultado[0]['id'], $resultado[0]['patente'],$resultado[0]['ingreso']);
		return $auto;
		//return $resultado;
	}


	public static function TraerTodosLosVehiculos()
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("select * from autos");
		$consulta->execute();			
		$arrAutos= $consulta->fetchAll(PDO::FETCH_CLASS, "vehiculo");	
		return $arrAutos;
	}

}

?>