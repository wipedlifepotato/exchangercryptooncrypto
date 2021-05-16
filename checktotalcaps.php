<?php
		require_once('config.php');
		require_once('sys/cryptocoins/main.php');
		require_once('sys/cryptocoins/wallet.php');

		$sql = new sql(MYSQL_HOST,MYSQL_USERNAME,MYSQL_PASS,MYSQL_DB   );
		$cryptocoins = new CryptoCoin( $sql );
		$wallet = new wallets( $cryptocoins );
		$wallet -> test_cryptocoins();
?>
