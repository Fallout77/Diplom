<?php

/*
	Evening Sphere Portal
	Written by (c) 2015-2018 EC Labs.

	MODULE: vasilyno
	TYPE:   action
	FILE:   vasilyno_material_view.php
	AUTHOR: andreas, 03/2018
	DESCRIPTION: vasilyno module for Vasily V. Novikov
*/


// считываем id материала
$id = (int) $module['query'][0];

// запрос в БД
if ($id) $category_material = sql_get_row ($VASILYNO['db_category_material'], $id);





/* НАЧАЛСЯ ВЫВОД НА ЭКРАН */

$url = $VASILYNO['url'];

?>

<? html_title2 ($HTML['TITLE']) ?>
<!--<? html_title3 ("Просмотр сведений о категориях") ?>-->
<? html_title3 (VASILYNO_short_name ($category_material['name_material_category'])) ?>

<table class="tbl_form" border="1">
<tbody>
<tr><th>#id</th><td><?=$category_material['id']?></td></tr>
<tr><th>Категория:</th><td><?=$category_material['name_material_category']?></td></tr>
</tbody>
</table>

<div class="mt20">
[<a class="admin" title="Редактировать данные о категориях" href="<?=$url?>.category_material_form.<?=$category_material['id']?>">Редактировать</a>]
</div>

<div class="mt20">
[<a href="<?=$url?>.category_material">К списку категорий</a>]
<!--
[<a title="Перейти к предыдущей странице" href="javascript:history.back();">Назад</a>]
-->
</div>
