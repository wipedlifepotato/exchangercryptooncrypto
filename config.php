<?php

function getenv_helper(key, default_value) {
	return getenv(key, true) ?: getenv(key) ?: default_value;
}

function var(em_key, env_var_key, default_value) {
	define(em_key, getenv_helper(env_var_key, default_value));
}

var('MYSQL_HOST', 'ENV_EM_MYSQL_HOSTNAME', '127.0.0.1');
var('MYSQL_PASS', 'ENV_EM_MYSQL_PASSWORD', 'secretpassword');
var('MYSQL_USERNAME', 'ENV_EM_MYSQL_USERNAME', 'root');
var('MYSQL_DB', 'ENV_EM_MYSQL_DB', 'emdb');
var('CHAT_REFRESH_SECONDS', , 'ENV_EM_CHAT_REFRESH_SECONDS', 20);
var('MAX_ADDRESS_FOR_WALLET', 'ENV_EM_MAX_ADDRESS_FOR_WALLET', 15);

?>
