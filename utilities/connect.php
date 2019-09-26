<?php

function connect () {
    $config = include ('../config.php');
    $connection = mysqli_connect($config['host'], $config['username'], $config['password'], $config['database']);
    return $connection;
}

function checkUser($email, $passwd) {
    // create db connection
    $mysqli = connect();
    // define the sql query to check the user
    $sql = "SELECT * FROM user WHERE email = '" . $email . "' AND password = '" . $passwd . "'";

    $result = $mysqli->query($sql);
    if ($result == true && $result->num_rows == 1) {
        echo "user is logged in";
        return true;
    }
    return false;
}
