<html>
<head>
	<title>Begeeb</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="stylesheet" type="text/css" href="style.css?v=1">
</head>
<body>
	<header class='top-header'>
		<span class='menu-m-show'>&ensp;</span>
		<span class='logo-m-wrap'><a href="index.php">&ensp;</a></span>
		<div class='right' id='user-nav-m'>
			<span class='userIco'><img src="images/profileImg.jpeg"></span> 
			<span class='userText'><?php echo $_SESSION['log_adminEmail'] ?></span>
		</div>
	</header>
	