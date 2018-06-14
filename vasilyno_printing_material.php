<?php

require_once 'Classes/PHPExcel.php';

$price_list = VASILYNO_get_material();

$objPHPExcel = new PHPEXcel();

$objPHPExcel->setActiveSheetIndex(0);

//$objPHPExcel->createSheet();

$active_sheet = $objPHPExcel->getActiveSheet();

$active_sheet->getPageSetup()
			->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
			
$active_sheet->getPageSetup()
			->SetPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
			
			
$active_sheet->getPageMargins()->setTop(1);
$active_sheet->getPageMargins()->setRight(0.75);
$active_sheet->getPageMargins()->setLeft(0.75);
$active_sheet->getPageMargins()->setBottom(1);

$active_sheet->setTitle("Расходные материалы");	

$active_sheet->getHeaderFooter()->setOddHeader("&CШапка нашего листа");	
$active_sheet->getHeaderFooter()->setOddFooter('&L&B'.$active_sheet->getTitle().'&RСтраница &P из &N');

$objPHPExcel->getDefaultStyle()->getFont()->setName('Arial');
$objPHPExcel->getDefaultStyle()->getFont()->setSize(8);	


$active_sheet->getColumnDimension('A')->setWidth(7);
$active_sheet->getColumnDimension('B')->setWidth(35);
$active_sheet->getColumnDimension('C')->setWidth(30);
$active_sheet->getColumnDimension('D')->setWidth(30);
$active_sheet->getColumnDimension('E')->setWidth(30);

$active_sheet->mergeCells('A1:E1');
$active_sheet->getRowDimension('1')->setRowHeight(40);
$active_sheet->setCellValue('A1','НОУ "Учебный центр" Знание"');

$active_sheet->mergeCells('A2:E2');
$active_sheet->setCellValue('A2','Управление материалами');

$active_sheet->setCellValue('A6','№п.п');
$active_sheet->setCellValue('B6','Название материала');
$active_sheet->setCellValue('C6','Цена продукта');
$active_sheet->setCellValue('D6','Цена за грамм');
$active_sheet->setCellValue('E6','Код Материала');

$row_start = 7;
$i = 0;
foreach($price_list as $item) {
	$row_next = $row_start + $i;
	
	$active_sheet->setCellValue('A'.$row_next,$item['id']);
	$active_sheet->setCellValue('B'.$row_next,$item['name_material']);
	$active_sheet->setCellValue('C'.$row_next,$item['price_product']);
	$active_sheet->setCellValue('D'.$row_next,$item['price_per_gram_product']);
	$active_sheet->setCellValue('E'.$row_next,$item['material_code']);
	
	$i++;
}

$style_wrap = array(
	'borders'=>array(
		'outline' => array(
			'style'=>PHPExcel_Style_Border::BORDER_THICK
		),
		'allborders'=>array(
			'style'=>PHPExcel_Style_Border::BORDER_THIN,
			'color' => array(
				'rgb'=>'696969'
			)
		)
	
	)


);

$active_sheet->getStyle('A1:E'.($i+6))->applyFromArray($style_wrap);


$style_header = array(
	'font'=>array(
		'bold' => true,
		'name' => 'Times New Roman',
		'size' => 20
	),
	'alignment' => array(
		'horizontal' => PHPExcel_STYLE_ALIGNMENT::HORIZONTAL_CENTER,
		'vertical' => PHPExcel_STYLE_ALIGNMENT::VERTICAL_CENTER,
	),
	'fill' => array(
		'type' => PHPExcel_STYLE_FILL::FILL_SOLID,
		'color'=>array(
			'rgb' => 'CFCFCF'
		)
	)


);

$active_sheet->getStyle('A1:E1')->applyFromArray($style_header);

$style_slogan = array(
	'font'=>array(
		'bold' => true,
		'italic' => true,
		'name' => 'Times New Roman',
		'size' => 13,
		'color'=>array(
			'rgb' => '8B8989'
		)
		
	),
	'alignment' => array(
		'horizontal' => PHPExcel_STYLE_ALIGNMENT::HORIZONTAL_CENTER,
		'vertical' => PHPExcel_STYLE_ALIGNMENT::VERTICAL_CENTER,
	),
	'fill' => array(
		'type' => PHPExcel_STYLE_FILL::FILL_SOLID,
		'color'=>array(
			'rgb' => 'CFCFCF'
		)
	),
	'borders' => array(
		'bottom' => array(
		'style'=>PHPExcel_Style_Border::BORDER_THICK
		)
	
	)

);

$active_sheet->getStyle('A2:E2')->applyFromArray($style_slogan);


$style_tdate = array(
	'alignment' => array(
		'horizontal' => PHPExcel_STYLE_ALIGNMENT::HORIZONTAL_RIGHT,
	),
	'fill' => array(
		'type' => PHPExcel_STYLE_FILL::FILL_SOLID,
		'color'=>array(
			'rgb' => 'CFCFCF'
		)
	),
	'borders' => array(
		'right' => array(
		'style'=>PHPExcel_Style_Border::BORDER_NONE
		)
	
	)


);

$active_sheet->getStyle('A4:D4')->applyFromArray($style_tdate);

$style_date = array(
	
	'fill' => array(
		'type' => PHPExcel_STYLE_FILL::FILL_SOLID,
		'color'=>array(
			'rgb' => 'CFCFCF'
		)
	),
	'borders' => array(
		'left' => array(
			'style'=>PHPExcel_Style_Border::BORDER_NONE
		)
	
	),
	


);

$active_sheet->getStyle('E4')->applyFromArray($style_date);


$style_hprice = array(
	'alignment' => array(
		'horizontal' => PHPExcel_STYLE_ALIGNMENT::HORIZONTAL_CENTER,
	),
	'fill' => array(
		'type' => PHPExcel_STYLE_FILL::FILL_SOLID,
		'color'=>array(
			'rgb' => 'CFCFCF'
		)
	),
	'font'=>array(
		'bold' => true,
		'italic' => true,
		'name' => 'Times New Roman',
		'size' => 10
	),
	


);

$active_sheet->getStyle('A6:E6')->applyFromArray($style_hprice);

$style_price = array(
	'alignment' => array(
		'horizontal' => PHPExcel_STYLE_ALIGNMENT::HORIZONTAL_LEFT,
	)
	

);

$active_sheet->getStyle('A7:E'.($i+6))->applyFromArray($style_price);


header("Content-Type:application/vnd.ms-excel");
header("Content-Disposition:attachment;filename='material.xls'");

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');

exit();