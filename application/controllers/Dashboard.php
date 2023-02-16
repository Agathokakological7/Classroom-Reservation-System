<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
class Dashboard extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->library('session');

		
	}
	public function index(){
		$this->load->helper('url');
		$this->load->database();
		$this->load->model('Inserting_model');
		$data['room_type'] = $this->Inserting_model->room_type();
		$data['capacity'] = $this->Inserting_model->seating_capacity();

		$this->load->view('users\request_form',$data);

	}
	public function dashboard($each_rm_name='')
	{	
		$this->load->database();
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
		$this->load->view('Admin_1/dashboard',$data);
		$this->load->view('Admin_1/Templates/java_script');
		}
		else{
			redirect('Login');

		}
		
	}

public function method1($param1="")
    {
     
      echo $param1;



    }
	
	public function open_form()
	{
		$this->load->database();  
	   	$this->load->model('Inserting_model');
		$data['room_type'] = $this->Inserting_model->room_type();
		$data['capacity'] = $this->Inserting_model->seating_capacity();

		$this->load->helper('url');
		$this->load->view('Admin_1/Templates/style_script');
		$this->load->view('Admin_1/Templates/navbar');
		$this->load->view('Admin_1/Templates/side_bar');
		$this->load->view('Admin_1/form',$data);
		$this->load->view('Admin_1/Templates/java_script');
				
	}
	public function open_table($param1='')
	{

		$this->load->database();  
		$data['room_profile'] = $this->db->get_where('form', array('id' => $param1))->row();

	   	$this->load->model('Inserting_model');  
	   	$data['h'] = $this->Inserting_model->select();
		$this->load->helper('url');
		$this->load->view('Admin_1/Templates/style_script');
		$this->load->view('Admin_1/Templates/navbar');
		$this->load->view('Admin_1/Templates/side_bar');
		$this->load->view('Admin_1/table',$data);
		$this->load->view('Admin_1/Templates/java_script');
		
	}
	public function get_popup_data()
{
	$this->load->database();  
	$this->load->helper('url');
	$id = $this->input->post("id");
	$data['room_profiles'] = $this->db->get_where('form', array('id' => $id))->row();

    $this->load->view('Admin_1/pop_up_table',$data);
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


		$this->load->view('Admin_1/Templates/style_script');
		$this->load->view('Admin_1/Templates/navbar');
		$this->load->view('Admin_1/Templates/side_bar');
		$this->load->view('Admin_1/admin_allocation',$data);
		$this->load->view('Admin_1/Templates/java_script');
		
		
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

		$this->load->view('Admin_1/Templates/style_script');
		$this->load->view('Admin_1/Templates/navbar');
		$this->load->view('Admin_1/Templates/side_bar');
		$this->load->view('Admin_1/allocate_faculty_request',$data);
		$this->load->view('Admin_1/Templates/java_script');
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
		$this->load->view('Admin_1/Templates/style_script');
		$this->load->view('Admin_1/Templates/navbar');
		$this->load->view('Admin_1/Templates/side_bar');
		$this->load->view('Admin_1/add_room',$data);
		$this->load->view('Admin_1/Templates/java_script');
		
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

		$this->load->view('Admin_1/Templates/style_script');
		$this->load->view('Admin_1/Templates/navbar');
		$this->load->view('Admin_1/Templates/side_bar');
		$this->load->view('Admin_1/class_room_booking',$data);
		$this->load->view('Admin_1/Templates/java_script');
		
	}
	public function available_class_room(){
		$this->load->helper('url');

		
		$this->load->database();  
	   	$this->load->model('Inserting_model'); 
		$date = date('Y-m-d');
		$data['available_slots'] = $this->Inserting_model->get_available_slots($date);
		//echo "<script>console.log('Debug Objects: " . $dd. "' );</script>";

		$this->load->view('Admin_1/Templates/style_script');
		$this->load->view('Admin_1/Templates/navbar');
		$this->load->view('Admin_1/Templates/side_bar');
		$this->load->view('Admin_1/available_class_room',$data);
		$this->load->view('Admin_1/Templates/java_script');
	}


	public function inserting_data(){
        //this array is used to get fetch data from the view page.  
		$this->load->helper('url');
		$date = date('Y-m-d');
		$name = $this->input->post('user');
		echo "<script>console.log('Debug Objects:' );</script>";

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
		echo "<script>console.log('Debug Objects gg:' );</script>";

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
        
		echo "<script>console.log('Debug Objects: " . $data['f_date']. "' );</script>";
				
		$this->load->model("Inserting_model");
		$this->Inserting_model->form_info($data);
		echo "<script>console.log('Debu222222222222222222g Objects:' );</script>";

        redirect('Dashboard/open_form');
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
        
		echo "<script>console.log('Debug Objects: " . $data['name']. "' );</script>";
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
		
				
		$this->load->model("Inserting_model");
		$this->Inserting_model->form_info($data);
		echo "<script>console.log('Debu222222222222222222g Objects:' );</script>";

        redirect('Dashboard/index');
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
		
						
        redirect('Dashboard/add_room');
	}

	public function room_type_deletes($para=""){
		$this->load->helper('url');
		$this->load->database();
		$this->db->where('id', $para);
       	$this->db->delete('room_info');
       	redirect('Dashboard/add_room');
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
		
		
		redirect('Dashboard/class_room_booking');
		
	}
	
	public function allocate_faculty_request($para=''){

		
		$this->load->helper('url');
		$this->load->model('Inserting_model'); 
		$allocates = $this->input->post('allocate');
		$edit = $this->input->post('edit');

		if ($allocates == 'Allocate'){
		$this->Inserting_model->allocate_faculty_request($para);
		}
		redirect('Dashboard/admin_allocation');

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

		redirect('Dashboard/faculty_request_allocate_form/'.$id.'');

	}


	// public function send_email(){
	// 	$this->load->helper('url');
	// 	echo "<script>console.log('snfkjbjkdjkdtar:' );</script>";


	// 	$name = $this->input->post('name');
	// 	$email = $this->input->post('email');
	// 	$subject = $this->input->post('subject');
	// 	$message = $this->input->post('message');

	// 	$from_address = "mohankumar.ct21@bitsathy.ac.in";//Sender email
	// 	$to_address = "srikanth.ct21@bitsathy.ac.in";//Receiver email
	// 	$body = "<html>
	// 				<style>
	// 					table,th,td{
	// 						border-collapse:collapse;
	// 						border:1px solid black;
	// 					}
	// 				</style>
	// 				<body>
	// 					<p>Someone has contacted you!</p>
	// 					<br><br>
	// 					<h3>Sender Details<h3><br>
	// 					<table>
	// 						<tr>
	// 							<th>Name</th>
	// 							<th>Email</th>
	// 							<th>Message</th>
	// 						</tr>
	// 						<tr>
	// 							<td>".$name."</td>
	// 							<td>".$email."</td>
	// 							<td>".$message."</td>
	// 						</tr>
	// 					</table>
	// 				</body>
	// 			</html>";
	// 	echo "<script>console.log('snfkjbjkdjkdtar:' );</script>";
	// 	echo "<script>console.log('snfkjbjkdjkdtar:' );</script>";
	// 	$this->load->view('Admin_1/contact_form.php');

	// 	$mailer = new PHPMailer(true);
	// 	try{
	// 		echo "<script>console.log('mmmm:' );</script>";

	// 		$mailer->isSMTP();
	// 		$mailer->Host="localhost";
	// 		$mailer->SMTPAuth =true;
	// 		$mailer->Username="mohankumar.ct21@bitsathy.ac.in";
	// 		$mailer->Password="etm@9597737255";
	// 		$mailer->SMTPSecure=PHPMailer::ENCRYPTION_SMTPS;
	// 		$mailer->Port="443";
	// 		$mailer->setFrom($from_address);
	// 		$mailer->addAddress($to_address);
	// 		$mailer->Subject=$subject;
	// 		$mailer->isHTML(true);
	// 		$mailer->Body=$body;
	// 		$mailer->send();
	// 		echo "Mail has been sent";
	// 	}catch(Exception $e){
	// 		echo "<script>console.log('err:' );</script>";

	// 		echo "Mail Error:".$mailer->ErrorInfo;
	// 	}
		
	// 	echo "<script>console.log('snfkjbjkdjkdtar:' );</script>";


	// }

	public  function send_mail(){
		
		
		$this->load->library("email");
		// $config = array(
		// 	'protocol'=>'smtp',
		// 	'smtp_host'=>'localhost',
			
		// 	'smtp_port'=>25,
		// 	'smtp_user'=>'mohankumar.ct21@bitsathy.ac.in'
		// 	'smtp_pass'=>'etm@9597737255',
		// 	'charset'=>'utf-8',
		// 	'mailtype'=>'html',
		// 	'wordwrap' => TRUE,
		// 	'newline'=>"\r\n"
		// );
		$to_email = "srikanth.ct21@bitsathy.ac.in";
        $subject = "Simple Email Test via PHP";
		$body = "Hi, This is test email send by PHP Script";
		$headers = "From: mohankumar.ct21@bitsathy.ac.in";

		if (mail($to_email, $subject, $body, $headers))
		 {
    		echo "Email successfully sent to $to_email...";
		} 
		else 
		{
    		echo "Email sending failed...";
		}

		
		// $this->email->initialize($config);
		// $this->email->set_newline("\r\n");
		// $this->email->set_crlf("\r\n");

		// $this->email->to("srikanth.ct12@bitsathy.ac.in");
		// $this->email->from("info@gophp.in");
		// $this->email->subject("test email");
		// $this->email->message("----------nothing--------------");
		// if ($this->email->send()){
		// 	echo "mail sent successfully";
		// }
		// else{
		// 	echo "sorry ";
		// 	print_r($this->email->print_debugger());
		// }

	}
}

