<?php

namespace app\controller;

use support\Request;
// use support\Db;
use ActiveRecord\ActiveDatabase;
use think\facade\Db;

class My {
    private function query($sql) {
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

    public function index(Request $request) {
        $number = rand(1, 382745);
        $sql = 'SELECT * FROM Posts p INNER JOIN PostsId i ON i.post_id = p.Id  where autoid =' . $number;
        $result = $this->query($sql);
        $array = $result->fetch_all(MYSQLI_ASSOC);
        return json($array);
    }

    public function think(Request $request) {
        $number = rand(1, 382745);
        $user = Db::table('Posts')
        ->join('PostsId', 'PostsId.post_id = Posts.Id')
        ->where('autoid', $number)->select();
        return json($user);
    }

    public function test(Request $request) {
        // $number = rand(1, 382745);
        // $body = Db::table('Posts')
        // ->join('PostsId', 'PostsId.post_id', '=', 'Posts.Id')
        // ->where('autoid', $number)
        // ->get();
        // // ->value('Body');
        // // return json(strip_tags($body));
        // return json($body);
    }

    public function active() {
        // Create Database configs
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
        //Use the named connection
        $number = rand(1, 382745);
        // $db->limit(1);
        $db->join('PostsId', 'Posts.Id = PostsId.post_id', 'inner');
        $query = $db->get_where('Posts', ['autoid' => $number]);
        $row = $query->row();
        // $json = json_encode($row);
        // $data = ['json' => $json];
        // $db->insert('json', $data);
        $this->gen_text('mtext.txt', json_encode($row));
        return json($row);
    }

    public function act() {
        // Create Database configs
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
        return json($row);
    }

    public function gen_text($file, $text) {
        $txt = $text;
        $full_path = public_path() . '/' . $file;
        file_put_contents($full_path, $txt . PHP_EOL, FILE_APPEND);
    }
}
