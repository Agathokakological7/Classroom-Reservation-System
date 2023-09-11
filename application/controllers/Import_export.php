<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Import_export extends CI_Controller {

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


 
  public function import_bank_transaction(){

 	$this->load->library('excel_reader');

 	$config['upload_path'] = './uploads/';
						$config['allowed_types'] = '*';
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

//print_r($numCols);exit;


for ($i=2; $i<=$n; $i++) 
{ 		
   $insert_data['transid']=$cells[$i][1];
   $insert_data['tdate']=date("Y-m-d",strtotime($cells[$i][2]));
   $insert_data['tdescription']=$cells[$i][3];
   $insert_data['camount']=intval($cells[$i][4]);
   $insert_data['source_type']=$cells[$i][5];
   $insert_data['name']=$cells[$i][6];
   $insert_data['regular_accrual']=$cells[$i][7];
   $insert_data['core_project']=$cells[$i][8];
   $insert_data['audit_income']=$cells[$i][9];
   $insert_data['ga']=$cells[$i][10];
   $insert_data['status']=1;

 $id=$this->Aedr_model->insert_id("bank_transaction",$insert_data);

  echo $insert_data['transid']."-".$insert_data['tdate']."-".$id;
  echo "<br>";
  

  
 }

// print_r($insert_data);

echo "success";

}

///////////////////// bank transaction end ////////////////////




///////////////////// donars bulk upload ////////////////////
public function import_donar(){

 	$this->load->library('excel_reader');

 	$fdata=$this->upload_xls();

 //	print_r($fdata);exit;

$file='./uploads/'.$fdata['file_name'];
$this->excel_reader->read($file);
$worksheet = $this->excel_reader->sheets[0];
$numRows = $worksheet['numRows']; // ex: 14
$numCols = $worksheet['numCols']; // ex: 4
$cells = $worksheet['cells'];
$n=count($cells);
$i=1;
for ($i=2; $i<=$n; $i++) 
{ 		
   $donar_data['name']=$cells[$i][1];
   $donar_data['email']=$cells[$i][2];
   $donar_data['is_live']=$cells[$i][3];
   $donar_data['age']=$cells[$i][4];
   $donar_data['Fname']=$cells[$i][5];
   $donar_data['ID_lookup']=$cells[$i][6];
   $donar_data['status']=1;
 $id=$this->Aedr_model->insert_id("donar",$donar_data);

  echo $donar_data['Fname']."-".$id;
  echo "<br>";
  
 }

// print_r($insert_data);

echo "success";

}


///////////////////// donars bulk upload end //////////////////

///////////////////// Missionarys bulk upload  /////////////////
public function import_Missionary(){

	////// extraction from DB ////////////

	/////////////////////////////////////

 	$this->load->library('excel_reader');

 	$fdata=$this->upload_xls();

	//print_r($fdata);exit;

$file='./uploads/'.$fdata['file_name'];
$this->excel_reader->read($file);
$worksheet = $this->excel_reader->sheets[0];
$numRows = $worksheet['numRows']; // ex: 14
$numCols = $worksheet['numCols']; // ex: 4
$cells = $worksheet['cells'];
$n=count($cells);
$i=1;
for ($i=2; $i<=$n; $i++) 
{ 		
   $Missionary_data['name']=$cells[$i][1];
   $Missionary_name=$cells[$i][1];

   $where="UPPER(name)=UPPER('".$cells[$i][2]."')";
   $rst=$this->Aedr_model->get_row("state",$where);
  // print_r($where);exit;

  	if(!empty($rst))
  	{
  		//echo "jeeva";exit;
  		$Missionary_data['state_id']=$rst['state_id'];
  	}
  	else
  	{
  		//echo "ji";exit;
  		$state_data['name']=$cells[$i][2];
  		$state_data['status']=1;
  		$Missionary_data['state_id']=$this->Aedr_model->insert_id("state",$state_data);;
  	}

   $Missionary_data['id']=$cells[$i][3];
   $Missionary_data['sponsor_country']=$cells[$i][4];
   $Missionary_data['is_live']=$cells[$i][5];
   $Missionary_data['date_budget_joined']=date('Y-m-d',strtotime($cells[$i][6]));
   $Missionary_data['date_partner_created']=date('Y-m-d',strtotime($cells[$i][7]));
   	if($cells[$i][8]=="Yes")
   	{
   		$Missionary_data['fact_file']=1;
   	}
   	else
   	{
   		$Missionary_data['fact_file']=0;
   	}
   


    $Missionary_data['status']=1;
 $missionary_id=$this->Aedr_model->insert_id("Missionary",$Missionary_data);

  echo $Missionary_name."-".$missionary_id." added";
  echo "<br>";

  $donar_name1=$cells[$i][9];
  $donar_name2=$cells[$i][10];
  $donar_name3=$cells[$i][11];

  	
  if($donar_name1!=NULL)
  {
  	
  	 $msetting['missionary_id']=$missionary_id;
  	 $where="UPPER(name)=UPPER('".$donar_name1."')";
     $rt=$this->Aedr_model->get_row("donar",$where);

  	if(!empty($rt))
  	{
  		$msetting['donar_id']=$rt['donar_id'];
  		$msetting['status']=1;
  		$this->Aedr_model->insert('missionary_donar_assignment',$msetting);
  		
  	}
  	
  }

  if($donar_name2!=NULL)
  {
  	 $msetting['missionary_id']=$missionary_id;
  	 $where="UPPER(name)=UPPER('".$donar_name2."')";
     $rt=$this->Aedr_model->get_row("donar",$where);
    
  	if(!empty($rt))
  	{
  		$msetting['donar_id']=$rt['donar_id'];
  		$msetting['status']=1;

  		$this->Aedr_model->insert('missionary_donar_assignment',$msetting);
  	}
  	unset($rt);  
  }

  if($donar_name3!=NULL)
  {
  	 $msetting['missionary_id']=$missionary_id;
  	 $where="UPPER(name)=UPPER('".$donar_name3."')";
     $rt=$this->Aedr_model->get_row("donar",$where);
  	if(!empty($rt))
  	{
  		$msetting['donar_id']=$rt['donar_id'];
  		$msetting['status']=1;
  		$this->Aedr_model->insert('missionary_donar_assignment',$msetting);
  	}
  	unset($rt);  
  }


  
 }

// print_r($insert_data);

echo "success";

}


///////////////// Missionarys bulk upload end /////////////////

function upload_xls()
{
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
							return $data;
							 
						}
						else
						{
							return $this->upload->display_errors();
							
						}
}


