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
if ($id) $brand = sql_get_row ($VASILYNO['db_brand'], $id);





/* НАЧАЛСЯ ВЫВОД НА ЭКРАН */

$url = $VASILYNO['url'];

?>

<? html_title2 ($HTML['TITLE']) ?>
<!--<? html_title3 ("Просмотр сведений о брендах") ?>-->
<? html_title3 (VASILYNO_short_name ($brand['name_brand'])) ?>

<table class="tbl_form" border="1">
<tbody>
<tr><th>#id</th><td><?=$brand['id']?></td></tr>
<tr><th>Бренд:</th><td><?=$brand['name_brand']?></td></tr>
</tbody>
</table>

<div class="mt20">
[<a class="admin" title="Редактировать данные о бренде" href="<?=$url?>.brand_form.<?=$brand['id']?>">Редактировать</a>]
</div>

<div class="mt20">
[<a href="<?=$url?>.brand">К списку брендов</a>]
<!--
[<a title="Перейти к предыдущей странице" href="javascript:history.back();">Назад</a>]
-->
</div>
