<?php
require_once('sys/sql.php');
require_once('sys/util.php');
class users extends sql
{
    static function issetCookies(){
		if( isset($_COOKIE['login']) && isset($_COOKIE['pass'])) return true;
		return false;
    }
    function mksecret($u,$p){
	return hash("md5", $u . $p); //maybe not md5?
    }
    function __construct($sql){
	$this->sql = $sql;
    }
    function getHashPass($secret, $password, $algo='sha512'){
	return hash($algo, $secret . $password . $secret); 
    }
// "checkHashPassByUser" => "SELECT * FROM users WHERE name='%s' and password='%s' and secret='%s'",
    function checkHashPass($username, $password, $algo ='sha512'){
        $secret = $this->mksecret($username, $password);
        $hashpass = $this->getHashPass($secret ,$password); 

        $res = $this->sql->doSQL(sql::sqls['checkHashPassByUser'], $username, $hashpass, $secret);
        if ( gettype ($res) == "boolean" ) die("mysql query failed: checkHashPassByUser");
        $res = mysqli_fetch_array($res);
        return $res['name'] != "";	
    }
    //        "addUser" => "INSERT INTO users (name, password, secret, REGISTERED) VALUES( '%s', '%s', '%s', 'NOW()')",
    function addUser($password, $nicksize=10)
    {
	$maxPasswordSize=128;
	$minPasswordSize=6;

    //TODO localization

        if (strlen($password) > $maxPasswordSize)
            return array(False, ("Вы превысили максимум длины пароля, максимальная длина ".$maxPasswordSize));
        if (strlen($password) < $minPasswordSize)
            return array(False, ("Слишком короткий пароль, укажите более длинный, пожалуйста. Минимальная длина пароля: ".$minPasswordSize));

	$username = generateRandString($nicksize);
	$retries=0;
	while( $this->getUserByName($username) != "" ){
		print_r($this->getUserByName($username));
		$username = generateRandString($nicksize);
		if($retries++ > 10) die("?!");
	}
        $secret = $this->mksecret($username, $password);
        $hashpass = $this->getHashPass($secret ,$password); 

        $ret = $this->sql->doSQL(sql::sqls['addUser'], $this->sql->escape_string($username), $hashpass, $secret);
        if ($ret !== True) return array(False, ($this->sql->getLastSQLError() . ""));
        //print("return true");
        return array(True, $username);
    }
    function getUserByName($username)
    {
        //print($username);
        $res = $this->sql->doSQL(sql::sqls['getUserByName'], $username);
	
        $user = mysqli_fetch_array($res);

        return $user;
    }

    function getUserByID($id)
    {
        $res = $this->sql->doSQL(sql::sqls['getUserByID'], $id);
        $user = mysqli_fetch_array($res);
        return $user;
    }
	//	"blockUser" => "update users set is_blocked=1 where name='%s'"
    function getUserBlockStats($username){
        $res= $this->sql->doSQL(sql::sqls['getUserBlockStats'], $this->sql->escape_string($username));
	$res = mysqli_fetch_array($res);
	return $res[0]; 		
    }
    function blackListToUsername($username)
    {
        $res= $this->sql->doSQL(sql::sqls['blockUser'], $this->sql->escape_string($username));
	if($res == NULL) die("sql err");
	return $res;
    }
    function delUserByUsername($username)
    {
        if (!($this->sql->doSQL(sql::sqls['delUser'], $username))) return $this->sql->getLastSQLError();
        return True;
    }
    function getAllUsers()
    {
        return $this->sql->doSQL(sql::sqls['getAllUsers']);
    }
    function countUsers()
    {
        return $this->sql->getCountOfTB("users");
    }
    function isAdmin($nick)
    {
        $r = $this->sql->doSQL(sql::sqls['isAdmin'], $nick);
        $r = mysqli_fetch_assoc($r);
        if ($r['is_admin']) return True;
        return False;
    }
	//
    function add_user_gpg_reg_ses($fingeprint, $username, $answer){
		return $this->sql->doSQL(sql::sqls['add_user_gpg_reg_ses'],  $this->sql->escape_string($fingeprint), $this->sql->escape_string($username), $this->sql->escape_string($answer));
    }
	//"updateGPGKeyOfUser" => "update users set gpgkey='%s' where name='%s';"
    function updateGPGKeyOfUser($gpgkey, $name){
		return $this->sql->doSQL(sql::sqls['updateGPGKeyOfUser'],  $this->sql->escape_string($gpgkey), $this->sql->escape_string($name));
    }
}	
?>
