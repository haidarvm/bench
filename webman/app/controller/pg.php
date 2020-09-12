<?php

namespace app\controller;

use support\Request;
// use support\Db;
use ActiveRecord\ActiveDatabase;
use think\facade\Db;

class Pg {
    private $pquery;

    public function __construct() {
        // $this->pquery = $this->p_query()
    }


    public function index(Request $request) {
        $number = rand(1, 382745);
        $sql = 'SELECT * FROM "Posts" p INNER JOIN "PostsId" i ON i.post_id = p."Id"  where autoid =' . $number;
        $result = $this->p_query($sql);
        $result = pg_fetch_all($result);
        return json($result);
    }

    
    private function p_query($sql) {
        // $database = $db == 'NULL' ? 'news' : $db;
        $db_connection = pg_connect('host=localhost dbname=stack user=postgres password=hai2coders');
        $query = pg_query($db_connection, $sql);
        if (!$query) {
            echo "An error occurred.\n";
            return false;
        }
        return $query ;
    }


    public function think(Request $request) {
        $number = rand(1, 1000);
        // $post = Db::table('Posts')->where('Id', '<', 3)->find();
        $post = Db::table('news')
        // ->join('PostsId', 'PostsId.post_id = Posts.Id')
        ->where('id', $number)->select();
        return json($post);
    }

    public function active() {
        // Create Database configs
        $db_config = [
            'dsn' => '',
            'hostname' => 'localhost',
            'username' => 'postgres',
            'password' => 'hai2coders',
            'database' => 'stack',
            'dbdriver' => 'postgre',
            'pconnect' => false,
            'db_debug' => true
        ];

        // Add Config and give it a name
        ActiveDatabase::addConfig('pg', $db_config);
        $db = ActiveDatabase::get('pg');
        //Use the named connection
        $number = rand(1, 382745);
        // $db->limit(1);
        $db->join('PostsId', 'Posts.Id = PostsId.post_id', 'inner');
        $query = $db->get_where('Posts', ['autoid' => $number]);
        $row = $query->row();
        // $this->gen_text('ptext.txt', json_encode($row));
        return json($row);
    }

    public function gen_text($file, $text) {
        $txt = $text;
        $full_path = public_path() . '/' . $file;
        file_put_contents($full_path, $txt . PHP_EOL, FILE_APPEND);
    }

    public function simple(Request $request) {
        $users = Db::table('Posts')->limit(1)->get();
        return json($users);
    }

    public function json(Request $request) {
        $hai = 'Hello haidar best';
        return json($hai);
    }
}
