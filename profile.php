<?php
		

		include('templates/user_preinit.php');
		include('templates/profile.php');
		$gpg = new gnupg();
		$gpg->setarmor(1);
		if(isset($_GET['createnewadress']) && isset( $login_cryptocoins[$_GET['createnewadress']] )){
			$crypto=$login_cryptocoins[$_GET['createnewadress']];
			if(sizeof($crypto['address']) < MAX_ADDRESS_FOR_WALLET){
				$username=$login;
				$cn=$_GET['createnewadress'];//cryptoname
				$wallet->getNewAddressForAccount($cn, $username);
				echo '...added...';
				return header("Location: ?");
			}
		}
?>


<form action='sendmoney.php' method=GET>
	<input type=text name=to placeholder='send to address'/>
	<input type=number name=amount step='0.001' value=0 max=1000 />
	<select name=cryptocoin>
<?php
	foreach( $login_cryptocoins as $name=>$crypto){
		print("<option name=$name>$name</option>");
	}
?>	
	</select>
	<button class='btn btn-primary'>Submit</button>
	<br/><a href=?info_cryptocoins>get wallets</a>
</form>
<hr/>
<!--
<pre style='color:red'>
	<?php

		if(isset($_FILES['NewGPGKey']) && $_FILES["NewGPGKey"]["error"] == UPLOAD_ERR_OK){
			$key=file_get_contents($_FILES['NewGPGKey']['tmp_name']);
			$r=$gpg->import($key);
			var_dump($r);
		}
	?>
	Add/Change GPG key:
	for 2FA
	<form method=POST action='profile.php' enctype="multipart/form-data">
		<input type=FILE name='NewGPGKey' />
		<input type=submit value='submit'>
	</form>
</pre>
-->

<div id='userinfo'>
	<div class='centerbox'>
		<?php 
			echo "<p class='centercontent'>Профиль: ".$login."</p>";
		?>
	</div>
	<br class='pit'/>
	<?php
	if(isset($_GET['info_cryptocoins'])){
	print('
	<div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
	  <div class="card-header">Your wallets:</div>
	  <div class="card-body">');
			foreach( $login_cryptocoins as $name=>$crypto){
	    			print('<h5 class="card-title">'.$name.'</h5>');
				//var_dump($crypto['address']);
				if( sizeof($crypto['address']) > 1){
	    				print('<p class="card-text">Addresses: </p>');
					for($i = sizeof($crypto['address'])-1; $i >= 0; $i--){
						echo $crypto['address'][$i];
						if($i != 0) echo ', ';
					}
				}else{
					print('<p class="card-text">Address: '.$crypto['address'].' </p>');
				}
	    			print('<p class="card-text">Balance: '.$crypto['balance'].'</p>');
				$balances=array(floatval($crypto['balance']), floatval($crypto['balance_notconfirmed']));
	    			print('<p class="card-text">Not confirmed balance: '
				.(max($balances)-min($balances)).
				'</p>');
				if(sizeof($crypto['address']) < MAX_ADDRESS_FOR_WALLET)
					print("<a href=?createnewadress=$name style=''><button class='btn btn-primary'>+</button></a>");
				print("</div><hr/>");
			}		
			print("<a href=? style=''><button class='btn btn-primary'>HIDE</button></a>");
			
			print("</div>");
		}





		foreach( $login_info as $what=>$info ){
			print("$what = $info<br/>");
		}
	?>
</div>

<div id='rightmenu'>
<iframe src="/chat.php" width="200" height="460" align="left">chat is disabled, because disabled iframe</iframe>	
</div>

<?php
include('templates/footer.php');
?>

