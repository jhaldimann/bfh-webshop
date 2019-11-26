<?php

if (array_key_exists('login', $_POST)) {
    adminLogin();
} else if (array_key_exists('update', $_POST)) {
    updateProduct();
} else if (array_key_exists('delete', $_POST)) {
    deleteProduct($_POST["id"]);
} else if (array_key_exists('insert', $_POST)) {
    insertProduct();
}

function connectDB() {
    $config = include($_SERVER['DOCUMENT_ROOT'] . '/config.php');
    $connection = mysqli_connect($config['host'], $config['username'], $config['password'], $config['database']);
    return $connection;
}

function adminLogin() {
    $mysqli = connectDB();
    $username = $mysqli->real_escape_string($_POST["username"]);
    $password = $mysqli->real_escape_string($_POST["password"]);

    // define the sql query to check the user
    $sql = "SELECT * FROM admin WHERE username = '" . $username . "' AND password = '" . md5($password) . "'";

    $result = $mysqli->query($sql);
    if ($result == true && $result->num_rows == 1) {
        session_start();
        if (!isset($_SESSION['admin_logged_in'])) {
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
    $size = $mysqli->real_escape_string($_POST["size"]);
    $price = $mysqli->real_escape_string($_POST["price"]);
    $quantity = $mysqli->real_escape_string($_POST["quantity"]);
    $sale = $mysqli->real_escape_string($_POST["sale"]);
    $image = $mysqli->real_escape_string($_POST["image"]);

    $sql = "UPDATE products SET
        brand ='" . $brand . "',
        category ='" . $category . "',
        gender ='" . $gender . "',
        description='" . $description . "',
        size ='" . $size . "',
        price ='" . $price . "',
        quantity ='" . $quantity . "',
        sale ='" . $sale . "',
        image ='" . $_FILES['image']['name'] . "'
        WHERE id=" . $id;

    $mysqli->query($sql);
    echo json_encode(array('status' => 200, 'text' => 'success'));
}

function deleteProduct($id) {
    $mysqli = connectDB();
    $sql = "DELETE FROM products WHERE id ='" . $id . "'";
    $mysqli->query($sql);
    echo json_encode(array('status' => 200, 'text' => 'success'));
}

function insertProduct() {
    $mysqli = connectDB();
    $brand = $mysqli->real_escape_string($_POST["brand"]);
    $category = $mysqli->real_escape_string($_POST["category"]);
    $gender = $mysqli->real_escape_string($_POST["gender"]);
    $description = $mysqli->real_escape_string($_POST["description"]);
    $size = $mysqli->real_escape_string($_POST["size"]);
    $price = $mysqli->real_escape_string($_POST["price"]);
    $quantity = $mysqli->real_escape_string($_POST["quantity"]);
    $sale = $mysqli->real_escape_string($_POST["sale"]);
    $image = $mysqli->real_escape_string($_POST["image"]);
    storeImage();
    $sql = "INSERT INTO products (brand, category, gender, description, size, price, quantity, sale, image) 
            VALUES ('" . $brand . "','" . $category . "','" . $gender . "','" . $description . "','" . $size . "','" . $price . "','" . $quantity . "','" . $sale . "','" . $_FILES['image']['name'] . "'" . ")";

    $mysqli->query($sql);
    echo json_encode(array('status' => 200, 'text' => 'success'));
}

function storeImage() {
    $uploaddir = $_SERVER['DOCUMENT_ROOT'] . '/images/uploads/';
    $uploadfile = $uploaddir . basename($_FILES['image']['name']);
    move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile);
}
