<?php
namespace App\View\Helpers;

use Exception;
use Packer;
use App;

class Html
{
    public function imgSrc($image, $transform = '', $filename = '')
    {
        if (is_object($image)) {
            $image = $image->image;
        }

        if (strpos($image, '/') !== 0) {
            $image = '/storage/resources/'.$image;
        }

        if (empty($transform)) {
            return asset($image);
        }

        try {
            return Packer::img($image, $transform);
        } catch (Exception $e) {
            return Packer::img('/assets/web/img/logo-default.png', $transform);
        }
    }

    public function file($file)
    {
        if (strpos($file, '/') !== 0) {
            $file = '/storage/resources/'.$file;
        }
        return asset($file);
    }

    public function cut($text, $limit = 140, $end = '...')
    {
        if (strlen($text) <= (int)$limit) {
            return $text;
        }

        $length = strlen($text);
        $num = 0;
        $tag = 0;

        for ($n = 0; $n < $length; $n++) {
            if ($text[$n] === '<') {
                $tag++;
                continue;
            }

            if ($text[$n] === '>') {
                $tag--;
                continue;
            }

            if ($tag !== 0) {
                continue;
            }

            $num++;

            if ($num < $limit) {
                continue;
            }

            $text = substr($text, 0, $n);

            if ($space = strrpos($text, ' ')) {
                $text = substr($text, 0, $space);
            }

            break;
        }

        if (strlen($text) === $length) {
            return $text;
        }

        $text .= $end;

        if (!preg_match_all('|(<([\w]+)[^>]*>)|', $text, $aBuffer) || empty($aBuffer[1])) {
            return $text;
        }

        preg_match_all('|</([a-zA-Z]+)>|', $text, $aBuffer2);

        if (count($aBuffer[2]) === count($aBuffer2[1])) {
            return $text;
        }

        foreach ($aBuffer[2] as $k => $tag) {
            if (empty($aBuffer2[1][$k]) || ($tag !== $aBuffer2[1][$k])) {
                $text .= '</'.$tag.'>';
            }
        }

        return $text;
    }

    /**
     * @param string $fieldName
     * @param string $fieldValue
     * @return null|string
     */
    public function checked($fieldName, $fieldValue)
    {
        if (old($fieldName) == $fieldValue) {
            return 'checked="checked"';
        }
        return null;
    }

    /**
     * @param string $fieldName
     * @param string $fieldValue
     * @return null|string
     */
    public function selected($fieldName, $fieldValue)
    {
        if (old($fieldName) == $fieldValue) {
            return 'selected="selected"';
        }
        return null;
    }

    public function jsModule($module)
    {
        $cacheHashFile = file_get_contents(base_path('cache.json'));

        if ($cacheHashFile === false) {
            throw new \Exception('cache.json not found');
        }

        $cache = json_decode($cacheHashFile);

        $hash = '';
        if ($cache) {
            $hash = $cache->hash;
        }

        return '<script src="'.asset('/assets/web/js/'.$module.'.'.$hash.'.js').'"></script>';
    }

    public function formatedDecimals($value)
    {
        if (intval($value) == $value) {
            return intval($value);
        }
        if (App::getLocale() == 'es' || App::getLocale() == 'gl') {
            return rtrim(str_replace('.', ',', $value), 0);
        }
        return $value;
    }
}
