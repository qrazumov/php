<?php

namespace App\Services;

use Storage;

class Resize
{

	protected $arrImage;
	protected $arrNewImage;
	protected $arrDimensions;
	const HORIZONTAL = 'horizontal';
	const VERTICAL = 'vertical';
	protected $arrAllowedExt = ['jpg', 'gif', 'png'];


	public function load(string $src) : self
	{
		$this->arrImage['arrImageInfo'] = getimagesize($src);

		switch ($this->arrImage['arrImageInfo'][2]) {
			case IMAGETYPE_JPEG :
				$this->arrImage['res'] = imagecreatefromjpeg($src);
				break;
			case IMAGETYPE_GIF :
				$this->arrImage['res'] = imagecreatefromgif($src);
				break;
			case IMAGETYPE_PNG :
				$this->arrImage['res'] = imagecreatefrompng($src);
				break;
			default :
				throw new \Error('Тип изображения не поддерживается');
		}
		$this->getDimensions();
		
		return $this;
	}

	private function getFilePaths(string $path, array $arrAllowedExt = ['jpg']) : array
	{
		$arrFilePaths = Storage::allFiles($path);
		$arrFiles = [];

		if (!$arrFilePaths) {
			throw new \Error('В папке нет файлов');
		}

		foreach ($arrFilePaths as $k => $v) {

			$ext = pathinfo($v, PATHINFO_EXTENSION);
			$fileName = pathinfo($v, PATHINFO_FILENAME);
	
			if (!in_array($ext, $arrAllowedExt))
				continue;

			$arrFiles[] = [
				'name' => $fileName,
				'ext' => $ext,
				'path' => $v
			];

		}
		// если вообще нет изображений
		if (count($arrFiles) == 0) {
			throw new \Error('В папке нет файлов нужных расширений');
		}

		return $arrFiles;
	}

	private function getDimensions()
	{
		$this->arrImage['width'] = $this->arrImage['arrImageInfo'][0];
		$this->arrImage['height'] = $this->arrImage['arrImageInfo'][1];
	}

	public function resize(int $intSizeTo) : self
	{
		$intRatio = $this->arrImage['width'] / $this->arrImage['height'];
		$strType = ($intRatio >= 1) ? self::HORIZONTAL : self::VERTICAL;
		switch ($strType) {
			case 'horizontal' :
				$hRatio = $this->arrImage['width'] / $intSizeTo;
				$newHeight = $this->arrImage['height'] / $hRatio;
				$newWidth = $intSizeTo;
				break;

			case 'vertical' :
				$vRatio = $this->arrImage['height'] / $intSizeTo;
				$newWidth = $this->arrImage['width'] / $vRatio;
				$newHeight = $intSizeTo;
				break;
		}
		$this->arrNewImage['res'] = imagecreatetruecolor($newWidth, $newHeight);
		$isRes = imagecopyresampled($this->arrNewImage['res'], $this->arrImage['res'], 0, 0, 0, 0,
			$newWidth, $newHeight, $this->arrImage['width'], $this->arrImage['height']);
		$this->arrImage['res'] = $this->arrNewImage['res'];
		
		return $this;
	}

	public function save(string $pathWithFileName, int $quality = 9, int $ingMaxSize)
	{
		imagepng($this->arrImage['res'], $pathWithFileName, $quality, PNG_ALL_FILTERS);
		$this->recursiveSave($pathWithFileName, $quality, $ingMaxSize);
	}

	private function recursiveSave(string $pathWithFileName, int $quality, int $ingMaxSize)
	{
		$intImgSize = filesize($pathWithFileName);
		if ($intImgSize > $ingMaxSize) {
			if($quality == 0) return;
			unlink($pathWithFileName);
			$this->save($pathWithFileName, $quality -= 1, $ingMaxSize);
		}
	}

	public function process(string $pathFrom, string $pathTo, int $intSizePx, int $intMaxSizeByte, int $quality = 9, string $storageRootDir = 'app')
	{
		
		$files = $this->getFilePaths($pathFrom, $this->arrAllowedExt);
		$pathToStorage = storage_path($storageRootDir . '/' . $pathTo);
		$pathFromStorage = storage_path($storageRootDir . '/' . $pathFrom);
	
		if(!file_exists($pathFromStorage)){
			throw new \Error('Папка не существует');
		}
		if(!file_exists($pathToStorage)){
			mkdir($pathToStorage);
		}

		foreach ($files as $v) {
			
			$fileName =  $v['name'] . '.' . $v['ext'];
			$src = $pathFromStorage . '/' . $fileName;
			$pathWithFileName = $pathToStorage . '/' . $v['name'] . '.' . 'png';

			$this->load($src)->resize(512)->save($pathWithFileName, $quality, $intMaxSizeByte);
		}
		
		
	}
	

} 
