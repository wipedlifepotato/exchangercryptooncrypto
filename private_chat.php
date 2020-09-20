<?php
		include('templates/user_preinit.php');
		include('templates/chat.php');			
		if( isset($_POST['message']) && isset($_GET['to']) ){
			$exchat=$chats->get_chat_with_users($login_info['id'], $_GET['to']);
			$chats->add_message($exchat['id'], $login_info['id'], $_POST['message'],$login_info);
		}
?>
