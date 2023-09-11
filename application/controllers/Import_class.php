<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Import_class extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('array');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library("pagination");
		$this->load->helper('text');
		$this->load->library('email');
		$this->load->library('calendar');
		$this->load->library('javascript');
		$this->load->library('session');
		$this->load->model('Aedr_model'); 
	}



////////////////////////////////  import room details /////////////////

 ///////////////////// bank_transaction  /////////////////////

  public function import_room_details(){

   // print_r($_POST);
   // print_r($this->input->post('room_major'));exit;

  $this->load->library('excel_reader');

  $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'xlsx|csv|xls';
            $config['overwrite']=true;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (!is_dir('uploads'))
            {
              mkdir('./uploads', 0777, true);
            }
            if ($this->upload->do_upload('room_details'))
            {
              $data = $this->upload->data();
              $file_name = $data['file_name'];
               
            }
            else
            {
              echo $this->upload->display_errors();
              
            }
              

$file='./uploads/'.$file_name;
$this->excel_reader->read($file);
$worksheet = $this->excel_reader->sheets[0];
$numRows = $worksheet['numRows']; // ex: 14
$numCols = $worksheet['numCols']; // ex: 4
$cells = $worksheet['cells'];
$n=count($cells);
$i=1;



 

for ($i=2; $i<=$n; $i++) 
{  
 
 
if($_POST['room_major']==1)
  {
   $insert_data['name']=$cells[$i][1];
   $insert_data['student_table']=$cells[$i][2];
   $insert_data['system']=$cells[$i][3];
   $insert_data['clock']=$cells[$i][4];
   $insert_data['projector']=$cells[$i][5];
   $insert_data['projector_screen']=$cells[$i][6];
   $insert_data['speaker']=$cells[$i][7];
   $insert_data['amplifier']=$cells[$i][8];
   $insert_data['floor_id']=$cells[$i][9];
   $insert_data['block_id']=$cells[$i][10];
   $insert_data['room_type']=$cells[$i][11];
   $id=$this->Aedr_model->insert_id("class_room",$insert_data);


  }
  else
  {
    $insert_data['room_name']=$cells[$i][1];
   $insert_data['seating_capacity']=$cells[$i][2];
   $insert_data['block_id']=$cells[$i][3];
   $insert_data['floor_id']=$cells[$i][4];
   $insert_data['room_type']=$cells[$i][5];
   
   $id=$this->Aedr_model->insert_id("room_info",$insert_data);
  }  
 }
 redirect('Dashboard/import_room');

}
 ///////////////////// bank_transaction  /////////////////////

  public function import_weatherReport(){

  $this->load->library('excel_reader');

  $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'xlsx|csv|xls';
            $config['overwrite']=true;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (!is_dir('uploads'))
            {
              mkdir('./uploads', 0777, true);
            }
            if ($this->upload->do_upload('transaction_file'))
            {
              $data = $this->upload->data();
              $file_name = $data['file_name'];
               
            }
            else
            {
              echo $this->upload->display_errors();
              
            }
              

$file='./uploads/'.$file_name;
$this->excel_reader->read($file);
$worksheet = $this->excel_reader->sheets[0];
$numRows = $worksheet['numRows']; // ex: 14
$numCols = $worksheet['numCols']; // ex: 4
$cells = $worksheet['cells'];
$n=count($cells);
$i=1;




for ($i=2; $i<=$n; $i++) 
{   
  
   $insert_data['COL 1']=$cells[$i][1];
   $insert_data['COL 2']=$cells[$i][2];
   $insert_data['COL 3']=$cells[$i][3];
   $insert_data['COL 4']=$cells[$i][4];
   $insert_data['COL 6']=$cells[$i][6];
   $insert_data['COL 7']=$cells[$i][7];
   $insert_data['COL 5']=date("Y-m-d H:i:s",strtotime($cells[$i][5]));
  

  print_r($insert_data);exit;

 $id=$this->Aedr_model->insert_id("irrigation",$insert_data);

  
  

  
 }

}


