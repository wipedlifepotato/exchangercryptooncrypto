<?php

	if(isset($_GET['lang'])){
		setcookie("lang", $_GET['lang'], time()+3600*12);  
		header("Location: index.php");
	}
?>
