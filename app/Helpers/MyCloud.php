<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use CURLFile;

class MyCloud
{
    private $_cloud_secret_key;
    private $_request_url;
    private $_response_url;
    private $_response_url_img;
    private $_response_url_vid;

    public function __construct()
    {
        $this->_cloud_secret_key = env('CLOUD_SECRET_KEY', 'b12a869d5c5b2e82b05f140299828a66');
        $this->_request_url = env('CLOUD_REQUEST_URL', 'http://192.168.6.88/');
        $this->_response_url = env('CLOUD_RESPONSE_URL', 'http://static1.admicro.vn/');
        $this->_response_url_img = env('CLOUD_RESPONSE_URL_IMAGE', 'http://static1.admicro.vn/');
        $this->_response_url_vid = env('CLOUD_RESPONSE_URL_VIDEO', 'http://static1.admicro.vn/');
    }

    function _error($result)
    {
        $result = json_decode($result, true);
        if (isset($result['status_code']) && $result['status_code'] != '200') {
            dd($result['description']);
        }
    }

    function _is_ok($result)
    {
        $chk = true;
        $result = json_decode($result, true);
        if (isset($result['status_code']) && $result['status_code'] != '200') {
            $chk = false;
        }
        return $chk;
    }

    function _getext($filename)
    {
        if (false === strpos($filename, '.')) {
            return 'txt';
        }
        $x = explode('.', $filename);
        return end($x);
    }

