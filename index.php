
<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  
  <title>Chatbot System System</title>
  <link rel="shortcut icon" href="img/logo.png" />
  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-l.min.css" rel="stylesheet">

</head>

<body class="" style="background-color:rgba(0,128,0,.8);height:-webkit-fill-available;">
<div>
    <!-- Bootstrap core JavaScript-->
    <script src="js/jquery.min.js"></script>
    <script src="./js/core/popper.min.js" type="text/javascript"></script>
  <script src="./js/bootstrap.min.js" type="text/javascript"></script> 
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="./js/login.js" type="text/javascript"></script>
  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>
  <div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-6 col-lg-6 col-md-6">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              
              <div class="col-lg-12">
              <br> 
              <div class="text-center"> 
              <img src="./img/logo.png" style="width: 70%">
               </div>
               
                <div style="padding:2% 10% 5% 10%;">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Bienvenido!</h1>
                  </div>
                  <form class="user" action="process/login.php" method="post" id="login-form">
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" id="exampleInputEmail" name="user" aria-describedby="emailHelp" placeholder="Ingrese su correo o nombre de usuario" required>
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" id="exampleInputPassword" name="password"  placeholder="Ingrese su contraseña" required>
                    </div>
                     <!--<div class="form-group">
                     <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Recordarme</label>
                      </div>
                    </div>-->
                    <button type="submit" id="acceder" style="background-color:rgba(0,128,0,.8);" class="btn btn-success btn-user btn-block">
                      Login
                     </button>
                    </form>
                    <div id="accediendo"></div>
                  <hr>
                  <div class="text-center">
                    <!--<a class="small" href="recupera.php">¿Se te olvidó tu contraseña?</a>-->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>
</div>
</body>

</html>
