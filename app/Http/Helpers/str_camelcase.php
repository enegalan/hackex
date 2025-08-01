<?php

function str_camelcase($str, $first_upper = false) {
    $str = preg_replace('/[^a-zA-Z0-9]+/', ' ', $str);
    $str = ucwords(strtolower(trim($str))); // Convierte a formato capitalizado por palabra
    $str = str_replace(' ', '', $str); // Elimina espacios
    if (!$first_upper && strlen($str) > 0) {
        $str[0] = strtolower($str[0]);
    }
    return $str;
}