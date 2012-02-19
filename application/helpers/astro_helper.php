<?php

    function get_astro($month, $day)
    {
        if ($month < 1 || $month > 12 || $day < 1 || $day > 31)
            return (false);
        $signs = array(
            array("20" => array('name' => '水瓶', 'index' => 10, 'eng' => 'Aquarius')),
            array("19" => array('name' => '双鱼', 'index' => 11, 'eng' => 'Pisces')),
            array("21" => array('name' => '白羊', 'index' => 0, 'eng' => 'Aries')),
            array("20" => array('name' => '金牛', 'index' => 1, 'eng' => 'Taurus')),
            array("21" => array('name' => '双子', 'index' => 2, 'eng' => 'Gemini')),
            array("22" => array('name' => '巨蟹', 'index' => 3, 'eng' => 'Cancer')),
            array("23" => array('name' => '狮子', 'index' => 4, 'eng' => 'Leo')),
            array("23" => array('name' => '处女', 'index' => 5, 'eng' => 'Virgo')),
            array("23" => array('name' => '天秤', 'index' => 6, 'eng' => 'Libra')),
            array("24" => array('name' => '天蝎', 'index' => 7, 'eng' => 'Scorpio')),
            array("22" => array('name' => '射手', 'index' => 8, 'eng' => 'Sagittarius')),
            array("22" => array('name' => '摩羯', 'index' => 9, 'eng' => 'Capricorn'))
        );
        list($sign_start, $sign_name) = each($signs[(int) $month - 1]);
        if ($day < $sign_start)
            list($sign_start, $sign_name) = each($signs[($month - 2 < 0) ? $month = 11 : $month -= 2]);
        return $sign_name;
    }