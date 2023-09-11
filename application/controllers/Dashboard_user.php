<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard_user extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->library('session');

		
	}
	public function index($each_rm_name='')
	{	
		$this->load->database();

		$this->load->model('Inserting_model');
	   	$this->load->model('Aedr_model');
		$this->load->helper('url');
		

	   	////////////////  preload page data //////////////////////
	   	$data['room_types']=$this->Aedr_model->get_row_by_id('room_type','room_type_id');	

	   	$data['search_data']=array();
		$data['search_result']=array();

		$data['class_room_details']=array();
		$data['hall_details']=array();

	   	//////////  page data start /////////////////


		

	

		///////// Insert the request ////////////


		if($each_rm_name!='')
		{

			/////////////// Date formatte converter //////////////////

			//print_r($_POST);exit;
			
			$mysql_converter = new DateTime($this->input->post('from_date_time'));
			$search_data['from_date']= $mysql_converter->format('Y-m-d H:i:s');

			$mysql_converter = new DateTime($this->input->post('to_date_time'));
			$search_data['to_date'] = $mysql_converter->format('Y-m-d H:i:s');
			$search_data['room_type']=$this->input->post('room_type');
			echo "<script>console.log('Anuj 11111' );</script>";		

		    $search_result=$this->room_search($search_data['from_date'],$search_data['to_date'],$search_data['room_type']);
			echo "<script>console.log('Anuj 2222' );</script>";		


		  //  print_r($search_result);exit;

		    $data['search_data']=$search_data;
			
		    $data['search_result']=$search_result;





		    if($search_data['room_type']==5)
		    		{
		     		    $sql="select * from class_room where status=1";
						 echo "<script>console.log('Anuj 22223' );</script>";		

		     		    $data['class_room_details']=$this->Aedr_model->get_result_sql_search_class_room();
						 echo "<script>console.log('Anuj 4444' );</script>";		

		    		}
		    else
		    {
		    	        $sql="select * from room_info where status=1";
		     		    $data['hall_details']=$this->Aedr_model->get_result_sql_search_room_info();
		    }

            


		   
				
	    }
		$data['room_typess']=$this->Inserting_model->room_type();	



		if($this->session->userdata('user')){
		$current_date = @date('Y-m-d');
		$data['each_rm']=$each_rm_name;
		echo "<script>console.log('select_room_type	: " . $each_rm_name. "' );</script>";		
			
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


		$user_info = $this->session->userdata('user');		
		$data['faculty_data'] = $this->db->get_where('user_account', array('email' => $user_info))->row();		
		//echo "<script>console.log('booked room	: " .$date['no_of_req']. "' );</script>";
        //total rooms

        //un booked
		$data['total_booked'] = $req_booked + $acadamic_booked;
        $un_booked = $data['tot_rm'] - $data['total_booked'] ;
        $data['un_booked'] = $un_booked;
		
		$this->load->model('Inserting_model');
		$data['time_per'] = $this->Inserting_model->time_percent($select_date);

		$this->load->helper('url');
		$this->load->view('user/Templates/style_script');
		$this->load->view('user/Templates/navbar');
		$this->load->view('user/Templates/side_bar');
		$this->load->view('user/dashboard',$data);
		$this->load->view('user/Templates/java_script');
		}
		else{
			redirect('Login');

		}
		
	}
	function room_search($date1='',$date2='',$room_type='')
	{

		$sql="SELECT * FROM booking WHERE room_type=$room_type and from_date >= '$date1' AND to_date <= '$date2'";
		echo "<script>console.log('".$date1.",".$date2.",".$room_type."' );</script>";		

		$result=$this->Aedr_model->get_result_sql_form($room_type,$date1,$date2);
		echo "<script>console.log('Anuj 1155511' );</script>";		

		//print_r($sql);exit;

		if(!empty($result))
		{
				$allotted_room=array();
			foreach ($result->result() as $rst) {
				echo "<script>console.log('Anuj 1156511' );</script>";		

				array_push($allotted_room,$rst->room_id);
			}
			echo "<script>console.log('Anuj srry	' );</script>";		

			return $allotted_room;
		}
		else
		{
			echo "<script>console.log('Anuj nune' );</script>";		

			return NULL;
		}
		

	}

