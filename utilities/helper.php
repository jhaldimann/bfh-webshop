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
    getUser($_POST['id']);
} else if(array_key_exists('getProduct', $_POST)) {
    getProduct($_POST['getProduct']);
} else if(array_key_exists('getProducts', $_POST)) {
    getProducts($_POST['getProducts'], $_POST['searchstring']);
} else if(array_key_exists('checkout', $_POST)) {
    checkout();
} else if(array_key_exists('search', $_POST)) {
    search();
}

/**
 * Connect to the database with the credentials from the config file
 * @return false|mysqli
 */
function connect () {
    $config = include ($_SERVER['DOCUMENT_ROOT'].$GLOBALS["path"].'/config.php');
    $connection = mysqli_connect($config['host'], $config['username'], $config['password'], $config['database']);
    return $connection;
}

/**
 * Proceed the checkout
 */
function checkout(){
    // Connect to the database
    $mysqli = connect();
    // Get all the important information of the user
    $firstname = htmlspecialchars($_POST["firstname"]);
    $lastname = htmlspecialchars($_POST["lastname"]);
    $address = htmlspecialchars($_POST["address"]);
    $housenr = htmlspecialchars($_POST["housenr"]);
    $zip = htmlspecialchars($_POST["zip"]);
    $city = htmlspecialchars($_POST["city"]);
    $country = htmlspecialchars($_POST["country"]);
    $ccowner = htmlspecialchars($_POST["ccowner"]);
    $ccdate = htmlspecialchars($_POST["ccdate"]);
    $ccnumber = htmlspecialchars($_POST["ccnumber"]);
    $ccccv = htmlspecialchars($_POST["ccccv"]);
    // Generate a random hash to know later the order
    $randomHash = rand();
    // Make the query and run it
    $query = "INSERT INTO orders (name, prename, address, housenumber, zip, city, country, hash) VALUES  "."('$firstname','$lastname','$address','$housenr','$zip','$city','$country','$randomHash')";
    $result = $mysqli->query($query);
    if($result) {
        echo json_encode(array('status' => 200, 'text' => 'success', 'hash' =>$randomHash));
    } else {
        echo json_encode(array('status' => 400, 'text' => 'Failed'));
    }
}

/**
 * Get all the products by category or by a search string
 * @param $cat
 * @param string $search
 */
function getProducts($cat, $search = "") {
    $mysqli = connect();
    $category = htmlspecialchars($cat);

    $myArray = array();

    // Check if category or searchstring
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

/**
 * Get a single product by id
 * @param $id
 */
function getProduct($id) {
    $mysqli = connect();
    $identifier = htmlspecialchars($id);

    if ($result = $mysqli->query("SELECT * FROM products WHERE id = '".$identifier."'")) {

        if($row = $result->fetch_array(MYSQLI_ASSOC)) {
            echo json_encode($row);
        }
    }

    $result->close();
    $mysqli->close();
}

/**
 * Proceed the registration of the user
 */
function register() {
    // Connect to database
    $mysqli = connect();
    // Get all the information from the POST request
    $firstname = htmlspecialchars($_POST["firstname"]);
    $name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    $password = htmlspecialchars($_POST["password"]);
    $passwordConfirm = htmlspecialchars($_POST["password-confirm"]);
    // Check if the password check is correct
    if($password === $passwordConfirm) {
        // Check if everything is filled
        if($firstname !== "" && $name !== "" && $email !== "" && $password !== "") {
            // Check if user is not in db
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

/**
 * User Login
 * @param $e
 * @param $p
 */
function login($e, $p) {
    // Database connection
    $mysqli = connect();
    // Escape the email and the password to avoid sql injection
    $email = htmlspecialchars($e);
    $password = htmlspecialchars($p);
    // Check if user
    if(checkUser($email,$password)) {
        // Start a session
        session_start();
        $query = "SELECT * FROM user WHERE email = '".$email."'";
        $data = $mysqli->query($query);
        $row = mysqli_fetch_assoc($data);
        // Fill the session with data
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

/**
 * Proceed logout
 */
function logout() {
    // Set the session to an empty array
    $_SESSION = array();
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000, $params["path"],
            $params["domain"], $params["secure"], $params["httponly"]
        );
    }
    echo json_encode(array('status' => 200, 'text' => 'success'));
}

/**
 * Check if there is a user in the database
 *
 * @param $email
 * @param $passwd
 * @return bool
 */
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

/**
 * Get a single user from the database by id
 *
 * @param $id
 */
function getUser($id) {
    $mysqli = connect();
    $myArray = array();
    if ($result = $mysqli->query("SELECT name, prename, email FROM user WHERE id =".$id)) {
        while($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $myArray[] = $row;
        }
        echo json_encode($myArray);
    }
}

/**
 * Get a random item
 */
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

/**
 * Get 3 products that are on sale from the database
 */
function getSaleProducts() {
    // Database connection
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

/**
 * Get the images of a single category
 *
 * @param $nrOfImages
 */
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

/**
 * Search in products and get all matching items
 *
 * @param string $searchparam
 * @return string
 */
function search($searchparam = "") {
    $mysqli = connect();
    if($searchparam != "") {
        $searchString = $searchparam;
    } else {
        $searchString = htmlspecialchars($_POST["searchstring"]);
    }

     return "SELECT * FROM products WHERE 
        MATCH(brand) AGAINST("."'+".$searchString."*' IN BOOLEAN MODE) OR 
        MATCH(category) AGAINST("."'+".$searchString."*' IN BOOLEAN MODE)";
}

/**
 * Returns a certain GET parameter
 */
function get_param($name, $default) {
    if (isset($_GET[$name]))
        return urldecode($_GET[$name]);
    else
        return $default;
}

/**
 * Adds a GET parameter to the url. The url is passed by reference.
 *
 * @param $url
 * @param $name
 * @param $value
 * @return string
 */
function add_param(&$url, $name, $value) {
    $sep = strpos($url, '?') !== false ? '&' : '?';
    $url .= $sep . $name . "=" . urlencode($value);
    return $url;
}

/**
 * Renders the page content for a certain page ID.
 *
 * @param $pageId
 */
function render_content($pageId) {
    echo t('content') . " $pageId";
}

/**
 * Renders the navigation for the passed language and page ID.
 *
 * @param $language
 * @param $pageId
 */
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

/**
 * The translation function.
 *
 * @param $key
 * @return mixed|string
 */
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
