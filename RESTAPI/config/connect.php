<?php
define('DB_HOST', 'localhost:3306');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'company');
define('DEBUG', false);
try {
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if ($conn) {
        if (DEBUG==true) {
            echo 'Connection Successfully';
        }
    } else {
        throw new mysqli_sql_exception();
    }
} catch (mysqli_sql_exception $e) {
    echo 'Connection Error :';
    //echo $e->getMessage();
    echo mysqli_connect_errno();
}