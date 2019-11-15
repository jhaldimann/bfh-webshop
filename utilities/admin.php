<?php

if(array_key_exists('login', $_POST)) {
    adminLogin();
}

function adminLogin() {
    $mysqli = connect();
    $username = $mysqli->real_escape_string($_POST["username"]);
    $password = $mysqli->real_escape_string($_POST["password"]);

    $mysqli = connect();
    // define the sql query to check the user
    $sql = "SELECT * FROM admin WHERE username = '".$username."' AND password = '".md5($password)."'";

    $result = $mysqli->query($sql);
    if ($result == true && $result->num_rows == 1) {
        return true;
    }
    return false;
    json_encode(true);
}

