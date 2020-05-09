<?php

$pagina = explode(".", basename($_SERVER['PHP_SELF']));
$pagina = $pagina[0];

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />

    <title><?= $pageTitle ?> - Administración</title>
    <!-- Bootstrap Core CSS -->
    <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- This is Sidebar menu CSS -->
    <link href="plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
    <!-- This is a Animation CSS -->
    <link href="css/animate.css" rel="stylesheet">
    <!-- This is a Custom CSS -->
 
    <!-- page CSS -->
    <link href="plugins/bower_components/summernote/dist/summernote.css" rel="stylesheet" />

    <link href="plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
    <link href="plugins/bower_components/custom-select/custom-select.css" rel="stylesheet" type="text/css" />
    <link href="plugins/bower_components/switchery/dist/switchery.min.css" rel="stylesheet" />
    <link href="plugins/bower_components/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
    <link href="plugins/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.css" rel="stylesheet" />
    <link href="plugins/bower_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />
    <link href="plugins/bower_components/multiselect/css/multi-select.css" rel="stylesheet" type="text/css" />

    <link href="plugins/bower_components/clockpicker/dist/jquery-clockpicker.min.css" rel="stylesheet">
    <!-- Color picker plugins css -->
    <link href="plugins/bower_components/jquery-asColorPicker-master/css/asColorPicker.css" rel="stylesheet">
    <!-- Date picker plugins css -->
    <link href="plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
    <!-- Daterange picker plugins css -->
    <link href="plugins/bower_components/timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
    <link href="plugins/bower_components/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">




    <link href="css/style.css" rel="stylesheet">
    <!-- color CSS you can use different color css from css/colors folder -->
    <!-- We have chosen the skin-blue (default.css) for this starter
         page. However, you can choose any other skin from folder css / colors .
    -->
    <link href="css/colors/blue-dark.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


    <style type="text/css">
        body { background-color: #edf1f5; }
    </style>
</head>
 


<body class="fix-header">

<div class="main">
    
