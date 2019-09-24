<?php
    require_once ('connect.php');
    if(array_key_exists('register', $_POST)) {
        register();
    }

    function register() {
        $mysqli = connect();
        @$prename = $mysqli->real_escape_string($_POST["prename"]);
        @$name = $mysqli->real_escape_string($_POST["name"]);
        @$email = $mysqli->real_escape_string($_POST["email"]);
        @$password = $mysqli->real_escape_string($_POST["password"]);

        if($prename !== "" && $name !== "" && $email !== "" && $password !== "") {
            $query = "INSERT INTO user (prename,name,email,password) values "."('$prename','$name','$email','".md5( $password )."')";
            $mysqli->query($query);
        }
    }
?>
