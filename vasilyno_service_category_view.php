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
if ($id) $service_category = sql_get_row ($VASILYNO['db_service_category'], $id);





/* НАЧАЛСЯ ВЫВОД НА ЭКРАН */

$url = $VASILYNO['url'];

?>

<? html_title2 ($HTML['TITLE']) ?>
<!--<? html_title3 ("Просмотр сведений о профессиях") ?>-->
<? html_title3 (VASILYNO_short_name ($service_category['name_service_category'])) ?>

<table class="tbl_form" border="1">
<tbody>
<tr><th>#id</th><td><?=$service_category['id']?></td></tr>
<tr><th>Профессия:</th><td><?=$service_category['name_service_category']?></td></tr>
</tbody>
</table>

<div class="mt20">
[<a class="admin" title="Редактировать данные о профессиях" href="<?=$url?>.service_category_form.<?=$service_category['id']?>">Редактировать</a>]
</div>

<div class="mt20">
[<a href="<?=$url?>.service_category">К списку профессий</a>]
<!--
[<a title="Перейти к предыдущей странице" href="javascript:history.back();">Назад</a>]
-->
</div>
