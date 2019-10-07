<?php

if(array_key_exists('register', $_POST)) {
    register();
} else if(array_key_exists('login', $_POST)) {
    login();
} else if(array_key_exists('logout', $_POST)) {
    logout();
} else if(array_key_exists('getRandomPicks', $_POST)) {
    pickRandomItem();
} else if(array_key_exists('getSaleProducts', $_POST)) {
    getSaleProducts();
} else if(array_key_exists('getProductImagesByCategory', $_POST)) {
    getProductImagesByCategory($_POST['nrOfImages']);
} else if(array_key_exists('getUser', $_POST)) {
    getUser($_SESSION['id']);
} else if(array_key_exists('getProduct', $_POST)) {
    getProduct($_POST['getProduct']);
} else if(array_key_exists('getProducts', $_POST)) {
    getProducts($_POST['getProducts']);
}

function connect () {
    $config = include ($_SERVER['DOCUMENT_ROOT'].'/config.php');
    $connection = mysqli_connect($config['host'], $config['username'], $config['password'], $config['database']);
    return $connection;
}

function getProducts($cat) {
    $mysqli = connect();
    $category = $mysqli->real_escape_string($cat);

    $myArray = array();
    if ($result = $mysqli->query("SELECT * FROM products WHERE category ='".$category."'")) {

        while($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $myArray[] = $row;
        }
        echo json_encode($myArray);
    }

    $result->close();
    $mysqli->close();
}

function getProduct($id) {
    $mysqli = connect();
    $identifier = $mysqli->real_escape_string($id);
    
    if ($result = $mysqli->query("SELECT * FROM products WHERE id = '".$identifier."'")) {

        if($row = $result->fetch_array(MYSQLI_ASSOC)) {
            echo json_encode($row);
        }
    }

    $result->close();
    $mysqli->close();
}

function register() {
    if(session_id() == '' || !isset($_SESSION)) {
        session_start();
    }
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
                $sql = "SELECT * FROM user WHERE email = '".$email."'";
                $data = $mysqli->query($sql);
                $row = mysqli_fetch_assoc($data);
                $_SESSION['logged_in'] = true;
                $_SESSION['name'] = $row['name'];
                $_SESSION['prename'] = $row['prename'];
                $_SESSION['id'] = $row['id'];
                $_SESSION['email'] = $email;
                header("Location: /index.php");
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
        if(session_id() == '' || !isset($_SESSION)) {
            session_start();
        }
        $query = "SELECT * FROM user WHERE email = '".$email."'";
        $data = $mysqli->query($query);
        $row = mysqli_fetch_assoc($data);
        $_SESSION['logged_in'] = true;
        $_SESSION['name'] = $row['name'];
        $_SESSION['prename'] = $row['prename'];
        $_SESSION['id'] = $row['id'];
        $_SESSION['email'] = $email;
        echo json_encode(true);
    } else {
        echo json_encode(false);
    }
}

function logout() {
    session_destroy();
    header("Location: /index.php");
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

function getUser($id) {
    $mysqli = connect();
    $myArray = array();
    if ($result = $mysqli->query("SELECT name, prename, email FROM user WHERE id =".$id)) {
        while($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $myArray[] = $row;
        }
        echo json_encode($myArray);
    }

    $result->close();
    $mysqli->close();
}

function pickRandomItem() {
    $mysqli = connect();
    $myArray = array();
    if ($result = $mysqli->query("SELECT * FROM products ORDER BY RAND() LIMIT 3")) {
        while($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $myArray[] = $row;
        }
        echo json_encode($myArray);
    }

    $result->close();
    $mysqli->close();
}

function getSaleProducts() {
    $mysqli = connect();
    $myArray = array();
    if ($result = $mysqli->query("SELECT * FROM products WHERE sale = 1 LIMIT 3")) {

        while($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $myArray[] = $row;
        }
        echo json_encode($myArray);
    }

    $result->close();
    $mysqli->close();
}

function getProductImagesByCategory($nrOfImages) {
    $mysqli = connect();
    $myCategories = [];
    if($resCat = $mysqli->query("SELECT DISTINCT category FROM products")) {
      while($category = $resCat->fetch_array(MYSQLI_ASSOC)) {
        $myCategories[] = $category;
      }
    }

    $images = [];

    for($i = 0; $i < sizeof($myCategories); $i++){
        if($result = $mysqli->query("SELECT image FROM products WHERE category = '" . $myCategories[$i]['category'] . "' LIMIT $nrOfImages")) {
          //echo json_encode("2");
          $images[$myCategories[$i]['category']] = [];
          while($image = $result->fetch_array(MYSQLI_ASSOC)) {
            $images[$myCategories[$i]['category']][] = $image;
          }
        }
    }

    echo json_encode($images);

    $result->close();
    $mysqli->close();
}
