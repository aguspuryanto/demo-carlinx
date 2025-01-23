<?php
// $url = $_GET['url'];
if(isset($_GET['url'])) {
    $url = $_GET['url'];
    header("Content-Type: image/jpeg");
    echo file_get_contents($url);
}
?>