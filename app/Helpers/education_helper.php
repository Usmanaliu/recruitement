<?php

if (!function_exists('getEducationLevel')) {
    function getEducationLevel($setId) {
        $levels = [
            1 => 'Matric',
            2 => 'Intermediate',
            3 => 'Bachelor',
            4 => 'Masters',
            5 => 'PhD'
        ];
        return $levels[$setId] ?? 'Unknown';
    }
}