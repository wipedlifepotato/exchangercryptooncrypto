<?php
		die('...');
		

		include('templates/user_preinit.php');
		include('templates/profile.php');
		$gpg = new gnupg();
		$gpg->setarmor(1);
?>
<?php
include('templates/footer.php');
?>