    function _get_option($curl, $url)
    {
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPGET, true);
    }

    function list_all($path = '', $show_error = false)
    {
        $param = 'secret_key=' . $this->_cloud_secret_key . '&dirname=' . $path;
        $url = $this->_request_url . 'ls?' . $param;

        $curl = curl_init();
        $this->_get_option($curl, $url);
        $result = curl_exec($curl);
        curl_close($curl);

        if ($show_error) $this->_error($result);
        return json_decode($result, true);
    }

    function list_files($path, $show_error = false)
    {
        $param = 'secret_key=' . $this->_cloud_secret_key . '&dirname=' . $path;
        $url = $this->_request_url . 'ls?' . $param;

        $curl = curl_init();
        $this->_get_option($curl, $url);
        $result = curl_exec($curl);
        curl_close($curl);

        if ($show_error) $this->_error($result);
        $data = array();
        $temp = json_decode($result, true);
        if (isset($temp['files'])) {
            $data = $temp['files'];
        }
        return $data;
    }

    function list_directories($path = '', $show_error = false)
    {
        $param = 'secret_key=' . $this->_cloud_secret_key . '&dirname=' . $path;
        $url = $this->_request_url . 'ls?' . $param;

        $curl = curl_init();
        $this->_get_option($curl, $url);
        $result = curl_exec($curl);
        curl_close($curl);

        if ($show_error) $this->_error($result);
        $data = array();
        $temp = json_decode($result, true);
        if (isset($temp['directories'])) {
            $data = $temp['directories'];
        }
        return $data;
    }

    function get_file_info($filename, $show_error = false)
    {
        $param = 'secret_key=' . $this->_cloud_secret_key . '&filename=' . $filename;
        $url = $this->_request_url . 'get_file_info?' . $param;

        $curl = curl_init();
        $this->_get_option($curl, $url);
        $result = curl_exec($curl);
        curl_close($curl);

        if ($show_error) $this->_error($result);
        return json_decode($result, true);
    }

    function upload($locpath, $rempath, $show_error = false)
    {
        // for php 5.5 or later
        $filedata = new CurlFile($locpath, mime_content_type($locpath), basename($locpath));
        //$filedata = "@".$locpath.";filename=".basename($locpath).";type=".mime_content_type($locpath);

        //$filedata = new CurlFile($locpath);
        $data = array
        (
            'filename' => $rempath,
            'filedata' => $filedata,
            'overwrite' => 1,
            'secret_key' => $this->_cloud_secret_key,
        );

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->_request_url);
        curl_setopt($curl, CURLOPT_VERBOSE, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        //curl_setopt ($curl, CURLOPT_SAFE_UPLOAD, false);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        $result = curl_exec($curl);
        curl_close($curl);

        Log::info($result);

        if ($show_error) $this->_error($result);
        return $result;
        //return $this->_is_ok($result);
    }

    function uploadImage($localFile, $remotePath, $showError = false)
    {
        $remotePath = $this->_response_url_img . $remotePath;
        $success = $this->upload($localFile, $remotePath, $showError);

        if ($success) {
            return $this->_response_url . $remotePath;
        }

        return false;
    }

    function uploadVideo($localFile, $remotePath, $showError = false)
    {
        $remotePath = $this->_response_url_vid . $remotePath;
        $success = $this->upload($localFile, $remotePath, $showError);

        if ($success) {
            return $this->_response_url . $remotePath;
        }

        return false;
    }

    function delete_file($filepath)
    {
        $chk = true;
        $param = 'secret_key=' . $this->_cloud_secret_key . '&filename=' . $filepath;
        $url = $this->_request_url . 'delete?' . $param;

        $curl = curl_init();
        $this->_get_option($curl, $url);
        $result = curl_exec($curl);
        curl_close($curl);

        return $this->_is_ok($result);
    }

    function rename($old_file, $new_file)
    {
        $param = 'secret_key=' . $this->_cloud_secret_key . '&from=' . $old_file . '&to=' . $new_file;
        $url = $this->_request_url . 'rename?' . $param;

        $curl = curl_init();
        $this->_get_option($curl, $url);
        $result = curl_exec($curl);
        curl_close($curl);

        return $this->_is_ok($result);
    }

    function mkdir($path)
    {
        $param = 'secret_key=' . $this->_cloud_secret_key . '&dirname=' . $path;
        $url = $this->_request_url . 'make_dir?' . $param;

        $curl = curl_init();
        $this->_get_option($curl, $url);
        $result = curl_exec($curl);
        curl_close($curl);

        return $this->_is_ok($result);
    }

    private function delete_empty_dir($path)
    {
        $param = 'secret_key=' . $this->_cloud_secret_key . '&dirname=' . $path;
        $url = $this->_request_url . 'remove_dir?' . $param;

        $curl = curl_init();
        $this->_get_option($curl, $url);
        $result = curl_exec($curl);
        curl_close($curl);

        return $this->_is_ok($result);
    }

    function file_exists($file)
    {
        $param = 'secret_key=' . $this->_cloud_secret_key . '&filename=' . $file;
        $url = $this->_request_url . 'get_file_info?' . $param;

        $curl = curl_init();
        $this->_get_option($curl, $url);
        $result = curl_exec($curl);
        curl_close($curl);

        return $this->_is_ok($result);
    }

    function move($old_file, $new_file)
    {
        return $this->rename($old_file, $new_file);
    }

    function directory_exists($path)
    {
        $param = 'secret_key=' . $this->_cloud_secret_key . '&dirname=' . $path;
        $url = $this->_request_url . 'ls?' . $param;

        $curl = curl_init();
        $this->_get_option($curl, $url);
        $result = curl_exec($curl);
        curl_close($curl);
        return $this->_is_ok($result);
    }

    function download($url, $path)
    {
        $chk = true;
        $fp = fopen(FCPATH . $path, 'w');
        $ch = curl_init($this->_response_url_img . '/' . $url);
        curl_setopt($ch, CURLOPT_FILE, $fp);
        $data = curl_exec($ch);
        curl_close($ch);
        fclose($fp);
        if ($data != 1) {
            $chk = false;
        }
        return $chk;
    }

    function check_empty_dir($dir)
    {
        $chk = false;
        if (count($this->list_directories($dir)) && count($this->list_files($dir))) {
            $chk = true;
        }
        return $chk;
    }

    function delete_dir($directory)
    {
        if ($this->check_empty_dir($directory)) {
            return false;
        } else {
            # here we attempt to delete the file/directory
            if (!($this->delete_empty_dir($directory))) {
                # if the attempt to delete fails, get the file listing
                $filelist = @$this->list_files($directory);
                # loop through the file list and recursively delete the FILE in the list
                foreach ($filelist as $file) {
                    $this->delete_file($directory . '/' . $file);
                }
                $dirlist = @$this->list_directories($directory);
                foreach ($dirlist as $dir) {
                    $this->delete_dir($dir);
                }
                # if the file list is empty, delete the DIRECTORY we passed
                $this->delete_empty_dir($directory);
            }
        }
        return true;
    }
}
