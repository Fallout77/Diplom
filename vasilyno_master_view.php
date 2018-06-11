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
if ($id) $master = sql_get_row ($VASILYNO['db_master'], $id);





/* НАЧАЛСЯ ВЫВОД НА ЭКРАН */

$url = $VASILYNO['url'];

?>

<? html_title2 ($HTML['TITLE']) ?>
<!--<? html_title3 ("Просмотр сведений о мастерах") ?>-->
<? html_title3 (VASILYNO_short_name ($master['name_master'])) ?>

<table class="tbl_form" border="1">
<tbody>
<tr><th>#id</th><td><?=$master['id']?></td></tr>
<tr><th>Мастер:</th><td><?=$master['name_master']?></td></tr>
<tr><th>Направленность:</th><td><?=$master['sex']?></td></tr>
<tr><th>Телефон:</th><td><?=$master['phone']?></td></tr>
<tr><th>График работы:</th><td class="medium"><?=nl2br($master['working_time'])?></td></tr>
</tbody>
</table>

<div class="mt20">
[<a class="admin" title="Редактировать данные о мастере" href="<?=$url?>.master_form.<?=$master['id']?>">Редактировать</a>]
</div>

<div class="mt20">
[<a href="<?=$url?>.master">К списку мастеров</a>]
<!--
[<a title="Перейти к предыдущей странице" href="javascript:history.back();">Назад</a>]
-->
</div>
