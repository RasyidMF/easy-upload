<?php

namespace Utils;

class Date
{
    public static function format(int $interval, $format = "Y-m-d H:i:s") {
        return date($format, $interval);
    }
}