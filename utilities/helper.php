<?php

if(session_id() == '' || !isset($_SESSION)) {
    session_start();
}

if(array_key_exists('register', $_POST)) {
    register();
} else if(array_key_exists('login', $_POST)) {
    login();
} else if(array_key_exists('add-to-cart', $_POST)) {
    addToCart();
} else if(array_key_exists('logout', $_POST)) {
    logout();
}

function connect () {
    $config = include ($_SERVER['DOCUMENT_ROOT'].'config.php');
    $connection = mysqli_connect($config['host'], $config['username'], $config['password'], $config['database']);
    return $connection;
}

function getProducts($cat) {
    $mysqli = connect();
    $categorie =  $mysqli->real_escape_string($cat);

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
    $identifier = $mysqli->real_escape_string($id);

    if($identifier === "") {
        return;
    } else {
        $query = $sql = "SELECT * FROM products WHERE id = '".$identifier."'";
        return $mysqli->query($query);
    }
}

function register() {
    $mysqli = connect();
    $prename = $mysqli->real_escape_string($_POST["prename"]);
    $name = $mysqli->real_escape_string($_POST["name"]);
    $email = $mysqli->real_escape_string($_POST["email"]);
    $password = $mysqli->real_escape_string($_POST["password"]);
    $passwordConfirm = $mysqli->real_escape_string($_POST["password-confirm"]);
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
    $email = $mysqli->real_escape_string($_POST["email"]);
    $password = $mysqli->real_escape_string($_POST["password"]);

    if(checkUser($email,$password)) {
        $query = "SELECT * FROM user WHERE email = '".$email."'";
        $data = $mysqli->query($query);
        $row = mysqli_fetch_assoc($data);
        $_SESSION['logged_in'] = true;
        $_SESSION['name'] = $row['name'];
        $_SESSION['prename'] = $row['prename'];
        $_SESSION['id'] = $row['id'];
        $_SESSION['email'] = $email;
    }
}

function logout() {
    session_destroy();
    header("Location: index.php");
}

/*function addToCart() {
    $mysqli = connect();

    if() {
        $query = "INSERT INTO cart_items (user_id, product_id) values"
    }
}*/

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

function getUser($id) {
    $mysqli = connect();
    $sql = "SELECT * FROM user WHERE id ='".$id."'";
    return $mysqli->query($sql);
}
