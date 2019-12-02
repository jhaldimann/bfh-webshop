<?php

$GLOBALS["path"] = "";

if(array_key_exists('register', $_POST)) {
    register();
} else if(array_key_exists('login', $_POST)) {
    login($_POST['email'], $_POST['password']);
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
    getProducts($_POST['getProducts'], $_POST['searchstring']);
} else if(array_key_exists('checkout', $_POST)) {
    checkout();
} else if(array_key_exists('search', $_POST)) {
    search();
}

function connect () {
    $config = include ($_SERVER['DOCUMENT_ROOT'].$GLOBALS["path"].'/config.php');
    $connection = mysqli_connect($config['host'], $config['username'], $config['password'], $config['database']);
    return $connection;
}

function checkout(){
    $mysqli = connect();
    $firstname = $mysqli->real_escape_string($_POST["firstname"]);
    $lastname = $mysqli->real_escape_string($_POST["lastname"]);
    $address = $mysqli->real_escape_string($_POST["address"]);
    $housenr = $mysqli->real_escape_string($_POST["housenr"]);
    $zip = $mysqli->real_escape_string($_POST["zip"]);
    $city = $mysqli->real_escape_string($_POST["city"]);
    $country = $mysqli->real_escape_string($_POST["country"]);
    $ccowner = $mysqli->real_escape_string($_POST["ccowner"]);
    $ccdate = $mysqli->real_escape_string($_POST["ccdate"]);
    $ccnumber = $mysqli->real_escape_string($_POST["ccnumber"]);
    $ccccv = $mysqli->real_escape_string($_POST["ccccv"]);
    $randomHash = rand();
    $query = "INSERT INTO orders (name, prename, address, housenumber, zip, city, country, hash) VALUES  "."('$firstname','$lastname','$address','$housenr','$zip','$city','$country','$randomHash')";
    $result = $mysqli->query($query);
    if($result) {
        echo json_encode(array('status' => 200, 'text' => 'success', 'hash' =>$randomHash));
    } else {
        echo json_encode(array('status' => 400, 'text' => 'Failed'));
    }
}

function getProducts($cat, $search = "") {
    $mysqli = connect();
    $category = $mysqli->real_escape_string($cat);

    $myArray = array();

    if($cat == 'none') {
        $query = "SELECT * FROM products";
    } else if( $cat == 'search') {
        $query = search($search);
    } else {
        $query = "SELECT * FROM products WHERE category ='".$category."'";
    }

    if ($result = $mysqli->query($query)) {

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
    $mysqli = connect();
    $firstname = $mysqli->real_escape_string($_POST["firstname"]);
    $name = $mysqli->real_escape_string($_POST["name"]);
    $email = $mysqli->real_escape_string($_POST["email"]);
    $password = $mysqli->real_escape_string($_POST["password"]);
    $passwordConfirm = $mysqli->real_escape_string($_POST["password-confirm"]);
    if($password === $passwordConfirm) {
        if($firstname !== "" && $name !== "" && $email !== "" && $password !== "") {
            if(!checkUser($email,$password)) {
                session_start();
                $query = "INSERT INTO user (prename,name,email,password) values "."('$firstname','$name','$email','".md5( $password )."')";
                $mysqli->query($query);
                $sql = "SELECT * FROM user WHERE email = '".$email."'";
                $data = $mysqli->query($sql);
                $row = mysqli_fetch_assoc($data);
                $_SESSION['logged_in'] = true;
                $_SESSION['name'] = $row['name'];
                $_SESSION['prename'] = $row['prename'];
                $_SESSION['id'] = $row['id'];
                $_SESSION['email'] = $email;
                echo json_encode(array('status' => 200, 'text' => 'success'));
            } else {
                echo json_encode(array('status' => 400, 'text' => 'user-already-exists'));
            }
        } else {
            echo json_encode(array('status' => 400, 'text' => 'failed'));
        }
    } else {
        echo json_encode(array('status' => 400, 'text' => 'password-not-equal'));
    }
}

function login($e, $p) {
    $mysqli = connect();
    $email = $mysqli->real_escape_string($e);
    $password = $mysqli->real_escape_string($p);

    if(checkUser($email,$password)) {
        session_start();
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
    $_SESSION = array();
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000, $params["path"],
            $params["domain"], $params["secure"], $params["httponly"]
        );
    }
    echo json_encode(array('status' => 200, 'text' => 'success'));

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
    var_dump($_SESSION['id']);
    die();
    if ($result = $mysqli->query("SELECT name, prename, email FROM user WHERE id =".$id)) {
        while($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $myArray[] = $row;
        }
        echo json_encode($myArray);
    }
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

function search($searchparam = "") {
    $mysqli = connect();
    if($searchparam != "") {
        $searchString = $searchparam;
    } else {
        $searchString = $mysqli->real_escape_string($_POST["searchstring"]);
    }

     return "SELECT * FROM products WHERE 
        MATCH(brand) AGAINST("."'+".$searchString."*' IN BOOLEAN MODE) OR 
        MATCH(category) AGAINST("."'+".$searchString."*' IN BOOLEAN MODE)";
}

// Returns a certain GET parameter or $default if the parameter
// does not exist.
function get_param($name, $default) {
    if (isset($_GET[$name]))
        return urldecode($_GET[$name]);
    else
        return $default;
}

// Adds a GET parameter to the url. The url is passed by reference.
function add_param(&$url, $name, $value) {
    $sep = strpos($url, '?') !== false ? '&' : '?';
    $url .= $sep . $name . "=" . urlencode($value);
    return $url;
}

// Renders the page content for a certain page ID.
function render_content($pageId) {
    echo t('content') . " $pageId";
}

// Renders the navigation for the passed language and page ID.
function render_navigation($language, $pageId) {
    $urlBase = $_SERVER['PHP_SELF'];
    add_param($urlBase, "lang", $language);
    $navs = array('home', 'contact', 'products', 'agb');
    foreach ($navs as $nav) {
        $url = $urlBase;
        add_param($url, "id", $nav);
        $class = $pageId == $nav ? 'active' : 'inactive';
        echo "<a class=\"$class\" href=\"$url\">".t($nav)."</a>";
    }
}

// The translation function.
function t($key) {
    global $messages;
    if (isset($messages[$key])) {
        return $messages[$key];
    } else {
        return "[$key]";
    }
}

// Set language and page ID as global variables.
$pageId = get_param('site', 'home');
$language = get_param('lang', 'de');
$messages = array();
$fn = $_SERVER['DOCUMENT_ROOT']. $GLOBALS["path"]."/language/messages_$language.txt";
$file = file($fn);
foreach($file as $line) {
    $keyval = explode('=', $line);
    $messages[$keyval[0]] = $keyval[1];

    list($key, $val) = explode('=', $line);
    $messages[$key] = $val;
}
