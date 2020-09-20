<?php
		include('templates/header.php');

		if ( !checkAuth($_COOKIE) ){
				header('Location: /index.php');	
				die("YOU NOT ARE WELCOME! REDIRECT TO <a href=/index.php>auth</a>");
		}
		require_once('config.php');
		require_once('sys/users.php');
		require_once('sys/chat_class.php');
		require_once('sys/cryptocoins/main.php');
		require_once('sys/cryptocoins/wallet.php');
		$sql = new sql(MYSQL_HOST,MYSQL_USERNAME,MYSQL_PASS,MYSQL_DB   );
		$u = new users( $sql );
		$cryptocoins = new CryptoCoin( $sql );
		$wallet = new wallets( $cryptocoins );
		$login=$_COOKIE['login'];
		$login_cryptocoins=$wallet->getWalletsForUser($login);
		$login_info = $u->getUserByName($login);
		$chats = new chat($sql);
?>
<nav id="topmenu">
    <ul class="">
     <!-- <li class="menu-item">
        <a class="disabled" href="#" disabled>Витрина</a>
      </li> -->
      <li class="menu-item">
        <a class="" href="#"><?php echo $lang->words['Profile'];?></a>
      </li>
      <li class="menu-item">
        <a class="" href="exchange.php">обменик</a>
      </li>
      <li class="menu-item">
        <a class="disabled" href="#"><?php echo $lang->words['Coversations'];?></a>
      </li>

     <li style="list-style:none;"><div class='splitinline'></div></li>
    </ul>
  

    <div style='' class='rightmenu'>
    	<a href='setLang.php?lang=eng' class="btn btn-primary">ENG</a>
    	<a href='setLang.php?lang=rus' class="btn btn-primary">RUS</a>
    </div>
</nav>


<div id='mainbox'>
