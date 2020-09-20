<?php
		include('templates/user_preinit.php');
		include('templates/chat.php');			
		if( isset($_POST['message']) ){
			$chats->add_message(0, $login_info['id'], $_POST['message']);
			//return header('Location: /chat.php');
		}

?>
