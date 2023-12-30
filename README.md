# feepdf
基于 setasign/fpdi库，增加了中文支持


- 创建pdf，并输出

```php
$pdf = new \royfee\feepdf\Fpdf;
$pdf->AddGBFont('simhei');
$pdf->AddPage();
$pdf->SetFont('simhei', '', 13);
$pdf->MultiCell(180,10,iconv("utf-8","gbk","多行会自动换行"));

$pdf->Cell(40,10,iconv("utf-8","gbk","单元格一"));
$pdf->Ln();
$pdf->Cell(40,10,iconv("utf-8","gbk","单元格二"));
$pdf->Ln();

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
//$pdf->Output('example.pdf','F');//保存为example.pdf文件
```

- 合并pdf
```php
$pdi  = new \royfee\feepdf\Fpdi;
$page_count =  $pdi->setSourceFile('133.pdf');
//读取pdf中的每一页
for( $i = 1 ; $i <= $page_count ; $i++){
    $pageId = $pdi->importPage($i);
    $size = $pdi->getTemplateSize($pageId);
    $pdi->AddPage($size['orientation'],$size);
    $pdi->useTemplate($pageId);
    $pdi->SetFont('Helvetica');
    $pdi->SetXY(5,5);
}
$pdi->Output();
```
