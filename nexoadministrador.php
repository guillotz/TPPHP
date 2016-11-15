<?php
	session_start();
	require ("Clases/AccesoDatos.php");
	require_once("Clases/autos.php");

	if (!isset($_SESSION['usuario']))
	{
		if (isset($_POST['usuario']) && isset($_POST['password']))
		{
			
				$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
				$consulta = $objetoAccesoDato->RetornarConsulta
				("
				select * 
				from usuarios
				where nombre = :nombre
				and password = :pass
				");
				$consulta->bindValue(':nombre',$_POST['usuario'],PDO::PARAM_STR);
				$consulta->bindValue(':pass',$_POST['password'],PDO::PARAM_STR);
				$consulta->execute();
				$devolucion = $consulta->fetchAll();
				

				if ($devolucion == FALSE)
				{
					echo "NO REGISTRADO";
				}
				else
				{
					$_SESSION['usuario']=$devolucion[0]['nombre'];
					$_SESSION["id"]=$devolucion[0]['id'];
					$_SESSION['admin']=$devolucion[0]['admin'];
					echo "REGISTRADO";	
				}
		}
		else
		{
			header("location: index.html");
			exit;
		}
	}
	else
	{
		if(isset($_POST['cargar']))
		{
			if(isset($_POST['patente']))
			{
				if (strlen($_POST['patente']) != 6)
				{
					echo "Patente invalida";
					exit;
				}
				
				 $letras = substr($_POST['patente'], 0,3);
				 $numeros = substr($_POST['patente'], 3,3);

				 if (!is_string($letras) || !is_numeric($numeros))
				 {
				 	echo "Pone bien los dedos";
				 	exit;
				 }
			 
				$fechain=time();

				$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
				$consulta =$objetoAccesoDato->RetornarConsulta
				("
					INSERT INTO autos(pat,ingreso)															 
					value(:pat,:fecha)
				");
				$consulta->bindValue(':pat',$_POST['patente'],PDO::PARAM_STR);
				$consulta->bindValue(':fecha',$fechain,PDO::PARAM_INT);
				if ($consulta->execute() == true)
				{
					echo "alta ok";
				}else
				{
					echo "alta error";
				}
			}
		}
		else
		{
			if(isset($_POST['patente']))
			{
				
				$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
				$consulta =$objetoAccesoDato->RetornarConsulta
				("
					select * from autos where pat = :pat
				");
				$consulta->bindValue(':pat',$_POST['patente'],PDO::PARAM_STR);
				$consulta->execute();
				$rta = $consulta->fetch();

				if ($rta != FALSE)
				{
					$salio = time();
					$consulta=$objetoAccesoDato->RetornarConsulta
					("
						INSERT into salio(fechaIn,fechaOut,pat)
						value(:fechain,:fechaout,:patente)
					");

					$consulta->bindValue(':fechain',$rta["ingreso"],PDO::PARAM_INT);
					$consulta->bindValue(':fechaout',$salio,PDO::PARAM_INT);
					$consulta->bindValue(':patente',$_POST['patente'],PDO::PARAM_STR);
					if($consulta->execute())
					{
						$elimino=$objetoAccesoDato->RetornarConsulta
						("
							DELETE from autos where pat = :pat
						");
						$elimino->bindValue(':pat',$_POST['patente'],PDO::PARAM_STR);
						if($elimino->execute())
						{
							echo "Salida ok";
							exit;
						}

					}

				}
				echo "La patente no se encuentra";
				if ($consulta->execute() == true)
				{
					echo "alta ok";
				}else
				{
					echo "alta error";
				}
			}
		}
		if (isset($_GET['tabla']))
		{
			echo Auto::MostrarTablaEstacionados();
		}
		if(isset($_GET['tabla2']))
		{
			echo Auto::MostrarTablaSalida();
		}
		if(isset($_GET['logout']))
		{
			session_unset();
			session_destroy();
			header("location:index.html");
		}
	}
?>