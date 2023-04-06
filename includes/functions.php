<?php
session_start();
function isPost()
{
    return $_SERVER['REQUEST_METHOD'] === 'POST';
}

function getParam($name, $defaultValue = null)
{
    $value = $_GET[$name] ?? null;
    if ($value === "") {
        $value = null;
    }
    return $value ?? $defaultValue;
}

function dd($value)
{
    var_dump($value);
    die;
}

?>