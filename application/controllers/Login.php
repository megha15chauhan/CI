<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller {

	   function __construct() {
        parent::__construct();
        $this->load->model('User');
        $this->load->library('form_validation');
        
       }

        public function index()
        {
                //echo 'Hello World!';
            $this->form_validation->set_rules('dname', 'Name', 'required');
            $this->form_validation->set_rules('demail', 'Email', 'required'); 
            $this->form_validation->set_rules('dmobile', 'Mobile', 'required'); 
            $this->form_validation->set_rules('daddress', 'Address', 'required');
            if ($this->form_validation->run() == FALSE) {
            /*$this->session->set_flashdata('message_name', 'This is my message');*/

                        $this->load->view('login'); 
                    } 
                else { 
            $this->load->view('Success_form'); 
         }   
        	/*if ($this->input->method()=='post') {
        		$data=array('name' => $this->input->post('dname'),
        					'email' => $this->input->post('demail'),
        					'no' => $this->input->post('dmobile'),
        					'address' => $this->input->post('daddress')
        					 );
        		$this->User->get_users($data);
        		

        		
        	}else{
        		 $this->load->view('login');
        	}*/
               
        	

        }
        public function register()
        {
            if ($this->input->method()=='post') {

                $data=array('name' => $this->input->post('name'),
                            'email' => $this->input->post('email'),
                            'no' => $this->input->post('mobile'),
                            'address' => $this->input->post('address')
                             );
                 $user =$this->User->match_users($this->input->post('email'),$this->input->post('name'));
               
                if ($user!=1) {
                     $this->User->get_users($data); 
                    $response['status']= 1;
                    $response['message']= 'success';
                    
                            
                }else{
                   
                    $response['status']= 0;
                    $response['message']= 'Account Alredy exist';
                }
                echo json_encode($response);

            }
                
        }

        public function formPost()
    {
        $recaptchaResponse = trim($this->input->post('g-recaptcha-response'));
 
        $userIp=$this->input->ip_address();
     
        $secret = $this->config->item('google_secret');
   
        $url="https://www.google.com/recaptcha/api/siteverify?secret=".$secret."&response=".$recaptchaResponse."&remoteip=".$userIp;
 
        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_URL, $url); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        $output = curl_exec($ch); 
        curl_close($ch);      
         
        $status= json_decode($output, true);
 
        if ($status['success']) {
            print_r('Google Recaptcha Successful');
            exit;
        }else{
            $this->session->set_flashdata('flashError', 'Sorry Google Recaptcha Unsuccessful!!');
        }
 
        redirect('form', 'refresh');
    }

        public function view(){
            $id = $this->input->post('user_id');
             $single_user =$this->User->user_view($id);
             //print_r($single_user);
            
            if ($single_user) {
                     $this->User->user_view($id); 
                    $response['status']= 1;
                    $response['message']= 'success';
                    $response['data']= $single_user;
                    /*$response['Name']= $single_user[0]['name'];
                    $response['Email']= $single_user[0]['email'];*/
                            
                }else{
                   
                    $response['status']= 0;
                    $response['message']= 'data not found ';
                }
                echo json_encode($response);

        }

        public function delete(){
            $id = $this->input->post('delete_user');
            $delete_user =$this->User->delete_user($id);
            if ( $delete_user==1) {
                    $response['status']= 1;
                    $response['message']= 'User deleted successfully';
               
            }else{
 
                    $response['status']= 0;
                    $response['message']= 'error';
            }
            echo json_encode($response);

        }

}