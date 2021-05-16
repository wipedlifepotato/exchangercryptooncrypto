<?php

define('SQL_DEBUG_TRACE_ON', true);

class sql
{

    const sqls = array(
        "getAllUsers" => "SELECT * from users;",
        "addUser" => "INSERT INTO users (name, password, secret) VALUES( '%s', '%s', '%s')",
        "delUser" => "DELETE FROM users WHERE name='%s'",
        "getUserByID" => "SELECT * FROM users WHERE id='%d'",
        "getUserByName" => "SELECT * FROM users WHERE name='%s'",
	"checkHashPassByUser" => "SELECT * FROM users WHERE name='%s' and password='%s' and secret='%s'",
        "delCommentsWhereIS" => "DELETE FROM comments WHERE %s='%s'",

	"getCryptoCoins" => "SELECT * FROM cryptocoins",
	"addCryptoCoin" => "INSERT INTO cryptocoins(name, host, port, rpcuser, rpcpassword) VALUES('%s','%s','%s','%s', '%s');",
	"getUserPrefixForCoinByName" => "SELECT user_prefix FROM cryptocoins where name='%s'",
	"getWalletsOfUsername" => "SELECT wallets.*,cryptocoins.name FROM wallets INNER JOIN cryptocoins ON cryptocoins.id=wallets.cryptocoin_id WHERE wallets.owner_id='%s'",


        "getCountOfTB" => "SELECT COUNT(*) FROM %s",
        "getCountOfTBWhere" => "SELECT COUNT(*) FROM %s WHERE %s='%s'",
        "getCountOfTBWhereMoreFunc" => "SELECT COUNT(*) FROM %s WHERE %s > %s",
        "isAdmin" => "SELECT * FROM users WHERE name='%s' AND admin='yes';",

        "getNameOfCategoryByID" => "SELECT * FROM categories WHERE id='%d'",
        "getCategories" => "select * from categories",
        "getCountOfTorrentsInCategory" => "SELECT COUNT(*) FROM categories WHERE %s='%s'",
        "getCategoryByName" => "select * from categories where name='%s'",
        "getCategoryByID" => "select * from categories where id='%d'",
        "addCategoryByName" => "INSERT INTO categories(name,sort_index) values(%s,LAST_INSERT_ID()*10);",
        "delCategoryByName" => "DELETE FROM categories where name='%s';",
        "delCategoryByID" => "DELETE FROM categories where id='%d';",
        "changeCategoryNameByID" => "update categories set name='%s' where id='%d';",
        "changeCategorySortIndexByID" => "update categories set sort_index='%d' where id='%d';",
        "changeCategorySortIndexByName" => "update categories set sort_index='%d' where name='%s';",
        "fixAutoIncrementToTable" => "ALTER TABLE %s AUTO_INCREMENT='%d'",
	"blockUser" => "update users set is_blocked=1 where name='%s'",
	"getUserBlockStats" => "SELECT is_blocked from users where name='%s'",
	"updateGPGKeyOfUser" => "update users set gpgkey='%s' where name='%s';",
	"add_user_gpg_reg_ses"=>"insert into gpg_reg_ses(fingeprint, username, answer) values( '%s', '%s', '%s')",
	"add_message" =>"insert into messages_chat(chat_id, author, message) values('%d', '%d', '%s');",
	"get_messages" => "SELECT * from messages_chat where chat_id='%d'",
	"delete_from_chat" => "DELETE FROM messages_chat where chat_id='%s';",
	"count_messages" => "select COUNT(*) from messages_chat where chat_id='%s'",
	"init_chat" => "insert into chats(first_user, second_user) values('%s','%s')",
	"get_chat" => "select * from chats where id='%s'",
	"get_chat_with_users" => "select * from chats where first_user='%s' and second_user='%s' or second_user='%s' and first_user='%s' "
    );

    function doSQL($sprintf, ...$arguments)
    {
        $string = vsprintf($sprintf, $arguments);
        if(SQL_DEBUG_TRACE_ON)printf("SQL debug trace: %s\n\r<br>", $string);
	
        $result = mysqli_query($this->con, $string);
        return $result;
    }
    function fixAutoIncrementToTable($table, $v)
    {
        return $this->doSQL(sql::sqls['fixAutoIncrementToTable'], $table, $v);
    }
    function getSQLCon()
    {
        return $this->con;
    }
    function __construct($host, $user, $pass, $db)
    {
        $this->con = mysqli_connect($host, $user, $pass, $db);
	if(!$this->con) die("can't connect to mysql");
    }
    function getLastSQLError()
    {
        return mysqli_error($this->con);
    }
    function getCountOfTB($table)
    {
        $r = $this->doSQL(sql::sqls['getCountOfTB'], $table);
        return mysqli_fetch_array($r)[0];
    }
    function getCountOfTBWhere($table, $a, $b)
    {
        $r = $this->doSQL(sql::sqls['getCountOfTBWhere'], $table, $a, $b);
        return mysqli_fetch_array($r)[0];
    }
    function getCountOfTBWhereMoreFunc($table, $a, $b)
    {
        $r = $this->doSQL(sql::sqls['getCountOfTBWhereMoreFunc'], $table, $a, $b);
        return mysqli_fetch_array($r)[0];
    }
    function escape_string($str){
	return mysqli_real_escape_string ( $this->con , $str );
    }
}

