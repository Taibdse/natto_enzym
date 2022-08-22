<?php

namespace App\Helper;

use Illuminate\Support\Facades\Request;
use DateTime;

class InputHelper
{
    public static function getInt($name, $default = 0)
    {
        $val = Request::input($name, $default);
        return intval($val);
    }

    public static function getFloat($name, $default = 0)
    {
        $val = Request::input($name, $default);
        return floatval($val);
    }

    public static function getString($name, $default = '', $appendQuote = false, $filterXss = true, $trim = true)
    {
        $val = Request::input($name, $default);

        if ($trim) {
            $val = trim($val);
        }

        if ($filterXss) {
            $val = htmlspecialchars($val, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        }

        if ($appendQuote) {
            $val = self::appendQuote($val);
        }

        return $val;
    }

    public static function getRawString($name, $default = '', $appendQuote = false, $filterXss = true, $trim = true)
    {
        $val = Request::input($name, $default);

        $val = self::removeTags($val);

        if ($trim) {
            $val = trim($val);
        }

        if ($filterXss) {
            $val = htmlspecialchars($val, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        }

        if ($appendQuote) {
            $val = self::appendQuote($val);
        }

        return $val;
    }

    public static function getEmail($name, $default = '')
    {
        $value = self::getRawString($name, $default, false, true, true);

        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        return $value;
    }

    public static function getSearchString($name, $default = '', $appendQuote = false, $filterXss = true, $trim = true)
    {
        $val = Request::input($name, $default);

        $val = self::removeWildcard($val);
        $val = self::removeTags($val);

        if ($trim) {
            $val = trim($val);
        }

        if ($filterXss) {
            $val = htmlentities($val, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        }

        if ($appendQuote) {
            $val = self::appendQuote($val);
        }

        return $val;
    }

    public static function getDate($name, $default = '', $inputFormat = 'Y-m-d', $outputFormat = 'Y-m-d')
    {
        $value = self::getString($name, $default);

        try {
            $date = DateTime::createFromFormat($inputFormat, $value);
            if ($date) {
                $value = $date->format($outputFormat);
            } else {
                $value = date($outputFormat);
            }

        } catch (Exception $e) {
            $value = date($outputFormat);
        }

        return $value;
    }

    public static function appendQuote($value)
    {
        $model = BaseModel::getInstance();
        $value = $model->getQuote($value);

        return $value;
    }

    public static function removeWildcard($value)
    {
        $value = str_replace(['%', '_', '?', '[', ']'], ['\%', '\_', '\?', '\[', '\]'], $value);

        return $value;
    }

    public static function removeTags($text)
    {
        $text = rawurldecode($text);
        $text = htmlspecialchars_decode(html_entity_decode($text, ENT_QUOTES | ENT_IGNORE, "UTF-8"), ENT_QUOTES | ENT_IGNORE);
        $text = trim($text);
        $text = preg_replace(
            array(
                // Remove invisible content
                '@<head[^>]*?>.*?</head>@siu',
                '@<style[^>]*?>.*?</style>@siu',
                '@<script[^>]*?.*?</script>@siu',
                '@<object[^>]*?.*?</object>@siu',
                '@<embed[^>]*?.*?</embed>@siu',
                '@<applet[^>]*?.*?</applet>@siu',
                '@<noframes[^>]*?.*?</noframes>@siu',
                '@<noscript[^>]*?.*?</noscript>@siu',
                '@<noembed[^>]*?.*?</noembed>@siu',

                // Add line breaks before & after blocks
                '@<((br)|(hr))@iu',
                '@</?((address)|(blockquote)|(center)|(del))@iu',
                '@</?((div)|(h[1-9])|(ins)|(isindex)|(p)|(pre))@iu',
                '@</?((dir)|(dl)|(dt)|(dd)|(li)|(menu)|(ol)|(ul))@iu',
                '@</?((table)|(th)|(td)|(caption))@iu',
                '@</?((form)|(button)|(fieldset)|(legend)|(input))@iu',
                '@</?((label)|(select)|(optgroup)|(option)|(textarea))@iu',
                '@</?((frameset)|(frame)|(iframe))@iu',
            ),
            array(
                ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ',
                "\n\$0", "\n\$0", "\n\$0", "\n\$0", "\n\$0", "\n\$0",
                "\n\$0", "\n\$0",
            ),
            $text);

        return strip_tags($text);
    }

    public static function removeScriptTags($text)
    {
        $text = rawurldecode($text);
        $text = htmlspecialchars_decode(html_entity_decode($text, ENT_QUOTES | ENT_IGNORE, "UTF-8"), ENT_QUOTES | ENT_IGNORE);
        $text = trim($text);
        $text = preg_replace(
            array(
                // Remove invisible content
                '@<head[^>]*?>.*?</head>@siu',
                '@<style[^>]*?>.*?</style>@siu',
                '@<script[^>]*?.*?</script>@siu',
                '@<object[^>]*?.*?</object>@siu',
                '@<embed[^>]*?.*?</embed>@siu',
                '@<applet[^>]*?.*?</applet>@siu',
                '@<noframes[^>]*?.*?</noframes>@siu',
                '@<noscript[^>]*?.*?</noscript>@siu',
                '@<noembed[^>]*?.*?</noembed>@siu',
                '@<frameset[^>]*?.*?</frameset>@siu',
                '@<frame[^>]*?.*?</frame>@siu'
            ),
            array(
                ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' '
            ),
            $text);

        return $text;
    }

    public static function getCaptcha($request)
    {
        $secret = config('system.apikey_google_captcha_secret');;
        /*$verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $request->{'g-recaptcha-response'});
        $responseData = json_decode($verifyResponse);*/

        $data = array(
            'secret' => $secret,
            'response' => $request->{'g-recaptcha-response'}
        );

        $verify = curl_init();
        curl_setopt($verify, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
        curl_setopt($verify, CURLOPT_POST, true);
        curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($verify, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($verify);
        $responseData = json_decode($responseData);

        return is_object($responseData) ? $responseData->success : 1;
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

    public static function getClientIp()
    {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if (isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }
}
