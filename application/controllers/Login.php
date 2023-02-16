<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
	function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
		$this->load->helper('url');
        $this->load->model('Inserting_model');

    }


        public function index($invalid = ''){
            //load session library
            $this->load->library('session');
            
            //restrict users to go back to login if session has been set
            if($this->session->userdata('user')){
                redirect('Dashboard/dashboard');
            }
            else{
                if ($invalid == 1){
                    echo "<script>alert('Please login with valid Login account')</script>";

                }
                $this->load->view('Admin_1/Templates/style_script');
                $this->load->view('Admin_1/login');
                $this->load->view('Admin_1/Templates/java_script');            
            }
        }
     
        public function login(){
            //load session library
            $this->load->library('session');
     
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $password = md5($password);

            echo "<script>console.log('Debug Objects: " . $email. "' );</script>";

            echo "<script>console.log('Debug Objects: " . $password. "' );</script>";

     
            $data = $this->Inserting_model->login($email, $password);
     
            if($data){
                $this->session->set_userdata('user', $data);
                redirect('Dashboard/dashboard');
            }
            else{
                redirect('Login/index/1');


            } 
        }
     
        public function logout(){
            //load session library
            $this->load->library('session');
            $this->session->unset_userdata('user');
            redirect('/');
        }
     
    }