class comments extends sql
{
    function countComments()
    {
        return $this->getCountOfTB("comments");
    }

    function delCommentIsWhere($is, $WHERE = "id")
    {
        $allowed = false;
        foreach (self::commentfields as $allow_fields) {
            if ($WHERE == $allow_fields) {
                $allowed = true;
                break;
            }
        }
        if (!$allowed) return false;
        return $this->doSQL(sql::sqls['delCommentsWhereIS'], $WHERE, $is);
    }
    function delCommentByUserID($id)
    {
        return $this->delCommentIsWhere($id, "user");
    }
}



class categories extends comments
{
    function getCategories()
    {
        return $this->doSQL(sql::sqls['getCategories'], "");
    }
    function countCategories()
    {
        return $this->getCountOfTB("categories");
    }
    function getCategoryByID($id)
    { // id, name, sort_index
        $category = $this->doSQL(sql::sqls['getCategoryByID'], $id);
        return mysqli_fetch_array($category);
    }
    function getNameOfCategoryByID($id)
    {
        //getNameOfCategoryByID
        //$category=$this->doSQL( sql::sqls['getNameOfCategoryByID'], $id );
        //$category=mysqli_fetch_array($category)['name'];
        //return mysqli_fetch_array($category)['name'];
        return $this->getCategoryByID($id)['name'];
    }
    function getCategoryByName($name)
    {
        $category = $this->doSQL(sql::sqls['getCategoryByName'], $name);
        return mysqli_fetch_array($category);
    }
    function addCategoryByName($name)
    {
        return $this->doSQL(sql::sqls['addCategoryByName'], $name);
    }
    function delCategoryByName($name)
    {
        return $this->doSQL(sql::sqls['delCategoryByName'], $name);
    }
    function delCategoryByID($id)
    {
        return $this->doSQL(sql::sqls['delCategoryByID'], $id);
    }
    function changeCategoryNameByID($id, $name)
    {
        //  "changeCategoryNameByID" => "update categories set name='%s' where id='%d';",
        return $this->doSQL(sql::sqls['changeCategoryNameByID'], $name, $id);
    }
    function changeCategorySortIndexByID($id, $sort)
    {
        //"changeCategorySortIndexByID"=> "update categories set sort_index='%d' where id='%d';",
        return $this->doSQL(sql::sqls['changeCategorySortIndexByID'], $sort, $id);
    }
    function changeCategorySortIndexByName($name, $sort)
    {
        //"changeCategorySortIndexByID"=> "update categories set sort_index='%d' where id='%d';",
        return $this->doSQL(sql::sqls['changeCategorySortIndexByName'], $sort, $id);
    }
}



class admin /*extends users*/
{
    const DEBUG = FALSE;
    function getServInfo(
        $indicesServer = array(
            'SERVER_NAME',
            'SERVER_ADDR',
            'SERVER_PORT',
            'SERVER_SIGNATURE',
            'SERVER_SOFTWARE',
            'SERVER_PROTOCOL',
        )
    ) {
        $returns = array();
        foreach ($indicesServer as $info) {
            //print("INFO:".$_SERVER[$info]);
            if (isset($_SERVER[$info])) $returns[$info] = $_SERVER[$info];
        }
        return $returns;
    }

    function __construct($moveIfNotAdmin = True, $page = '../index.php')
    {
        sql::__construct();
        if ($moveIfNotAdmin) {
            $is_admin = $this->checkAdmin();
            if (!$is_admin) {

                if (!self::DEBUG) {
                    header("Location: ../index.php");
                    exit(0);
                } else {
                }
            }
        }
        stdhead("Admin page");
        //include_once "../include/page_header.inc.php";
    }

    function checkAdmin()
    {
        global $CURUSER;
        $this->isAdmin = (isset($CURUSER) && $CURUSER["admin"] == "yes");
        return $this->isAdmin;
    }
};
?>
