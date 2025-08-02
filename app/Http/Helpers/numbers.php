<?php

function formatNumber($number): string {
    return number_format((float)$number, 0, '', '.');
}