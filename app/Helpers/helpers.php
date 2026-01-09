<?php

use Stichoza\GoogleTranslate\GoogleTranslate;

if (!function_exists('translateIt')) {
    function translateIt($text)
    {
        $lang = app()->getLocale();
        if ($lang!='id') {
            $tr = new GoogleTranslate('id');
            $tr->setTarget(app()->getLocale());
            return $tr->translate($text);
        }
        return $text;
    }
}
