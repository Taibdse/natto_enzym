<?php

namespace App\Http\Controllers;

use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use App\Helpers\FileHelper;

use Session;
use Auth;
use File;
use App\Models\Media;

class MediaController extends Controller
{
    public $fileTypes = array(
        'image' => [
            'mime' => 'image/x-icon, image/gif, image/png, image/jpg, image/jpeg',
            'ext' => 'ico, gif, jpg, jpeg, png',
        ],
        'document' => [
            'mime' => 'application/pdf, application/msword, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/vnd.openxmlformats-officedocument.wordprocessingml.template, application/vnd.ms-word.document.macroEnabled.12, application/vnd.ms-word.template.macroEnabled.12, application/vnd.ms-excel, application/vnd.ms-excel, application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.openxmlformats-officedocument.spreadsheetml.template, application/vnd.ms-excel.sheet.macroEnabled.12, application/vnd.ms-excel.template.macroEnabled.12, application/vnd.ms-excel.addin.macroEnabled.12, application/vnd.ms-excel.sheet.binary.macroEnabled.12, application/vnd.ms-powerpoint, application/vnd.ms-powerpoint, application/vnd.ms-powerpoint, application/vnd.ms-powerpoint, application/vnd.openxmlformats-officedocument.presentationml.presentation, application/vnd.openxmlformats-officedocument.presentationml.template, application/vnd.openxmlformats-officedocument.presentationml.slideshow, application/vnd.ms-powerpoint.addin.macroEnabled.12, application/vnd.ms-powerpoint.presentation.macroEnabled.12, application/vnd.ms-powerpoint.template.macroEnabled.12, application/vnd.ms-powerpoint.slideshow.macroEnabled.12',
            'ext' => 'pdf, doc, dot, docx, dotx, docm, dotm, xls, xlt, xla, xlsx, xltx, xlsm, xltm, xlam, xlsb, ppt, pot, pps, ppa, pptx, potx, ppsx, ppam, pptm, potm, ppsm',
        ],
        'video' => [
            'mime' => 'video/x-flv, video/mp4, application/x-mpegURL, video/MP2T, video/3gpp, video/quicktime, video/x-msvideo, video/x-ms-wmv',
            'ext' => 'flv, mp4, m3u8, ts, 3gp, mov, avi, wmv',
        ],
        'audio' => [
            'mime' => 'audio/basic, audio/basic, audio/mid, audio/mid, audio/mpeg, audio/mp4, audio/x-aiff, audio/x-aiff, audio/x-aiff, audio/x-mpegurl, audio/vnd.rn-realaudio, audio/vnd.rn-realaudio, audio/ogg, audio/vorbis, audio/vnd.wav',
            'ext' => 'au, snd, mid, rmi, mp3, mp4 audio, aif, aifc, aiff, m3u, ra, ram, ogg vorbis, vorbis, wav',
        ],
        'pdf' => [
            'mime' => 'application/pdf',
            'ext' => 'pdf',
        ],
        'zip' => [
            'mime' => 'application/gzip, application/zlib, application/tar, application/tar+gzip,  application/x-rar-compressed, application/octet-stream, application/zip, application/octet-stream, application/x-zip-compressed, multipart/x-zip',
            'ext' => 'zip, rar, gz, tgz, tar'
        ],
        'design' => [
            'mime' => 'image/vnd.adobe.photoshop, application/postscript, application/octet-stream',
            'ext' => 'psd, ai'
        ]
    );

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->fileTypes['all'] = [
            'mime' => '',
            'ext' => ''
        ];

