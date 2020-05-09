<?php

$pagina = explode(".", basename($_SERVER['PHP_SELF']));
$pagina = $pagina[0];

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="ISO-8859-15">
    <title><?= $pageTitle ?> - Administración</title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="js/vendors/select2/css/select2.css"  />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/backend.css" />

    <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>
<body>


<div class="container">
  