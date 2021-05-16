<?php

function getenv_helper($key, $default_value) {
	return getenv($key, true) ?: getenv($key) ?: $default_value;
}

function config_var($em_key, $env_var_key, $default_value) {
	define($em_key, getenv_helper($env_var_key, $default_value));
}

config_var('MYSQL_HOST', 'ENV_EM_MYSQL_HOSTNAME', '127.0.0.1');
config_var('MYSQL_PASS', 'ENV_EM_MYSQL_PASSWORD', 'secretpassword');
config_var('MYSQL_USERNAME', 'ENV_EM_MYSQL_USERNAME', 'root');
config_var('MYSQL_DB', 'ENV_EM_MYSQL_DB', 'emdb');
config_var('CHAT_REFRESH_SECONDS', 'ENV_EM_CHAT_REFRESH_SECONDS', 20);
config_var('MAX_ADDRESS_FOR_WALLET', 'ENV_EM_MAX_ADDRESS_FOR_WALLET', 15);

?>
