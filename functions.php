<?php

function connect_to_db()
{
    // $dbn = 'mysql:dbname=dj_db;charset=utf8mb4;port=3306;host=localhost';
    // $user = 'root';
    // $pwd = '';
    $dbn = 'mysql:dbname=fukpzm_fukpzm;charset=utf8;port=3306;host=localhost.xserver.jp';
    $user = 'fukpzm_fukpzm';
    $pwd = 'tonkotsu';

    try {
        return new PDO($dbn, $user, $pwd);
    } catch (PDOException $e) {
        exit('dbError:' . $e->getMessage());
    }
}
