<?php
namespace royfee\feepdf;
use royfee\feepdf\exceptions\ConvertorException;

final class Convertor {
	public const FORMAT_JPG = 'jpg';
	public const FORMAT_PNG = 'png';
	public const FORMAT_GIF = 'gif';
	public const SUPPORTED_FORMATS = [self::FORMAT_JPG, self::FORMAT_PNG, self::FORMAT_GIF];

	public function __construct() {
		throw new \Error('Class ' . get_class($this) . ' is static and cannot be instantiated.');
	}
	
	//临时的
	public static function png(string $image): string {
	    $im = self::process();
	    
		//需在读取图像之前调用
        $im->setResolution(180,180);
        $im->setCompressionQuality(100);
        
		$im->readImageBlob ($image);
		
        // 将第一页转换为PNG格式
        $im->setImageFormat('png');

        $bolb = $im->getImageBlob();

        $im->clear();
        $im->destroy();
        
        return base64_encode($bolb);
	}
	
	private static function  process() : \Imagick{
		if (class_exists('\Imagick') === false) {
			ConvertorException::imagicKIsNotInstalled();
		}

		return new \Imagick;
	}
    
    /*
    
    public function test()
    {
        dump(\royfee\feepdf\Convertor::png(file_get_contents('./323.pdf')));
        //\royfee\feepdf\Convertor::convert('./323.pdf','0406.jpg','png');
        exit;
        $imagick = new \Imagick();
        
        $imagick->setResolution(180,180);
        $imagick->setCompressionQuality(200);
        
        $imagick->readImage('/www/wwwroot/erp.my56.hk/public/323.pdf[0]');
        //$imagick->setImageResolution(50, 50);
        
        // 将第一页转换为PNG格式
        $imagick->setImageFormat('png');
        
        dump(base64_encode($imagick->getImageBlob()));
        
        // 写入图片文件
        $imagick->writeImage('/www/wwwroot/erp.my56.hk/public/323-11111.png');
        // 清理资源
        $imagick->clear();
        $imagick->destroy();
            
        exit('fffEEEE');
        $this->success('返回成功', $this->request->param());
    }

	public function convert(string $pdfPath, ?string $savePath, ?string $format = 'jpg', ?bool $trim = false): void {
		if (\in_array($format = strtolower($format), self::SUPPORTED_FORMATS, true) === false) {
			ConvertorException::unsupportedFormat($format);
		}

		if (\is_file($pdfPath) === false) {
			ConvertorException::fileDoesNotExist($pdfPath);
		}

		try {
			$im = self::process($pdfPath, $savePath, $format);
			if ($trim === true) {
				$im->setImageBorderColor('rgb(255,255,255)');
				$im->trimImage(1);//删除图像的边
				self::write($savePath, (string) $im);
			}
		} catch (\ImagickException $e) {
			throw new ConvertorException($e->getMessage(), $e->getCode(), $e);
		}
	}
	
	private function process(string $pdfPath, string $savePath, string $format): \Imagick {
		$im = new \Imagick;
		
		//需在读取图像之前调用
        $im->setResolution(180,180);
        $im->setCompressionQuality(100);

		$im->readImage($pdfPath);

		$im->setImageFormat($format);

		self::write($savePath, (string) $im);

		return $im;
	}

	private function write(string $file, string $content, ?int $mode = 0666): void {
		static::createDir(dirname($file));
		if (@file_put_contents($file, $content) === false) { // @ is escalated to exception
			throw new ConvertorException('Unable to write file "' . $file . '": ' . self::getLastError());
		}
		if ($mode !== null && !@chmod($file, $mode)) { // @ is escalated to exception
			throw new ConvertorException('Unable to chmod file "' . $file . '": ' . self::getLastError());
		}
	}

	private function createDir(string $dir, int $mode = 0777): void {
		if (!is_dir($dir) && !@mkdir($dir, $mode, true) && !is_dir($dir)) { // @ - dir may already exist
			throw new ConvertorException('Unable to create directory "' . $dir . '": ' . self::getLastError());
		}
	}

	private function getLastError(): string {
		return (string) preg_replace('#^\w+\(.*?\): #', '', error_get_last()['message']);
	}
	*/
}