<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Begeeb | Your shopping friend</title>
    <link rel="shortcut icon" href="<?php echo SITE_URL; ?>images/favicon.ico" type="image/x-icon">
    <!-- Bootstrap -->
    <link href="<?php echo SITE_URL; ?>css/bootstrap.min.css" rel="stylesheet">
    <!-- custom css -->
    <link rel="stylesheet" href="<?php echo SITE_URL; ?>css/simple-line-icons.css">
    <link rel="stylesheet" href="<?php echo SITE_URL; ?>css/font-awesome.min.css">
    <link href="<?php echo SITE_URL; ?>css/style.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="<?php echo SITE_URL; ?>css/custom.css">
    <!-- fonts -->
    <link href='https://fonts.googleapis.com/css?family=Oswald:400,700,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,300,600,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <div id="wrapper" class="<?php if(!empty($wrapperClass))echo $wrapperClass;?>">
        <!-- Start Header -->
        <div id="header">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1><a href="#"><img src="<?php echo SITE_URL; ?>images/icons/Begeeb-50px.png" alt="Begeeb" /></a></h1>
                        <h2 class="menulink"><a href="#">Menu</a></h2>
                        <!-- Start Menu -->
                        <div id="menu">
                            <ul>
                            
                                <li <?php if(isset($wrapperClass) and $wrapperClass == "wrapper-flexi signup-page")echo '';elseif(isset($wrapperClass) and $wrapperClass == "wrapper-flexi login-page")echo '';else echo 'class="current"' ?> ><a href="<?php echo SITE_URL; ?>">Home</a></li>
                                <li><a href="<?php echo SITE_URL; ?>#how-it-works">How it works?</a></li>
                                <li <?php if(isset($wrapperClass) and $wrapperClass == "order-page")echo 'class="current"' ?>>
                                	<a href="<?php echo SITE_URL; ?>order.php">Track Order</a>
                                </li>
                                <li><a data-toggle="modal" data-target="#calculatorModal">Calculate cost</a></li>
                                
                                <?php if($user->isLoggedIn()): ?>
                                <li class="dropdown">
                                	<a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-haspopup="true" aria-expanded="false"><?php echo ucfirst($_SESSION['log_name']); ?> <span class="caret"></span></a>
                                	<ul class="dropdown-menu">
                                		<li><a href="<?php echo SITE_URL; ?>account/order-history.php">Your Orders</a></li>
                                		<li><a href="<?php echo SITE_URL; ?>account/profile.php">Your Profile</a></li>
                                		<li><a href="<?php echo SITE_URL; ?>logout.php">Logout</a></li>
                                	</ul>
                                </li>
                                <?php else: ?>
                                	<li <?php if(isset($wrapperClass) and $wrapperClass == "wrapper-flexi login-page")echo 'class="current"' ?>><a href="<?php echo SITE_URL; ?>login.php">Login</a></li>
                                <?php endif; ?>
                                <li class="current"><a data-toggle="modal" data-target="#calculatorModal">العربية</a></li>
                            </ul>
                        </div>
                        <!-- End Menu -->
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <!-- End Header -->