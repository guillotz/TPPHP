<?php 
session_start();

require_once("clases/vehiculo.php");
require_once("clases/usuario.php");
require_once("clases/historial.php");
require_once("clases/estacionados.php");

if (isset($_POST['boton']))
{
	if ($_POST['boton']=="ingresar")
	{
		
		if ($_POST['patente']=="")
		{
			echo("vacio");
			return true;
		}

		$auto=vehiculo::TraerUnVehiculo($_POST['patente']);

		if ($auto->id==NULL)
		{
			echo ("ingresar");
			vehiculo::ingresar($_POST['patente']);
			//////////para cargar varios autos a la base
			/*
			for ($i=0; $i < 1000; $i++)
			{ 
				$random=rand(101,999);
				$patente="grd".$random;
				vehiculo::ingresar($patente);
			}
			*/
			
		}
		else
		{
			//echo("cobrar");
			$horas=(strtotime('now') - strtotime($auto->ingreso))/60/60 ;
			//var_dump($horas);ç
			$monto=CalcularMonto($horas);
			vehiculo::registrar($_POST['patente'],$horas,$monto);
			vehiculo::retirar($_POST['patente']);
			//var_dump($monto);
			echo($monto);

			/////////para cargar varias operaciones a la base (solo ingresar las 3 letras de la patente)
			/*
			for ($i=0; $i < 20; $i++)
			{ 
				$randomH=rand(1,11);
				$randomP=rand(100,999);
				$monto=CalcularMonto($randomH);
				$patente=$_POST['patente'].$randomP;
				vehiculo::registrar($patente,$randomH,$monto);
			}*/
			
		}

		//var_dump(vehiculo::TraerUnVehiculo($_POST['patente']));	

		//vehiculo::BuscarUnVehiculo($_POST['patente']);
		;
	}

	else if ($_POST['boton']=="login")
	{
		$devolucion=usuario::login($_POST['usuario'], $_POST['pass']);

		if ($devolucion!=false)
		{
			$_SESSION['usuario']=$devolucion[0]['usuario'];
			$_SESSION['admin']=$devolucion[0]['admin'];			
			//var_dump($_SESSION);
			echo("ok");
		}
		else
		{
			echo("error");
		}
		
	}

	elseif ($_POST['boton']=="tabla") 
	{
		echo(historial::ConstruirTabla()) ;
	}

	elseif ($_POST['boton']=="estacionados") 
	{
		echo(estacionados::ConstruirTabla()) ;
	}

	elseif ($_POST['boton']=="tablaUsuarios") 
	{
		echo(usuario::ConstruirTabla()) ;
	}

	else if ($_POST['boton']=="salir")
	{
		session_unset();
		session_destroy();
		echo "salir";
	}
}

function CalcularMonto($horas)
{
	$monto=10;
	if ($horas > 0 && $horas <= 1)
	{
		return $monto;
	}
	elseif ($horas > 1 && $horas <= 2)
	{
		return $monto*2;
	}
	elseif ($horas > 2 && $horas <= 3)
	{
		return $monto*3;
	}
	elseif ($horas > 3 && $horas <= 4)
	{
		return $monto*4;
	}
	elseif ($horas > 4 && $horas <= 5)
	{
		return $monto*5;
	}
	elseif ($horas > 5 && $horas <= 6)
	{
		return $monto*6;
	}
	elseif ($horas > 6 && $horas <= 7)
	{
		return $monto*7;
	}
	elseif ($horas > 7 && $horas <= 8)
	{
		return $monto*8;
	}
	elseif ($horas > 8)
	{
		return $monto*10;
	}
}

?>