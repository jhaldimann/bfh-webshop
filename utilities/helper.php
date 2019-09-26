<?php
require_once ('connect.php');

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
