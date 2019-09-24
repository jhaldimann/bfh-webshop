<?php

function connect () {
    $connection = mysqli_connect("sql", "root", "example", "gamefameclothing");
    return $connection;
}

function checkUser($username, $passwd) {
    // create db connection
    $mysqli = connect();
    // define the sql query to check the user
    $sql = "SELECT * FROM user where prename = '" . $username . "' and password = '" . $passwd . "'";

    $result = $mysqli->query ( $sql );
    if ($result == true && $result->num_rows == 1) {
        echo "user is logged in";
        return true;
    }
    return false;
}

// Test check if user exists
checkUser("Julian","bbhb");
