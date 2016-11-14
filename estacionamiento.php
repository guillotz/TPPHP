<?php
session_start();
if (!isset($_SESSION['usuario']))
{
  header("Location: index.html");
  exit;
}
?>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>GESTION ESTACIONAMIENTO</title>
  <link rel="stylesheet" href="css/style2.css">
  <link rel="stylesheet" href="css/buttons.css">

  <script src="./dist/sweetalert-dev.js"></script>
  <link rel="stylesheet" href="./dist/sweetalert.css">

  <script src="funciones.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

  <style>
  table, th, td {
      border: 1px solid black;
      border-collapse: collapse;
      padding: 4px;
      text-align: center;
      background: #eee;
      background: rgba(250, 250, 250, 0.8);
      border-radius: 4px;
      background-image: -webkit-linear-gradient(top, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.1));
      background-image: -moz-linear-gradient(top, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.1));
      background-image: -o-linear-gradient(top, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.1));
      background-image: linear-gradient(to bottom, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.1));
       -webkit-box-shadow: inset 0 1px rgba(255, 255, 255, 0.3), inset 0 0 0 1px rgba(255, 255, 255, 0.1), 0 0 6px rgba(0, 0, 0, 0.2);
        box-shadow: inset 0 1px rgba(255, 255, 255, 0.3), inset 0 0 0 1px rgba(255, 255, 255, 0.1), 0 0 6px rgba(0, 0, 0, 0.2);
  }
  </style>

</head>
<body>
  <section class="container">
 <div class="shadow-forms">
  <div class="message warning">
  <div class="login-head">
       
    <button type="button" class="round medium green button" onclick="salir()">Logout</button>

      <form onsubmit="return false" >
        <p><input type="text" name="patente" id="patente" placeholder="Ingrese Patente"></p>
        <br>
        <button type="button" class="round medium blue button" onclick="ingresar()">Gestionar</button>
        <button type="button" class="round medium blue button" onclick="estacionados()">Estacionados</button>
        <?php
          if ($_SESSION['admin']==1)
          {
            echo('<button type="button" class="round medium purple button" onclick="tabla()">Recaudacion</button>');
            echo('<button type="button" class="round medium purple button" onclick="tablaUsuarios()">Usuarios</button>');
          }
        ?>
      </form>
          <div id="tabla">
            <?php
              //include("grilla.php");
            ?>
          </div>
    </div>

  </section>


</body>
</html>