public function method1($param1="")
    {
     
      echo $param1;



    }
		   
public function bulk_booking($param1='')
{
	
	//////////  page data start /////////////////
	$this->load->model('Aedr_model');


	$sql="select * from class_room";

	$data['class_room_details']=$this->Aedr_model->get_result_sql($sql);


	$sql="select * from room_info";

	$data['hall_details']=$this->Aedr_model->get_result_sql($sql);

	$data['block_by_id']=$this->Aedr_model->get_row_by_id('block_name','block_name_id');

	$data['floor_by_id']=$this->Aedr_model->get_row_by_id('floor','floor_id');
	$data['room_type_by_id']=$this->Aedr_model->get_row_by_id('room_type','room_type_id');


	//////////  page data end /////////////////

  /*  $class_room1=$data['class_room_details'][1];

   // print_r($class_room1['block_id']);exit;
	echo "<br>";
	echo "*********<br>";
  //  print_r($floor_by_id[$class_room1['floor_id']]['floor_name']);exit;*/


	$this->load->helper('url');
	$this->load->view('user/Templates/style_script');
	$this->load->view('user/Templates/navbar');
	$this->load->view('user/Templates/side_bar');
	$this->load->view('user/bulk_booking',$data);
	$this->load->view('user	/Templates/java_script');
	
}   


	
	public function open_form()
	{
		$this->load->database();  
	   	$this->load->model('Inserting_model');
		$data['room_type'] = $this->Inserting_model->room_type();
		$data['capacity'] = $this->Inserting_model->seating_capacity();


		$user_info = $this->session->userdata('user');		
		$data['faculty_data'] = $this->db->get_where('user_account', array('email' => $user_info))->row();

		$this->load->helper('url');
		$this->load->view('user/Templates/style_script');
		$this->load->view('user/Templates/navbar');
		$this->load->view('user/Templates/side_bar');
		$this->load->view('user/form',$data);
		$this->load->view('user/Templates/java_script');
				
	}
	public function open_table($param1='')
	{

		$this->load->database();  
		$data['room_profile'] = $this->db->get_where('form', array('id' => $param1))->row();

	   	$this->load->model('Inserting_model');  
	   	$data['h'] = $this->Inserting_model->select();
		$this->load->helper('url');
		$this->load->view('user/Templates/style_script');
		$this->load->view('user/Templates/navbar');
		$this->load->view('user/Templates/side_bar');
		$this->load->view('user/table',$data);
		$this->load->view('user/Templates/java_script');
		
	}

	public function open_total_table($param1='')
	{

		$this->load->database();  
		$data['room_profile'] = $this->db->get_where('form', array('id' => $param1))->row();

	   	$this->load->model('Inserting_model');  
	   	$data['h'] = $this->Inserting_model->Total_room();
		$this->load->helper('url');
		$this->load->view('user/Templates/style_script');
		$this->load->view('user/Templates/navbar');
		$this->load->view('user/Templates/side_bar');
		$this->load->view('user/total_table',$data);
		$this->load->view('user/Templates/java_script');
		
	}


	public function get_popup_data()
{
	$this->load->database();  
	$this->load->helper('url');
	$id = $this->input->post("id");
	$data['room_profiles'] = $this->db->get_where('form', array('id' => $id))->row();

    $this->load->view('user/pop_up_table',$data);
}
	public function admin_allocation()
	{

		$this->load->database();  
		$this->load->helper('url');
		$this->load->model('Inserting_model'); 
		$data['room_type'] = $this->Inserting_model->room_type();

		$select_room_type = $this->input->post('select_room_type');
		$checking_availability = $this->input->post('availability');

		if($select_room_type == ''){
			$select_room_type = 'All';
		}
		if($checking_availability == ''){
			$checking_availability = 'Allotement';
		}
		echo "<script>console.log('select_room_type	: " . $select_room_type. "' );</script>";		

		$data['available_venue'] = $this->Inserting_model->get_available_admin_allocation();
		echo "<script>console.log('checking_availability: " . $checking_availability. "' );</script>";	
		$data['rm_availability'] = $checking_availability;
		$data['select_rm_type'] = $select_room_type;

		
	
		if ($select_room_type == '' or $select_room_type == 'All'){
			$this->db->select('*');
			$this->db->from('form');
			$this->db->where('approval != "approved"');
			$data['allotment']= $this->db->get();	
		}
		elseif ($select_room_type != '' or $select_room_type != 'All'){
			$this->db->select('*');
			$this->db->from('form');
			$this->db->where('approval != "approved" AND room_type="'. $select_room_type. '"');
			$data['allotment']= $this->db->get();	
		}
//and ($checking_availability == 'Allotement' or $checking_availability=='')


		$this->load->view('user/Templates/style_script');
		$this->load->view('user/Templates/navbar');
		$this->load->view('user/Templates/side_bar');
		$this->load->view('user/admin_allocation',$data);
		$this->load->view('user/Templates/java_script');
		
		
	}
	public function faculty_request_allocate_form($para=''){
		$this->load->database();  
		$this->load->helper('url');
		$this->load->model('Inserting_model'); 
		$data['room_type'] = $this->Inserting_model->room_type();
		$data['seating_capacity'] = $this->Inserting_model->seating_capacity();

		$data['allocate_detail'] = $this->db->get_where('form', array('id' => $para))->row();
		
		$data['avail_room_name'] = $this->Inserting_model->avail_request_room_name($para);
		//echo "<script>console.log('snfkjbjkdjkdtar: " . $para. "' );</script>";

		$this->load->view('user/Templates/style_script');
		$this->load->view('user/Templates/navbar');
		$this->load->view('user/Templates/side_bar');
		$this->load->view('user/allocate_faculty_request',$data);
		$this->load->view('user/Templates/java_script');
	}

	public function add_room($param1='')
	{
		$this->load->database();  
	   	$this->load->model('Inserting_model'); 

	   	$data['info'] = $this->Inserting_model->get_room_info();
		$data['room_data'] = $this->db->get_where('room_info', array('id' => $param1))->row();
	
		$this->db->select('block_name.*, room_type.*,floor.*,seating_capacity.*');
        $this->db->from('block_name');
        $this->db->join('room_type', 'room_type.room_type_id = block_name.block_name_id','left');
        $this->db->join('floor', 'floor.floor_id = block_name.block_name_id','left');
        $this->db->join('seating_capacity', 'seating_capacity.seating_capacity_id = block_name.block_name_id','right');

        $query = $this->db->get();

        foreach ($query->result() as $row){ 

            if ($data['room_data']->block_name == $row->block_name_id){
                $data['room_data']->block_name = $row->block_name;
          	};	

            if ($data['room_data']->room_type == $row->room_type_id){
                $data['room_data']->room_type = $row->room_type_name;
            };

            if ($data['room_data']->floor == $row->floor_id){
                $data['room_data']->floor= $row->floor_name;
            };

            if ($data['room_data']->seating_capacity == $row->seating_capacity_id){
                $data['room_data']->seating_capacity = $row->capacity;
            };
        };


		//echo "<script>console.log('Debug Objects: " .$data['info']->seating_capacity. "' );</script>";
		//Calling Model to Insert data
		$data['room_type'] = $this->Inserting_model->room_type_name();
		$data['block_name'] = $this->Inserting_model->block_name();	
		$data['floor_name'] = $this->Inserting_model->floor_name();
		$data['seating_capacity'] = $this->Inserting_model->seating_capacity();

		// View
		$this->load->helper('url');
		$this->load->view('user/Templates/style_script');
		$this->load->view('user/Templates/navbar');
		$this->load->view('user/Templates/side_bar');
		$this->load->view('user/add_room',$data);
		$this->load->view('user/Templates/java_script');
		
	}

	public function class_room_booking($para="")
	{	
		$this->load->database();  
		
	   	$this->load->model('Inserting_model');  
	   	$data['a_s'] = $this->Inserting_model->get_academic_schedule();
		$this->load->helper('url');
		$data['room_data'] = $this->db->get_where('room_info', array('id' => $para))->row();


		//echo "<script>console.log('Debug Objects: " . $para. "' );</script>";

		//Calling Model to Insert data
		$data['class_type'] = $this->Inserting_model->room_type_name();
		$data['dept'] = $this->Inserting_model->dept_name();	
		$data['year'] = $this->Inserting_model->year_name();

		$this->load->view('user/Templates/style_script');
		$this->load->view('user/Templates/navbar');
		$this->load->view('user/Templates/side_bar');
		$this->load->view('user/class_room_booking',$data);
		$this->load->view('user/Templates/java_script');
		
	}
	public function available_class_room(){
		$this->load->helper('url');

		
		$this->load->database();  
	   	$this->load->model('Inserting_model'); 
		$date = date('Y-m-d');
		$data['available_slots'] = $this->Inserting_model->get_available_slots($date);
		//echo "<script>console.log('Debug Objects: " . $dd. "' );</script>";

		$this->load->view('user/Templates/style_script');
		$this->load->view('user/Templates/navbar');
		$this->load->view('user/Templates/side_bar');
		$this->load->view('user/available_class_room',$data);
		$this->load->view('user/Templates/java_script');
	}


	public function inserting_data(){
        //this array is used to get fetch data from the view page.  
		$this->load->helper('url');
		$date = date('Y-m-d');
		$name = $this->input->post('user');
		echo "<script>console.log('Debug Objectsg:' );</script>";
		
		$user_info = $this->session->userdata('user');		
		$faculty_data = $this->db->get_where('user_account', array('email' => $user_info))->row();

		$person_name = $faculty_data->faculty_name;
		$person_id = $faculty_data->faculty_id;
		$email = $faculty_data->email;


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
		echo "<script>console.log('Debug Objects gg:".$person_name."' );</script>";

        $data = array(  
                        'name'     => $person_name,
						'person_id'     => $person_id,
						'email'     => $email,						
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
		echo "<script>console.log('Debu222222222222222222g Objects:' );</script>";

        redirect('Dashboard_user/open_form');
	}

	//////////////////////////////////////////////////////////////////
	public function users_pg_request(){
        //this array is used to get fetch data from the view page.  
		$this->load->helper('url');
		$date = date('Y-m-d');
	
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

        $data = array(  
                        'name'     => $this->input->post('faculty_name'),
						'person_id'     => $this->input->post('faculty_id'),
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
        
		/* echo "<script>console.log('Debug Objects: " . $data['name']. "' );</script>";
		echo "<script>console.log('Debug Objects: " . $data['person_id']. "' );</script>";
		echo "<script>console.log('Debug Objects: " . $data['email']. "' );</script>";
		echo "<script>console.log('Debug Objects: " . $data['capacity']. "' );</script>";
		echo "<script>console.log('Debug Objects: " . $data['room_type']. "' );</script>";
		echo "<script>console.log('Debug Objects: " . $data['proposal']. "' );</script>";
		echo "<script>console.log('Debug Objects: " . $data['f_date']. "' );</script>";
		echo "<script>console.log('Debug Objects: " . $data['t_date']. "' );</script>";
		echo "<script>console.log('Debug Objects: " . $data['f_time']. "' );</script>";
		echo "<script>console.log('Debug Objects: " . $data['t_time']. "' );</script>";
		echo "<script>console.log('Debug Objects: " . $data['projector']. "' );</script>";
		echo "<script>console.log('Debug Objects: " . $data['wifi']. "' );</script>";
		echo "<script>console.log('Debug Objects: " . $data['systems']. "' );</script>";
		echo "<script>console.log('Debug Objects: " . $data['speaker']. "' );</script>";
		echo "<script>console.log('Debug Objects: " . $data['approval']. "' );</script>";
		*/
				
		$this->load->model("Inserting_model");
		$this->Inserting_model->form_info($data);
		echo "<script>console.log('Debu222222222222222222g Objects:' );</script>";

        redirect('Dashboard_user/index');
	}
	//////////////////////////////////////////////////////////////////


	public function deletes($para=""){
		$this->load->helper('url');
		$this->load->database();
		$this->db->where('id', $para);
       	$this->db->delete('form');
       	redirect('open_table');
	}

	public function room_type_data($para=""){ 
		$this->load->helper('url');

		$systems = $this->input->post('systems');

		if ($systems=='YES'){
			$systems = $this->input->post('no_of_system');
		}
		else{
			$systems = "NO";
		}
		
		$speaker = $this->input->post('speaker');
		if ($speaker=='YES'){
			$speaker = $this->input->post('no_of_speaker');
		}
		else{
			$speaker = "NO";
		};

        $room_data = array(
                        'block_name'     => $this->input->post('block_name'),
						'floor'     => $this->input->post('floor'),						
						'seating_capacity'     => $this->input->post('seating_capacity'),
						'room_name'     => $this->input->post('room_name'),
						'room_type'     => $this->input->post('room_type'),
						'projector'     => $this->input->post('projector'),
						'wifi'     => $this->input->post('wifi'),
						'systems'     => $systems,
						'speaker'     => $speaker,
                        );   
		//echo "<script>console.log('Debug Objects1: " . $room_data['room_type']. "' );</script>";
		$this->load->model("Inserting_model");
		$this->Inserting_model->room_info($para,$room_data);
		
						
        redirect('Dashboard_user/add_room');
	}

	public function room_type_deletes($para=""){
		$this->load->helper('url');
		$this->load->database();
		$this->db->where('id', $para);
       	$this->db->delete('room_info');
       	redirect('Dashboard_user/add_room');
	}

	public function allocated_room_form($para=""){
        //this array is used to get fetch data from the view page. 
		//echo "<script>console.log('Debug Objects: " . $para. "' );</script>";
	
		$this->load->helper('url');
		$from_date_time = $this->input->post('from_date_time');
		$f_dateTime = new DateTime($from_date_time);
		$f_date = $f_dateTime->format('Y-m-d');
		$f_time = $f_dateTime->format('H:i:s');
		//$xy = $this->input->post('times');
		$to_date_time = $this->input->post('to_date_time');
		$t_dateTime = new DateTime($to_date_time);
		$t_date = $t_dateTime->format('Y-m-d');
		$t_time = $t_dateTime->format('H:i:s');

		$alloted_room_data = array(
			'dept'     => $this->input->post('department'),
			'year'     => $this->input->post('year'),						
			'room_name'     => $this->input->post('room_name'),
			'from_date'     => $f_date,
			'to_date'     => $t_date,
			'from_time'     => $f_time,
			'to_time'     => $t_time,
			);  
		
		$this->load->model("Inserting_model");
		//echo "<script>console.log('Debug Objects: " . $para. "' );</script>";
		$this->Inserting_model->allocated_room_insert($alloted_room_data,$para);
		
		
		redirect('Dashboard_user/class_room_booking');
		
	}
	
	public function allocate_faculty_request($para=''){

		
		$this->load->helper('url');
		$this->load->model('Inserting_model'); 
		$allocates = $this->input->post('allocate');
		$edit = $this->input->post('edit');

		if ($allocates == 'Allocate'){
		$this->Inserting_model->allocate_faculty_request($para);
		}
		redirect('Dashboard_user/admin_allocation');

	}

	public function select_search(){
		
		$select_room_type = $this->input->post('availability');
		echo "<script>console.log('snfkjbjkdjkdtar: " . $select_room_type. "' );</script>";
	}

	public function edit_faculty_req($id=''){
		$this->load->database();
		$this->load->model('Inserting_model'); 
		$this->load->helper('url');
		$this->Inserting_model->edit_faculty_request($id);

		redirect('Dashboard_user/faculty_request_allocate_form/'.$id.'');

	}

}