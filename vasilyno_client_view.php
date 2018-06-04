<?php

/*
	Evening Sphere Portal
	Written by (c) 2015-2017 EC Labs.

	MODULE: vasilyno
	TYPE:   action
	FILE:   vasilyno_client_view.php
	AUTHOR: andreas, 11/2017
	DESCRIPTION: vasilyno module for Vasily V. Novikov
*/


// считываем id клиента
$id = (int) $module['query'][0];

// запрос в БД
if ($id) $client = sql_get_row ($VASILYNO['db_client'], $id);





/* НАЧАЛСЯ ВЫВОД НА ЭКРАН */

$url = $VASILYNO['url'];

?>

<? html_title2 ($HTML['TITLE']) ?>
<!--<? html_title3 ("Просмотр сведений о клиенте") ?>-->
<? html_title3 (VASILYNO_short_name ($client['name'])) ?>

<table class="tbl_form" border="1">
<tbody>
<tr><th>#id</th><td><?=$client['id']?></td></tr>
<tr><th>Имя:</th><td><?=$client['name']?></td></tr>
<tr><th>Возраст:</th><td><?=VASILYNO_print_date ($client['birthday'], "Не указано")?><?

if ($client['birthday'] != "0000-00-00") echo " (". VASILYNO_print_old ($client['birthday']). ")";

?></td></tr>
<tr><th>Email:</th><td><?=$client['email']?></td></tr>
<tr><th>Телефон:</th><td><?=$client['phone']?></td></tr>
<tr><th>Дополнительная <br />информация:</th><td class="medium"><?=nl2br($client['note'])?></td></tr>
</tbody>
</table>

<div class="mt20">
[<a class="admin" title="Редактировать данные о клиенте" href="<?=$url?>.client_form.<?=$client['id']?>">Редактировать</a>]
</div>

<div class="mt20">
[<a href="<?=$url?>.client">К списку клиентов</a>]
<!--
[<a title="Перейти к предыдущей странице" href="javascript:history.back();">Назад</a>]
-->
</div>

