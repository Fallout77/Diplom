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
if ($id) $material = sql_get_row ($VASILYNO['db_material'], $id);

// заполняем заголовок
if ($id) $title = "Редактирование данных о материале";
else $title = "Добавление данных о материале";





/* НАЧАЛСЯ ВЫВОД НА ЭКРАН */

$url = $VASILYNO['url'];

if ($id) $action = "edit";
else $action = "new";

?>

<? html_title2 ($HTML['TITLE']) ?>
<? html_title3 ($title) ?>

<form action="<?=$url?>.material" method="POST">
<input type='hidden' name='action' value="<?=$action?>" />
<? if ($id) : ?>
<input type='hidden' name='id' value="<?=$id?>" />
<? endif ; ?>

<table class="tbl_form" border=1>
<tbody>
<tr><th>Название материала:<span class="red">*</span></th><td><input required type='text' name='name' value='<?=$material['name']?>' style="width: 400px;" /></td></tr>
<tr><th>Группа материалов:</th><td><input type='text' name='group_of_mat' value='<?=$material['group_of_mat']?>' style="width: 400px;" /></td></tr>
<tr><th>Объем:</th><td><input type='text' name='volume' value='<?=$material['volume']?>' style="width: 400px;" /></td></tr>
<tr><th>Цена:</th><td><input type='text' name='price_ed' value='<?=$material['price_ed']?>' style="width: 400px;" /></td></tr>
<tr><th>Коэффициент:</th><td><input name='coeff' value='<?=$material['coeff']?>' style="width: 400px;"/> </td></tr>
</tbody>
</table>

<div class="mb20 medium gray">
Обязательные поля помечены знаком (<span class="red">*</span>).
</div>

<input type='submit' value='Сохранить' />
</form>

<br /><br />[<a class="admin" href="<?=$url?>.material">Не сохранять</a>]
