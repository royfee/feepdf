# feepdf
Base on fpdf,fpdi

#增加了中文支持
```php
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