        foreach ($this->fileTypes as $type => $info){
            if ($type != 'ext'){
                $this->fileTypes['all']['mime'] .= ' '.$info['mime'];
                $this->fileTypes['all']['ext'] .= ' '.$info['ext'];
            }
        }
    }

    public function uploadImage(Request $request)
    {
        $user = Auth::user();
        $maxSizeFile = $this->getPHPMaxUploadSize();
        $image = $request->file('upload-file');

        if (!$request->hasFile('upload-file') || !$image) {
            return $this->ajaxRespond(0, "File không hợp lệ, bạn chỉ được upload file có kích thước tối đa: " . $this->formatSizeUnits($maxSizeFile));
        }

        // Check get image from client send
        $mineTypeFile = $image->getClientMimeType();
        $fileExt = $image->getClientOriginalExtension();
        $fileExt = strtolower($fileExt);
        if (strpos($this->fileTypes['image']['mime'], $mineTypeFile) === false || strpos($this->fileTypes['image']['ext'], $fileExt) === false) {
            return $this->ajaxRespond(0, 'Kiểu file không hợp lệ');
        }

        // Check size file
        if (File::size($image) > FileHelper::toByteSize($this->formatSizeUnits($maxSizeFile))) {
            return $this->ajaxRespond(0, "File có kích thước quá giới hạn! Hãy tải file có dung lượng <= " . $this->formatSizeUnits($maxSizeFile));
        }

        // Count upload
        // Session::put('upload_count', 0);
        if (Session::get('upload_count', 0) > 2000) {
            return $this->ajaxRespond(0, 'Bạn không được thử upload quá 20 file!');
        }

        /*$imageInfo = getimagesize($image);
        if ($imageInfo[0] != 1970 || $imageInfo[1] != 1476) {
            return $this->ajaxRespond(0, "File có kích thước không hợp lệ, bạn hãy upload file có kích thước: 1970x1476");
        }*/

        // Auto rotate
        $exif = @exif_read_data($image->getRealPath());
        if ($exif && !empty($exif['Orientation'])) {
            @ini_set('gd.jpeg_ignore_warning', 1);
            $imageResource = @imagecreatefromjpeg($image->getRealPath());
            switch ($exif['Orientation']) {
                case 3:
                    $img = imagerotate($imageResource, 180, 0);
                    break;
                case 6:
                    $img = imagerotate($imageResource, -90, 0);
                    break;
                case 8:
                    $img = imagerotate($imageResource, 90, 0);
                    break;
                default:
                    $img = $imageResource;
            }
            imagedestroy($imageResource);
        }
        if (isset($img) && $img) {
            @imagejpeg($img, $image->getRealPath(), 100);
            @imagedestroy($img);
        }

        $orgFile = 'media/tmp/' . time() . rand(1, 100) . '.jpg';
        FileHelper::saveFile($orgFile, file_get_contents($image->getRealPath()));
        Session::put('org_file', $orgFile);

        $resizeFile = str_replace('.', '_resize.', $orgFile);
        try {
            @ini_set("gd.jpeg_ignore_warning", 1);
            $imageMake = Image::make(public_path($orgFile))->resize(1200, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $imageMake->stream('jpg', 100);
            FileHelper::saveFile($resizeFile, $imageMake);
        } catch (\Exception $e) {
            Log::info($e->getMessage() . ': ' . $orgFile);
            @copy(public_path($orgFile), public_path($resizeFile));
        }

        $this->deleteOldFiles();
        Session::put('upload_count', Session::get('upload_count', 0) + 1);

        return $this->ajaxRespond(
            1,
            'Upload thành công!',
            [
                'resize_link' => url($resizeFile),
                'resize_value' => $resizeFile,
                'org_link' => url($orgFile),
                'org_value' => $orgFile,
                //'org_md5' => md5_file(public_path($orgFile)),
                'max_post_size' => $this->formatSizeUnits($maxSizeFile),
            ]
        );
    }

    public function uploadVideo(Request $request)
    {
        $this->deleteOldFiles();

        $user = Auth::user();
        $maxSizeFile = $this->getPHPMaxUploadSize();
        $image = $request->file('upload-file');

        if (!$request->hasFile('upload-file') || !$image) {
            return $this->ajaxRespond(0, "File không hợp lệ, bạn chỉ được upload file có kích thước tối đa: " . $this->formatSizeUnits($maxSizeFile));
        }

        // Check get image from client send
        $mineTypeFile = $image->getClientMimeType();
        $fileExt = $image->getClientOriginalExtension();
        $fileExt = strtolower($fileExt);

        $filenameFull = time() . '.' . $fileExt;
        $uriPathFolder = 'media/tmp/';
        $filePath = $uriPathFolder . $filenameFull;

        // Check minetype file and type extend file
        if (strpos($this->fileTypes['video']['mines'], $mineTypeFile) === false || strpos($this->fileTypes['video']['ext'], $fileExt) === false) {
            return $this->ajaxRespond(0, 'Kiểu file không hợp lệ. Hệ thống chỉ chấp nhận các file: mp4, mov');
        }

        // Check size file
        if (File::size($image) > $maxSizeFile) {
            return $this->ajaxRespond(0, "File có kích thước quá giới hạn! Hãy tải file có dung lượng <= " . $this->formatSizeUnits($maxSizeFile));
        }

        // Count upload
        // Session::put('upload_count', 0);
        if (Session::get('upload_count', 0) > 20) {
            return $this->ajaxRespond(0, 'Bạn không được thử upload quá 10 file!');
        }

        FileHelper::saveFile($filePath, file_get_contents($image->getRealPath()));

        Session::put('upload_count', Session::get('upload_count', 0) + 1);

        return $this->ajaxRespond(
            1,
            'Upload thành công!',
            [
            'resize_link' => url($filePath),
            'resize_value' => $filePath,
            'org_link' => url($filePath),
            'org_value' => $filePath,
            ]
        );
    }

    public function uploadBase64(Request $request)
    {
        $filePath = FileHelper::processImageBase64($request->filename, $request->filecontent);

        return $this->ajaxRespond(1, '', $filePath);
    }

    public function deleteOldFiles()
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function adminIndex(Request $request)
    {
        $this->middleware('admin');

        $filter = [];
        $order = ['id', 'DESC'];

        $mediaOrder = $request->input('mediaOrder', 'newest');
        $mediaOrder = ($mediaOrder == 'newest') ? 'newest' : 'oldest';
        if ($mediaOrder == 'oldest'){
            $order = ['id', 'ASC'];
        }

        $mediaType = $request->input('mediaType', 'all');
        if ($mediaType != 'all') {
            $filter['mine_type'] = $mediaType;
        }

        $items = Media::search($filter, $order[0], $order[1])->paginate(11);
        return $this->ajaxRespond(
            1,
            '',
            view('admin.common.media_items', compact('items'))->render());
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function adminDelete(Request $request)
    {
        $this->middleware('admin');

        $id = intval($request->id);
        $item = Media::find($id);

        FileHelper::deleteFile($item->url);
        $item->delete();

        return $this->ajaxRespond(
            1,
            '');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function adminUpdate(Request $request)
    {
        $this->middleware('admin');

        $id = intval($request->id);

        $item = Media::find($id);
        $item->update([
            'title' => strip_tags($request->title)
        ]);

        return $this->ajaxRespond(
            1,
            '');
    }

    public function adminUpload(Request $request)
    {
        $this->middleware('admin');

        $user = Auth::user();
        $resize = intval($request->input('resize', 0));
        $file = $request->file('upload-file');
        $orgName = $file->getClientOriginalName();

        $mimeType = $file->getClientMimeType();
        if (strpos($this->fileTypes['all']['mime'], $mimeType) === false) {
            return $this->ajaxRespond(0, 'Invalid file type: '.$mimeType, null);
        }

        $ext = $file->getClientOriginalExtension();
        if (strpos($this->fileTypes['all']['ext'], $ext) === false) {
            return $this->ajaxRespond(0, 'Invalid file extension: '.$ext, null);
        }

        $fileType = '';
        foreach ($this->fileTypes as $type => $info){
            if (strpos($info['mime'], $mimeType) !== false && $type != 'all') {
                $fileType = $type;
            }
        }

        $filePath = FileHelper::getMediaLink($orgName);

        if ($fileType == 'image' && !in_array($ext, ['ico', 'gif']) && $resize) {
            // Upload and resize
            $imageMake = Image::make($file->getRealPath())->resize($resize, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            /*if($watermark == true || $watermark == 'true') {
                $imageMake->insert('uploads/others/logo.png', 'bottom-right', 15, 15);
            }*/
            $imageMake->stream('jpg', 100);
            FileHelper::saveFile($filePath, $imageMake);

        } else {
            // Upload
            FileHelper::saveFile($filePath, file_get_contents($file->getRealPath()));
        }

        $media = Media::create([
            'title' => pathinfo($orgName, PATHINFO_FILENAME),
            'mine_type' => $fileType,
            'size' => $file->getSize(),
            'url' => $filePath,
        ]);

        return $this->ajaxRespond(1, 'Uploaded successfully', $media);
    }

    public static function getPHPMaxUploadSize() {
        static $max_size = -1;

        if ($max_size < 0) {
            // Start with post_max_size.
            $max_size = self::parseFileSize(ini_get('post_max_size'));

            // If upload_max_size is less, then reduce. Except if upload_max_size is
            // zero, which indicates no limit.
            $upload_max = self::parseFileSize(ini_get('upload_max_filesize'));
            if ($upload_max > 0 && $upload_max < $max_size) {
                $max_size = $upload_max;
            }
        }

        return $max_size;
    }

    public static function parseFileSize($size) {
        $unit = preg_replace('/[^bkmgtpezy]/i', '', $size); // Remove the non-unit characters from the size.
        $size = preg_replace('/[^0-9\.]/', '', $size); // Remove the non-numeric characters from the size.
        if ($unit) {
            // Find the position of the unit in the ordered string which is the power of magnitude to multiply a kilobyte by.
            return round($size * pow(1024, stripos('bkmgtpezy', $unit[0])));
        }
        else {
            return round($size);
        }
    }

    public static function formatSizeUnits($bytes)
    {
        if ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }
        elseif ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . ' bytes';
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . ' byte';
        }
        else
        {
            $bytes = '0 bytes';
        }

        return $bytes;
    }
}
