<?php
    define("HOST", "sql301.byethost13.com");
    define("USERNAME", "b13_21372958");
    define("PASSWORD", "w0cnb94p");
    define("DBNAME", "db_credit_transfer");

    $link = mysqli_connect(HOST, USERNAME, PASSWORD, DBNAME);

    if(!$link){
        die("Connection Problem : ".mysqli_error($link));
    }