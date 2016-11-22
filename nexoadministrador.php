<?php
date_default_timezone_set('America/Argentina/Buenos_Aires');
	session_start();
	require ("Clases/AccesoDatos.php");
	require_once("Clases/autos.php");

	
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
					$data['success'] = "NO REGISTRADO";
					echo json_encode($data);
					die();
				}
				else
				{
					//session_start();
					$_SESSION['usuario']=$devolucion[0]['nombre'];
					$_SESSION["id"]=$devolucion[0]['id'];
					$_SESSION['admin']=$devolucion[0]['admin'];
					$data['success'] = "REGISTRADO";
					echo json_encode($data);
					die();
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
					$data['error'] = "Patente invalida";
					echo json_encode($data);
					die();
				}

				 if (!ValidarPatente($_POST['patente']))
				 {
				 	$data['error'] = "Pone bien los dedos";
				 	echo json_encode($data);
				 	die();
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
					$data['success'] = "ok";
					echo json_encode($data);
				}else
				{
					$data['error'] = "error";
					echo json_encode($data);
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
					$d1 = $rta["ingreso"];

							$d1 = date("Y-m-d H:i:s",$d1);
							$d2 = date("Y-m-d H:i:s",$salio);


							$t1 = StrToTime ( $d2 );
							$t2 = StrToTime ( $d1 );
							$diff = $t1 - $t2;
							$horas = $diff / ( 60 * 60 );

					$consulta=$objetoAccesoDato->RetornarConsulta
					("
						INSERT into salio(fechaIn,fechaOut,pat, cobrado)
						value(:fechain,:fechaout,:patente, :cobrado)
					");

					$consulta->bindValue(':fechain',$rta["ingreso"],PDO::PARAM_INT);
					$consulta->bindValue(':fechaout',$salio,PDO::PARAM_INT);
					$consulta->bindValue(':patente',$_POST['patente'],PDO::PARAM_STR);
					$consulta->bindValue(':cobrado', round(ceil($horas) * 10), 2);
					if($consulta->execute())
					{
						$elimino=$objetoAccesoDato->RetornarConsulta
						("
							DELETE from autos where pat = :pat
						");
						$elimino->bindValue(':pat',$_POST['patente'],PDO::PARAM_STR);
						if($elimino->execute())
						{
							
							$data['success'] = "ok";
							$data['horas'] = ceil($horas);
							$data['costo'] = ceil($horas) * 10;
							echo json_encode($data);
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
			header("location:index.php");
		}
	}


	function ValidarPatente($mipatente)
	{
		return (preg_match("/([a-zA-Z]{3})([0-9]{3})/",$mipatente) === 1) ? true : false;
	}