<?php
$BASE = '../';
include($BASE . 'init.php');
if(isset($_POST['accio']) && $_POST['accio'] == "login") {
	$_SESSION['admin'] = array(
		'nom_complet'=>'Administrador', 
		'email' => $_POST['usuari'], 
		'contrasenya' => md5($_POST['contrasenya'])
		);
	
	$usuari = array('usuari' => $_POST['usuari'], 'contrasenya'=> $_POST['contrasenya']);
	setcookie('usuari',$usuari['usuari'] . '-' . $usuari['contrasenya'],time()+60*60*24*365);
	
	header('Location: index.php');
    exit;
}

// template
$pageTitle = 'LOGIN - ENTRAR';
?>
<!DOCTYPE html>  
<html lang="en">
<head>
<meta charset="ISO-8859-15">
    
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<link rel="icon" type="image/png" sizes="16x16" href="plugins/images/favicon.png">
<title><?= $pageTitle ?></title>
<!-- Bootstrap Core CSS -->
<link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- animation CSS -->
<link href="css/animate.css" rel="stylesheet">
<!-- Custom CSS -->
<link href="css/style.css" rel="stylesheet">
<!-- color CSS -->
<link href="css/colors/default.css" id="theme"  rel="stylesheet">
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

</head>
<body>
<!-- Preloader -->
<div class="preloader">
  <div class="cssload-speeding-wheel"></div>
</div>
<section id="wrapper" class="new-login-register">
      
      <div class="new-login-box" style="margin: 0px auto; margin-top: 10%;">
                <div class="white-box">
                    <h3 class="box-title m-b-0">Administraci&oacute;</h3>

                  <form class="form-horizontal new-lg-form" id="loginform" action="" method="post">
                    <input type="hidden" name="accio" value="login" />
                    
                    <div class="form-group  m-t-20">
                      <div class="col-xs-12">
                        <label>Usuari</label>
                        <input class="form-control" type="text" required="" name="usuari" placeholder="Username">
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-xs-12">
                        <label>Contrasenya</label>
                        <input class="form-control" type="password" name="contrasenya" required="" placeholder="Password">
                      </div>
                    </div> 
                    <div class="form-group text-center m-t-20">
                      <div class="col-xs-12">
                        <button class="btn btn-info btn-lg btn-block btn-rounded text-uppercase waves-effect waves-light" type="submit">Entrar</button>
                      </div>
                    </div>
                      
                  </form>
                   
                </div>
      </div>            
  
  
</section>
<!-- jQuery -->
<script src="plugins/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Menu Plugin JavaScript -->
<script src="plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>

<!--slimscroll JavaScript -->
<script src="js/jquery.slimscroll.js"></script>
<!--Wave Effects -->
<script src="js/waves.js"></script>
<!-- Custom Theme JavaScript -->
<script src="js/custom.min.js"></script>
<!--Style Switcher -->
<script src="plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
</body>
</html>
