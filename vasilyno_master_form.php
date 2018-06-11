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
if ($id) $master = sql_get_row ($VASILYNO['db_master'], $id);

// заполняем заголовок
if ($id) $title = "Редактирование данных о мастере";
else $title = "Добавление данных о мастере";





/* НАЧАЛСЯ ВЫВОД НА ЭКРАН */

$url = $VASILYNO['url'];

if ($id) $action = "edit";
else $action = "new";

?>

<? html_title2 ($HTML['TITLE']) ?>
<? html_title3 ($title) ?>

<form action="<?=$url?>.master" method="POST">
<input type='hidden' name='action' value="<?=$action?>" />
<? if ($id) : ?>
<input type='hidden' name='id' value="<?=$id?>" />
<? endif ; ?>

<table class="tbl_form" border=1>
<tbody>
<tr><th>Мастер:<span class="red">*</span></th><td><input required type='text' name='name_master'  autocomplete="off" value='<?=$master['name_master']?>' style="width: 400px;" /></td></tr>
<tr><th>Направленность муж/жен:</th><td><input type='text' name='sex' list="sex" autocomplete="off" value='<?=$master['sex']?>' style="width: 400px;" /></td></tr>
  <datalist id="sex">
	<option value="Мужское">
	<option value="Женское">
</datalist>
<tr><th>Специальность:</th><td><input type='text' name='specialty' autocomplete="off" value='<?=$master['specialty']?>' style="width: 400px;" /></td></tr>
<tr><th>Телефон:</th><td><input type="tel" aria-invalid="false" aria-required="true" placeholder="Телефон +7(___)___-__-__" title="Номер должен содержать 11 цифр и начинаться с +7 или 8" value='<?=$master['phone']?>' style="width: 400px;" pattern="^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{10,10}$" maxlength='15' name='Phone'  autocomplete="off" /></td></tr>
<tr><th>График работы:</th><td><textarea name="working_time"  autocomplete="off" style="width: 400px; height: 100px;"><?=$master['working_time']?></textarea></td></tr>
</tbody>
</table>

<div class="mb20 medium gray">
Обязательные поля помечены знаком (<span class="red">*</span>).
</div>

<input type='submit' value='Сохранить' />
</form>

<br /><br />[<a class="admin" href="<?=$url?>.master">Не сохранять</a>]
