<?php

// function connect_to_db()
// {
//     // $dbn = 'mysql:dbname=dj_db;charset=utf8mb4;port=3306;host=localhost';
//     // $user = 'root';
//     // $pwd = '';
//     $dbn = "mysql:dbname=fukpzm_fukpzm;charset=utf8;port=3306;host=localhost.xserver.jp";
//     $user = "fukpzm_fukpzm";
//     $pwd = "tonkotsu";

//     try {
//         return new PDO($dbn, $user, $pwd);
//     } catch (PDOException $e) {
//         exit('dbError:' . $e->getMessage());
//     }
// }

function connect_to_db(){
    $dsn = 'mysql:dbname=fukpzm_fukpzm;
            host=localhost;
            charset=utf8';
    $user = 'fukpzm_fukpzm';
    $password = 'tonkotsu';
    try {
        return new PDO($dsn, $user, $password);
    } catch (PDOException $e) {
        exit('dbError:' . $e->getMessage());
    }
    // $options = array(
    //   PDO::ATTR_ERRMODE => PDO::ERRMODE_SILENT,
    //   PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    //   PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true,
    // );
    // $dbh = new PDO($dsn, $user, $password, $options);
    // return $dbh;
  }