<?php
    require_once('config.php');
    require_once('sys/users.php');

    $MY_STDOUT = fopen('php://stdout');

    function stdout($str) { global $MY_STDOUT; fwrite($MY_STDOUT, $str); }
    function stdoutprint($str) { log($str); print($str); }

    function generateRandString($length=10,$alphabite = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ' ){
	$randomString = ''; 

	while($length--){
		$i = rand(0, strlen($alphabite) - 1); 
		$randomString .= $alphabite[$i]; 		
	}
	return $randomString;
    }
    function setLoginCookie($login, $pass,$dtime=3600*12){
			setcookie("login", $login, time()+$dtime);  
			setcookie("pass", $pass, time()+$dtime);  
    }

    function delLoginCookie($login, $pass,$dtime=3600*12){
			setcookie("login", $login, time()-$dtime);  
			setcookie("pass", $pass, time()-$dtime);  
    }

    function checkAuth($array){
	if( isset($array['login']) && isset($array['pass'])){
		$u = new users( new sql(MYSQL_HOST,MYSQL_USERNAME,MYSQL_PASS,MYSQL_DB   ) );
		$ret=$u->checkHashPass($array['login'],$array['pass']);	
		if($ret != False){
			setLoginCookie($array['login'], $array['pass']);
			return true;
		}else{
			delLoginCookie($array['login'], $array['pass']);
			return false;
		}
	}	
    }
    function isset_array($what,$where){
		foreach($what as $i)
			if ( !isset($where[$i]) ) 
				return false;
		return true; 
   }
   function getDirFiles($dir,$defval='/backgrounds/triply.gif'){
				$rt = array();
				$files_dir = dir($dir);
				if($files_dir == false) return array($defval);
				while (false !== ($entry = $files_dir->read()) ) {
					//if($entry == '.' || $entry == '..') continue;
					if ( check_correct_content_file($entry) )
						$rt[] = $entry;
				}
				return $rt;
   }
   function check_correct_content_file($entry, $allows = array(
						".jpg",".png", ".jpeg", ".gif",'.webp'
					)){
					
					foreach($allows as $allow)
						if( strstr($entry, $allow) ) return True;
					return False;
   }

   function get_rand_file($dir='./backgrounds'){
		$ret=getDirFiles($dir);
		//$el=rand(0, sizeof($ret)-1);
		//print($el.":".$el);
		return "$dir/".$ret[rand(0, sizeof($ret)-1)];
   }
   function setRandBackground(){
	//кислоты ктото переел //print("<style>body,html{ background-image: url(".get_rand_file()."); }</style>");
   }
?>
