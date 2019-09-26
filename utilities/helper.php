<?php

if(array_key_exists('register', $_POST)) {
    register();
} else if(array_key_exists('login', $_POST)) {
    login();
}

function connect () {
    $config = include ('../config.php');
    $connection = mysqli_connect($config['host'], $config['username'], $config['password'], $config['database']);
    return $connection;
}

function getProducts($cat) {
    $mysqli = connect();
    @$categorie =  $mysqli->real_escape_string($cat);

    if($categorie === "") {
        $query =   $sql = "SELECT * FROM products";
        return $mysqli->query($query);

    } else {
        $query = $sql = "SELECT * FROM products WHERE category = '".$categorie."'"."OR gender ='".$categorie."'";
        return $mysqli->query($query);

    }
}

function getProduct($id) {
    $mysqli = connect();
    @$identifier = $mysqli->real_escape_string($id);

    if($identifier === "") {
        return;
    } else {
        $query = $sql = "SELECT * FROM products WHERE id = '".$identifier."'";
        return $mysqli->query($query);
    }
}

function register() {
    $mysqli = connect();
    @$prename = $mysqli->real_escape_string($_POST["prename"]);
    @$name = $mysqli->real_escape_string($_POST["name"]);
    @$email = $mysqli->real_escape_string($_POST["email"]);
    @$password = $mysqli->real_escape_string($_POST["password"]);
    @$passwordConfirm = $mysqli->real_escape_string($_POST["password-confirm"]);
    if($password === $passwordConfirm) {
        if($prename !== "" && $name !== "" && $email !== "" && $password !== "") {
            if(!checkUser($email,$password)) {
                $query = "INSERT INTO user (prename,name,email,password) values "."('$prename','$name','$email','".md5( $password )."')";
                $mysqli->query($query);
                echo"<div class='message-box success'><p>Registration successfully</p></div>";

            } else {
                echo"<div class='message-box failed'><p>User already exists</p></div>";
            }
        } else {
            echo"<div class='message-box failed'><p>Registration failed</p></div>";
        }
    } else {
        echo"<div class='message-box failed'><p>Passwords are not equal</p></div>";
    }
}

function login() {
    $mysqli = connect();

    @$email = $mysqli->real_escape_string($_POST["email"]);
    @$password = $mysqli->real_escape_string($_POST["password"]);
    checkUser($email,$password);
}

function checkUser($email, $passwd) {
    // create db connection
    $mysqli = connect();
    // define the sql query to check the user
    $sql = "SELECT * FROM user WHERE email = '".$email."' AND password = '".md5($passwd)."'";

    $result = $mysqli->query($sql);
    if ($result == true && $result->num_rows == 1) {
        return true;
    }
    return false;
}
