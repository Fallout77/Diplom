<?php

/*
	Evening Sphere Portal
	Written by (c) 2015-2017 EC Labs.

	MODULE: vasilyno
	TYPE:   action
	FILE:   vasilyno_client.php
	AUTHOR: andreas, 03/2018
	DESCRIPTION: vasilyno module for Vasily V. Novikov
*/


// ***** Добавление или редактирование
if ($_POST["action"])
{
	//..................................................................
	// *** считываем POST
	$sql_str = "";
	foreach ($_POST as $key=>$val)
	{
		$_POST[$key] = sql_clear ($val);
		$key = sql_clear ($key);
		$val = sql_clear ($val);
		
		if ($key == "action") continue;
		
		
		if ($sql_str) $sql_str .= ", ";
		$sql_str .= "`$key`='$val'";
	}
	//...................................................................
	// *** Добавление или редактирование
	$query = "INSERT INTO `{$VASILYNO['db_master']}` SET $sql_str ON DUPLICATE KEY UPDATE $sql_str";
	//print_pre ($query);
	$result = sql_query ($query);
	if (sql_aff_rows() > 0)
	{
		if (!$_POST['id']) $_POST['id'] = sql_last_id ();
		
		$warning = "Данные о мастере #{$_POST['id']} [{$_POST['name_master']}] сохранены в БД";
		if ($VASILYNO['log'] ) sql_log_write ($warning, $module['current'], $module['action'], 'VASILYNO_MATERIAL_SAVE');
	}
	else $error = "Запись не сохранена в БД";
}

// ***** удаление
$del = (int) $_GET["del"];

if ($del)
{
	$query  = "DELETE FROM `{$VASILYNO['db_master']}` WHERE `id`='{$del}' LIMIT 1";
	$result = sql_query ($query);
	if (sql_aff_rows() > 0)
	{
		$warning = "Материал #$del успешно удален";
		if ($VASILYNO['log']) sql_log_write ($warning, $module['current'], $module['action'], 'VASILYNO_MATERIAL_DEL');
	}
	else $error = "Не удалось удалить мастера #$del";
}


// поиск
$str = sql_clear ($_GET["str"]);
$search = sql_clear ($_GET["search"]);
if ($str) $WHERE = "AND `$search` LIKE '%$str%'";

// сортировка
$order = sql_clear ($_GET["order"]);
if (!$order) $order = "name";
$SORT = "ORDER BY `$order` ASC";

// работа со страницами
$page = (int) $_GET["page"];
if (!$page) $page = 1;
$lines_on_page = (int) $_GET["lines"];
if (!$lines_on_page) $lines_on_page = $VASILYNO['clients_on_page'];
$limit = ($page * $lines_on_page) - $lines_on_page;

// запрос в БД
$query  = "SELECT * FROM `{$VASILYNO['db_master']}` WHERE 1 $WHERE $SORT LIMIT $limit,$lines_on_page";
//print_pre ($query);
$result = sql_query ($query);
$total_view = mysqli_num_rows ($result);
if ($total_view > 0) $array_master = sql_to_array ($result);

// сколько всего
$total = sql_get_num ($VASILYNO['db_master']);
//-$total_activ = sql_get_num ($VASILYNO['db_client'], "status", 10);
//-$total_ingroup = sql_get_num ($VASILYNO['db_client'], "", "", "AND `group`!='0'");





/* ***** НАЧАЛСЯ ВЫВОД НА ЭКРАН ********************************************* */

?>

<? html_title2 ($HTML['TITLE']) ?>

<?

$url = $VASILYNO['url'];
$url_sort = "{$VASILYNO['url']}.master&search=$search&str=$str";
$url_page = "{$VASILYNO['url']}.master&search=$search&str=$str&order=$order";

?>

<div>
<? if ($error) print_error ($error); ?>
<? if ($warning) print_warning ($warning); ?>
</div>

