<?php

class User extends CI_Model {
	       function __construct() {
	       	       parent::__construct();
                   $this->load->database();
              }
	
			function get_users($data)
			  {
			    $userval =$this->db->insert('user', $data);
			    if ($userval > 0) {
			    	return 1;
			    }else{
			    	return 0;
			    }
			  }
          

            function match_users($email, $name)
			  {
			  	$this->db->where('email' , $email);
			  	$this->db->where('name' , $name);
			  	
			  	$var=$this->db->get('user'); 

			  	  return $var->num_rows();

			  }

			  function user_view($id)
			  {
			  	$this->db->where('user.id' , $id);
			  	//$this->db->select('user.name,user.email,detail.blood_group');
			  	$this->db->select('*');
			  	$this->db->from('user');
			  	$this->db->join('detail','detail.user_id=user.id');
			  	$var=$this->db->get();	
			     return $var->result_array();
			  }

			  function delete_user($id)
			  {
			  	$this->db->where('id' , $id);
			  	$this->db->from('user');
			  	//$this->db->join('detail','detail.user_id=user.id');
			  	$delete=$this->db->delete('user');
			  	if ($delete) {
               $this->db->where('user_id' , $id);
			  	$this->db->from('detail');
			  	//$this->db->join('detail','detail.user_id=user.id');
			  	$delete=$this->db->delete('detail');

			  		return 1;
			  	}
			  	//$var=$this->db->get();	
			     //return $var->result_array();
			  }
			}
           

?>