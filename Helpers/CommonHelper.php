<?php

/**
 * cut string
 * @param  string $str      input
 * @param  char $n_chars  [description]
 * @param  string $crop_str [description]
 * @return [type]           [description]
 */
function ellipse($str,$n_chars,$crop_str=' [...]')
{
    $buff=strip_tags($str);
    if(strlen($buff) > $n_chars)
    {
        $cut_index=strpos($buff,' ',$n_chars);
        $buff=substr($buff,0,($cut_index===false? $n_chars: $cut_index+1)).$crop_str;
    }
    return $buff;

}

