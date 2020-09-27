<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Postgres extends CI_Controller {
    public $postgres;

    public function __construct() {
        parent::__construct();
        $this->postgres = $this->load->database('postgres', true);
    }

    public function index() {
        $number = rand(1, 382745);
        $this->postgres->join('postsid as i', 'i.post_id = p.Id', 'inner');
        $query = $this->postgres->get_where('posts as p', ['autoid' => $number]);
        $result = $query->row();
        header('Content-Type: application/json');
        echo json_encode($result);
    }

    public function test() {
        $this->db->limit(3);
        // $this->db->select('*, , md5(rand()) as md5');
        $query = $this->postgres->get('Posts');
        echo json_encode($query->result());
    }
}
