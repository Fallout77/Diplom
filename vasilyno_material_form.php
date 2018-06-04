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
<tr><th>Название материала:<span class="red">*</span></th><td><input required type='text' name='name'  autocomplete="off" value='<?=$material['name']?>' style="width: 400px;" /></td></tr>
<tr><th>Цена продукта:</th><td><input type='text' name='price_product'  autocomplete="off" value='<?=$material['price_product']?>' style="width: 400px;" /></td></tr>
<tr><th>Цена за грамм:</th><td><input type='text' name='price_per_gram_product'  autocomplete="off" value='<?=$material['price_per_gram_product']?>' style="width: 400px;" /></td></tr>
<tr><th>Объем на складе:</th><td><input type='text' name='volume_in_storage'  autocomplete="off" value='<?=$material['volume_in_storage']?>' style="width: 400px;" /></td></tr>
<tr><th>Код материала:</th><td><input type='text' name='material_code'  autocomplete="off" value='<?=$material['material_code']?>' style="width: 400px;" /></td></tr>
<tr><th>Информация:</th><td><textarea name="description"  autocomplete="off" style="width: 400px; height: 100px;"><?=$material['description']?></textarea> </td></tr>
</tbody>
</table>

<div class="mb20 medium gray">
Обязательные поля помечены знаком (<span class="red">*</span>).
</div>

<input type='submit' value='Сохранить' />
</form>

<br /><br />[<a class="admin" href="<?=$url?>.material">Не сохранять</a>]
