<?php

/*
    Evening Sphere Portal
	Written by (c) 2015-2017 EC Labs.

	MODULE: vasilyno
    TYPE:   action
    FILE:   vasilyno_client_form.php
	AUTHOR: andreas, 11/2017
	DESCRIPTION: vasilyno module for Vasily V. Novikov
*/


// считываем id клиента
$id = (int) $module['query'][0];

// запрос в БД
if ($id) $client = sql_get_row ($VASILYNO['db_client'], $id);

// заполняем заголовок
if ($id) $title = "Редактирование данных о клиенте";
else $title = "Добавление данных о клиенте";





/* НАЧАЛСЯ ВЫВОД НА ЭКРАН */

$url = $VASILYNO['url'];

if ($id) $action = "edit";
else $action = "new";

?>

<? html_title2 ($HTML['TITLE']) ?>
<? html_title3 ($title) ?>

<form action="<?=$url?>.client" method="POST">
<input type='hidden' name='action' value="<?=$action?>" />
<? if ($id) : ?>
<input type='hidden' name='id' value="<?=$id?>" />
<? endif ; ?>

<table class="tbl_form" border=1>
<tbody>
<tr><th>ФИО клиента:<span class="red">*</span></th><td><input required type='text' name='name'  autocomplete="off" value='<?=$client['name']?>' style="width: 400px;" /></td></tr>
<tr><th>Дата рождения:</th><td><input placeholder='ДД.ММ.ГГГГ' type='date' name='birthday'  autocomplete="off" value='<?=VASILYNO_print_date ($client['birthday'])?>' style="width: 200px;" /></td></tr>
<tr><th>Email:</th><td><input type='email' name='email'  autocomplete="off" value='<?=$client['email']?>' style="width: 400px;" /></td></tr>
<tr><th>Телефон:</th><td><input type="tel" aria-invalid="false" aria-required="true" placeholder="Телефон +7(___)___-__-__" title="Номер должен содержать 11 цифр и начинаться с +7 или 8" value='<?=$client['phone']?>' style="width: 400px;" pattern="^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{10,10}$" maxlength='15' name='Phone'  autocomplete="off" /></td></tr>
<tr><th>Дополнительная <br />информация:</th><td><textarea name="note"  autocomplete="off" style="width: 400px; height: 100px;"><?=$client['note']?></textarea></td></tr>
</tbody>
</table>

<div class="mb20 medium gray">
Обязательные поля помечены знаком (<span class="red">*</span>).
</div>

<input type='submit' value='Сохранить' />
</form>

<br /><br />[<a class="admin" href="<?=$url?>.client">Не сохранять</a>]

