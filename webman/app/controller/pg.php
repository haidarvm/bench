<?php

namespace app\controller;

use support\Request;
use support\Db;
use ActiveRecord\ActiveDatabase;


class Pg {
    private $pquery;

    public function __construct() {
        // $this->pquery = $this->p_query()
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

    public function active() {
        // Create Database configs
        $db_config = [
            'dsn'	=> '',
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
        $row = $query->row_array();
        return json($row['Body']);
    }

    public function index(Request $request) {
        $number = rand(1, 382745);
        $sql = 'SELECT p."Body" FROM "Posts" p INNER JOIN "PostsId" i ON i.post_id = p."Id"  where autoid =' . $number;
        $result = $this->p_query($sql);
        if ($result) {
            $array = array_column(pg_fetch_all($result), 'Body');
            $resultArray = array_map('strip_tags', $array);
            $json = json($resultArray);
            return $json;
        }
        return null;
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
