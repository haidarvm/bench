<?php
$servername = 'localhost';
$username = 'root';
$password = 'hai2coders';
$dbname = 'stack';

$conn = mysqli_connect($servername, $username, $password, $dbname);

if ($conn->connect_error) {
die('Connection failed: ' . $conn->connect_error);
}

function gen_text($file, $text) {
    $txt = $text;
    file_put_contents($file, $txt . PHP_EOL, FILE_APPEND);
}

$number = rand(1, 116193);
$sql = "SELECT p.Body FROM Posts p INNER JOIN PostsId i ON i.post_id = p.Id  where autoid =".$number;
$result =  $conn->query($sql);
$fetchall  = $result->fetch_all(MYSQLI_ASSOC);
$array = array_column($fetchall, 'Body');
$resultArray = array_map("strip_tags", $array);
$json = json_encode($resultArray);
echo $json;
