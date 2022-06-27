<?php
function checkRequest($request, $method): bool
{
    if (isset($_POST[$request]) && $_SERVER['REQUEST_METHOD'] == $method) {
        return true;
    }
    return false;
}
function checkRequestGET($request, $method): bool
{
    if (isset($_GET[$request]) && $_SERVER['REQUEST_METHOD'] == $method) {
        return true;
    }
    return false;
}
function postData($input)
{
    if ($_POST[$input]) {
        return $_POST[$input];
    }
}
function getData($input)
{
    if ($_GET[$input]) {
        return $_GET[$input];
    }
}
function page($location)
{
    return header("location:$location");
}

function checkSession($name)
{
    if (isset($_SESSION[$name])) {
        return true;
    }
    return false;
}
function catchDataSession($sessionName, $data)
{
    if (isset($_SESSION[$sessionName][$data])) {
        return $_SESSION[$sessionName][$data];
    }
}
function checkSessionEmpty($name)
{
    if (empty($_SESSION[$name])) {
        return true;
    }
    return false;
}

function getAge($alldate)
{
    $age = explode("-", $alldate);
    return $age[0];
}
function print_age($dateFDB)
{
    $date =  date_create($dateFDB);
    $age = date("Y") - date_format($date, "Y");
    return $age;
}
function saveAge(){
    
}
