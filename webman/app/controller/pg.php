<?php

namespace app\controller;

use support\Request;
use support\Db;


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
