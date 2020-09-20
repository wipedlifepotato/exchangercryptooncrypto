<?php
	require_once("sys/captcha.php");
	header('Content-Type: image/png');
	if(isset($_GET['fake']))
		$captcha = new Simply_Captcha($_GET['fake']);
	else
		$captcha = new Simply_Captcha();
?>
