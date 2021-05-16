<?php
require_once('sys/cryptocoins/main.php');
/*
getaccount <gostcoinaddress>
getaccountaddress <account>
getaddressesbyaccount <account>
getbalance [account] [minconf=1]
getblock <hash> [verbose=true]
getblockcount
getblockhash <index>
getblocktemplate [params]
getdifficulty
gethashespersec
getnewaddress [account]
getreceivedbyaccount <account> [minconf=1]
getreceivedbyaddress <gostcoinaddress> [minconf=1]
listaccounts [minconf=1]
move <fromaccount> <toaccount> <amount> [minconf=1] [comment]
sendfrom <fromaccount> <togostcoinaddress> <amount> [minconf=1] [comment] [comment-to]
sendmany <fromaccount> {address:amount,...} [minconf=1] [comment]
setaccount <gostcoinaddress> <account>
validateaddress <gostcoinaddress>

*/
class wallets{
	function __construct($CryptoCoins){
		$this->cryptocoins = $CryptoCoins;
	}
	function existCryptoName($name){
		return isset($this->cryptocoins->coins[$name]);
	}
	function test_cryptocoins(){
		foreach( $this->cryptocoins->coins as $name=>$crypto ){
			print("Balance of $name now: ".$crypto->getBalance()."\n</br>");
		}
	}
	function createAccountsForUser($username){
		$addresses=array();
		foreach( $this->cryptocoins->coins as $name=>$crypto ){
			$prefix=$this->cryptocoins->getUserPrefixForCoinsByName($name);
			$addresses[$name]=$crypto->getnewaddress($prefix.$username);
		}
		return $addresses;
	}
	function validate_addres($cryptocoinName, $address){
		$json=$this->cryptocoins->coins[$cryptocoinName]->validateaddress($address);
		return $json;/*
			{
			"isvalid" : true,
			"address" : "mmie7fURGZX4gTBKBs3BC5DXWErtSwUrYf",
			"ismine" : true,
			"isscript" : false,
			"pubkey" : "03de267e7acf1a96cc8252e92adcc335cd8b7790c4ecb8c7b8c1f20044f9f0b626",
			"iscompressed" : true,
			"account" : "main"
			}
		*/
	}
	function getBalance($cryptocoinName, $username){
		/*
		//TODO take $username into account
		$crypto = $this->cryptocoins->coins[$cryptocoinName];
		$balance = $crypto->getBalance();
		print("Balance of $cryptocoinName now: $balance\n</br>");
		*/
	}
	function send($cryptocoinName, $username, $to, $amount){
		$prefix=$this->cryptocoins->getUserPrefixForCoinsByName($cryptocoinName);
		
			$this->cryptocoins->coins[$cryptocoinName]->sendfrom($prefix.$username, $to, $amount );
		
	}
	//tamount for famount
	function exchange($fusername, $tusername, $fcryptoname,$tcryptoname, $famount,$tamount){
		$prefix0=$this->cryptocoins->getUserPrefixForCoinsByName($fcryptoname);//from
		$prefix1=$this->cryptocoins->getUserPrefixForCoinsByName($tcryptoname);//to
		$this->cryptocoins->coins[$cryptocoinName]->move($prefix0.$fusername, 
			$prefix0.$tusername, $famount );//from to
		$this->cryptocoins->coins[$cryptocoinName]->move($prefix1.$tusername, 
			$prefix1.$fusername, $tamount );// to from
	}
	function getAccounts(){
		$accounts=array();
		foreach( $this->cryptocoins->coins as $name=>$crypto ){
			$accounts[$name]=$crypto->listaccounts();
		}
		return $accounts;
	}
	function getNewAddressForAccount($cryptoname, $username){
		$prefix=$this->cryptocoins->getUserPrefixForCoinsByName($cryptoname);
		return $this->cryptocoins->coins[$cryptoname]->getaddressesbyaccount($prefix.$username);
	}
	function getTransactionsForAccount($crypto, $prefix, $username){
		$transactions=$crypto->listtransactions($prefix.$username);

		return $transactions;
	}
	function getRealBalance($crypto, $prefix, $username){ //without not confirmed
		$amount=0.0;
		$minconfirmations=6;
		$transactions = $this->getTransactionsForAccount($crypto, $prefix, $username);
		for($i = sizeof($transactions)-1; $i >= 0; $i--){
			//var_dump( $transactions[$i] );
			if( $transactions[$i]['confirmations'] >= $minconfirmations ){
				$amount+= $transactions[$i]['amount'];
			}
		}
		return $amount;
	}
	function getWalletsForUser($username){
		$wallets=array();
		$accounts=$this->getAccounts();
		foreach( $this->cryptocoins->coins as $name=>$crypto ){
			$prefix=$this->cryptocoins->getUserPrefixForCoinsByName($name);
			$wallets[$name]['balance']=$this->getRealBalance($crypto, $prefix, $username);

			$tmp=(array) $crypto->getbalance($prefix.$username);
			if( isset( $tmp['result'] ) )
				$wallets[$name]['balance_notconfirmed']=$tmp['result'];
			else $wallets[$name]['balance_notconfirmed']=0;

			//settype($wallets[$name]['balance_notconfirmed'], 'float');
			$wallets[$name]['crypto'] = $crypto;
			$tmp=$accounts[$name][$prefix.$username];
			if( is_null($tmp) ){
				//var_dump($tmp);
				//echo 'create';
				//var_dump($accounts[$name][$prefix.$username] );
				$wallets[$name]['address']=$crypto->getaccountaddress($prefix.$username);
				
			}else{
				//echo 'created';
				//var_dump($accounts[$name][($prefix.$username)]);
				$wallets[$name]['address']=$this->getNewAddressForAccount($name,$username);
			}
			//
		}
		return $wallets;	
	}
};
?>