//////////////////// district start  //////////////////////////

public function import_district(){

  ////// extraction from DB ////////////

  /////////////////////////////////////

  $this->load->library('excel_reader');

  $fdata=$this->upload_xls();

  //print_r($fdata);exit;

$file='./uploads/'.$fdata['file_name'];
$this->excel_reader->read($file);
$worksheet = $this->excel_reader->sheets[0];
$numRows = $worksheet['numRows']; // ex: 14
$numCols = $worksheet['numCols']; // ex: 4
$cells = $worksheet['cells'];
$n=count($cells);
$i=1;
for ($i=2; $i<=$n; $i++) 
{     
   $district['state_id']=$cells[$i][1];
   $district['name']=$cells[$i][2];

  
      $Missionary_data['state_id']=$this->Aedr_model->insert_id("district",$district);;
    }

  
// print_r($insert_data);

echo "successfully updated";

}

public function import_factfile_details(){

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
 // print_r($cells[$i][2]);  
   $missionary_id=$cells[$i][1];
   $update_data['photo']=$cells[$i][2];
   $update_data['spouse_name']=$cells[$i][4];
   $update_data['children_name']=$cells[$i][5];
 

// print_r($missionary_id);
 //print_r($update_data);
  $where ="missionary_id=".$missionary_id;

  $this->Aedr_model->update('missionary_first',$where,$update_data);

 // print_r($missionary_id);
 // echo "Successfully <br>";
  
 }


}

////////////////////////////// missionary import temprary  start  ////////////////

///////////////////// Missionarys bulk upload  /////////////////
public function import_Missionary_temp(){

  ////// extraction from DB ////////////

  /////////////////////////////////////

  $this->load->library('excel_reader');

  $fdata=$this->upload_xls();

  //print_r($fdata);exit;

$file='./uploads/'.$fdata['file_name'];
$this->excel_reader->read($file);
$worksheet = $this->excel_reader->sheets[0];
$numRows = $worksheet['numRows']; // ex: 14
$numCols = $worksheet['numCols']; // ex: 4
$cells = $worksheet['cells'];
$n=count($cells);
$i=1;
for ($i=2; $i<=$n; $i++) 
{     
   $Missionary_data['name']=$cells[$i][2];
   $Missionary_name=$cells[$i][2];

   $dob=$cells[$i][6];

   if($dob=="")
   {
    $Missionary_data['dob']=NULL;
   }
   else
   {
    $Missionary_data['dob']=date('Y-m-d',strtotime($dob));
   }

  //print_r($Missionary_data['dob']);exit;



   $Missionary_data['id']=$cells[$i][1];

   $Missionary_data['date_budget_joined']=date("Y-m-d",strtotime($cells[$i][5]));

 

  
   
   $Missionary_data['is_live']=$cells[$i][4];
   
   
    

    $where="UPPER(name)=UPPER('".$cells[$i][3]."')";
    $rstState=$this->Aedr_model->get_row("state",$where);
   //print_r($rst);exit;

    if(!empty($rstState))
    {
      //echo "jeeva";exit;
      $Missionary_data['state_id']=$rstState['state_id'];
    }
    else
    {
      //echo "ji";exit;
      $state_data['name']=$cells[$i][3];
      $state_data['status']=1;
      $Missionary_data['state_id']=$this->Aedr_model->insert_id("state",$state_data);;
    }

   // print_r($Missionary_data);exit;
   
   $where="UPPER(name)=UPPER('".$cells[$i][1]."')";
   $rst=$this->Aedr_model->get_row("missionary_gsect",$where);
   //print_r($rst);exit;

    if(!empty($rst))
    {
        $missionary_id=$rst['missionary_id'];
        $update['dob']=$Missionary_data['dob'];
        

        $where ="missionary_id=".$missionary_id;
        $this->Aedr_model->update('missionary_gsect',$where,$update);
    }
    else
    {
       $Missionary_data['status']=1;
      $missionary_id=$this->Aedr_model->insert_id("missionary_gsect",$Missionary_data);

     echo $Missionary_name."-".$missionary_id." added";
      echo "<br>";
    }


   

  

  
 }

// print_r($insert_data);

echo "success";

}

////////////////////////////// missionary import temprary  end  ////////////////


}



?>