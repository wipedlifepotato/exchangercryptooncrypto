<?php

	require_once('sys/util.php');
	
	if ( checkAuth($_COOKIE) ){
		header('Location: /profile.php');	
		die("REDIRECTING TO <a href=/profile.php>profile</a>");
	}

	session_start();
	
	include('templates/header.php');

	function isNeed($what) {
		foreach($what as $i)
			if ( !isset($_POST[$i]) ) 
				return false;
		return true;
	}

	$captchacorrect = -1;

	if (isset ($_POST['captcha']) && 
		isset ($_SESSION['HYPNOSE']) && 
		strlen($_SESSION['HYPNOSE']) > 0  
	   ) $captchacorrect = hash ( "sha1", $_POST['captcha'] ) == $_SESSION['HYPNOSE'];
	if( isNeed(array("pass")) && $captchacorrect===true ){
		unset($_SESSION['HYPNOSE']);
		unset($_SESSION);		
		session_destroy();
		require_once('config.php');
		require_once('sys/users.php');
		require_once('sys/cryptocoins/main.php');
		require_once('sys/cryptocoins/wallet.php');
		$sql = new sql(MYSQL_HOST,MYSQL_USERNAME,MYSQL_PASS,MYSQL_DB   );
		$u = new users( $sql );
		$cryptocoins = new CryptoCoin( $sql );
		$wallet = new wallets( $cryptocoins );

		$ret=$u->addUser($_POST['pass']);//Todo: addCryptoAddresses
		if($ret[0] != False){
			setLoginCookie($ret[1],$_POST['pass']);
			print("
				<div id='reg' class='boxask'>
				<center style='background-color:#1A87C2;color:white'>Успешная регистрация</center><br/>
			");
			$addresses = $wallet->createAccountsForUser($ret[1]);
			//print("Ваши крипто-адреса: </br>");
			//foreach($addresses as $name => $address ){
			//	print("$name - $address</br>");
			//}
			print("<hr/>");
			//TODO localization
			print('
			 <div class="form-group">
			  <label for="usr">ID(логин):</label>
			  <input type="text" class="form-control" value="'.$ret[1].'" disabled>
			</div>
			<div class="form-group">
			  <label for="pwd">Пароль:</label>
			  <input type="text" class="form-control" value="'.$_POST['pass'].'" disabled>
			</div> 
			');
			//TODO localization
			print("<p style=color:red>Сохраните эти данные в безопасном месте!(CTRL+S или CTRL+P)</p><br/><a href='profile.php'>Profile</a>"); 

			include('templates/footer.php');
			exit(0);
		}else{
			print('
				<div class="alert alert-danger" role="alert">
				  	'.$ret[1].'
				</div>
			');
		}
	}

	setRandBackground();
	
?>

<div id='reg' class='boxask'>
	<form action='reg.php' method=POST>
		<center style='background-color:#1A87C2;color:white'>
			<?php echo $lang->words['Sign Up'];?>
		</center><br/>

		<input type=text name=pass placeholder='<?php echo $lang->words['Create a password'];?>'/><br/>
		<input type=text name=captcha placeholder='<?php echo $lang->words['Captcha'];?>'/><br/>

		<center>
			<div id="captchas" class='captchabox'>
	            <div class="captchaboxfake layer1"></div>
	            <div class="captchaboxfake layer2"></div>
	            <div class="captchaboxfake layer3"></div>
	            <div class="captchaboxfake layer4"></div>
	        </div>
		</center>

		<hr/>

		<button class="btn btn-primary" type="submit"><?php echo $lang->words['Create a user account'];?></button>
		<a class="btn btn-primary" href="index.php" role="button"><?php echo $lang->words['Login'];?></a>

		<hr/>

		<a href='setLang.php?lang=eng' class="btn btn-primary">ENG</a>
		<a href='setLang.php?lang=rus' class="btn btn-primary">RUS</a>

		<?php
			if ($captchacorrect === -1) 
				print("<div style='color:red'>".$lang->words["It's unknown whether captcha is correct or not, failing"]."</div>");
			else
				if (!$captchacorrect)
					print("<div style='color:red'>".$lang->words['Incorrect captcha']."</div>");
		?>
	</form>
</div>

<marquee style='color:yellow'>🙃️🤔️🤤️</marquee>

<?php include('templates/footer.php'); ?>
