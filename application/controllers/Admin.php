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
	$this->load->helper('url');
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
	$id = $this->input->post('id');
	$data['id']=$id;
	$data['room_profiles'] = $this->db->get_where('form', array('id' => $id))->row();

	//print_r($data['room_profiles']);exit;

    $this->load->view('Admin_1/pop_up_form',$data);
}

////////////////////  Room Booking Start  ///////////////////////////////

 function book_room($param1='')
	{
		$this->load->database();  
	   	$this->load->model('Inserting_model');


	   	////////////////  preload page data //////////////////////
	   	$data['room_types']=$this->Aedr_model->get_row_by_id('room_type','room_type_id');	
	   	$data['search_data']=array();
		$data['search_result']=array();

		$data['class_room_details']=array();
		$data['hall_details']=array();

	   	//////////  page data start /////////////////
	

		

	

		///////// Insert the request ////////////


		if($param1!='')
		{

			/////////////// Date formatte converter //////////////////

			//print_r($_POST);exit;
			
			$mysql_converter = new DateTime($this->input->post('from_date_time'));
			$search_data['from_date']= $mysql_converter->format('Y-m-d H:i:s');

			$mysql_converter = new DateTime($this->input->post('to_date_time'));
			$search_data['to_date'] = $mysql_converter->format('Y-m-d H:i:s');
			$search_data['room_type']=$this->input->post('room_type');

		    $search_result=$this->room_search($search_data['from_date'],$search_data['to_date'],$search_data['room_type']);


		  //  print_r($search_result);exit;

		    $data['search_data']=$search_data;
		    $data['search_result']=$search_result;





		    if($search_data['room_type']==5)
		    		{
		     		    $sql="select * from class_room where status=1";
		     		    $data['class_room_details']=$this->Aedr_model->get_result_sql($sql);
		    		}
		    else
		    {
		    	        $sql="select * from room_info where status=1";
		     		    $data['hall_details']=$this->Aedr_model->get_result_sql($sql);
		    }

            


		   
				
	    }

		$this->load->view('Admin_1/Templates/style_script');
		$this->load->view('Admin_1/Templates/navbar');
		$this->load->view('Admin_1/Templates/side_bar');
		$this->load->view('Admin_1/book_room1',$data);
		$this->load->view('Admin_1/Templates/java_script');
	    
	}





///////////////////////////// Room Search Start  ////////////////////////

	function room_search($date1='',$date2='',$room_type='')
	{
		$sql="SELECT * FROM booking WHERE room_type=$room_type and from_date >= '$date1' AND to_date <= '$date2'";
		$result=$this->Aedr_model->get_result_sql($sql);

		//print_r($sql);exit;

		if(!empty($result))
		{
				$allotted_room=array();
			foreach ($result as $rst) {
				array_push($allotted_room,$rst['room_id']);
			}
			return $allotted_room;
		}
		else
		{
			return NULL;
		}
		

	}
///////////////////////////// Room Search END  ////////////////////////

  }

?>