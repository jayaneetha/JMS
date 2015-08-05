<?php

class User_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_pass($email) {
        $this->db->select('id, password');
        $this->db->from('user');
        $this->db->where('email_address', $email);
        $res = $this->db->get();
        $arr = $res->result();

        if ($res->num_rows() > 0) {
            return $arr[0];
        } else {
            return NULL;
        }
    }

    function loginLogSave($uid, $ipadd) {
        $data = array('user_id' => $uid, 'ip' => $ipadd);
        $this->db->insert('login_log', $data);
    }

    function loginLogRetriv() {
        $this->db->select('user_id,timestamp,IP');
        $this->db->from('login_log');
    }

    function saveUser($param) {
        $this->db->insert('user', $param);
    }

}

?>