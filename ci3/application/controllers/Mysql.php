<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mysql extends CI_Controller {
    public function index() {
        $number = rand(1, 382745);
        $this->db->select('Body');
        $this->db->join('PostsId as i', 'i.post_id = p.Id', 'inner');
        $query = $this->db->get_where('Posts as p', ['autoid' => $number]);
        $result = $query->result_array();
        $array = array_column($result, 'Body');
        // print_r($array);
        $resultArray = array_map('strip_tags', $array);
        echo json_encode($resultArray);
    }

    public function test() {
        $this->db->limit(3);
        $this->db->select('*, , md5(rand()) as md5');
        $query = $this->db->get('posts');
        echo json_encode($query->result());
    }
}
