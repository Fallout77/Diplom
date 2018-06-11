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
if ($id) $service_type = sql_get_row ($VASILYNO['db_service_type'], $id);





/* НАЧАЛСЯ ВЫВОД НА ЭКРАН */

$url = $VASILYNO['url'];

?>

<? html_title2 ($HTML['TITLE']) ?>
<!--<? html_title3 ("Просмотр сведений о сервисах") ?>-->
<? html_title3 (VASILYNO_short_name ($service_type['name_service_type'])) ?>

<table class="tbl_form" border="1">
<tbody>
<tr><th>#id</th><td><?=$service_type['id']?></td></tr>
<tr><th>Сервис:</th><td><?=$service_type['name_service_type']?></td></tr>
<tr><th>Цена:</th><td><?=$service_type['price']?></td></tr>
</tbody>
</table>

<div class="mt20">
[<a class="admin" title="Редактировать данные о сервисе" href="<?=$url?>.service_type_form.<?=$service_type['id']?>">Редактировать</a>]
</div>

<div class="mt20">
[<a href="<?=$url?>.service_type">К списку сервисов</a>]
<!--
[<a title="Перейти к предыдущей странице" href="javascript:history.back();">Назад</a>]
-->
</div>
