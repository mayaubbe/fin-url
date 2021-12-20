<?php
//defining global settings for db connection 
define("DB_SERVER", 'localhost');
//Replace dbUserName with Database server User name
define("DB_USER", 'dbUserName');
//Replace dbPassword with Database server password
define("DB_PASS", 'dbPassword');
//Replace dbName with Database name
define("DB_NAME", 'dbName');

/**
 * connection for db
 */
function connectDb(){
    $connect = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
    if(!empty($connect)){
        return $connect;
    }else{
        return false;
    }
}
?>