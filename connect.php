<?php
include_once 'Database.php';

function open($dataSource, $username, $password)
{
    global $db;
    $db = new Database($dataSource, $username, $password);


    return $db;
}
//open('assabbane', 'root', '');
open('db_name', 'db_user', 'db_pass');
