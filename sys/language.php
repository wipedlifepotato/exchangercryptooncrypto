<?php
	class language{
		//eng / rus; shitcode implement without fopen ... str_replace ... caching ... load from cache
		// because its more fast than implement ^^^
		//because we are want use 2 language eng/rus, not more;
	    	const def = array(
		"Registration"=>"Регистрация",
		"Authorization" => "Авторизация",
		"Profile"=>"Профиль",
		"Main"=>"Главная / Авторизация",
		"Submit" => "Подтвердить",
		"Password" => "Пароль",
		"Captcha"=> "Капча",
		"Enter" => "Вход",
		"Create a password"=>"Придумайте пароль",
		"Incorrect captcha" => "Капча введена неверно!",
		"Start private chat" => "Начать приватный чат",
		"Back" => "Назад",
		"Conversations" => "Переписки",
		"Create a user account" => "Создать учётную запись пользователя",
		"Login" => "Войти"
		);
		function set_language($name){
			$allow_names=array("rus","eng");
			if($name == "rus"){
					$this->words = language::def;
			
			}else{
					$tmp=array();
					foreach( language::def as $eng=>$rus){
						$tmp[$eng]=$eng;
					}
					$this->words = $tmp;
				
			}
		}
		function __construct(){
			if(isset($_COOKIE['lang']))
				$this->set_language($_COOKIE['lang']);
			else $this->set_language("rus");
		}
	}
?>
