<?php

/*
	Evening Sphere Portal
	Written by (c) 2015-2017 EC Labs.

	MODULE: vasilyno
	TYPE:	config
	FILE:	vasilyno_#config.php
	AUTHOR: andreas, 11/2017
	DESCRIPTION: for Vasily V. Novikov
*/


// основные переменные
$VASILYNO['name']	= $module['current'];
$VASILYNO['ver']	= "1.0"; // andreas 2017-11-01
$VASILYNO['rootdir']= $module['path']. "/". $module['current'];
$VASILYNO['log']	= $sph['log_on'];
$VASILYNO['url']	= $sph['core']. "?id=". $module['current'];
$VASILYNO['admins']	= 'vasilyno_admins';
$VASILYNO['clients_on_page'] = 50;

// таблицы
global $db;
$VASILYNO['db_client'] = $db['prefix']. 'VASILYNO_client';
$VASILYNO['db_material'] = $db['prefix']. 'VASILYNO_material';
/*
// подключение шаблонов
$return_tpl = 1;

// переопределение переменных в user_config
$filename = dirname(realpath(__FILE__)). '/_'. $module['current']. '_#user_config'. $module['mask'];
if (file_exists($filename)) include ($filename);
*/

// подключение функций модуля, опционально
$filename = dirname(realpath(__FILE__)). '/'. $module['current']. '_#functions'. $module['mask'];
if (file_exists($filename)) include_once ($filename);


?>
