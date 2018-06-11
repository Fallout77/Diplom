<?php

/*
    Evening Sphere Portal
	Written by (c) 2015-2018 EC Labs.

	MODULE: vasilyno
    TYPE:   action
    FILE:   vasilyno_client_form.php
	AUTHOR: andreas, 03/2018
	DESCRIPTION: vasilyno module for Vasily V. Novikov
*/


// считываем id материала
$id = (int) $module['query'][0];

// запрос в БД
if ($id) $brand = sql_get_row ($VASILYNO['db_brand'], $id);

// заполняем заголовок
if ($id) $title = "Редактирование данных о бренде";
else $title = "Добавление данных о бренде";





/* НАЧАЛСЯ ВЫВОД НА ЭКРАН */

$url = $VASILYNO['url'];

if ($id) $action = "edit";
else $action = "new";

?>

<? html_title2 ($HTML['TITLE']) ?>
<? html_title3 ($title) ?>

<form action="<?=$url?>.brand" method="POST">
<input type='hidden' name='action' value="<?=$action?>" />
<? if ($id) : ?>
<input type='hidden' name='id' value="<?=$id?>" />
<? endif ; ?>

<table class="tbl_form" border=1>
<tbody>
<tr><th>Бренд:<span class="red">*</span></th><td><input required type='text' name='name_brand'  autocomplete="off" value='<?=$brand['name_brand']?>' style="width: 400px;" /></td></tr>
</tbody>
</table>

<div class="mb20 medium gray">
Обязательные поля помечены знаком (<span class="red">*</span>).
</div>

<input type='submit' value='Сохранить' />
</form>

<br /><br />[<a class="admin" href="<?=$url?>.brand">Не сохранять</a>]
