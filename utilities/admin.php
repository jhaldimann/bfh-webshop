<?php

$GLOBALS["path"] = "";

if (array_key_exists('login', $_POST)) {
    adminLogin();
} else if (array_key_exists('update', $_POST)) {
    updateProduct();
} else if (array_key_exists('delete', $_POST)) {
    deleteProduct($_POST["id"]);
} else if (array_key_exists('insert', $_POST)) {
    insertProduct();
} else if(array_key_exists('getUsers', $_POST)) {
    getUsers();
} else if(array_key_exists('getOrders', $_POST)) {
    getUserOrders();
} else if(array_key_exists('updateUser', $_POST)) {
    updateUser();
} else if(array_key_exists('updateOrder', $_POST)) {
    updateOrder();
}

/**
 * Connect to the database with the data from the config file
 *
 * @return false|mysqli
 */
function connectDB() {
    $config = include($_SERVER['DOCUMENT_ROOT'] . $GLOBALS["path"] . '/config.php');
    $connection = mysqli_connect($config['host'], $config['username'], $config['password'], $config['database']);
    return $connection;
}

/**
 * Check the login of the admin
 *
 */
function adminLogin() {
    $mysqli = connectDB();
    $username = htmlspecialchars($_POST["username"]);
    $password = htmlspecialchars($_POST["password"]);

    // Define the sql query to check the user
    $sql = "SELECT * FROM admin WHERE username = '" . $username . "' AND password = '" . md5($password) . "'";

    $result = $mysqli->query($sql);
    if ($result == true && $result->num_rows == 1) {
        // Start the session and set the admin_logged_in
        session_start();
        if (!isset($_SESSION['admin_logged_in'])) {
            $_SESSION['admin_logged_in'] = true;
        }
        echo json_encode(array('status' => 200, 'text' => 'success'));
    } else {
        echo json_encode(array('status' => 401, 'text' => 'failed'));
    }
}

/**
 * Update a single product with the frontend data
 */
function updateProduct() {
    // Connect to the database
    $mysqli = connectDB();
    // Get all the data from the post request and
    // use htmlspecialchars to escape special characters
    $id = htmlspecialchars($_POST["id"]);
    $brand = htmlspecialchars($_POST["brand"]);
    $category = htmlspecialchars($_POST["category"]);
    $gender = htmlspecialchars($_POST["gender"]);
    $description = htmlspecialchars($_POST["description"]);
    $size = htmlspecialchars($_POST["size"]);
    $price = htmlspecialchars($_POST["price"]);
    $quantity = htmlspecialchars($_POST["quantity"]);
    $sale = htmlspecialchars($_POST["sale"]);
    $image = htmlspecialchars($_POST["image"]);

    // Define the update query
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

    // Execute the query and store the new image
    $mysqli->query($sql);
    storeImage();
    echo json_encode(array('status' => 200, 'text' => 'success'));
}

/**
 * Remove a single product from the database by id
 *
 * @param $id
 */
function deleteProduct($id) {
    $mysqli = connectDB();
    $sql = "DELETE FROM products WHERE id ='" . $id . "'";
    $mysqli->query($sql);
    echo json_encode(array('status' => 200, 'text' => 'success'));
}

/**
 * Add a new product to the database
 */
function insertProduct() {
    // Connect to the database
    $mysqli = connectDB();
    // Get data from POST and escape special chars
    $brand = htmlspecialchars($_POST["brand"]);
    $category = htmlspecialchars($_POST["category"]);
    $gender = htmlspecialchars($_POST["gender"]);
    $description = htmlspecialchars($_POST["description"]);
    $size = htmlspecialchars($_POST["size"]);
    $price = htmlspecialchars($_POST["price"]);
    $quantity = htmlspecialchars($_POST["quantity"]);
    $sale = htmlspecialchars($_POST["sale"]);
    // Save the image in the upload folder
    storeImage();
    $sql = "INSERT INTO products (brand, category, gender, description, size, price, quantity, sale, image) 
            VALUES ('" . $brand . "','" . $category . "','" . $gender . "','" . $description . "','" . $size . "','" . $price . "','" . $quantity . "','" . $sale . "','" . $_FILES['image']['name'] . "'" . ")";

    $mysqli->query($sql);
    echo json_encode(array('status' => 200, 'text' => 'success'));
}

/**
 * Store the uploaded image in a folder in this project
 */
function storeImage() {
    $uploaddir = $_SERVER['DOCUMENT_ROOT'] . $GLOBALS["path"] . '/images/uploads/';
    $uploadfile = $uploaddir . basename($_FILES['image']['name']);
    move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile);
}

function getUsers() {
    $mysqli = connectDB();

    $query = "SELECT * FROM user";

    $myArray = array();
    if ($result = $mysqli->query($query)) {

        while($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $myArray[] = $row;
        }

        echo json_encode($myArray);
    }

    $result->close();
    $mysqli->close();
}

function getUserOrders() {
    $mysqli = connectDB();

    $query = "SELECT * FROM orders";

    $myArray = array();
    if ($result = $mysqli->query($query)) {

        while($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $myArray[] = $row;
        }

        echo json_encode($myArray);
    }

    $result->close();
    $mysqli->close();
}

function updateUser() {
    // Connect to the database
    $mysqli = connectDB();
    // Get all the data from the post request and
    // use htmlspecialchars to escape special characters
    $id = htmlspecialchars($_POST["id"]);
    $prename = htmlspecialchars($_POST["prename"]);
    $name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    $password = htmlspecialchars($_POST["password"]);

    // Define the update query
    $sql = "UPDATE user SET
        prename ='" . $prename . "',
        name ='" . $name . "',
        email ='" . $email . "',
        password='" . $password . "'
        WHERE id=" . $id;
    // Execute the query and store the new image
    $mysqli->query($sql);
    echo json_encode(array('status' => 200, 'text' => 'success'));
}

function updateOrder() {
    $mysqli = connectDB();

    $id = htmlspecialchars($_POST["id"]);
    $name = htmlspecialchars($_POST["name"]);
    $prename = htmlspecialchars($_POST["prename"]);
    $address = htmlspecialchars($_POST["address"]);
    $housenumber = htmlspecialchars($_POST["housenumber"]);
    $zip = htmlspecialchars($_POST["zip"]);
    $city = htmlspecialchars($_POST["city"]);
    $country = htmlspecialchars($_POST["country"]);

    $sql = "UPDATE orders SET
        name ='" . $name . "',
        prename ='" . $prename . "',
        address ='" . $address . "',
        housenumber='" . $housenumber . "',
        zip='" . $zip . "',
        city='" . $city . "',
        country='" . $country . "'
        WHERE id=" . $id;

    $mysqli->query($sql);
    echo json_encode(array('status' => 200, 'text' => 'success'));
}
