<?php

/**
 * check if user logged in or not
 * @return bool
 */
function checkLogin()
{
    return (isset($_SESSION['user']))? true : false;
}