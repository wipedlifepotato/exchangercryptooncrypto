<?php
	include('sys/language.php');
	$lang = new language();
	$titles = array(
		"index.php" => $lang->words['Main'],
		"reg.php" => $lang->words['Registration'],
		"profile.php" => $lang->words['Profile'],
		"/" => "ANCMS"
	);
	function getTitle($titles){
		
		$actual_link = $_SERVER['REQUEST_URI'];
		//die($actual_link);
		foreach ( $titles as $key=>$title ){
			if( strstr($actual_link, $key) != FALSE) return $title;
		}
		return $actual_link;
	}
?>
<html>
	<head>
		<title><?php echo getTitle($titles); ?></title>
		<link rel="stylesheet" href="/style/css/main.css">
		<meta charset=utf-8>
  		<meta http-equiv="Content-Security-Policy" content="script-src 'none'">
	</head>
	<script src=style/js/animations.js></script>
	<body>
	<div id='loader'><div id='loader-text'></div></div>

	<noscript>
		    <style type="text/css">
			#loader{display:none;}
		    </style>
	</noscript>
<?php
	require_once('sys/util.php');

?>
