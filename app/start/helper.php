<?php

/**
 * 
 * @param string $text      -> the string wants to truncate
 * @param integer $limit    -> the length limited of given string
 * @param string $pad       -> replace truncated string by
 * @return string
 */
function truncate($text, $limit, $pad = "...", $stripTag = true) {
    if ($stripTag) {
        $text = strip_tags($text);
    }
    $words = explode(' ', $text, ($limit + 1));
    if (count($words) > $limit) {
        array_pop($words);
        array_push($words, $pad);
    }
    return implode(' ', $words);
}
