<?php
/**
 * Created by PhpStorm.
 * User: VinhCV
 * Date: 2/19/2020
 * Time: 11:29 AM
 */

if (! function_exists('highlightKeyword')) {
    function highlightKeyword($string, $keyword) {
        if (!$keyword) {
            return $string;
        }

        $string .= ' ';
        $keyword = explode(' ', $keyword);

        foreach ($keyword as $str) {
            $string = str_replace($str.' ', '<span class="highlight-keyword">'.$str.' </span>', $string);
            $string = str_replace($str.'?', '<span class="highlight-keyword">'.$str.'</span>?', $string);
            $string = str_replace(ucfirst($str).' ', '<span class="highlight-keyword">'.ucfirst($str).' </span>', $string);
        }

        return $string;
    }

    function makeSafe($string) {
        return trim(strip_tags($string));
    }

    function numberFormat($number){
        return number_format($number, 0, ',', '.');
    }
}
