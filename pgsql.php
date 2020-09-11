<?php
$db_connection = pg_connect("host=localhost dbname=stack user=postgres password=hai2coders");
// $sql = 'SELECT body FROM posts WHERE  "id" =146013';
// $sqll = 'SELECT * FROM "Posts" LIMIT 10 ';
// $sqlr = 'SELECT body FROM posts ORDER BY random() LIMIT 5';
$number = rand(1, 382745);
$sqlpr = "SELECT p.\"Body\" FROM \"Posts\" p INNER JOIN \"PostsId\" i ON i.post_id = p.\"Id\"  where autoid =".$number;
// echo $sqlpr;
// $sqlpr = 'SELECT body FROM posts WHERE id='.$number;
$result = pg_query($db_connection, $sqlpr);

function gen_text($file, $text) {
    $txt = $text;
    file_put_contents($file, $txt . PHP_EOL, FILE_APPEND);
}
$fetchall = pg_fetch_all($result);
// print_r($fetchall);
// $fetcharray = pg_fetch_array($result);
$array = array_column($fetchall, 'Body');
// print_r($array);
$resultArray = array_map("strip_tags", $array);
$json = json_encode($resultArray);
//gen_text('ptext.txt', $json);
echo $json;	
// echo json_encode($fetcharray);
