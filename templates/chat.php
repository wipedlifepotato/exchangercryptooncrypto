<style>
#topmenu{ display:none;margin-bottom:0; }
body{
	position:relative;
};
</style>
<meta http-equiv="refresh" content="<?php if(defined('CHAT_REFRESH_SECONDS')) echo CHAT_REFRESH_SECONDS; else echo 5 ?>">

<div id='chatbox' class='chat'>

<a href='/chat.php' target="_blank">Chat in another window</a>|
<?php
{
	$tmp=isset($_GET['to']) ? $_GET['to'] : 0;
	$tmp1=isset($_GET['disablerefresh']) && $_GET['disablerefresh'] == 'true' ? 'false' : 'true';
	$data = array(
		'disablerefresh' => $tmp1
	);
	if($tmp != 0) $data['to'] = $_GET['to'];

	if(isset($_GET['disablerefresh']) && $_GET['disablerefresh'] == 'true')
		echo "<a href='?".http_build_query($data)."'>enable refresh</a>";
	else	echo "<a href='?".http_build_query($data)."'>disable refresh</a>";
}
?>
<div class='chat' id='messagebox'>
		<ul>
			<?php
				$exchat=false;
				if( isset($_GET['to']) ){
					if($_GET['to'] == $login_info['id']) {
						print('<div style=color:red>Write to himself not allowed
						<br>Нельзя писать самому себе.</div>');
						return header("Refresh:4;URL=/chat.php");
					}
					$exchat=$chats->get_chat_with_users($login_info['id'], $_GET['to']);
					if($exchat  == FALSE ){
						$chats->init_chat($login_info['id'], $_GET['to']);
						$exchat=$chats->
						get_chat_with_users($login_info['id'], $_GET['to']);
					}
				}

				$chat_id = isset($_GET['to']) ? $exchat['id'] : 0;
				//var_dump($chat_id);
				$res=$chats->get_messages($chat_id, isset($_GET['to'])?$login_info:false);
				//var_dump($res);
				if($res != false) 
				while($mess = mysqli_fetch_array($res)){
					//var_dump($chats->getUserByID($mess['author']));
					$authorname=$chats->getUserByID($mess['author'])['name'];
					$time=$mess['time'];
					$message=$mess['message'];
					print("<li>".$time.
					" <a href=user_info.php?name=$authorname>".$authorname."</a>:". 
					$message."</li>");
				}
			?>
			<li></li>
		</ul>

	</div>
	<div class='chat' id='sendform'>
		<form method=POST>
			<input type=text autocomplete="off" name='message' placeholder='сообщение'/>
			<input type=submit value=send />
		
		</form>
	</div>
	<div class='split'></div>

</div>
