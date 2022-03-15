<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$active_group = 'default';
$query_builder = TRUE;

if($_SERVER['CI_ENV']=="development"){
	$db['default'] = array(
		'dsn'	=> '',
		'hostname' => '128.199.137.36',
		'username' => 'adhimas',
		'password' => 'Bandung@@2022',
		'database' => 'apidb',
		'dbdriver' => 'mysqli',
		'dbprefix' => '',
		'pconnect' => FALSE,
		'db_debug' => TRUE,
		'cache_on' => FALSE,
		'cachedir' => '',
		'char_set' => 'utf8',
		'dbcollat' => 'utf8_general_ci',
		'swap_pre' => '',
		'encrypt' => FALSE,
		'compress' => FALSE,
		'stricton' => FALSE,
		'failover' => array(),
		'save_queries' => TRUE,
		// '_protect_identifiers' => FALSE
	);
}
else{
	$db['default'] = array(
		'dsn'	=> '',
		'hostname' => '128.199.137.36',
		'username' => 'adhimas',
		'password' => 'Bandung@@2022',
		'database' => 'apidb',
		'dbdriver' => 'mysqli',
		'dbprefix' => '',
		'pconnect' => FALSE,
		'db_debug' => FALSE,
		'cache_on' => FALSE,
		'cachedir' => '',
		'char_set' => 'utf8',
		'dbcollat' => 'utf8_general_ci',
		'swap_pre' => '',
		'encrypt' => FALSE,
		'compress' => FALSE,
		'stricton' => FALSE,
		'failover' => array(),
		'save_queries' => TRUE,
		// '_protect_identifiers' => FALSE
	);
}



