<?php 
	# Stop Hacking attempt
	define('__APP__', TRUE);
	
	# Database connection
	include ("dbconn.php");
	
	# Variables MUST BE INTEGERS
    if(isset($_GET['menu'])) { $menu   = (int)$_GET['menu']; }
	if(isset($_GET['action'])) { $action   = (int)$_GET['action']; }
	
	# Variables MUST BE STRINGS A-Z
    if(!isset($_POST['_action_']))  { $_POST['_action_'] = FALSE;  }
	
	if (!isset($menu)) { $menu = 1; }
print '
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="style.css">
		<title>Programiranje web aplikacija - projekt</title>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta name="description" content="">
		<meta name="keywords" content="">
		<meta name="author" content="Danijel Končić">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
		<link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet">
		<title>Primjer 5</title>
	</head>
<body>
	<header>
		<div'; if ($menu > 1) { print ' class="hero-subimage"'; } else { print ' class="hero-image"'; }  print '></div>
		<nav>';
			include("menu.php");
		print '</nav>
	</header>
	<main>';
	
	
	#Homepage
	if (!isset($menu) || $menu == 1) { include("home.php"); }
	
	#Register
	else if ($menu == 2) { include("register.php"); }
	print '
	</main>
	<footer>
		<p>Danijel Končić</p>
	</footer>
</body>
</html>';
?>
