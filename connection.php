<?php

include_once "lib/ez_sql_core.php";
include_once "lib/ez_sql_mysql.php";

$config['db_host'] = 'localhost';
$config['db_user'] = 'root';
$config['db_pass'] = 'commonrbs';
$config['db_name'] = 'schools_colleges';

function getConnection()
{
    global $config;
    return new ezSQL_mysql($config['db_user'], $config['db_pass'], $config['db_name'], $config['db_host']);
}