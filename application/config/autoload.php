<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$autoload['packages'] = array();
$autoload['libraries'] = array('database','user_agent','session');
$autoload['drivers'] = array();
$autoload['helper'] = array('url','general');
$autoload['config'] = array('pagination');
$autoload['language'] = array();
$autoload['model'] = array('Authentication');
// ,'Mdatatables','Mgetdata',
//                             'Musers','Mproviders','Mservices',
//                             'Mpackages','Mmember','Mlabs',
//                             'Mreports','Monlineregistrations','Mproviderrole',
//                             'Mbranchs','Mimports','Mtemplates','Mcoupons','Mresultgenerator','Mtodaylabs');
