<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$ip = $_SERVER['SERVER_ADDR'];
$domain = $_SERVER['HTTP_HOST'];
$cliendaddress = $_SERVER['REMOTE_ADDR'];
// if($cliendaddress=="127.0.0.1" || $cliendaddress =="::1"){
//     $serveraddr = "http://localhost/arkatama/";
// }
// else{
//     $serveraddr = "http://192.168.1.23/arkatama/";
// }
if($_SERVER['CI_ENV']=="development"){
    $serveraddr = "http://localhost/apitesting/";
}
else{
    $serveraddr = $protocol."$domain/";
}


$config['base_url'] = $serveraddr;

$config['index_page'] = '';

$config['uri_protocol']	= 'REQUEST_URI';

$config['url_suffix'] = '';

$config['language']	= 'english';

$config['charset'] = 'UTF-8';

$config['enable_hooks'] = FALSE;

$config['subclass_prefix'] = 'MY_';

$config['composer_autoload'] = FALSE;

$config['permitted_uri_chars'] = 'a-z 0-9~%.:_\-';

$config['enable_query_strings'] = FALSE;
$config['controller_trigger'] = 'c';
$config['function_trigger'] = 'm';
$config['directory_trigger'] = 'd';

$config['allow_get_array'] = TRUE;

$config['log_threshold'] = 0;

$config['log_path'] = '';

$config['log_file_extension'] = '';

$config['log_file_permissions'] = 0644;

$config['log_date_format'] = 'Y-m-d H:i:s';

$config['error_views_path'] = '';

$config['cache_path'] = '';

$config['cache_query_string'] = FALSE;

$config['encryption_key'] = '';

$config['sess_driver'] = 'database';
$config['sess_cookie_name'] = 'ci_sessions';
$config['sess_expiration'] = 7200;
$config['sess_save_path'] = 'sessions';
$config['sess_match_ip'] = FALSE;
$config['sess_time_to_update'] = 300;

$config['cookie_prefix']	= '';
$config['cookie_domain']	= '';
$config['cookie_path']		= '/';
$config['cookie_secure']	= FALSE;
$config['cookie_httponly'] 	= FALSE;

$config['standardize_newlines'] = FALSE;

$config['global_xss_filtering'] = FALSE;

$config['csrf_protection'] = FALSE;//TRUE;
$config['csrf_token_name'] = 'systemcsrf';
$config['csrf_cookie_name'] = 'csrf_cookie_name';
$config['csrf_expire'] = 7200;
$config['csrf_regenerate'] = FALSE;
// $config['csrf_exclude_uris'] = array(
//     'api/categories','api/roles','api/users','api/providers','api/services','api/packages','api/labs',
//     'api/labsbystatus/appoinment','api/labsbystatus/unverified','api/labsbystatus/verified','api/members',
//     'api/onlineregistrations','api/providerorders','api/branchs','api/templates','api/coupons','api/todaylabs'
//     );

$config['compress_output'] = FALSE;

$config['time_reference'] = 'Asia/Jakarta';

$config['rewrite_short_tags'] = FALSE;

$config['proxy_ips'] = '';

$config['composer_autoload'] = 'vendor/autoload.php';