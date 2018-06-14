<?php

/*
    Evening Sphere Portal
    Written by (c) 2015-2017 EC Labs.

    MODULE: vasilyno
    TYPE:   initialization
    FILE:   vasilyno_#init.php
	AUTHOR: andreas, 11/2017
	DESCRIPTION: for Vasily V. Novikov
*/


include (dirname(realpath(__FILE__)). "/vasilyno_#config.php");


if ($sph['action'] == "admin") $HTML['TITLE'] = "Администрирование";
elseif (substr($sph['action'], 0, 6)=="client") $HTML['TITLE'] = "Управление клиентами";
elseif (substr($sph['action'], 0, 8)=="material") $HTML['TITLE'] = "Управление материалами";
else $HTML['TITLE'] = "Vasily V. Novikov's admin panel";
?>
