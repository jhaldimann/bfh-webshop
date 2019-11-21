<?php

if(array_key_exists('login', $_POST)) {
    adminLogin();
} else if(array_key_exists('update', $_POST)) {
    updateProduct();
} else if(array_key_exists('delete', $_POST)) {
    deleteProduct();
}else if(array_key_exists('insert', $_POST)) {
    insertProduct();
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
      echo json_encode(array('status' => 401, 'text' => 'failed'));
    }
}

function updateProduct() {
        $mysqli = connectDB();
        $id = $mysqli->real_escape_string($_POST["id"]);
        $brand = $mysqli->real_escape_string($_POST["brand"]);
        $category = $mysqli->real_escape_string($_POST["category"]);
        $gender = $mysqli->real_escape_string($_POST["gender"]);
        $description = $mysqli->real_escape_string($_POST["description"]);
        $image = $mysqli->real_escape_string($_POST["image"]);

        $sql = "UPDATE products SET id ='".$id."',brand ='".$brand."', category ='".$category."',gender ='".$gender.
            "', description='".$description."', image ='".$image."' WHERE id=".$id;

        $mysqli->query($sql);
        echo json_encode(array('status' => 200, 'text' => 'success'));
}

function deleteProduct() {
        $mysqli = connectDB();
        $id = $mysqli->real_escape_string($_POST["id"]);
        $sql = "DELETE FROM products WHERE id ='".$id."'";
        $mysqli->query($sql);
        echo json_encode(array('status' => 200, 'text' => 'success'));
}

function insertProduct() {
    if(isset($_SESSION['admin_logged_in'])) {
        $mysqli = connectDB();
        $id = $mysqli->real_escape_string($_POST["id"]);
        $brand = $mysqli->real_escape_string($_POST["brand"]);
        $category = $mysqli->real_escape_string($_POST["category"]);
        $gender = $mysqli->real_escape_string($_POST["gender"]);
        $description = $mysqli->real_escape_string($_POST["description"]);
        $image = $mysqli->real_escape_string($_POST["image"]);

        $sql = "INSERT INTO products (brand, category, gender, desctiption, image) 
                VALUES (".$brand.",".$category.",".$gender.",".$description.",".$image.")";

        $mysqli->query($sql);
    } else {
        http_response_code(403);
    }
}
