<?php

if (!function_exists('convertToTime')) {
    function convertToTime($length)
    {
        $minutes = floor($length / 60);
        $seconds = $length - ($minutes*60);

        return sprintf('%02d', $minutes).':'.sprintf('%02d', $seconds);
    }
}
