<?php

if(array_key_exists('login', $_POST)) {
    adminLogin();
}

function connectDB () {
    $config = include ($_SERVER['DOCUMENT_ROOT'].'/config.php');
    $connection = mysqli_connect($config['host'], $config['username'], $config['password'], $config['database']);
    return $connection;
}

function adminLogin() {
    $mysqli = connectDB();
    $username = $mysqli->real_escape_string($_POST["username"]);
    $password = $mysqli->real_escape_string($_POST["password"]);
    
    // define the sql query to check the user
    $sql = "SELECT * FROM admin WHERE username = '".$username."' AND password = '".md5($password)."'";

    $result = $mysqli->query($sql);
    if ($result == true && $result->num_rows == 1) {
      session_start();
      if(!isset($_SESSION['admin_logged_in'])) {
        $_SESSION['admin_logged_in'] = true;
      }
      echo json_encode(array('status' => 200, 'text' => 'success'));
    } else {
      if(isset($_SESSION['admin_logged_in'])) {
        unset($_SESSION['admin_logged_in']);
      }
      echo json_encode(array('status' => 401, 'text' => 'failed'));
    }
}
