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
if ($id) $material = sql_get_row ($VASILYNO['db_material'], $id);





/* НАЧАЛСЯ ВЫВОД НА ЭКРАН */

$url = $VASILYNO['url'];

?>

<? html_title2 ($HTML['TITLE']) ?>
<!--<? html_title3 ("Просмотр сведений о материале") ?>-->
<? html_title3 (VASILYNO_short_name ($material['name'])) ?>

<table class="tbl_form" border="1">
<tbody>
<tr><th>#id</th><td><?=$material['id']?></td></tr>
<tr><th>Название материала:</th><td><?=$material['name']?></td></tr>
<tr><th>Группа материалов:</th><td><?=$material['group_of_mat']?></td></tr>
<tr><th>Объем:</th><td><?=$material['volume']?></td></tr>
<tr><th>Цена:</th><td><?=$material['price_ed']?></td></tr>
<tr><th>Коэффициент:</th><td><?=$material['coeff']?></td></tr>
</tbody>
</table>

<div class="mt20">
[<a class="admin" title="Редактировать данные о материале" href="<?=$url?>.material_form.<?=$material['id']?>">Редактировать</a>]
</div>

<div class="mt20">
[<a href="<?=$url?>.material">К списку материалов</a>]
<!--
[<a title="Перейти к предыдущей странице" href="javascript:history.back();">Назад</a>]
-->
</div>
