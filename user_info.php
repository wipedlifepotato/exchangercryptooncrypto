<?php
		include('templates/header.php');
		require_once('sys/util.php');
		if ( !checkAuth($_COOKIE) ){
				header('Location: /index.php');	
				die("REDIRECTING TO <a href=/index.php>auth</a>");
		}
		require_once('config.php');
		require_once('sys/users.php');
		require_once('sys/cryptocoins/main.php');
		require_once('sys/cryptocoins/wallet.php');
		$sql = new sql(MYSQL_HOST,MYSQL_USERNAME,MYSQL_PASS,MYSQL_DB   );
		$u = new users( $sql );
		$cryptocoins = new CryptoCoin( $sql );
		$wallet = new wallets( $cryptocoins );
		$login=$_GET['name'];
		$login_cryptocoins=$wallet->getWalletsForUser($login);
		$need_info = $u->getUserByName($login);
		/*include('templates/profile.php');*/
		
?>
	<a href='chat.php'><?php echo $lang->words['Back'];?></a>
	<a href='private_chat.php?to=<?php echo $need_info['id'] ?>'><?php echo $lang->words['Start private chat'];?></a>
<?php 
	echo "<div>profile of: ".$login."</br>";
	$not_allowed_info=array("password", "secret", "gpgkey", "browser-info");
	foreach( $need_info as $what=>$info ){
		if( is_numeric($what) || in_array($what, $not_allowed_info)) continue;
		print(" $what = $info<br/>");
	}

?>
<?php
include('templates/footer.php');
?>
