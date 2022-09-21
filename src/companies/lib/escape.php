<?php

function escape($string)
{
    $companies = [];

    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}
