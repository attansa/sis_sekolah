<?php

function redirect($url)
{
    header("Location: " . BASE_URL . $url);
    exit;
}

function isLogin()
{
    return isset($_SESSION['login']);
}

function userRole()
{
    return $_SESSION['role'] ?? null;
}

function userName()
{
    return $_SESSION['nama'] ?? '';
}

function base_url($path = '')
{
    return BASE_URL . $path;
}
function userId()
{
    return $_SESSION['id'] ?? 0;
}