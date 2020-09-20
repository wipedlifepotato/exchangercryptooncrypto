<?php
require_once('sys/users.php');
/*
MariaDB [ancms]> describe messages_chat;
+---------+------------+------+-----+---------------------+----------------+
| Field   | Type       | Null | Key | Default             | Extra          |
+---------+------------+------+-----+---------------------+----------------+
| id      | int(11)    | NO   | PRI | NULL                | auto_increment |
| chat_id | bigint(20) | YES  |     | NULL                |                |
| author  | bigint(20) | YES  |     | NULL                |                |
| message | text       | YES  |     | NULL                |                |
| time    | timestamp  | NO   |     | current_timestamp() |                |
+---------+------------+------+-----+---------------------+----------------+
5 rows in set (0.066 sec)

MariaDB [ancms]> describe messages;
ERROR 1146 (42S02): Table 'ancms.messages' doesn't exist
MariaDB [ancms]> describe chats;
+-------------+------------+------+-----+---------+----------------+
| Field       | Type       | Null | Key | Default | Extra          |
+-------------+------------+------+-----+---------+----------------+
| id          | int(11)    | NO   | PRI | NULL    | auto_increment |
| first_user  | bigint(20) | YES  |     | -1      |                |
| second_user | bigint(20) | YES  |     | -1      |                |
+-------------+------------+------+-----+---------+----------------+
3 rows in set (0.001 sec)
*/
class chat extends users{
	//	"init_chat" => "insert into chats(first_user, seconds_user) values('%s','%s')"
	public function init_chat($first_user, $second_user){
		$first_user=intval($first_user);
		$second_user=intval($second_user);
		$res= $this->sql->doSQL(sql::sqls['init_chat'], $this->sql->escape_string($first_user),
			 $this->sql->escape_string($second_user)); 
			// maybe not need then escape_string?	
		return $res;		
	}
	//	"get_chat" => "select * from chats where id='%s'"
	public function get_chat($chat_id){
		$chat_id=intval($chat_id);
		$res= 
		$this->sql->doSQL(sql::sqls['get_chat'], $this->sql->escape_string($chat_id)); 
		// maybe not need then escape_string?	
		if(!$res||$res==null) return false;
		//var_dump($res);
		$res= mysqli_fetch_array($res);	
		//var_dump($res);
		return $res;
	}
	public function __construct($sql, $max_messages=30){
		users::__construct($sql);
		$this->max_messages=$max_messages;
	}//	"add_message" =>"insert into messages_chat(chat_id, author, message) values('%d', '%d', '%s');"
	//check to flood?
	public function add_message($chat_id, $author, $message, $login_info=false){
		session_start();
		if( isset($_SESSION['last_message']) ) {
			header("Refresh:1");print('<meta http-equiv="refresh" content="1">'); // not works?
			if( $_SESSION['last_message'] == $message ) return false;
		}
		$_SESSION['last_message']=$message;
		if($chat_id != 0){
			$chat_info=$this->get_chat($chat_id);
	
			if(!$chat_info) return false;
			//var_dump($chat_info);
			//die('add message');
			
			if($login_info == false|| 
			($login_info['id'] != $chat_info['first_user'] &&
				 $login_info['id'] != $chat_info['second_user']) ) 
				 return false;
		}//double code...
		
		$szmsg=strlen($message);
		if(  $szmsg < 2 || $szmsg > 100){
			print("<b style=color:red>MESSAGE SIZE IS SMALL OR BIG</b>");
			return false;
		}
		//var_dump($this->get_count_message($chat_id));
		if($this->get_count_message($chat_id) > $this->max_messages) 
		{
			$this->sql->doSQL(sql::sqls['delete_from_chat'],
				 $this->sql->escape_string($chat_id));
			die("CHAT WILL BE CLEAR IS NOW!");
		}
		
		$message=htmlspecialchars($message);
		$author=htmlspecialchars($author);
		$chat_id=intval($chat_id);
   	 	return $this->sql->doSQL(sql::sqls['add_message'], $this->sql->escape_string($chat_id),$this->sql->escape_string($author), $this->sql->escape_string($message)  );	
	}//	"get_messages" => "SELECT * from messages_chat where chat_id='%d'"
//	"get_chat_with_users" => "select * from chats where first_user='%s' and second_user='%s'"
	public function get_chat_with_users($first_user, $second_user){
		 
	         $res= $this->sql->doSQL(sql::sqls['get_chat_with_users'],
		 $this->sql->escape_string($first_user),$this->sql->escape_string($second_user),
		 $this->sql->escape_string($first_user),$this->sql->escape_string($second_user));
		 if(!$res) return false;
		 return mysqli_fetch_array($res);	
	}
	public function get_messages($chat_id,$login_info=false){
		if($chat_id != 0){
			$chat_info=$this->get_chat($chat_id);
			if($chat_info == false) return false;

			if($login_info == false|| 
			($login_info['id'] != $chat_info['first_user'] &&
				 $login_info['id'] != $chat_info['second_user']) ) 
				 return false;
		}

		$res= $this->sql->doSQL(sql::sqls['get_messages'], $this->sql->escape_string($chat_id));	
		return $res;
	}
	public function get_count_message($chat_id){
		$res = $this->sql->doSQL(sql::sqls['count_messages'], $this->sql->escape_string($chat_id));
		return mysqli_fetch_array($res)[0];
	}
};
?>
