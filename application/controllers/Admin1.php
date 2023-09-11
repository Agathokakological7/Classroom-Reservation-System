<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
    $this->load->library('session');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');		
   // $this->load->model('Admin_model');
    $this->load->model('Aedr_model');
    $this->load->helper('download_helper');
   if ($this->session->userdata('id') != 1)
       redirect(base_url(), 'refresh');     
    }

    function index()
    {    
    	print_r($this->session->userdata('id'));
      echo "Hi";exit;

     }
     public function dashboard($each_rm_name='')
	{	
		$this->load->database();
		//print_r($this->session->userdata('user'));exit;
		if($this->session->userdata('user')){

		$current_date = @date('Y-m-d');
		$data['each_rm']=$each_rm_name;
		

		$this->db->distinct();
		$this->db->select('room_name');
		$this->db->from('academic_classroom_booking');
		$this->db->where('"'.$current_date.'" BETWEEN from_date AND to_date');
		$acadamic_booked = $this->db->get()->result_array();
        $acadamic_booked = count($acadamic_booked);

		$this->db->distinct();
		$this->db->select('allocated_room_name');
		$this->db->from('form');
		$this->db->where('("'.$current_date.'" BETWEEN f_date AND t_date) AND approval="approved"');
		$req_booked = $this->db->get()->result_array();
        $req_booked = count($req_booked);

		$this->db->select('allocated_room_name');
		$this->db->from('form');
		$this->db->where('approval !="approved"');
		$no_of_req = $this->db->get()->result_array();
        $data['no_of_req'] = count($no_of_req);
		
		$this->db->select('room_name');
		$this->db->from('room_info');
		$tot_rm = $this->db->get()->result_array();
      	$data['tot_rm'] = count($tot_rm);

		echo "<script>console.log('booked room	: " .$date['no_of_req']. "' );</script>";


        //total rooms
        
        //un booked
		$data['total_booked'] = $req_booked + $acadamic_booked;
        $un_booked = $data['tot_rm'] - $data['total_booked'] ;
        $data['un_booked'] = $un_booked;
		
		$this->load->model('Inserting_model');
		$data['time_per'] = $this->Inserting_model->time_percent();

		$this->load->helper('url');
		$this->load->view('Admin_1/Templates/style_script');
		$this->load->view('Admin_1/Templates/navbar');
		$this->load->view('Admin_1/Templates/side_bar');
		$this->load->view('Admin_1/dashboard1',$data);
		$this->load->view('Admin_1/Templates/java_script');
		}
		else{
			redirect('Login');

		}
		
	}


     public function import_room($param1='')
	{
		
		//////////  page data start /////////////////
		$sql="select * from class_room";

        $data['class_room_details']=$this->Aedr_model->get_result_sql($sql);

        $sql="select * from room_info";

        $data['hall_details']=$this->Aedr_model->get_result_sql($sql);

        $data['block_by_id']=$this->Aedr_model->get_row_by_id('block_name','block_name_id');

        $data['floor_by_id']=$this->Aedr_model->get_row_by_id('floor','floor_id');
        $data['room_type_by_id']=$this->Aedr_model->get_row_by_id('room_type','room_type_id');

		$this->load->helper('url');
		$this->load->view('Admin_1/Templates/style_script');
		$this->load->view('Admin_1/Templates/navbar');
		$this->load->view('Admin_1/Templates/side_bar');
		$this->load->view('Admin_1/import_class_room',$data);
		$this->load->view('Admin_1/Templates/java_script');
		
	}
	public function get_popup_data()
{
	$this->load->database();  
	$this->load->helper('url');
	$id = 13;
	$data['room_profiles'] = $this->db->get_where('form', array('id' => $id))->row();

	//print_r($data['room_profiles']);exit;

    $this->load->view('Admin_1/pop_up_room',$data);
}

////////////////////  Room Booking Start  ///////////////////////////////

 function book_room($param1='')
	{
		$this->load->database();  
	   	$this->load->model('Inserting_model');


	   	$data['room_types']=$this->Aedr_model->get_row_by_id('room_type','room_type_id');	

		//$data['room_type_by_id'] = $this->Inserting_model->room_type();
		$data['capacity'] = $this->Inserting_model->seating_capacity();

//		print_r($data['room_types']);exit;

		$this->load->helper('url');
		$this->load->view('Admin_1/Templates/style_script');
		$this->load->view('Admin_1/Templates/navbar');
		$this->load->view('Admin_1/Templates/side_bar');
		$this->load->view('Admin_1/book_room',$data);
		$this->load->view('Admin_1/Templates/java_script');

		///////// Insert the request ////////////


		if($param1!='')
		{
			echo "****************<br>";
			print_r($_POST);
			echo "<br>****************<br>";
			echo "Hi";exit;
				
	    }
	}

////////////////////  Room Booking End  ///////////////////////////////

	 function inserting_data(){
		print_r($_POST);exit;
        //this array is used to get fetch data from the view page. 

        /* 
		$this->load->helper('url');
		$date = date('Y-m-d');
		$name = $this->input->post('user');
	
		if ($name='faculty'){
			$person_name = $this->input->post('faculty_name');
			$person_id = $this->input->post('faculty_id');
		}
		else{
			$person_name = $this->input->post('Student_name');
			$person_id = $this->input->post('Student_id');
		};

		$events = $this->input->post('proposal');
		if ($events =="Others"){
			$events = $this->input->post('others_option');
		};
		

		$systems = $this->input->post('systems');
		if ($systems='YES'){
			$systems = $this->input->post('no_of_system');
		}
		else{
			$systems ="No";
		};
		$speaker = $this->input->post('speaker');
		if ($speaker=='YES'){
			$speaker = $this->input->post('no_of_speaker');
		}
		else{
			$speaker = "NO";
		};
		$from_date_time = $this->input->post('from_date_time');
		$f_dateTime = new DateTime($from_date_time);
		$f_date = $f_dateTime->format('Y-m-d');
		$f_time = $f_dateTime->format('H:i:s');
		//$xy = $this->input->post('times');
		$to_date_time = $this->input->post('to_date_time');
		$t_dateTime = new DateTime($to_date_time);
		$t_date = $t_dateTime->format('Y-m-d');
		$t_time = $t_dateTime->format('H:i:s');
		$hi = $this->input->post('Register');
	
        $data = array(  
                        'name'     => $person_name,
						'person_id'     => $person_id,
						'email'     => $this->input->post('email'),						
						'capacity'     => $this->input->post('capacity'),
						'room_type'     => $this->input->post('room_type'),
						'proposal'     => $this->input->post('proposal'),
						'f_date'     => $f_date,
						't_date'     => $t_date,
						'f_time'     => $f_time,
						't_time'     => $t_time,
						'projector'     => $this->input->post('projector'),
						'wifi'     => $this->input->post('wifi'),
						'systems'     => $systems,
						'speaker'     => $speaker,
						'approval'=> 'pending',
                        );   
        
						
		$this->load->model("Inserting_model");
		$this->Inserting_model->form_info($data);

        redirect('Dashboard/open_form');*/
	}

  }

?>