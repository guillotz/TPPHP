<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Estacionamiento</title>
  
  <!-- jQuery -->
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
  <script src="https://code.jquery.com/jquery-3.1.1.js"></script>
  <link rel="stylesheet" type="text/css" href="./assets/dist/sweetalert.css">
  <script src="./assets/dist/sweetalert.min.js"></script>
  <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css'>
  <link rel="stylesheet" href="css/style.css">
<style>
  #avatar{
      width: 120px;
      height: 120px;
      margin: auto;
      border-radius: 35px;
      -webkit-border-radius: 35px;
      -moz-border-radius: 35px;
      background: url(./images/mem2.jpg) no-repeat;
  }
  .test-btn
  {
    background: #C9DA56;
  display: inline-block;
  width: 100%;
  font-size: 16px;
  height: 50px;
  color: #000;
  text-decoration: none;
  border: none;
  margin-top: 20px;
  -moz-border-radius: 4px;
  -webkit-border-radius: 4px;
  border-radius: 4px;
  }
  .test-btn:hover
  {
    cursor: pointer;
  }
</style>
  <script>
  $(document).ready(function() {
    $('#login').click(function(event) {
      /* Act on the event */
      event.preventDefault();
      //$('form').submit();
      EnviarLogin();

    });
  });
    function EnviarLogin() {
      var q = $.ajax({
        type: "POST",
        url: "nexoadministrador.php",
        data: {
          usuario: $("#username").val(),
          password: $("#password").val()
        },
        dataType: 'json',

        success: function(respuestaPHP) {
            if (respuestaPHP.success === "REGISTRADO") {
            swal({
              title: "Genial!",
              text: "Te has logueado. Redireccionando...",
              imageUrl: "./images/menem.jpg"
            });
            setTimeout(function(){
              window.location.href = 'paneladministrador.php';
            }, 2000);
            } else {
              swal({
              title: "Error! :(",
              text: "Usuario Incorrecto.",
              imageUrl: "./images/menem2.jpg"
            });
            }
          }
          //error:alert("no anda")
      });
    }

    function loginUser() {
      $("#username").val("user");
      $("#password").val("user");
    }

    function llenarAdmin() {
      $("#username").val("admin");
      $("#password").val("admin");
    }
  </script>
</head>

<body>
  <div class="login-form">
     <h1><div id="avatar"></div></h1>
     <div class="form-group ">
     <form>
       <input type="text" class="form-control" placeholder="Usuario" id="username" required="true">
       <i class="fa fa-user"></i>
     </div>
     <div class="form-group log-status">
       <input type="password" class="form-control" placeholder="Contraseña" id="password" required="true">
       <i class="fa fa-lock"></i>
     </div>
      <span class="alert"></span>
     <button type="submit" name="login" class="log-btn" id="login" style="cursor: pointer">Ingresar</button>
     </form>
     <br>
     <button id="test-user" class="test-btn" onclick="loginUser()">Test Usuario</button>
     <br>
     <button id="test-admin" class="test-btn" onclick="llenarAdmin()">Test Admin</button>
     
    
   </div>

</body>
</html>