<form action="/?id=vasilyno.master" method="GET">
<input type='hidden' name='id' value="vasilyno.master" />
<input type='hidden' name='order' value="<?=$order?>" />
<input type='hidden' name='mode' value="<?=$mode?>" />

<?

$VASILYNO['val']['search'] = $search;
function VASILYNO_search ($name1, $name2)
{
	global $VASILYNO;
	
	echo "<option value='$name1'";
	if ($name1 == $VASILYNO['val']['search']) echo " selected";
	echo ">$name2</option>";
}

?>

<table border=0>
<tbody>
<tr>
	<td>
		<select name='search'>
			<? VASILYNO_search ("name_master", "Мастер") ?>
			<? VASILYNO_search ("sex", "Направленность") ?>
		</select>
	</td>
	<td><input type='text' name='str' value='<?=$str?>' style='width: 400px;' /></td>
	<td><input type='submit' value='Искать' /></td>
</tr>
</tbody>
</table>

</form>

<div class="fright">
Показывать по 
<? if ($lines_on_page==25) : ?><b>25</b><? else :?><a href="<?=$url_page?>&lines=25">25</a><? endif ;?>, <? if ($lines_on_page==50) : ?><b>50</b><? else :?><a href="<?=$url_page?>&lines=50">50</a><? endif ;?>, <? if ($lines_on_page==100) : ?><b>100</b><? else :?><a href="<?=$url_page?>&lines=100">100</a><? endif ;?>
</div>

<!--
<div class="mt20 mb20">
<b>Всего</b> мастеров: <?=$total?>
</div>

<div class="mb20">
[<a class="admin" href="<?=$url?>.student_form">Добавить</a>]
</div>
-->

<table class="mt20 tbl_student" border=1>
<thead>
<tr>
	<th><a href="<?=$url_sort?>&order=id">#</a><? if ($order=="id") echo "▼"; ?></th>
	<th><a href="<?=$url_sort?>&order=name">Мастер</a><? if ($order=="name_master") echo "▼"; ?></th>
    <th><a href="<?=$url_sort?>&order=sex">Направленность</a><? if ($order=="sex") echo "▼"; ?></th>
	<th>Телефон</th>
    <th>График работы</th>
	<th>ADMIN</th>
</tr>
</thead>

<tbody>
<? if ($total_view) : /* Если есть мастера */ ?>
<? foreach ($array_master as $master) : ?>
<tr>
	<td class="tbl_id"><?=$master['id']?></td>
	<td><a href="<?=$url?>.master_view.<?=$master['id']?>"><?=$master['name_master']?></a></td>
	<td><?=$master['sex']?></td>
	<td><?=$master['phone']?></td>
    <td><?=nl2br($master['working_time'])?></td>
	<td class="tbl_admin">[<a href="<?=$url?>.master_form.<?=$master['id']?>">Редактировать</a>]&nbsp;&nbsp;[<a href="#" onclick="_.confirm('Материал #<?=$master['id']?> `<?=$master['name_master']?>` будет удален. Продолжить?', '<?="{$url_page}&lines={$lines_on_page}&del={$master['id']}"?>')">Удалить</a>]</td>
</tr>
<? endforeach ; ?>
<? else : /* Если нет материалов */ ?>
<tr>
	<td colspan=7 class="">Записи не найдены</td>
</tr>
<? endif ; /* Если есть/нет материалов */ ?>
</tbody>

</table>

<div class="mt20">
[<a class="admin" href="<?=$url?>.master_form">Добавить</a>]
</div> 

<div class="mt20 mb20">
<b>Всего</b> мастеров: <?=$total?>, из них показано: <?=$total_view?>, страница: <?=$page?>
</div>

<div class="mt10">
<b>Навигация</b> по страницам: 
<? print_navigation ($page, $lines_on_page, $total, "$url_page&lines=$lines_on_page", "", array("current"=>"page-sel", "other"=>"page-notsel")); ?>
</div>