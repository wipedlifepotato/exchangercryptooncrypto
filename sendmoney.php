<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);

		include('templates/user_preinit.php');

		if($_GET['amount'] ===0) return header("Location: /");
		if( !isset_array( array("to","amount","cryptocoin"), $_GET)) return header("Location: /");
		if(preg_match('/[^a-zA-Z0-9]/i', $_GET['to']) 
		|| strlen($_GET['to']) < 2 || !$wallet -> existCryptoName($_GET['cryptocoin'])
		|| $wallet->validate_addres($_GET['cryptocoin'],$_GET['to'])['isvalid'] == false )
		{
		  die( "<p style=color:red>not valid addr</p>" );
		  return header('Refresh: 10; URL=/');
		}
		$cryptoname=$_GET['cryptocoin'];
		if( $login_cryptocoins[$cryptoname]['balance'] < $_GET['amount']){
		  echo $login_cryptocoins[$cryptoname]['balance']."<".$_GET['amount'];
		  echo( "<p style=color:red>not valid amount, you dont have this money</p>" );
		  return header('Refresh: 10; URL=/');						
		die("");
		}
		echo( "<p style=color:green>send!</p>" );
		$wallet->send($cryptoname, $login, $_GET['to'], (double)$_GET['amount']);
		return header("Location: /");
		

?>
