<?php
use Mark\App;

require 'vendor/autoload.php';

$api = new App('http://0.0.0.0:3000');

$api->count = 4; // process count


function p_query($sql) {
    // $database = $db == 'NULL' ? 'news' : $db;
    $db_connection = pg_connect('host=localhost dbname=stack user=postgres password=hai2coders');
    $query = pg_query($db_connection, $sql);
    if(!$query) {
        echo "An error occurred.\n";
        return false;
    }
    return $query ;
}

function query($sql) {
    $servername = 'localhost';
    $username = 'root';
    $password = 'hai2coders';
    $dbname = 'stack';
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }
    return $conn->query($sql);
}


$api->any('/', function ($requst) {
    return 'Hello haidar';
});

$api->get('/pes', function ($requst) {
    $sql = 'SELECT body FROM posts where "id" =45';
    $result = p_query($sql);
    $json = json_encode(pg_fetch_all($result));
    return $json;
});

$api->get('/ps', function ($requst) {
    $number = rand(1, 116193);
    $sql = 'SELECT body FROM posts_clean where id ='.$number;
    $sqlr = 'SELECT body FROM posts_clean ORDER BY random() LIMIT 5';
    $result = p_query($sql);
    if ($result) {
        $array = array_column(pg_fetch_all($result), 'body');
        $resultArray = array_map('strip_tags', $array);
        $json = json_encode($resultArray);
        return $json;
    }
    return null;
});

$api->get('/pr', function ($requst) {
    $number = rand(1, 382745);
    $sql = "SELECT p.\"Body\" FROM \"Posts\" p INNER JOIN \"PostsId\" i ON i.post_id = p.\"Id\"  where autoid =".$number;
    $result = p_query($sql);
    if ($result) {
        $array = array_column(pg_fetch_all($result), 'Body');
        $resultArray = array_map('strip_tags', $array);
        $json = json_encode($resultArray);
        return $json;
    }
    return null;
});

$api->get('/mr', function ($requst) {
    $number = rand(1, 382745);
    $sql = "SELECT p.Body FROM Posts p INNER JOIN PostsId i ON i.post_id = p.Id  where autoid =".$number;
    $result = query($sql);
    if ($result) {
        $array = array_column($result->fetch_all(MYSQLI_ASSOC), 'Body');
        $resultArray = array_map('strip_tags', $array);
        $json = json_encode($resultArray);
        return $json;
    }
    return null;
});

$api->get('/hello/{name}', function ($requst, $name) {
    return "Hello $name";
});

$api->post('/user/create', function ($requst) {
    return json_encode(['code'=>0 ,'message' => 'ok']);
});

$api->start();