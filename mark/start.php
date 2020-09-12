<?php
use Mark\App;
use ActiveRecord\ActiveDatabase;

require 'vendor/autoload.php';

$api = new App('http://0.0.0.0:3000');

$api->count = 4; // process count

function mactive() {
    $db_config = [
        'hostname' => 'localhost',
        'username' => 'root',
        'password' => 'hai2coders',
        'database' => 'stack',
        'dbdriver' => 'mysqli',
        'pconnect' => false,
        'db_debug' => true
    ];

    // Add Config and give it a name
    ActiveDatabase::addConfig('read', $db_config);
    $db = ActiveDatabase::get('read');
    return $db;
}

function p_query($sql) {
    // $database = $db == 'NULL' ? 'news' : $db;
    $db_connection = pg_connect('host=localhost dbname=stack user=postgres password=hai2coders');
    $query = pg_query($db_connection, $sql);
    if (!$query) {
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


$api->get('/ps', function ($requst) {
    $sql = 'SELECT "Body" FROM "Posts"  where "Id" =565';
    $result = p_query($sql);
    $array = pg_fetch_all($result);
    return json_encode($array);
});

$api->get('/pr', function ($requst) {
    $number = rand(1, 382745);
    $sql = 'SELECT * FROM "Posts" p INNER JOIN "PostsId" i ON i.post_id = p."Id"  where autoid =' . $number;
    $result = p_query($sql);
    $array = pg_fetch_all($result);
    return json_encode($array);
});

$api->get('/par', function ($requst) {
    $db_config = [
        'hostname' => 'localhost',
        'username' => 'postgres',
        'password' => 'hai2coders',
        'database' => 'stack',
        'dbdriver' => 'postgre',
        'pconnect' => false,
        'db_debug' => true
    ];

    // Add Config and give it a name
    ActiveDatabase::addConfig('read', $db_config);
    $db = ActiveDatabase::get('read');
    $number = rand(1, 382745);
    $db->join('PostsId', 'Posts.Id = PostsId.post_id', 'inner');
    $query = $db->get_where('Posts', ['autoid' => $number]);
    $row = $query->row();
    return json_encode($row);
});

$api->get('/mar', function ($requst) {
    $db_config = [
        'hostname' => 'localhost',
        'username' => 'root',
        'password' => 'hai2coders',
        'database' => 'stack',
        'dbdriver' => 'mysqli',
        'pconnect' => false,
        'db_debug' => true
    ];

    // Add Config and give it a name
    ActiveDatabase::addConfig('read', $db_config);
    $db = ActiveDatabase::get('read');
    $number = rand(1, 382745);
    $db->join('PostsId', 'Posts.Id = PostsId.post_id', 'inner');
    $query = $db->get_where('Posts', ['autoid' => $number]);
    $row = $query->row();
    return json_encode($row);
});

$api->get('/mr', function ($requst) {
    $number = rand(1, 382745);
    $sql = 'SELECT p.Body FROM Posts p INNER JOIN PostsId i ON i.post_id = p.Id  where autoid =' . $number;
    $result = query($sql);
    return json_encode($result->fetch_all(MYSQLI_ASSOC));
});

$api->get('/ms', function ($requst) {
    $db_config = [
        'hostname' => 'localhost',
        'username' => 'root',
        'password' => 'hai2coders',
        'database' => 'stack',
        'dbdriver' => 'mysqli',
        'pconnect' => false,
        'db_debug' => true
    ];

    // Add Config and give it a name
    ActiveDatabase::addConfig('read', $db_config);
    $db = ActiveDatabase::get('read');
    $number = rand(1, 382745);
    $query = $db->get_where('Posts', ['Id' => 565]);
    $row = $query->row();
    return json_encode($row->Body);
});

$api->get('/hello/{name}', function ($requst, $name) {
    return "Hello $name";
});

$api->post('/user/create', function ($requst) {
    return json_encode(['code' => 0, 'message' => 'ok']);
});

$api->start();