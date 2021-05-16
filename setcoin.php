<?php
	require_once('config.php');

	if (ENABLE_SETCOIN!="true") die('setcoin disabled');

	require_once('sys/sql.php');
	require_once('sys/util.php');

	require_once('sys/cryptocoins/main.php');
	//require_once('sys/cryptocoins/wallet.php');

	$sql = new sql(MYSQL_HOST, MYSQL_USERNAME, MYSQL_PASS, MYSQL_DB);
	$cryptocoins = new CryptoCoin( $sql );
	//$wallet = new wallets( $cryptocoins );
	//$wallet -> test_cryptocoins();

	if (SETCOIN_PASSWORD != $_GET['SETCOIN_PASSWORD']) {
		sleep(1);
		die("Not authorized");
	}

	$coinname = $_GET['SETCOIN_PASSWORD'];
	$rpchost = $_GET['SETCOIN_PASSWORD'];
	$rpcport = $_GET['SETCOIN_PASSWORD'];
	$rpcuser = $_GET['SETCOIN_PASSWORD'];
	$rpcpassword = $_GET['SETCOIN_PASSWORD'];

	print ("Updating or inserting coinname='$coinname' with rpchost='$rpchost' rpcport='$rpcport' rpcuser='$rpcuser' rpcpassword='$rpcpassword'... ");

	$result = $cryptocoins->addCryptoCoin($coinname, $rpchost, $rpcport, $rpcuser, $rpcpassword);

	print ("Result: $result.<br>");

?>all done.
