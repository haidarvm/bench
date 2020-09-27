<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mysql extends CI_Controller {
    public function index() {
        $number = rand(1, 382745);
        $this->db->join('PostsId as i', 'i.post_id = p.Id', 'inner');
        $query = $this->db->get_where('Posts as p', ['autoid' => $number]);
        $result = $query->row();
        header('Content-Type: application/json');
        echo json_encode($result);
    }

    public function test() {
        $this->db->limit(3);
        $this->db->select('*, , md5(rand()) as md5');
        $query = $this->db->get('posts');
        echo json_encode($query->result());
    }
}
