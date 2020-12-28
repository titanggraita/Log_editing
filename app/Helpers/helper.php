<?php

if(!function_exists('array_add')) {
    function array_add(array $array, string $key, $value) {
        return Arr::add($array, $key, $value);
    }
}