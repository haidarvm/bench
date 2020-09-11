<?php

namespace app\controller;

use support\Request;
use support\Db;


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
        $sql = 'SELECT p.Body FROM Posts p INNER JOIN PostsId i ON i.post_id = p.Id  where autoid =' . $number;
        $result = $this->query($sql);
        if ($result) {
            $array = array_column($result->fetch_all(MYSQLI_ASSOC), 'Body');
            $resultArray = array_map('strip_tags', $array);
            return json($resultArray);
        }
        return null;
    }

    public function test(Request $request) {
        $number = rand(1, 382745);
        $body = Db::table('Posts')
        ->join('PostsId', 'PostsId.post_id', '=', 'Posts.Id')
        ->where('autoid', $number)
        // ->get();
        ->value('Body');
        return json(strip_tags($body));
    }
}