public function import_bluk_room_details(){

  // print_r($_POST);
  // print_r($this->input->post('room_major'));exit;


 $this->load->library('excel_reader');

 $config['upload_path'] = './uploads/';
           $config['allowed_types'] = 'xlsx|csv|xls';
           $config['overwrite']=true;
           $this->load->library('upload', $config);
           $this->upload->initialize($config);
           if (!is_dir('uploads'))
           {
             mkdir('./uploads', 0777, true);
           }
           if ($this->upload->do_upload('room_details'))
           {
             $data = $this->upload->data();
             $file_name = $data['file_name'];
              
           }
           else
           {
             echo $this->upload->display_errors();
             
           }
             

$file='./uploads/'.$file_name;
$this->excel_reader->read($file);
$worksheet = $this->excel_reader->sheets[0];
$numRows = $worksheet['numRows']; // ex: 14
$numCols = $worksheet['numCols']; // ex: 4
$cells = $worksheet['cells'];
$n=count($cells);
$i=1;





for ($i=2; $i<=$n; $i++) 
{  


if($_POST['room_major']==1)
 {
  $insert_data['name']=$cells[$i][1];
  $insert_data['person_id']=$cells[$i][2];
  echo "Class Room added ".$insert_data['name']."- id".$id."<br>";

  $insert_data['email']=$cells[$i][3];
  $insert_data['capacity']=$cells[$i][4];
  $insert_data['allocated_room_name']=$cells[$i][5];
  $insert_data['room_type']=$cells[$i][6];
  $insert_data['proposal']=$cells[$i][7];
  //$date11 = str_replace("/", ".", $cells[$i][8]);// replace the / with .
  //$date11 = date("Y-m-d", strtotime($date));
 // $dataexcel[$i-3]['date_edit']  = $date;



 //Your input date
$input_date = $cells[$i][8];
$excel_date = $input_date;  //here is that excel value 41621 or 41631

//Convert excel date to mysql db date
      $unix_date = ($excel_date - 25569) * 86400;
      $excel_date = 25569 + ($unix_date / 86400);
      $unix_date = ($excel_date - 25569) * 86400;
      //echo gmdate("Y-m-d", $unix_date);

//Insert below to sql
$added_date = gmdate("Y-m-d", $unix_date);
  $insert_data['f_date']= $added_date;
  ///////////////////////////////////////////////////////////////////////////////////////////////9//////////////////////////////

  $input_date = $cells[$i][9];
  $excel_date = $input_date;  //here is that excel value 41621 or 41631
  
  //Convert excel date to mysql db date
        $unix_date = ($excel_date - 25569) * 86400;
        $excel_date = 25569 + ($unix_date / 86400);
        $unix_date = ($excel_date - 25569) * 86400;
        //echo gmdate("Y-m-d", $unix_date);
  
  //Insert below to sql
  $added_date1 = gmdate("Y-m-d", $unix_date);  
    $insert_data['t_date']= $added_date1;

  ///////////////////////////////////////////////////////////////////////////////////////////10////////////////////////////////////
  
 // $input_time = $sheet->getCellByColumnAndRow(10,$i)->getValue();
// Convert Excel time to Unix timestamp

$input_time= $cells[$i][10];
$excel_date = $input_time;
$unix_time = ($input_time - 25569) * 86400;
// Convert Unix timestamp to MySQL time format
$mysql_time = date('H:i:s', $unix_time);
$insert_data['f_time']= $mysql_time;




 


  $excel_date3= $cells[$i][10];
  $insert_data['t_time']=date("H:i:s",strtotime($excel_date));
  //$insert_data['t_date']=$cells[$i][9];
  //$insert_data['f_time']=$cells[$i][10];
  //$insert_data['t_time']=$cells[$i][11];
  //$insert_data['projector']=$cells[$i][12];
  $insert_data['wifi']=$cells[$i][13];
  $insert_data['systems']=$cells[$i][14];
  $insert_data['speaker']=$cells[$i][15];
  $insert_data['approval']=$cells[$i][16];
  $insert_data['state']=$cells[$i][17];

  $id=$this->Aedr_model->insert_id("form",$insert_data);

  //echo "Class Room added ".$insert_data['name']."- id".$id."<br>";

 }
 else
 {
   $insert_data['room_name']=$cells[$i][1];
  $insert_data['seating_capacity']=$cells[$i][2];
  $insert_data['block_id']=$cells[$i][3];
  $insert_data['floor_id']=$cells[$i][4];
  $insert_data['room_type']=$cells[$i][5];
  
  $id=$this->Aedr_model->insert_id("room_info",$insert_data);
  //echo "Hall Details added ".$insert_data['room_name']."- id".$id."<br>";
 }  
}

redirect('Dashboard/bulk_booking');


}


}

?>
