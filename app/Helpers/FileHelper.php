<?php

namespace App\Helpers;

use App\Helpers\MyCloud;
use App\Helpers\StringHelper;
use Intervention\Image\Facades\Image;
use Storage;
use File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class FileHelper
{
    public static $useVCCloud = false;

    public static function moveUploadFile($filePath, $type = 'jpg')
    {
        $movedLink = self::getMediaLink(null, $type);
        @copy(public_path($filePath), public_path($movedLink));

        return $movedLink;
    }

    public static function autoCropImage($imagePath, $createNew = false)
    {
        try {
            $imageInfo = getimagesize(public_path($imagePath));
            $imageMake = Image::make(public_path($imagePath));
            if ($imageInfo[0] < $imageInfo[1]) {
                $imageMake->crop($imageInfo[0], $imageInfo[0], 0, 0);
            } else {
                $xPos = $imageInfo[0] / 2 - $imageInfo[1] / 2;
                $xPos = intval($xPos);
                $imageMake->crop($imageInfo[1], $imageInfo[1], $xPos, 0);
            }
            $imageMake->stream('jpg', 100);

            if ($createNew) {
                $imagePath = \App\Helpers\FileHelper::getMediaLink();
                FileHelper::saveFile($imagePath, $imageMake);
            } else {
                FileHelper::saveFile($imagePath, $imageMake);
            }

        } catch (\Exception $e) {
            Log::info($e->getMessage() . ': ' . $imagePath);
        }

        return $imagePath;
    }

    public static function autoCropFacebookImage($imagePath, $createNew = false)
    {
        try {
            $imageInfo = getimagesize(public_path($imagePath));
            $imageMake = Image::make(public_path($imagePath));
            if ($imageInfo[0] <= $imageInfo[1]) {
                $imageMake->crop($imageInfo[0], 630, 0, 0);
            } else {
                $width = $imageInfo[1] * 1.91;

                if ($imageInfo[0] <= $width) {
                    $imageMake->crop($imageInfo[0], intval($imageInfo[0] / 1.91), 0, 0);
                } else {
                    $imageMake->crop(intval($imageInfo[1] * 1.91), $imageInfo[1], 0, 0);
                }
            }
            $imageMake->stream('jpg', 100);

            if ($createNew) {
                $imagePath = \App\Helpers\FileHelper::getMediaLink();
                FileHelper::saveFile($imagePath, $imageMake);
            } else {
                FileHelper::saveFile($imagePath, $imageMake);
            }

        } catch (\Exception $e) {
            Log::info($e->getMessage() . ': ' . $imagePath);
        }

        return $imagePath;
    }

    public static function createImageFrame($avatar, $name, $string)
    {
        if (strpos($avatar, 'http') === false) {
            $avatar = public_path($avatar);
        }

        // Cover image
        $cover = imagecreatefrompng(public_path('assets/images/share.png'));

        imagealphablending($cover, true);
        imagesavealpha($cover, true);

        // Resize avatar
        if (strpos($avatar, 'jpg') === false) {
            $srcAva = imagecreatefrompng($avatar);
        } else {
            $srcAva = imagecreatefromjpeg($avatar);
        }
        list($width, $height) = getimagesize($avatar);
        $destAva = imagecreatetruecolor(720, 630);
        imagecopyresampled($destAva, $srcAva, 0, 0, 0, 0, 720, 630, $width, $height);

        // Blank image
        $blankBg = imagecreatetruecolor(1200, 630);
        //imagealphablending($blankBg, false);
        //imagesavealpha($blankBg, true);

        imagecopy($blankBg, $destAva, 0, 0, 0, 0, 720, 630);
        imagecopy($blankBg, $cover, 0, 0, 0, 0, 1200, 630);



        // Insert text
        $font_path = public_path('assets/acecook/fonts/SVN-SwissquoteMedium.ttf');
        $red = imagecolorallocate($blankBg, 161, 20, 23);
        $white = imagecolorallocate($blankBg, 255, 255, 255);
        $black = imagecolorallocate($blankBg, 0, 0, 0);

        // User name
        imagettftext($blankBg, 30, 0, 751, 439, $white, $font_path, $name);

        // Description: wrap text
        $text1 = $string;
        $text1 = Str::limit($text1, 20, '...');
        $arrText = explode("\n", wordwrap($text1, 55, "\n"));
        $y = 509;
//        foreach ($arrText as $arr) {
//            imagettftext($blankBg, 40, 0, 467, $y, $white, $font_path, $arr);
//            $y = $y + 40;
//        }

        imagettftext($blankBg, 30, 0, 751, $y, $white, $font_path, $text1);

        $fileName = self::getMediaLink();
        if (self::$useVCCloud) {
            $localPath = public_path('media/tmp/' . Session::getId());
            imagejpeg($blankBg, $localPath);
            $myCloud = new MyCloud();
            $fileName = $myCloud->uploadImage($localPath, $fileName);
            self::deleteOldFiles();
        } else {
            self::saveFile($fileName, '');
            imagejpeg($blankBg, public_path($fileName));
        }

        imagedestroy($blankBg);
        imagedestroy($destAva);
        imagedestroy($cover);

        return $fileName;
    }

    public static function deleteOldFiles()
    {
        // Delete old files
        $files = File::allFiles(public_path('media/tmp'));
        if (count($files)) {
            foreach ($files as $file) {
                if ($file->isFile() && $file->getExtension() != 'gitignore' && $file->getExtension() != 'html' && $file->getCTime() < (time() - 48 * 60 * 60)) {
                    File::delete($file->getPathname());
                }
            }
        }
    }

    public static function processImageBase64($fileName, $inputImage)
    {
        $check_url_image = strpos($inputImage, 'media/');

        if($check_url_image !== false) {
            return $inputImage;
        } else {
            // Image select and it's base64
            $imageBase64 = explode(',', $inputImage);
            if (count($imageBase64) >= 2) {
                $imageBase64 = base64_decode($imageBase64[1]);

                if ($imageBase64) {
                    $filePath = self::getMediaLink($fileName);

                    self::saveFile($filePath, $imageBase64);
                    return $filePath;
                }
            }
        }

        return '';
    }

    public static function getMediaLink($name=null, $type='jpg', $content=false){
        if ($name) {
            $fileInfo = pathinfo($name);
            $fileInfo['filename'] = str_replace('-', ' ', $fileInfo['filename']);
            $name = StringHelper::removeSign(
                    $fileInfo['filename'],
                    true,
                    30)
                .'-'.date('His').'.'.$fileInfo['extension'];
        } else {
            $name = time().rand(1,999999).'.'.$type;
        }

        self::checkStorageDirectory('media');

        $link = 'media/'.date('Y-m').'/'.date('d').'/'.$name;
        if($content) {
            @file_put_contents(public_path($link), $content);
        }

        return $link;
    }

    public static function checkStorageDirectory($des, $checkDateFolder = true)
    {
        $folder = public_path($des);
        if (!File::isDirectory($folder)) {
            File::makeDirectory($folder);
            File::put($folder . '/index.html', '');
        }

        if ($checkDateFolder) {
            $folder = public_path($des . '/' . date('Y-m'));
            if (!File::isDirectory($folder)) {
                File::makeDirectory($folder);
                File::put($folder . '/index.html', '');
            }

            $folder = public_path($des . '/' . date('Y-m') . '/' . date('d'));
            if (!File::isDirectory($folder)) {
                File::makeDirectory($folder);
                File::put($folder . '/index.html', '');
            }
        }

        return [$folder, $des . ($checkDateFolder ? '/' . date('Y-m') . '/' . date('d') : '')];
    }

    public static function toByteSize($p_sFormatted)
    {
        $aUnits = array('B' => 0, 'KB' => 1, 'MB' => 2, 'GB' => 3, 'TB' => 4, 'PB' => 5, 'EB' => 6, 'ZB' => 7, 'YB' => 8);
        $sUnit = strtoupper(trim(substr($p_sFormatted, -2)));
        if (intval($sUnit) !== 0) {
            $sUnit = 'B';
        }
        if (!in_array($sUnit, array_keys($aUnits))) {
            return FALSE;
        }
        $iUnits = trim(substr($p_sFormatted, 0, strlen($p_sFormatted) - 2));
        if (!intval($iUnits) == $iUnits) {
            return FALSE;
        }
        return $iUnits * pow(1024, $aUnits[$sUnit]);
    }

    public static function getStorage(){
        return Storage::disk('local');
    }

    public static function saveFile($savePath, $content){
        return self::getStorage()->put($savePath, $content);
    }

    public static function deleteFile($filePath){
        return self::getStorage()->delete($filePath);
    }

    public static function exists($filePath){
        return self::getStorage()->has($filePath);
    }

    public static function hasFile($filePath){
        return self::getStorage()->has($filePath);
    }

    public static function getFile($filePath){
        return self::getStorage()->get($filePath);
    }

    public static function mimeType($filePath){
        return self::getStorage()->mimeType($filePath);
    }

    public static function size($filePath){
        return self::getStorage()->size($filePath);
    }

    public static function url($filePath){
        return self::getStorage()->url($filePath);
    }
}
