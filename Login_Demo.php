<?php
$post = $_POST;
foreach($post as $key => $value){
    $post[$key] = trim($value);
}
$password = md5($post["password"]);
$username = $post["username"];

$query = "SELECT `username` FROM `user` WHERE `password` = '$password' AND `username` = '$username'";

$userInfo = $DB->getRow($query); 

if (!empty($userInfo)) {
include "index.html";
}
?>
