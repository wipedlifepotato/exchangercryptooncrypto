<?php
	require_once('sys/util.php');

	if ( checkAuth($_COOKIE) ){
			header('Location: /profile.php');	
			die("YOU ARE WELCOME! REDIRECT TO <a href=/profile.php>profile</a>");
	}

	session_start();
	function isNeed($what){
		foreach($what as $i)
			if ( !isset($_POST[$i]) ) 
				return false;
		return true;
	}
	$captchacorrect = -1;
	if(isset($_POST['captcha']) && isset( $_SESSION['HYPNOSE'] ) && strlen($_SESSION['HYPNOSE']) > 0  )
		if((hash("sha1",$_POST['captcha']) == $_SESSION['HYPNOSE']) ) $captchacorrect=true;
		else $captchacorrect=false;
	if( isNeed(array("login","pass")) && $captchacorrect ){
		session_destroy();
		$ret = checkAuth($_POST);
		if($ret != False){
			header('Location: /profile.php');	
			die("YOU ARE WELCOME! REDIRECT TO <a href=/profile.php>profile</a>");
		}else{
			print('
			<div class="alert alert-danger" role="alert">
			  	Вы ввели не верные данные к аккаунту.
			</div>
			');
		}
	}
include('templates/header.php');
setRandBackground();
?>


			<div id='auth' class='boxask'>
				<form action='index.php' method=POST>
					<center style='background-color:#1A87C2;color:white'><?php echo $lang->words['Authorization'];?></center><br/>
					<input type=text name=login placeholder='ID'/><br/>
					<input type=text name=pass placeholder='<?php echo $lang->words['Password'];?>'/><br/>
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
					<button class="btn" type="submit"><?php echo $lang->words['Enter'];?></button>
					<a class="btn" href="reg.php"><?php echo $lang->words['Registration'];?></a>
					<hr/><a href='setLang.php?lang=eng' class="btn btn-primary">ENG</a>
				    	<a href='setLang.php?lang=rus' class="btn btn-primary">RUS</a>
<?php
	if(! $captchacorrect && $captchacorrect !== -1 ) print("<div style='color:red' role='alert'>".$lang->words['The uncorrect captcha']."</div>");
?>
</center>
<hr/>

				</form>
			</div>
<!--<marquee style=color:yellow>Welcome again?</marquee>-->
<?php
include('templates/footer.php');
?>

