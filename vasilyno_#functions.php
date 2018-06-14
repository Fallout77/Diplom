<?php

/*
	Evening Sphere Portal
	Written by (c) 2015-2017 EC Labs.

	MODULE:	vasilyno
	TYPE:	functions
	FILE:	vasilyno_#functions.php
	AUTHOR: andreas, 11/2017
	DESCRIPTION: for Vasily V. Novikov
*/


// форматирование даты
function VASILYNO_print_date ($date1, $str1="")
{
	if (!$date1 || $date1=="0000-00-00") return $str1;
	else return date("d.m.Y", strtotime($date1));
}

// вычисление и форматирование возраста
function VASILYNO_print_old ($date1, $str1="")
{
	if (!$date1 || $date1=="0000-00-00") return $str1;

	$day = date("j", strtotime($date1));
	$month = date("n", strtotime($date1));
	$year = date("Y", strtotime($date1));

	$day2 = date("j");
	$month2 = date("n");
	$year2 = date("Y");

	$return = date("Y") - $year;

	if ($month < $month2)
	{
	}
	elseif ($month == $month2)
	{
		if ($day < $day2) ;
		elseif ($day == $day2) ;
		if ($day > $day2) $return -= 1;
	}
	elseif ($month > $month2)
	{
		$return -= 1;
	}
	
	//$return = date("Y") - date("Y", strtotime($date1));

	if ($return==0) $return = "новорожденный";
	elseif ($return==1) $return .= " год";
	elseif ($return>=2 && $return<=4) $return .= " года";
	elseif ($return>=5 && $return<=20) $return .= " лет";
	else
	{
		$char = "$return";
		$char = $char[1];
		if ($char==1) $return .= " год";
		elseif ($char>=2 && $char<=4) $return .= " года";
		elseif ($char>=5 && $char<=9) $return .= " лет";
		elseif ($char==0) $return .= " лет";
	}
	
	return $return;
}

// краткое имя клиента
function VASILYNO_short_name ($name1, $key1=1)
{
	if (!strpos($name1, " ")) return $name1;
	
	if ($key1 == 1) return substr($name1, 0, strpos($name1, " ")+3). ".";
}


?>
