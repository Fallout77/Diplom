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
	$query = "INSERT INTO `{$VASILYNO['db_brand']}` SET $sql_str ON DUPLICATE KEY UPDATE $sql_str";
	//print_pre ($query);
	$result = sql_query ($query);
	if (sql_aff_rows() > 0)
	{
		if (!$_POST['id']) $_POST['id'] = sql_last_id ();
		
		$warning = "Данные о бренде #{$_POST['id']} [{$_POST['name_brand']}] сохранены в БД";
		if ($VASILYNO['log'] ) sql_log_write ($warning, $module['current'], $module['action'], 'VASILYNO_MATERIAL_SAVE');
	}
	else $error = "Запись не сохранена в БД";
}

// ***** удаление
$del = (int) $_GET["del"];

if ($del)
{
	$query  = "DELETE FROM `{$VASILYNO['db_brand']}` WHERE `id`='{$del}' LIMIT 1";
	$result = sql_query ($query);
	if (sql_aff_rows() > 0)
	{
		$warning = "Бренд #$del успешно удален";
		if ($VASILYNO['log']) sql_log_write ($warning, $module['current'], $module['action'], 'VASILYNO_MATERIAL_DEL');
	}
	else $error = "Не удалось удалить бренд #$del";
}


// поиск
$str = sql_clear ($_GET["str"]);
$search = sql_clear ($_GET["search"]);
if ($str) $WHERE = "AND `$search` LIKE '%$str%'";

// сортировка
$order = sql_clear ($_GET["order"]);
if (!$order) $order = "name_brand";
$SORT = "ORDER BY `$order` ASC";

// работа со страницами
$page = (int) $_GET["page"];
if (!$page) $page = 1;
$lines_on_page = (int) $_GET["lines"];
if (!$lines_on_page) $lines_on_page = $VASILYNO['clients_on_page'];
$limit = ($page * $lines_on_page) - $lines_on_page;

// запрос в БД
$query  = "SELECT * FROM `{$VASILYNO['db_brand']}` WHERE 1 $WHERE $SORT LIMIT $limit,$lines_on_page";
//print_pre ($query);
$result = sql_query ($query);
$total_view = mysqli_num_rows ($result);
if ($total_view > 0) $array_brand = sql_to_array ($result);

// сколько всего
$total = sql_get_num ($VASILYNO['db_brand']);
//-$total_activ = sql_get_num ($VASILYNO['db_client'], "status", 10);
//-$total_ingroup = sql_get_num ($VASILYNO['db_client'], "", "", "AND `group`!='0'");





/* ***** НАЧАЛСЯ ВЫВОД НА ЭКРАН ********************************************* */

?>

<? html_title2 ($HTML['TITLE']) ?>

<?

$url = $VASILYNO['url'];
$url_sort = "{$VASILYNO['url']}.brand&search=$search&str=$str";
$url_page = "{$VASILYNO['url']}.brand&search=$search&str=$str&order=$order";

?>

<div>
<? if ($error) print_error ($error); ?>
<? if ($warning) print_warning ($warning); ?>
</div>

<form action="/?id=vasilyno.brand" method="GET">
<input type='hidden' name='id' value="vasilyno.brand" />
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
			<? VASILYNO_search ("name_brand", "Бренд") ?>
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
	<th><a href="<?=$url_sort?>&order=name_brand">Бренд</a><? if ($order=="name_brand") echo "▼"; ?></th>
	<th>ADMIN</th>
</tr>
</thead>

<tbody>
<? if ($total_view) : /* Если есть бренд */ ?>
<? foreach ($array_brand as $brand) : ?>
<tr>
	<td class="tbl_id"><?=$brand['id']?></td>
	<td><a href="<?=$url?>.brand_view.<?=$brand['id']?>"><?=$brand['name_brand']?></a></td>
	<td class="tbl_admin">[<a href="<?=$url?>.brand_form.<?=$brand['id']?>">Редактировать</a>]&nbsp;&nbsp;[<a href="#" onclick="_.confirm('Бренд #<?=$brand['id']?> `<?=$brand['name_brand']?>` будет удален. Продолжить?', '<?="{$url_page}&lines={$lines_on_page}&del={$brand['id']}"?>')">Удалить</a>]</td>
</tr>
<? endforeach ; ?>
<? else : /* Если нет бренда */ ?>
<tr>
	<td colspan=7 class="">Записи не найдены</td>
</tr>
<? endif ; /* Если есть/нет бренды */ ?>
</tbody>

</table>

<div class="mt20">
[<a class="admin" href="<?=$url?>.brand_form">Добавить</a>]
</div> 

<div class="mt20 mb20">
<b>Всего</b> брендов: <?=$total?>, из них показано: <?=$total_view?>, страница: <?=$page?>
</div>

<div class="mt10">
<b>Навигация</b> по страницам: 
<? print_navigation ($page, $lines_on_page, $total, "$url_page&lines=$lines_on_page", "", array("current"=>"page-sel", "other"=>"page-notsel")); ?>
</div>