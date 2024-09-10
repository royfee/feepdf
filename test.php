<?php
require './vendor/autoload.php';

use royfee\feepdf\Fpdi;

//
$fpdi = new Fpdi();
$fpdi->AddGBFont('simhei', '黑体');

/*
$fpdi->setSourceFile('1.pdf');
$tplid = $fpdi->importPage(1);
$specs = $fpdi->getTemplateSize($tplid);
$fpdi->AddPage('P',[$specs['width'],$specs['height']]);
$fpdi->useTemplate($tplid);
*/

$fpdi->AddPage('P',[100,150]);

//面单添加文字
$fpdi->SetFont('simhei','',13);
$fpdi->SetXY(1, 10);
$fpdi->Write(0,iconv("UTF-8","gbk",'中文测试'));

$fpdi->SetXY(1, 129);
$fpdi->Write(0,iconv("UTF-8","gbk",'打印测试'));

$fpdi->Output();


///创建pdf文件并输出
$pdf = new \royfee\feepdf\Fpdf;
$pdf->AddGBFont('simhei');
$pdf->AddPage();
$pdf->SetFont('simhei', '', 13);
$pdf->MultiCell(180,10,iconv("utf-8","gbk","多行会自动换行"));

//显示一格
$pdf->Cell(40,10,iconv("utf-8","gbk","第一个单元格"));
$pdf->Ln();//换行
$pdf->Cell(40,10,iconv("utf-8","gbk","第二个单元格"));
$pdf->Ln();//换行

//输出表格
//Cell方法最后一个参数表示是否显示边框
$pdf->Cell(60,10,iconv("utf-8","gbk","姓名"),1);
$pdf->Cell(60,10,iconv("utf-8","gbk","性别"),1);
$pdf->Ln();
$pdf->Cell(60,10,iconv("utf-8","gbk","张三"),1);
$pdf->Cell(60,10,iconv("utf-8","gbk","男"),1);
$pdf->Ln();
$pdf->Cell(60,10,iconv("utf-8","gbk","李四"),1);
$pdf->Cell(60,10,iconv("utf-8","gbk","女"),1);
$pdf->Ln();
$pdf->Output();//直接输出，即在浏览器显示

//修改pdf
$pdf = new \royfee\feepdf\Fpdi;
$file = 'EYT4090945199SZ.pdf';
$pdf->setSourceFile($file);
$template = $pdf->importPage(1);
$specs = $pdf->getTemplateSize($template);
$pdf->AddPage('P',[$specs['width'],$specs['height']]);
$pdf->useTemplate($template); 

$pdf->image("roymail-return-address.png", 76, 75, 19);
$pdf->Output($file,'F');
