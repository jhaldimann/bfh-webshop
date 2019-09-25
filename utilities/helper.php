<?php
require_once ('connect.php');

function getProducts($cat) {
    $mysqli = connect();
    @$categorie =  $mysqli->real_escape_string($cat);

    if($categorie === "") {
        $query =   $sql = "SELECT * FROM products";
        return $mysqli->query($query);

    } else {
        $query = $sql = "SELECT * FROM products where category = '".$categorie."'"."OR gender ='".$categorie."'";
        return $mysqli->query($query);

    }
}
