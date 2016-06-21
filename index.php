<?php
if($_POST)
{
	echo '<pre>';
	$file_name = ($_FILES['fileToUpload']['name']);
	class Upload
	{
		private static $image;
		private static $width;
		private static $height;
		private static $imageResized;
		//TASK: refactor this code into something useable
		public static function uploadFileEmail($path)
		{
			$file_name = ($_FILES['fileToUpload']['name']);
			$save_path =  $path;	
			
			$newWidth = 650;
					$newHeight = 150;
					$imageQuality = 100;
					
					$extension = strtolower(strrchr($file_name, '.'));
					// *** Get extension
					$extension = strtolower($extension);
					

					switch ($extension)
					{
						case '.jpg':
						case '.jpeg':
							self::$image = @imagecreatefromjpeg($file_name);
							break;
						case '.gif':
							self::$image = @imagecreatefromgif($file_name);
							break;
						case '.png':
							self::$image = @imagecreatefrompng($file_name);
							break;
						default:
							self::$image = false;
							break;
					}
					self::$width = imagesx(self::$image);
					self::$height = imagesy(self::$image);
					
					$heightRatio = self::$height / $newHeight;
					$widthRatio = self::$width / $newWidth;

					if ($heightRatio < $widthRatio)
					{
						$optimalRatio = $heightRatio;
					} else
					{
						$optimalRatio = $widthRatio;
					}

					$optimalHeight = self::$height / $optimalRatio;
					$optimalWidth = self::$width / $optimalRatio;
					
					// *** Resample - create image canvas of x, y size
					self::$imageResized = imagecreatetruecolor($optimalWidth, $optimalHeight);
					
					imagecopyresampled(self::$imageResized, self::$image, 0, 0, 0, 0, $optimalWidth, $optimalHeight, self::$width, self::$height);
					
						// *** Find center - this will be used for the crop
					$cropStartX = ( $optimalWidth / 2) - ( $newWidth / 2 );
					$cropStartY = ( $optimalHeight / 2) - ( $newHeight / 2 );

					$crop = self::$imageResized;
					//imagedestroy($this->imageResized);
					// *** Now crop from center to exact requested size
					self::$imageResized = imagecreatetruecolor($newWidth, $newHeight);
					imagecopyresampled(self::$imageResized, $crop, 0, 0, $cropStartX, $cropStartY, $newWidth, $newHeight, $newWidth, $newHeight);
					
					$newName = time();

					switch ($extension)
					{
						case '.jpg':
						case '.jpeg':
							if (imagetypes() & IMG_JPG)
							{
								imagejpeg(self::$imageResized, $save_path.$file_name , $imageQuality);
							}
							break;

						case '.gif':
							if (imagetypes() & IMG_GIF)
							{
								imagegif(self::$imageResized, $save_path.$file_name);
							}
							break;

						case '.png':
							// *** Scale quality from 0-100 to 0-9
							$scaleQuality = round(($imageQuality / 100) * 9);

							// *** Invert quality setting as 0 is best, not 9
							$invertScaleQuality = 9 - $scaleQuality;

							if (imagetypes() & IMG_PNG)
							{
								imagepng(self::$imageResized, $save_path.$file_name, $invertScaleQuality);
							}
							break;

						// ... etc

						default:
							// *** No extension - No save.
							break;
					}

					imagedestroy(self::$imageResized);
			

			
		}
	}
	Upload::uploadFileEmail($file_name);
	
	/*
	 * 
	 * 
	 * 
	 * 
	 * 
	 * 
	 * 
	 * 
	 * */
	 
	 
}
date_default_timezone_set('Asia/Dubai');
echo date("D");
echo date('Y-m-d G:i');


?>
<!DOCTYPE html>
<html>
<body>

<form action="" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
</form>

</body>
</html>
