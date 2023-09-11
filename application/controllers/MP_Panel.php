<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MP_Panel extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
    $this->load->library('session');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');		
    $this->load->model('Admin_model');
    $this->load->model('Aedr_model');
    $this->load->helper('download_helper');
    if ($this->session->userdata('MP_login') != 1)
       redirect(base_url(), 'refresh');          
    }

    function index()
    {    

      //print_r(substr($this->session->userdata('name'),0,2));exit;

   /* $id=random_string('alpha', 2);   
    $num=1;
    $mid="0".$num;
      echo strtoupper($id."TN".$mid);*/  
   
    
       // echo "Here we go jeeva";exit;

          /*  $page_data['page_name']="backennd/mp_pannel/dashboard";
            $page_data['top_menu']="bk_cms/top_menu";
            $page_data['css_file']="bk_cms/dasboard_css";
            $page_data['script_file']="bk_cms/dashboard_script";
            $page_data['side_menu']="backennd/mp_pannel/side_menu";
            $page_data['footer']='bk_cms/footer';

              ///////////////// page details ////////////////////////


                $this->load->view($page_data['css_file'],$page_data);
                $this->load->view($page_data['top_menu']);
                $this->load->view( $page_data['side_menu']);
                $this->load->view($page_data['page_name'],$page_data);
                $this->load->view('bk_cms/footer');
                $this->load->view($page_data['script_file']);*/
              redirect(base_url().'MP_Panel/missionaries','refresh');

    }

    function submit_missionary($param1="")
    {
       //print_r($_POST);exit;

      if($param1=="first")
      {


        $insert=$_POST;
        $insert['submission_date']=date("Y-m-d");
        $insert['mp_id']=$this->session->userdata("mp_id");
               $insert['status']=1;
        $missionary_id=$this->Aedr_model->insert_id("missionary_first",$insert);

        redirect(base_url().'MP_Panel/add_missionary/first1/'.$missionary_id,'refresh');
         
      }
      if($param1=="first1")
      {
        //print_r($_POST);exit;
        $missionary_id=$_POST['missionary_id'];
        
        $update_data=$_POST;
        
            if($_POST['alt_phone_num']=="")
               $update_data['alt_phone_num']=NULL;
               
            if($_POST['aadhar_number']=="")
               $update_data['aadhar_number']=NULL;
               
            if($_POST['surename']=="")
               $update_data['surename']=NULL;   
            
            

            $state_by_id=$this->Aedr_model->get_row_by_id('state','state_id');
              $district_by_id=$this->Aedr_model->get_row_by_id('district','district_id');
              $statename=$state_by_id[$_POST['state_id']]['short_name'];

             
              $mrid=strtoupper(substr($this->session->userdata('name'),0,2)."".random_string('alnum', 2)."".$statename."".$missionary_id);
           
          $update_data['mrid']=$mrid;

         // echo $mrid;exit;

             

        
        $update_data['dob']=date("Y-m-d",strtotime($this->input->post('dob')));

        $where ="missionary_id=".$missionary_id;

        $this->Aedr_model->update('missionary_first',$where,$update_data);

        redirect(base_url().'MP_Panel/add_missionary/second/'.$missionary_id,'refresh');
         
      }
      elseif($param1=="second")
      {
      //  print_r($_POST);exit;
        $missionary_id=$_POST['missionary_id'];
        $insert=$_POST;
        if($_POST['pincode']=="")
               $insert['pincode']=NULL;   
               
        if($this->input->post('is_fw_active_in_mf')==1)
        {
            $insert['mf_starting_date']=date("Y-m-d",strtotime($this->input->post('mf_starting_date')));
        }
        else
        {
            $insert['mf_starting_date']=NULL;
            $insert['desc_mf']=0;
            $insert['tbaptized']=0;
        }
        //$insert['mf_starting_date']=date("Y-m-d",strtotime($this->input->post('mf_starting_date')));        
        $id=$this->Aedr_model->insert_id("missionary_second",$insert);
        //echo $missionary_id;exit;
        redirect(base_url().'MP_Panel/add_missionary/third/'.$missionary_id,'refresh');
      }
      elseif($param1=="third")
      {
        $missionary_id=$_POST['missionary_id'];
        $insert=$_POST;

        
        if($_POST['add_OP_BA_main']!=null)
        {
             $insert_option['name']=$_POST['add_OP_BA_main'];
             $option_id=$this->Aedr_model->insert_id("bc_main",$insert_option);
             $insert['BC_main']=$option_id;        
            
        }

        unset($insert['add_OP_BA_main']);
        $insert['other_spk_language']=implode(',',$_POST['other_spk_language']);
        
        $id=$this->Aedr_model->insert_id("missionary_third",$insert);
        redirect(base_url().'MP_Panel/add_missionary/four/'.$missionary_id,'refresh');
      }
      elseif($param1=="four")
      {
        $missionary_id=$_POST['missionary_id'];
        $insert=$_POST;
        
        if($_POST['nof_supervisor']=="")
               $insert['nof_supervisor']=NULL;   
        
        $id=$this->Aedr_model->insert_id("missionary_four",$insert);
        redirect(base_url().'MP_Panel/add_missionary/five/'.$missionary_id,'refresh');
      }
      elseif($param1=="five")
      {
        $missionary_id=$_POST['missionary_id'];
       
        $insert=$_POST;
        
        $id=$this->Aedr_model->insert_id("missionary_five",$insert);
        redirect(base_url().'MP_Panel/add_missionary/six/'.$missionary_id,'refresh');
      }
      elseif($param1=="six")
      {
        $missionary_id=$_POST['missionary_id'];

       
            
        $insert=$_POST;        
        $id=$this->Aedr_model->insert_id("missionary_six",$insert);

        redirect(base_url().'MP_Panel/add_missionary/seven/'.$missionary_id,'refresh');
      }
      elseif($param1=="seven")
      {
        $missionary_id=$_POST['missionary_id'];
        
           // print_r($_POST);exit;
       
            
        $insert=$_POST;        
        if($_POST['installation_cost']=="")
               $insert['installation_cost']=NULL;   
               
        if($_POST['salary_recommandation']=="")
               $insert['salary_recommandation']=NULL;   
        $id=$this->Aedr_model->insert_id("missionary_seven",$insert);

        $this->update_googlesheet($missionary_id);

        redirect(base_url().'MP_Panel/missionary_profile/'.$missionary_id,'refresh');
      }
      


          ////////////////// google api sheet /////////////

      /* $this->load->library('Gapi');
        

        
       $report_period=$data['report_year']." R".$data['report_period'];


       $val_to_sheet=array(date('d-m-Y',strtotime($report['report_date'])),$reporter['name'],$report_period,$mid,$data['missionary_name'],$data['report'],$report['village_details'],implode(',',$data['prayer_points']),$data['photo_link'],$data['doc_link']);
     // print_r($val_to_sheet);exit;

    $this->gapi->writeData_uploadCatcher("1Vcwj46Cl3bIUhUbw7sYVU7QzgzMkJZgT4wt_6XM3u9g", "reportcatcher!A:J",$val_to_sheet);

   //exit;
       //print_r($result);exit;*/

 ////////////////////// google api sheet //////////////////////
    }

    function update_main_college()
    {
      $op_BC_main[1]="IPC Theological Seminary";
$op_BC_main[2]="ACE, Hydrabad";
$op_BC_main[3]="Action Ministries, India";
$op_BC_main[4]="ACTS Academy , Banglaore";
$op_BC_main[5]="ACY, HYD";
$op_BC_main[6]="AG Bible College, Gola";
$op_BC_main[7]="AG Bible Taining Centre";
$op_BC_main[8]="AG Central Bible College";
$op_BC_main[9]="Ag Traing Center";
$op_BC_main[10]="Agape Institute (Ponta Sahib)";
$op_BC_main[11]="AGAPE, VIJAYAWADA";
$op_BC_main[12]="Allahabad Bible Seminary";
$op_BC_main[13]="Anglican Clergy Episcopal, Hyderabad";
$op_BC_main[14]="Aroma Bible College, Dhamtari";
$op_BC_main[15]="Aroma Bible College, Dhamtari 3Years and New Life Biblical Seminari Kerla 3Years";
$op_BC_main[16]="Asian theological association";
$op_BC_main[17]="Assembly of Gospel For Asia, Bhubaneswar (Lucknow)";
$op_BC_main[18]="Beersheba Theological College";
$op_BC_main[19]="Beersheba Theological College, Jagadalpur";
$op_BC_main[20]="Beersheba Theological College, Pippiria";
$op_BC_main[21]="Beleivers Church";
$op_BC_main[22]="believers church";
$op_BC_main[23]="Berean Baptist Bible College And Seminary";
$op_BC_main[24]="Bethany Bible College, Trivandrum";
$op_BC_main[25]="Bethel Bible College, Punalur";
$op_BC_main[26]="Bethel Bible College, Punalur, New Life Biblical Seminary , Cheruvakkal, Harvest Mission Bible college";
$op_BC_main[27]="Bethel New life college, Banglore";
$op_BC_main[28]="Bilaspur";
$op_BC_main[29]="Buntain Theological Seminary, Kolkotta";
$op_BC_main[30]="C.TH, Pamgarh";
$op_BC_main[31]="Calvary Bible College";
$op_BC_main[32]="Carmel Bible Training Centre Pathankot";
$op_BC_main[33]="Central Bible College";
$op_BC_main[34]="Central India Bible College";
$op_BC_main[35]="Central India theological seminary Itarsi MP.";
$op_BC_main[36]="CFI";
$op_BC_main[37]="CFI CHHATTISGARH";
$op_BC_main[38]="Chandigarh";
$op_BC_main[39]="Changshin Academy for pastors in Nagpur";
$op_BC_main[40]="Christ Ambassadors Bible Training centre, Mumbai";
$op_BC_main[41]="Christ Calvary";
$op_BC_main[42]="Church on the Rock";
$op_BC_main[43]="CTH BILASPUR";
$op_BC_main[44]="Delhi";
$op_BC_main[45]="Delhi Bible Instiute";
$op_BC_main[46]="DLM";
$op_BC_main[47]="Doon Bible college, Dheradoon";
$op_BC_main[48]="DTH";
$op_BC_main[49]="Ebenezar Theological Seminary";
$op_BC_main[50]="Eleos Bible Training School";
$op_BC_main[51]="Elim Bible traning center Rourkela";
$op_BC_main[52]="Elue Bible Institute";
$op_BC_main[53]="Emmanuel Bible College";
$op_BC_main[54]="Emmanuel BIble Institute Karnataka";
$op_BC_main[55]="faith bible collage";
$op_BC_main[56]="Faith Bible College,Ranny , Kerala";
$op_BC_main[57]="Fisherman Bible college, Vijayawada
Grace Bible Coillege , hariyana";
$op_BC_main[58]="FTS Manakkala";
$op_BC_main[59]="Gamaliel Theological centre, Uttarakhand";
$op_BC_main[60]="GCM Gujrath";
$op_BC_main[61]="GEMS BIBLE SCHOOL, BIHAR";
$op_BC_main[62]="GFA, Odisha";
$op_BC_main[63]="Gilgal Bible college, Goa";
$op_BC_main[64]="Gola, Uttaer Pradesh";
$op_BC_main[65]="Good News International University";
$op_BC_main[66]="Gorakhpur Seminary";
$op_BC_main[67]="Gospel For Asia, Anoopgarh";
$op_BC_main[68]="Gospel For Asia, Bhubaneswar";
$op_BC_main[69]="Gospel For Asia, Bilaspur";
$op_BC_main[70]="Gospel For Asia, Brijaraj Nagar";
$op_BC_main[71]="Gospel For Asia, Palampur";
$op_BC_main[72]="Gospel For Asia, Thiruvalla";
$op_BC_main[73]="Grace Bible College, Hariyana";
$op_BC_main[74]="Grace Bible Institute Durg";
$op_BC_main[75]="Grace centre for theological Taining";
$op_BC_main[76]="Grace Centre, Gola";
$op_BC_main[77]="Grace Decipleship Centre";
$op_BC_main[78]="Great Commission Bible College";
$op_BC_main[79]="Gujarath Bible College";
$op_BC_main[80]="Hallelujah Bible School, Bhopal";
$op_BC_main[81]="Hallelujah Bible Training Centre";
$op_BC_main[82]="Harvest Mission College, Noida";
$op_BC_main[83]="Harvest Training Institute, Chennai";
$op_BC_main[84]="Harvest Vision Centre Karkapal";
$op_BC_main[85]="Himachal Bible College and Seminary";
$op_BC_main[86]="Himalaya Evangelical Mission";
$op_BC_main[87]="Himanchal Bible College and Bersheeba Bible College";
$op_BC_main[88]="Holistic Training Centre";
$op_BC_main[89]="Holy Spirit Training Centre";
$op_BC_main[90]="Hosanna Ministry, Andhra Pradesh";
$op_BC_main[91]="IBM";
$op_BC_main[92]="ICA";
$op_BC_main[93]="ICMTP (Diploma In Christian Ministry)";
$op_BC_main[94]="ICOM";
$op_BC_main[95]="ICT, SEVABHARAT";
$op_BC_main[96]="IDC-JEHOVAN NISSI BILE INSTITUTE.";
$op_BC_main[97]="IGM, Lucknow";
$op_BC_main[98]="IGSM";
$op_BC_main[99]="India Bible college and Seminary";
$op_BC_main[100]="India Full Gospel Bible College in Banglore";
$op_BC_main[101]="Indian Bible Literature";
$op_BC_main[102]="Indiann Institiute of Theological";
$op_BC_main[103]="International Institute of Church Management";
$op_BC_main[104]="International Institute Of Theology";
$op_BC_main[105]="International School of Evangelism";
$op_BC_main[106]="IPC Theological Seminary";
$op_BC_main[107]="Jeevan Jyoti Bible Training Centre Bible Training Centre";
$op_BC_main[108]="Kachua Mission College, Alahabad";
$op_BC_main[109]="Karnataka Institute of Theology";
$op_BC_main[110]="Kerala Theological Seminary";
$op_BC_main[111]="Khammam, Telangana";
$op_BC_main[112]="Latur bible college";
$op_BC_main[113]="LCT Lucknow";
$op_BC_main[114]="Light for India";
$op_BC_main[115]="Light for India Bible college";
$op_BC_main[116]="Living bible Institute";
$op_BC_main[117]="Living Hope";
$op_BC_main[118]="Living Word Mission";
$op_BC_main[119]="Lucknow Theological College";
$op_BC_main[120]="Mahaneh Den Theological Trainning Center, Mubai";
$op_BC_main[121]="Maharashtra Bible college";
$op_BC_main[122]="Manna Bible College";
$op_BC_main[123]="Maranatha Bible Training Centre";
$op_BC_main[124]="Masters Trainers";
$op_BC_main[125]="MBCB";
$op_BC_main[126]="MBTI";
$op_BC_main[127]="Mission India Bible College, Guna";
$op_BC_main[128]="Mission India Bible College, Trivandrum";
$op_BC_main[129]="Mission India Bible College, Trivandrum and SeminaryRaipur";
$op_BC_main[130]="Mission India Disciple center.Chatisgarh";
$op_BC_main[131]="Missionary Training Centre, Patiala";
$op_BC_main[132]="Missions India Theological Seminary, Nagpur";
$op_BC_main[133]="NA";
$op_BC_main[134]="NAMTE, Jalandhar";
$op_BC_main[135]="NBM, Latur";
$op_BC_main[136]="Nehemiah Bible Istitution ,Tamil Nadu";
$op_BC_main[137]="New Hope Bible College, Nilambur";
$op_BC_main[138]="New India Biblical Seminary, Paippad";
$op_BC_main[139]="New India church of God bible College";
$op_BC_main[140]="New Life Bible College, Bangalore";
$op_BC_main[141]="New Life Biblical Seminary , Cheruvakkal";
$op_BC_main[142]="New LIfe College";
$op_BC_main[143]="New Thelogical College, DehraDoon Bible college, Dheradoon";
$op_BC_main[144]="Others";
$op_BC_main[145]="No";
$op_BC_main[146]="No formal training";
$op_BC_main[147]="No formal Training";
$op_BC_main[148]="NO FORMAL TRAINING";
$op_BC_main[149]="No Training";
$op_BC_main[150]="North India Bible Institute";
$op_BC_main[151]="North India Theological Seminary Bhopal";
$op_BC_main[152]="North Indian Institute for Theological Studies";
$op_BC_main[153]="Northen Institute Of Biblical Study, In Patiala";
$op_BC_main[154]="Odisha Bible School";
$op_BC_main[155]="Operation Agape ible College,Ludhiana";
$op_BC_main[156]="Peniel Bible Seminary, Keezhillam";
$op_BC_main[157]="Philedelphia Bible College";
$op_BC_main[158]="Pniel Bible College";
$op_BC_main[159]="Punjab";
$op_BC_main[160]="Punjab Bible college";
$op_BC_main[161]="Rajsthan bible collage";
$op_BC_main[162]="Rev BM Chand School of Theology and Leadership";
$op_BC_main[163]="Rhaema Bible training college, Nagpur,";
$op_BC_main[164]="Rhema Bible College and Seminary, Palakkad";
$op_BC_main[165]="Rourkeala Bible college";
$op_BC_main[166]="Sacred Assemblies fellowship Delhi";
$op_BC_main[167]="Samarpit Bible college";
$op_BC_main[168]="Sathya Veda Seminary, Trivandrum";
$op_BC_main[169]="School of Holy Spirit";
$op_BC_main[170]="Shalom Bible Institute";
$op_BC_main[171]="Sharon Bible College";
$op_BC_main[172]="Shekkana";
$op_BC_main[173]="Short term church bases dtraining";
$op_BC_main[174]="South Western Bible college India";
$op_BC_main[175]="Southern Asia Bible College";
$op_BC_main[176]="Southern Bible College, Kanyakumary";
$op_BC_main[177]="Spirit Faith Bible School";
$op_BC_main[178]="Spirit of Faith Bible School";
$op_BC_main[179]="Susamachar Theological College & Seminary";
$op_BC_main[180]="SVS";
$op_BC_main[181]="Tamilnadu Bible College and seminary";
$op_BC_main[182]="TBL, Karnataka";
$op_BC_main[183]="TEAC Mission Nawapur";
$op_BC_main[184]="Telangana";
$op_BC_main[185]="Trinity Binle College,Calicut";
$op_BC_main[186]="Truth University, Nagpur,Maharashtra";
$op_BC_main[187]="UP Mission Bible College, Kanpur";
$op_BC_main[188]="Western India Pentecosta church-Anand,Gujarat";
$op_BC_main[189]="Wisdom for Asia Bible College";
$op_BC_main[190]="Word of Life Ministries, Lucknow, Up";
$op_BC_main[191]="Yeshua Thelogical College. Alahabad";
$op_BC_main[192]="Youth With A Mission";
$op_BC_main[193]="Zion Raj";
$op_BC_main[194]="Other";         
$op_BC_main[195]="Bethel Bible Institute,  Markapur  (JLM)"; 
              $op_BC_main[196]="Timothy training international"; 
              $op_BC_main[197]="Bethel Bible Institute,  Markapur  (JLM)"; 
              $op_BC_main[198]="CFI Samajik Vikas Kendra"; 
              $op_BC_main[199]="Believer church of India"; 
              $op_BC_main[200]="Biblical institute of leadership and development"; 
              $op_BC_main[201]="The leadership of operational agape (Bild)"; 
              $op_BC_main[202]="Agape institute of leadership development"; 
              $op_BC_main[203]="Gilgal Bible institute"; 
              $op_BC_main[204]="ILI (International leadership institute south asia)"; 
              $op_BC_main[205]="Olive theological institute";
              $op_BC_main[206]="Hindustan Bible institute and college";
              $op_BC_main[207]="RTI (Rehoboth Theological Institute)";  
              $op_BC_main[208]="BBTI (Bengal Bible Training Institute)";               
              $op_BC_main[209]="SBC (Steward Bible College)";  
              $op_BC_main[210]="BBI (Brethren Bible Institute)";  
              $op_BC_main[211]="GTC (Gospel Training Center)";  
              $op_BC_main[212]="ABC (Adra Bible College)";  
              $op_BC_main[213]="Tata Nagar Bible College";  
              $op_BC_main[214]="ACA (Asian Christian Academy)";  
              $op_BC_main[215]="Alwar Bible College, Rajasthan ";  
              $op_BC_main[216]="GBBI (Gujarat Brethren Bible Institute)";  
              $op_BC_main[217]="Shalem Theological Seminary"; 
              
              foreach ($op_BC_main as $key => $value) {
                
                $insert['name']=$value;
                
                echo $this->Aedr_model->insert_id("bc_main",$insert)."-".$value."<br>";
              }
      
    }

  function update_googlesheet($missionary_id)
  { 
   

      $mp_name=$this->session->userdata('name');
              
    

    /////////////////////////// Data Start ////////////////////////

              $state_by_id=$this->Aedr_model->get_row_by_id('state','state_id');
              $district_by_id=$this->Aedr_model->get_row_by_id('district','district_id');

              $sql="select * from missionary_first where missionary_id=$missionary_id";

              $missionary_details1=$this->Aedr_model->get_row_sql($sql);

              
              //print_r($missionary_details1);exit;

              $sql="select * from missionary_second where missionary_id=$missionary_id";

              $missionary_details2=$this->Aedr_model->get_row_sql($sql);

              if($missionary_details2['is_fw_active_in_mf']==2)
              {
                $missionary_details2['desc_mf']="Not Applicable";
                $missionary_details2['mf_starting_date']="Not Applicable";
                $missionary_details2['tbaptized']="Not Applicable";
              }
              else
              {
                $missionary_details2['mf_starting_date']=date("d-m-Y",strtotime($missionary_details2['mf_starting_date']));
              }

              $sql="select * from missionary_third where missionary_id=$missionary_id";

              $missionary_details3=$this->Aedr_model->get_row_sql($sql);

              $sql="select * from missionary_four where missionary_id=$missionary_id";

              $missionary_details4=$this->Aedr_model->get_row_sql($sql);

              $sql="select * from missionary_five where missionary_id=$missionary_id";

              $missionary_details5=$this->Aedr_model->get_row_sql($sql);

              $sql="select * from missionary_six where missionary_id=$missionary_id";

              $missionary_details6=$this->Aedr_model->get_row_sql($sql);
              
              $sql="select * from missionary_seven where missionary_id=$missionary_id";

              $missionary_details7=$this->Aedr_model->get_row_sql($sql);

    ////////////////////////  data  end  /////////////////////////////////////////


    /////////// option data start ////////////////////////

              $op_yes_no[1]="Yes";
              $op_yes_no[2]="No";

              $op_mf_type[1]="Village";
              $op_mf_type[2]="Town";
              $op_mf_type[3]="City";

              $op_hw_fund_help_fw[1]="It will enable the FW to do church planting work full time not part time";
              $op_hw_fund_help_fw[2]="It will enable the FW to begin ministry in a new locaiton";
              $op_hw_fund_help_fw[3]="It will enable the FW to live in his ministry location";
              $op_hw_fund_help_fw[4]="It will remove unnecessary financial burdens so the FW will be under less pressure and be able to focus more on the church planting work";
              $op_hw_fund_help_fw[5]="Support from another organisation removed";


              $op_BC_mains=$this->Aedr_model->get_row_by_id('bc_main','op_BC_main_id');

      $op_BC_main[""]="";

      foreach ($op_BC_mains as $id => $value) {
        $op_BC_main[$id]=$value['name'];
      }  

              $op_affiliated[1]="Affiliated";
              $op_affiliated[2]="Independent";


              $op_language[1]="Bengali";
              $op_language[2]="Marathi";
              $op_language[3]="Telugu";
              $op_language[4]="Tamil";
              $op_language[5]="Gujarati";
              $op_language[6]="Urdu";
              $op_language[7]="Kannada";
              $op_language[8]="Odia";
              $op_language[9]="Malayalam";
              $op_language[10]="Punjabi";
              $op_language[11]="Sanskrit";


              $op_DBC[1]="Pentecostal";
              $op_DBC[2]="Evangelical";
              $op_DBC[3]="Inter Denominational";
              $op_DBC[4]="NCM";
              $op_DBC[5]="Christ for India";
              $op_DBC[6]="Baptist";
              $op_DBC[7]="NA";
              $op_DBC[8]="IET";
              $op_DBC[9]="Assembly Of God";
              $op_DBC[10]="IPC";
              $op_DBC[11]="Pentecost";
              $op_DBC[12]="life center";
              $op_DBC[13]="Sharon Fellowship";
              $op_DBC[14]="Sathya Veda Seminary, Trivandrum";
              $op_DBC[15]="ICT, SEVABHARATh";
              $op_DBC[16]="Anglican";
              $op_DBC[17]="Southern Asia Bible College";
              $op_DBC[18]="No";
              $op_DBC[19]="IGM";
              $op_DBC[20]="Beleivers Church";
              $op_DBC[21]="CFI";
              $op_DBC[22]="Bretheren";
              $op_DBC[23]="Independent";
              $op_DBC[24]="Sharon";
              $op_DBC[25]="Church of God";
              $op_DBC[26]="NCM";
              $op_DBC[27]="NOT Applicable";


                

            //// options end /////
               //print_r($this->session->userdata('name'));exit;
              
   //  print_r($missionary_details6);exit;

    ////////////////// google api sheet /////////////

      $this->load->library('Gapi');
       $val_to_sheet=array(date('d-m-Y',strtotime($missionary_details1['submission_date'])),$mp_name,$missionary_details1['mp_staff_name'],$missionary_details1['mp_staff_sname'],$missionary_details1['mp_staff_id'],$missionary_details1['mrid'],$missionary_details1['fname'],$missionary_details1['middlename'],$missionary_details1['surename'],date('d-m-Y',strtotime($missionary_details1['dob'])),$op_yes_no[$missionary_details1['fstatus']],$missionary_details1['depent'],$missionary_details1['phone_num'],$missionary_details1['alt_phone_num'],$op_yes_no[$missionary_details1['is_whatsapp_available']],$missionary_details1['aadhar_number'],$state_by_id[$missionary_details1['state_id']]['name'],$district_by_id[$missionary_details1['district_id']]['name'],$missionary_details2['primary_village'],$missionary_details2['pincode'],$op_mf_type[$missionary_details2['mf_type']],$missionary_details2['mf_population'],$op_yes_no[$missionary_details2['is_fw_active_in_mf']],$missionary_details2['mf_starting_date'],$missionary_details2['desc_mf'],$missionary_details2['desc_fw_income'],$missionary_details2['tbaptized'],$missionary_details2['hw_fund_help_fw'],$op_hw_fund_help_fw[$missionary_details2['hw_fund_help_fw_op']],$missionary_details2['tchristians'],$op_yes_no[$missionary_details2['is_fw_live_in_mf']],$missionary_details2['fw_address'],$op_yes_no[$missionary_details3['is_fw_trained_in_bc']],$op_BC_main[$missionary_details3['BC_main']],$missionary_details3['qualification'],$missionary_details3['noyear_training'],$missionary_details3['graduation_year'],$missionary_details3['other_course_year'],$op_yes_no[$missionary_details3['is_fw_spk_english']],$op_affiliated[$missionary_details3['is_affiliated']],$op_DBC[$missionary_details3['affiliated_denomination']],$missionary_details3['desc_fw_aligns'],$op_yes_no[$missionary_details3['is_fw_spk_hindi']],$op_language[$missionary_details3['other_spk_language']],$missionary_details4['supervisor_name'],$missionary_details4['supervisor_id'],$op_yes_no[$missionary_details4['is_supervisor_inducted']],$op_yes_no[$missionary_details4['is_supervisor_agree']],$missionary_details4['nof_supervisor'],$missionary_details4['distance_supervisor_fw'],$op_yes_no[$missionary_details4['is_FW_other_org']],$missionary_details4['FW_other_payment'],$missionary_details5['ref_name'],$missionary_details5['desc_reference'],$missionary_details6['FW_testimony'],$missionary_details7['installation_cost'],$missionary_details7['explaination_cost'],$missionary_details7['salary_recommandation']);


       $val_to_mpsheet=array(date('d-m-Y',strtotime($missionary_details1['submission_date'])),$missionary_details1['mp_staff_name'],$missionary_details1['mp_staff_sname'],$missionary_details1['mp_staff_id'],$missionary_details1['mrid'],$missionary_details1['fname'],$missionary_details1['middlename'],$missionary_details1['surename'],date('d-m-Y',strtotime($missionary_details1['dob'])),$op_yes_no[$missionary_details1['fstatus']],$missionary_details1['depent'],$missionary_details1['phone_num'],$missionary_details1['alt_phone_num'],$op_yes_no[$missionary_details1['is_whatsapp_available']],$missionary_details1['aadhar_number'],$state_by_id[$missionary_details1['state_id']]['name'],$district_by_id[$missionary_details1['district_id']]['name'],$missionary_details2['primary_village'],$missionary_details2['pincode'],$op_mf_type[$missionary_details2['mf_type']],$missionary_details2['mf_population'],$op_yes_no[$missionary_details2['is_fw_active_in_mf']],$missionary_details2['mf_starting_date'],$missionary_details2['desc_mf'],$missionary_details2['desc_fw_income'],$missionary_details2['tbaptized'],$missionary_details2['hw_fund_help_fw'],$op_hw_fund_help_fw[$missionary_details2['hw_fund_help_fw_op']],$missionary_details2['tchristians'],$op_yes_no[$missionary_details2['is_fw_live_in_mf']],$missionary_details2['fw_address'],$op_yes_no[$missionary_details3['is_fw_trained_in_bc']],$op_BC_main[$missionary_details3['BC_main']],$missionary_details3['qualification'],$missionary_details3['noyear_training'],$missionary_details3['graduation_year'],$missionary_details3['other_course_year'],$op_yes_no[$missionary_details3['is_fw_spk_english']],$op_affiliated[$missionary_details3['is_affiliated']],$op_DBC[$missionary_details3['affiliated_denomination']],$missionary_details3['desc_fw_aligns'],$op_yes_no[$missionary_details3['is_fw_spk_hindi']],$op_language[$missionary_details3['other_spk_language']],$missionary_details4['supervisor_name'],$missionary_details4['supervisor_id'],$op_yes_no[$missionary_details4['is_supervisor_inducted']],$op_yes_no[$missionary_details4['is_supervisor_agree']],$missionary_details4['nof_supervisor'],$missionary_details4['distance_supervisor_fw'],$op_yes_no[$missionary_details4['is_FW_other_org']],$missionary_details4['FW_other_payment'],$missionary_details5['ref_name'],$missionary_details5['desc_reference'],$missionary_details6['FW_testimony'],$missionary_details7['installation_cost'],$missionary_details7['explaination_cost'],$missionary_details7['salary_recommandation']);

       $val_to_MSsheet=array($missionary_details1['mrid'],$missionary_details1['fname'],$state_by_id[$missionary_details1['state_id']]['name'],$district_by_id[$missionary_details1['district_id']]['name'],$missionary_details7['salary_recommandation'],$missionary_details7['installation_cost'],"Applying",Date('d-m-Y'),$missionary_details4['supervisor_name'],$missionary_details2['fw_address'],$missionary_details2['pincode'],$missionary_details1['phone_num']);

       
       $val_to_CMSsheet=array($mp_name,$missionary_details1['mrid'],$missionary_details1['fname'],$state_by_id[$missionary_details1['state_id']]['name'],$district_by_id[$missionary_details1['district_id']]['name'],$missionary_details7['salary_recommandation'],$missionary_details7['installation_cost'],"Applying",Date('d-m-Y'),$missionary_details4['supervisor_name'],$missionary_details2['fw_address'],$missionary_details2['pincode'],$missionary_details1['phone_num']);

//print_r(count($val_to_MSsheet));exit;


for($i=0;$i<count($val_to_MSsheet);$i++)
{
    if($val_to_MSsheet[$i]==NULL)
    {
        $val_to_MSsheet[$i]="Not updated";
    }

}
for($i=0;$i<count($val_to_sheet);$i++)
{
    if($val_to_sheet[$i]==NULL)
    {
        $val_to_sheet[$i]="Not updated";
    }

}
for($i=0;$i<count($val_to_CMSsheet);$i++)
{
    if($val_to_CMSsheet[$i]==NULL)
    {
        $val_to_CMSsheet[$i]="Not updated";
    }

}
for($j=0;$j<count($val_to_mpsheet);$j++)
{
    if($val_to_mpsheet[$j]==NULL)
    {
        $val_to_mpsheet[$j]="Not updated";
    }

}
//print_r($val_to_sheet);exit;
    $this->gapi->writeData_NewMissionary_centralsheet("1G0Rc5DRBLnFlNCpjhC7JO8E3Z-7aZ0o3wnjE1m-dTjM", "NR4R!A:BG",$val_to_sheet);
    $this->gapi->writeData_MSupport_centralsheet("1G0Rc5DRBLnFlNCpjhC7JO8E3Z-7aZ0o3wnjE1m-dTjM", "m support!A:N",$val_to_CMSsheet);

          //print_r($this->session->userdata());exit;

          $missionary_name=$this->session->userdata('name');

         // print_r($missionary_name);exit;

        if($missionary_name=="JLM")
        {
              //print_r($missionary_name);exit;
              $this->gapi->writeData_NewMissionary_inmissionarysheet("1_iVbphOeEapm2bP-EdY_uLSTdICuKxSA5QITqben1QE", "NR4R!A:BG",$val_to_mpsheet);
              $this->gapi->writeData_MSupport_inmissionarysheet("1_iVbphOeEapm2bP-EdY_uLSTdICuKxSA5QITqben1QE", "m support!A:N",$val_to_MSsheet);
        }
        elseif($missionary_name=="NJM")
        {
          $this->gapi->writeData_NewMissionary_inmissionarysheet("1jALNG9vSWODi6PTUtpYMs7dMDPkrQu24MQCNmivolVk", "NR4R!A:BF",$val_to_mpsheet);
          $this->gapi->writeData_MSupport_inmissionarysheet("1jALNG9vSWODi6PTUtpYMs7dMDPkrQu24MQCNmivolVk", "m support!A:N",$val_to_MSsheet);
        }
        echo "updated";




    echo "Successfully Added to the sheet";

   //exit;
       //print_r($result);exit;

 ////////////////////// google api sheet //////////////////////

  }



    ///////////////  Missionary Report New  ///////////////////
function add_missionary($param1='',$param2='')
    {

     
        //////////////// page setup /////////////        
          
              $page_data['page_title']="Add New Missionary";
              $page_data['form_heading']="Missionary Partners Details";
              $page_data['table_heading']="Report List";
               $page_data['page_heading']="New Missionary";
              $page_data['err']="display: none";    


            $page_data['page_name']="backennd/mp_pannel/add_missionary_first";
            $page_data['top_menu']="bk_cms/top_menu";
            $page_data['css_file']="bk_cms/advance_form_css";
            $page_data['script_file']="bk_cms/advance_form_script";
            $page_data['side_menu']="backennd/mp_pannel/side_menu";
             $page_data['footer']='bk_cms/footer';
          
             $bread_crum[0]=array("link"=>base_url()."MP_Panel","name"=>"Missionary Partner","class"=>"active-trail active");
            $bread_crum[1]=array("link"=>base_url()."MP_Panel/add_missionary","name"=>"New Missionary","class"=>"current");
            $page_data['bread_crums']=$bread_crum;


     ///////////////////////  Data  //////////////////////

            $sql="select * from state order by name";

      $page_data['states']=$this->Aedr_model->get_result_sql($sql);
      
      $sql="select district_id,name from district where state_id=1 order by name";

      $dis_list=$this->Aedr_model->get_result_sql($sql);
      
      $op_dis[0]="select";
      
      foreach($dis_list as $dl)
      {
         $op_dis[$dl['district_id']]=$dl['name']; 
      }
    
        $page_data['op_dis']=$op_dis;
      

      

      $page_data['state_by_id']=$this->Aedr_model->get_row_by_id('state','state_id');

      $op_BC_mains=$this->Aedr_model->get_row_by_id('bc_main','op_BC_main_id');

      $op_BC_main[""]="";

      foreach ($op_BC_mains as $id => $value) {
        $op_BC_main[$id]=$value['name'];
      }
       
        /////// options starts //////////////////////

$op_DBC[""]="";
$op_DBC[1]="Pentecostal";
$op_DBC[2]="Evangelical";
$op_DBC[3]="Inter Denominational";
$op_DBC[4]="NCM";
$op_DBC[5]="Christ for India";
$op_DBC[6]="Baptist";
$op_DBC[7]="NA";
$op_DBC[8]="IET";
$op_DBC[9]="Assembly Of God";
$op_DBC[10]="IPC";
$op_DBC[11]="Pentecost";
$op_DBC[12]="life center";
$op_DBC[13]="Sharon Fellowship";
$op_DBC[14]="Sathya Veda Seminary, Trivandrum";
$op_DBC[15]="ICT, SEVABHARATh";
$op_DBC[16]="Anglican";
$op_DBC[17]="Southern Asia Bible College";
$op_DBC[18]="No";
$op_DBC[19]="IGM";
$op_DBC[20]="Beleivers Church";
$op_DBC[21]="CFI";
$op_DBC[22]="Bretheren";
$op_DBC[23]="Independent";
$op_DBC[24]="Sharon";
$op_DBC[25]="Church of God";
$op_DBC[26]="NCM";
$op_DBC[27]="NOT Applicable";

//op_board
$op_BC_main[""]="";
$op_board[1]="NCM";
$op_board[2]="AG";
$op_board[3]="Harvest";
$op_board[4]="Other";

//$op_fstatus
$op_fstatus[""]="";
$op_fstatus[2]="Married- no children";
$op_fstatus[3]="Widower / Widow";
$op_fstatus[4]="Married- with children";
$op_fstatus[5]="Widower / Widow - with children";

//op_mf_type
$op_mf_type[""]="";
$op_mf_type[1]="Village";
$op_mf_type[2]="Town";
$op_mf_type[3]="City";

//op_pre_news
$op_pre_news[""]="";
$op_pre_news[1]="Pre-existing";
$op_pre_news[2]="NewStarter";

//op_pio_inherits
$op_pio_inherits[""]="";
$op_pio_inherits[1]="Pioneer";
$op_pio_inherits[2]="inheritor";

//op_living
$op_living[""]="";
$op_living[1]="Staying in his own village and commuting to the mission field";
$op_living[2]="Rented House in Mission field";
$op_living[3]="Beliver's House";
$op_living[4]="Pastor's Home";
$op_living[5]="Friend's Home";
$op_living[6]="Paraents Home";
$op_living[7]="Parents Home";
$op_living[8]="Supervisor's House";

/// op_rec_fund 
$op_rec_fund[""]="";
$op_rec_fund[1]="Part time to full time";
$op_rec_fund[2]="Newly starting ministry";
$op_rec_fund[3]="Struggling for daily bread";
$op_rec_fund[4]="Commuter to residential missionary";
$op_rec_fund[5]="Support from another mission withdrawn";
$op_rec_fund[6]="Part time to full time & commuter to residential";
$op_rec_fund[7]="He was working in an another organisation now God guided him to this new area.";
$op_rec_fund[8]="Missionary is going to start the ministry.";
$op_rec_fund[9]="Support stopped from other organization";
$op_rec_fund[10]="For his survival. room rent, and for his travel expences";

///op_influence_factor
$op_influence_factor[""]="";
$op_influence_factor[1]="0-20%";
$op_influence_factor[2]="20-40%";
$op_influence_factor[3]="40-60%";
$op_influence_factor[4]="60-80%";
$op_influence_factor[5]="80-100%";

//op_coordinator
$op_coordinator[""]="";
$op_coordinator[1]="Aris Selvan";
$op_coordinator[2]="Pramanda Durga";
$op_coordinator[3]="Bikram Upadhay";
$op_coordinator[4]="Narendra Das";
$op_coordinator[5]="Joel Soloman";
$op_coordinator[6]="Binu Sekharan";
$op_coordinator[7]="Wilson";
$op_coordinator[8]="P C Mathew ";
$op_coordinator[9]="Suresh Kumar";
$op_coordinator[10]="Shaji Varghese";
$op_coordinator[11]="Santosh";
$op_coordinator[12]="Wilson Patole";
$op_coordinator[13]="M S Ramesh";
$op_coordinator[14]="Aneesh Mathew";
$op_coordinator[15]="Jobin Abraham";
$op_coordinator[16]="Babu Raj Thomson";
$op_coordinator[17]="Reji Samuel ";
$op_coordinator[18]="Gleetus Vincent";
$op_coordinator[19]="Ashok Sharma";
$op_coordinator[20]="David Wilson";
$op_coordinator[21]="Branton Philip";

//op_supervisor
$op_supervisor[""]="";
$op_supervisor[1]="Aris Selvan";
$op_supervisor[2]="Ajith Kumar Pani";
$op_supervisor[3]="Bikram Upadhay";
$op_supervisor[4]="Sunil Kumar Jangde";
$op_supervisor[5]="Dinesh Nirala";
$op_supervisor[6]="Jagadesh Kumar";
$op_supervisor[7]="Narendra Das";
$op_supervisor[8]="Amarnath Sreekanth Bai";
$op_supervisor[9]="Vasanth Solanki";
$op_supervisor[10]="Preamodpargigleetus ";
$op_supervisor[11]="Ravison";
$op_supervisor[12]="Anu Soman";
$op_supervisor[13]="Manubendra Digal";
$op_supervisor[14]="Prakash GK Gamaliel Kanakam";
$op_supervisor[15]="Wilson";
$op_supervisor[16]="Naveen Kumar";
$op_supervisor[17]="Anji Nandihalli";
$op_supervisor[18]="Shajan A R";
$op_supervisor[19]="Christen Raj";
$op_supervisor[20]="Salim Raj";
$op_supervisor[21]="Suresh Kumar";
$op_supervisor[22]="Jose Lazer";
$op_supervisor[23]="Christopher C Thampi";
$op_supervisor[24]="Shiva Charan";
$op_supervisor[25]="Jagatheesh Bamne";
$op_supervisor[26]="Santosh ";
$op_supervisor[27]="Amol Satish Valvi";
$op_supervisor[28]="Vikram Vasava";
$op_supervisor[29]="Ayub Digal";
$op_supervisor[30]="Nanki Badaik Sing";
$op_supervisor[31]="Girish Chandra Marandi";
$op_supervisor[32]="Nilambar Pangi";
$op_supervisor[33]="Ashish Kumar";
$op_supervisor[34]="A.K. Binoy";
$op_supervisor[35]="Ramesh Khadia";
$op_supervisor[36]="Sandeep Singh";
$op_supervisor[37]="Binu Vijayan";
$op_supervisor[38]="Christudas ";
$op_supervisor[39]="Anto Mathew M";
$op_supervisor[40]="Pharget/Parget Massih";
$op_supervisor[41]="Premraj ";
$op_supervisor[42]="Shijo Samuel";
$op_supervisor[43]="Stephen Masih";
$op_supervisor[44]="Molay Roy";
$op_supervisor[45]="Karan John";
$op_supervisor[46]="Massih Issaiah";
$op_supervisor[47]="Umesh Kumar";
$op_supervisor[48]="Amrithpal Singh";
$op_supervisor[49]="Arokya Das";
$op_supervisor[50]="Pramanda ";
$op_supervisor[51]="Aneesh Mathew";
$op_supervisor[52]="Jobin Abraham";
$op_supervisor[53]="Joseph Sankeshwar";
$op_supervisor[54]="Johen Kumar";
$op_supervisor[55]="Brijesh Kumar Singh";
$op_supervisor[56]="Shaji Mathew";
$op_supervisor[57]="Sujit Kumar Nayak";
$op_supervisor[58]="Suresh Rajan";
$op_supervisor[59]="Kalyan Nanda";
$op_supervisor[60]="Joseph Khristi";
$op_supervisor[61]="Monu Rawat";
$op_supervisor[62]="Samuel Stephen";
$op_supervisor[63]="Samuel Raj";
$op_supervisor[64]="Jagadeesh Bellomkonda";
$op_supervisor[65]="Thumala Pawankumar";
$op_supervisor[66]="Johnson Stephen";
$op_supervisor[67]="Bifan Lohara";
$op_supervisor[68]="Ashok Sharma";
$op_supervisor[69]="Digambar Pathode";
$op_supervisor[70]="Vipeen Rodge";
$op_supervisor[71]="Frankline Jose";
$op_supervisor[72]="Om Panth";
$op_supervisor[73]="David Wilson";
$op_supervisor[74]="Pradeep Kamble";
$op_supervisor[75]="Jitendra Kumar Bagha";
$op_supervisor[76]="Robert Benard";
$op_supervisor[77]="Finny George";
$op_supervisor[78]="John Singh";
$op_supervisor[79]="Meera Patil";
$op_supervisor[80]="Binu Gabriel";
$op_supervisor[81]="Dileep Kumar";
$op_supervisor[82]="Harash Kumar Anand";
$op_supervisor[83]="Dandu Vijaya Raju";
$op_supervisor[84]="Judson Abraham";
$op_supervisor[85]="Ravish Ronald";
$op_supervisor[86]="Amruta Rao";
$op_supervisor[87]="Ransay Bhagat";
$op_supervisor[88]="Eswara Rao";
$op_supervisor[89]="Akash Deep Acharjee";
$op_supervisor[90]="Firoj Tigga";
$op_supervisor[91]="Samuel C H";
$op_supervisor[92]="Purushottam Kumar";
$op_supervisor[93]="Rajkumar Dodiba Chowhan";
$op_supervisor[94]="Ghanshyam Hirawani";
$op_supervisor[95]="Firesh limma";

//op_account_cluster
$op_account_cluster[""]="";
$op_account_cluster[1]="Andhra Pradesh 1";
$op_account_cluster[2]="Tripura 1";
$op_account_cluster[3]="Odisha 1";
$op_account_cluster[4]="Assam 1";
$op_account_cluster[5]="Chhattisgarh 1";
$op_account_cluster[6]="Gujurat 1";
$op_account_cluster[7]="Jammu & Kashmir 1";
$op_account_cluster[8]="Punjab 1";
$op_account_cluster[9]="Karnataka 1";
$op_account_cluster[10]="Kerala 1";
$op_account_cluster[11]="Rajasthan 1";
$op_account_cluster[12]="Uttar Pradesh 4";
$op_account_cluster[13]="Madhya Pradesh 1";
$op_account_cluster[14]="Maharashtra 1";
$op_account_cluster[15]="Odisha 2";
$op_account_cluster[16]="Uttarakhand 1";
$op_account_cluster[17]="Uttar Pradesh 3";
$op_account_cluster[18]="Himachal Pradesh 1";
$op_account_cluster[19]="Tamil Nadu 1";
$op_account_cluster[20]="Andaman Nicobar 1";
$op_account_cluster[21]="Uttar Pradesh 1";
$op_account_cluster[22]="West Bengal 1";
$op_account_cluster[23]="Uttar Pradesh 2";
$op_account_cluster[24]="Delhi 1";
$op_account_cluster[25]="Maharashtra 2";

//op_cost_type
$op_cost_type[""]="";
$op_cost_type[1]="Community Development Programme";
$op_cost_type[2]="work support";
$op_cost_type[3]="Child welfare programme";
$op_cost_type[4]="Educational Assistance";
$op_cost_type[5]="Medical Assistance";
$op_cost_type[6]="Rehabilitation Programme";
$op_cost_type[7]="Economic Enhancement Project";
$op_cost_type[8]="Staff Honerarium";
$op_cost_type[9]="Social welfare program";
$op_cost_type[10]="Community Develp";
$op_cost_type[11]="Child welfare programe";
$op_cost_type[12]="Child welsfare Programme";
$op_cost_type[13]="Child Welfare Program";
$op_cost_type[14]="Community Development Program";
$op_cost_type[15]="Field Training";

//op_support_country
$op_support_country[""]="";
$op_support_country[1]="500k UK/Indiana/Arizona";
$op_support_country[2]="Costa Rica";
$op_support_country[3]="India (Cotton Hill Account)";
$op_support_country[4]="UAE";
$op_support_country[5]="Cash in hand";
$op_support_country[6]="Brazil";
$op_support_country[7]="Canada";
$op_support_country[8]="Panama (Pr Antonio church)";
$op_support_country[9]="Panama (Pr Mario church)";
$op_support_country[10]="USA (independent)";
$op_support_country[11]="Non-500k";

//op_lang
$op_lang[""]="";
$op_lang[1]="Read";
$op_lang[2]="Write";
$op_lang[3]="Read and Write";
$op_lang[4]="Read and Write - Not Proficient";
$op_lang[5]="Read and Write - Proficient";

//op_score
$op_score[""]="";
$op_score[1]="Very Poor";
$op_score[2]="Poor";
$op_score[3]="Moderate";
$op_score[4]="Good";
$op_score[5]="Very Good";


$op_yes_no[""]="";
$op_yes_no[1]="Yes";
$op_yes_no[2]="No";

$op_hw_fund_help_fw[""]="";
$op_hw_fund_help_fw[1]="It will enable the FW to do church planting work full time not part time";
$op_hw_fund_help_fw[2]="It will enable the FW to begin ministry in a new locaiton";
$op_hw_fund_help_fw[3]="It will enable the FW to live in his ministry location";
$op_hw_fund_help_fw[4]="It will remove unnecessary financial burdens so the FW will be under less pressure and be able to focus more on the church planting work";
$op_hw_fund_help_fw[5]="Support from another organisation removed";

$op_affiliated[""]="";
$op_affiliated[1]="Affiliated";
$op_affiliated[2]="Independent";

$op_language[""]="";
$op_language[1]="Bengali";
$op_language[2]="Marathi";
$op_language[3]="Telugu";
$op_language[4]="Tamil";
$op_language[5]="Gujarati";
$op_language[6]="Urdu";
$op_language[7]="Kannada";
$op_language[8]="Odia";
$op_language[9]="Malayalam";
$op_language[10]="Punjabi";
$op_language[11]="Sanskrit";








//print_r($op_BC_main);exit;


        /////// options ends //////////////////////

        $page_data['op_BC_main']=$op_BC_main;
        $page_data['op_DBC']=$op_DBC;
        $page_data['op_board']=$op_board;
        $page_data['op_fstatus']=$op_fstatus;
        $page_data['op_mf_type']=$op_mf_type;
        $page_data['op_pre_news']=$op_pre_news;
        $page_data['op_pio_inherits']=$op_pio_inherits;
        $page_data['op_living']=$op_living;
        $page_data['op_rec_fund']=$op_rec_fund;
        $page_data['op_influence_factor']=$op_influence_factor;
        $page_data['op_coordinator']=$op_coordinator;
        $page_data['op_supervisor']=$op_supervisor;
        $page_data['op_account_cluster']=$op_account_cluster;
        $page_data['op_cost_type']=$op_cost_type;
        $page_data['op_support_country']=$op_support_country;
        $page_data['op_lang']=$op_lang;
        $page_data['op_score']=$op_score;
        $page_data['op_yes_no']=$op_yes_no;
        $page_data['op_hw_fund_help_fw']=$op_hw_fund_help_fw;
        $page_data['op_affiliated']=$op_affiliated;
        $page_data['op_language']=$op_language;

        


        if($param1=="first")
        {
    
        ///////////////// page details ////////////////////////
                $this->load->view($page_data['css_file']);
                $this->load->view($page_data['top_menu']);
                $this->load->view( $page_data['side_menu'],$page_data);
                $this->load->view($page_data['page_name'],$page_data);
                $this->load->view('bk_cms/footer');
                $this->load->view($page_data['script_file']); 
        //////////////////// page details end ///////////////////
          }

          /////////////////////  add new second start  /////////////////////////

        else if($param1=="first1")
            {

                //$missionary_id=$param2;
               // echo "hi second";exit;

             // echo $param2;exit;
              $page_data["missionary_id"]=$param2;

              $page_data['page_title']="Add New Missionary";
              $page_data['form_heading']="Add FW Demographic Information";
              $page_data['table_heading']="Report List";
              $page_data['page_heading']="New Missionary";
                  


            $page_data['page_name']="backennd/mp_pannel/add_missionary_new";
            $page_data['top_menu']="bk_cms/top_menu";
            $page_data['css_file']="bk_cms/advance_form_css";
            $page_data['script_file']="bk_cms/advance_form_script";
            $page_data['side_menu']="backennd/mp_pannel/side_menu";
             $page_data['footer']='bk_cms/footer';

            ///////////////// page details ////////////////////////
                $this->load->view($page_data['css_file']);
                $this->load->view($page_data['top_menu']);
                $this->load->view( $page_data['side_menu'],$page_data);
                $this->load->view($page_data['page_name'],$page_data);
                $this->load->view('bk_cms/footer');
                $this->load->view($page_data['script_file']); 
            //////////////////// page details end ///////////////////

            }

      /////////////////////  add new second start  /////////////////////////

        else if($param1=="second")
            {

                //$missionary_id=$param2;
               // echo "hi second";exit;

             // echo $param2;exit;
              $page_data["missionary_id"]=$param2;

              $page_data['page_title']="Add New Missionary";
              $page_data['form_heading']="Add Ministry location details";
              $page_data['table_heading']="Report List";
              $page_data['page_heading']="New Missionary";
                  


            $page_data['page_name']="backennd/mp_pannel/add_missionary_second";
            $page_data['top_menu']="bk_cms/top_menu";
            $page_data['css_file']="bk_cms/advance_form_css";
            $page_data['script_file']="bk_cms/advance_form_script";
            $page_data['side_menu']="backennd/mp_pannel/side_menu";
             $page_data['footer']='bk_cms/footer';

            ///////////////// page details ////////////////////////
                $this->load->view($page_data['css_file']);
                $this->load->view($page_data['top_menu']);
                $this->load->view( $page_data['side_menu'],$page_data);
                $this->load->view($page_data['page_name'],$page_data);
                $this->load->view('bk_cms/footer');
                $this->load->view($page_data['script_file']); 
            //////////////////// page details end ///////////////////

            }




      /////////////////////  add new second end  /////////////////////////

            /////////////////////  add new third start  /////////////////////////

        else if($param1=="third")
            {

              $page_data["missionary_id"]=$param2;
               // echo "hi second";exit;

              $page_data['page_title']="Add New Missionary";
              $page_data['form_heading']="Add FW skills and Experience Details";              
              $page_data['page_heading']="New Missionary";
                  


            $page_data['page_name']="backennd/mp_pannel/add_missionary_third";
            $page_data['top_menu']="bk_cms/top_menu";
            $page_data['css_file']="bk_cms/advance_form_css";
            $page_data['script_file']="bk_cms/advance_form_script";
            $page_data['side_menu']="backennd/mp_pannel/side_menu";
             $page_data['footer']='bk_cms/footer';

            ///////////////// page details ////////////////////////
                $this->load->view($page_data['css_file']);
                $this->load->view($page_data['top_menu']);
                $this->load->view( $page_data['side_menu'],$page_data);
                $this->load->view($page_data['page_name'],$page_data);
                $this->load->view('bk_cms/footer');
                $this->load->view($page_data['script_file']); 
            //////////////////// page details end ///////////////////

            }

        else if($param1=="four")
            {

                 $page_data["missionary_id"]=$param2;
               // echo "hi second";exit;

              $page_data['page_title']="Add New Missionary";
              $page_data['form_heading']="Add Supervision";              
              $page_data['page_heading']="New Missionary";
                  


            $page_data['page_name']="backennd/mp_pannel/add_missionary_four";
            $page_data['top_menu']="bk_cms/top_menu";
            $page_data['css_file']="bk_cms/advance_form_css";
            $page_data['script_file']="bk_cms/advance_form_script";
            $page_data['side_menu']="backennd/mp_pannel/side_menu";
             $page_data['footer']='bk_cms/footer';

            ///////////////// page details ////////////////////////
                $this->load->view($page_data['css_file']);
                $this->load->view($page_data['top_menu']);
                $this->load->view( $page_data['side_menu'],$page_data);
                $this->load->view($page_data['page_name'],$page_data);
                $this->load->view('bk_cms/footer');
                $this->load->view($page_data['script_file']); 
            //////////////////// page details end ///////////////////

            }

          else if($param1=="five")
            {

                 $page_data["missionary_id"]=$param2;
               // echo "hi second";exit;

              $page_data['page_title']="Add New Missionary";
              $page_data['form_heading']="Add Reference";              
              $page_data['page_heading']="New Missionary";
                  


            $page_data['page_name']="backennd/mp_pannel/add_missionary_five";
            $page_data['top_menu']="bk_cms/top_menu";
            $page_data['css_file']="bk_cms/advance_form_css";
            $page_data['script_file']="bk_cms/advance_form_script";
            $page_data['side_menu']="backennd/mp_pannel/side_menu";
             $page_data['footer']='bk_cms/footer';

            ///////////////// page details ////////////////////////
                $this->load->view($page_data['css_file']);
                $this->load->view($page_data['top_menu']);
                $this->load->view( $page_data['side_menu'],$page_data);
                $this->load->view($page_data['page_name'],$page_data);
                $this->load->view('bk_cms/footer');
                $this->load->view($page_data['script_file']); 
            //////////////////// page details end ///////////////////

            }
            else if($param1=="six")
            {

                 $page_data["missionary_id"]=$param2;
               // echo "hi second";exit;

              $page_data['page_title']="Add New Missionary";
              $page_data['form_heading']="Add FW testimony";              
              $page_data['page_heading']="New Missionary";
                  


            $page_data['page_name']="backennd/mp_pannel/add_missionary_six";
            $page_data['top_menu']="bk_cms/top_menu";
            $page_data['css_file']="bk_cms/advance_form_css";
            $page_data['script_file']="bk_cms/advance_form_script";
            $page_data['side_menu']="backennd/mp_pannel/side_menu";
             $page_data['footer']='bk_cms/footer';

            ///////////////// page details ////////////////////////
                $this->load->view($page_data['css_file']);
                $this->load->view($page_data['top_menu']);
                $this->load->view( $page_data['side_menu'],$page_data);
                $this->load->view($page_data['page_name'],$page_data);
                $this->load->view('bk_cms/footer');
                $this->load->view($page_data['script_file']); 
            //////////////////// page details end ///////////////////

            }
         else if($param1=="seven")
            {

                 $page_data["missionary_id"]=$param2;
               // echo "hi second";exit;

              $page_data['page_title']="Add New Missionary";
              $page_data['form_heading']="Add FW Installation Cost";              
              $page_data['page_heading']="New Missionary";
                  


            $page_data['page_name']="backennd/mp_pannel/add_missionary_seven";
            $page_data['top_menu']="bk_cms/top_menu";
            $page_data['css_file']="bk_cms/advance_form_css";
            $page_data['script_file']="bk_cms/advance_form_script";
            $page_data['side_menu']="backennd/mp_pannel/side_menu";
             $page_data['footer']='bk_cms/footer';

            ///////////////// page details ////////////////////////
                $this->load->view($page_data['css_file']);
                $this->load->view($page_data['top_menu']);
                $this->load->view( $page_data['side_menu'],$page_data);
                $this->load->view($page_data['page_name'],$page_data);
                $this->load->view('bk_cms/footer');
                $this->load->view($page_data['script_file']); 
            //////////////////// page details end ///////////////////

            }



      /////////////////////  add new third end  /////////////////////////


                
            

    }
///////////////////////// Missionary list End ////////////////

    ///////////////// missionary profile start /////////////

       function missionary_profile($param1="")
    {

        $missionary_id=$param1;
        //echo $missionary_id;exit;

            ///// options starts ////

              $op_yes_no[1]="Yes";
              $op_yes_no[2]="No";

              $op_mf_type[1]="Village";
              $op_mf_type[2]="Town";
              $op_mf_type[3]="City";

              $op_hw_fund_help_fw[1]="It will enable the FW to do church planting work full time not part time";
              $op_hw_fund_help_fw[2]="It will enable the FW to begin ministry in a new locaiton";
              $op_hw_fund_help_fw[3]="It will enable the FW to live in his ministry location";
              $op_hw_fund_help_fw[4]="It will remove unnecessary financial burdens so the FW will be under less pressure and be able to focus more on the church planting work";
              $op_hw_fund_help_fw[5]="Support from another organisation removed";


              $op_BC_mains=$this->Aedr_model->get_row_by_id('bc_main','op_BC_main_id');

              $op_BC_main[""]="";

              foreach ($op_BC_mains as $id => $value) {
                $op_BC_main[$id]=$value['name'];
              }


              $op_affiliated[1]="Affiliated";
              $op_affiliated[2]="Independent";


              $op_language[1]="Bengali";
              $op_language[2]="Marathi";
              $op_language[3]="Telugu";
              $op_language[4]="Tamil";
              $op_language[5]="Gujarati";
              $op_language[6]="Urdu";
              $op_language[7]="Kannada";
              $op_language[8]="Odia";
              $op_language[9]="Malayalam";
              $op_language[10]="Punjabi";
              $op_language[11]="Sanskrit";


              $op_DBC[1]="Pentecostal";
              $op_DBC[2]="Evangelical";
              $op_DBC[3]="Inter Denominational";
              $op_DBC[4]="NCM";
              $op_DBC[5]="Christ for India";
              $op_DBC[6]="Baptist";
              $op_DBC[7]="NA";
              $op_DBC[8]="IET";
              $op_DBC[9]="Assembly Of God";
              $op_DBC[10]="IPC";
              $op_DBC[11]="Pentecost";
              $op_DBC[12]="life center";
              $op_DBC[13]="Sharon Fellowship";
              $op_DBC[14]="Sathya Veda Seminary, Trivandrum";
              $op_DBC[15]="ICT, SEVABHARATh";
              $op_DBC[16]="Anglican";
              $op_DBC[17]="Southern Asia Bible College";
              $op_DBC[18]="No";
              $op_DBC[19]="IGM";
              $op_DBC[20]="Beleivers Church";
              $op_DBC[21]="CFI";
              $op_DBC[22]="Bretheren";
              $op_DBC[23]="Independent";
              $op_DBC[24]="Sharon";
              $op_DBC[25]="Church of God";
              $op_DBC[26]="NCM";
              $op_DBC[27]="NOT Applicable";


            //// options end /////

              $page_data['op_yes_no']=$op_yes_no;
              $page_data['op_mf_type']=$op_mf_type;
              $page_data['op_hw_fund_help_fw']=$op_hw_fund_help_fw;
              $page_data['op_BC_main']=$op_BC_main;
              $page_data['op_affiliated']=$op_affiliated;
              $page_data['op_language']=$op_language;
              $page_data['op_DBC']=$op_DBC;



             
              $page_data['form_heading']="Upload Missionary list";
              $page_data['table_heading']="Missionaries List";
               $page_data['page_heading']="Missionarys";
              $page_data['err']="display: none";    

              $page_data['page_title']="Missionaries Profile";
              $page_data['css_file']="bk_cms/list_css";
              $page_data['page_name']="backennd/mp_pannel/missionary_profile";


           
            $page_data['top_menu']="bk_cms/top_menu";
            
            $page_data['script_file']="bk_cms/script";
             $page_data['side_menu']="backennd/mp_pannel/side_menu";
             $page_data['footer']='bk_cms/footer';
          
             $bread_crum[0]=array("link"=>base_url()."MP_Panel","name"=>"Missionary Partner Pannel","class"=>"active-trail active");
            $bread_crum[1]=array("link"=>base_url()."MP_Panel/missionaries","name"=>"Missionary List","class"=>"current");
            $page_data['bread_crums']=$bread_crum;

            $page_data['state_by_id']=$this->Aedr_model->get_row_by_id('state','state_id');
            $page_data['district_by_id']=$this->Aedr_model->get_row_by_id('district','district_id');

              $sql="select * from missionary_first where missionary_id=$missionary_id";

              $page_data['missionary_details1']=$this->Aedr_model->get_row_sql($sql);

              $page_data['profile_data']=$page_data['missionary_details1'];


              $sql="select * from missionary_second where missionary_id=$missionary_id";

              $missionary_details2=$this->Aedr_model->get_row_sql($sql);

              if($missionary_details2['is_fw_active_in_mf']==2)
              {
                $missionary_details2['desc_mf']="Not Applicable";
                $missionary_details2['mf_starting_date']="Not Applicable";
                $missionary_details2['tbaptized']="Not Applicable";
              }
              else
              {
                  $missionary_details2['mf_starting_date']=date('d-m-Y',strtotime($missionary_details2['mf_starting_date']));
              }

              $page_data['missionary_details2']=$missionary_details2;

              $sql="select * from missionary_third where missionary_id=$missionary_id";

              $page_data['missionary_details3']=$this->Aedr_model->get_row_sql($sql);

              $sql="select * from missionary_four where missionary_id=$missionary_id";

              $page_data['missionary_details4']=$this->Aedr_model->get_row_sql($sql);

              $sql="select * from missionary_five where missionary_id=$missionary_id";

              $page_data['missionary_details5']=$this->Aedr_model->get_row_sql($sql);

              $sql="select * from missionary_six where missionary_id=$missionary_id";

              $page_data['missionary_details6']=$this->Aedr_model->get_row_sql($sql);
              
              $sql="select * from missionary_seven where missionary_id=$missionary_id";

              $page_data['missionary_details7']=$this->Aedr_model->get_row_sql($sql);
              

              $page_data['missionary_id']=$missionary_id;

             //print_r($page_data['missionary_details2']);exit;

            





             ///////////////// page details ////////////////////////
                $this->load->view($page_data['css_file']);
                $this->load->view($page_data['top_menu']);
                $this->load->view( $page_data['side_menu'],$page_data);
                $this->load->view($page_data['page_name'],$page_data);
                $this->load->view('bk_cms/footer');
                $this->load->view($page_data['script_file']); 
  //////////////////// page details end ///////////////////




    }






    ///////////////// missionary profile end /////////////

    ///////////////  Missionary List  ///////////////////


function missionaries($param1 = '', $param2 = '' , $param3 = '')
    {

     

        //////////////// page setup /////////////        
          
              $page_data['page_title']="Missionaries";
              $page_data['form_heading']="Upload Missionary list";
              $page_data['table_heading']="Missionaries List";
               $page_data['page_heading']="Missionarys";
              $page_data['err']="display: none";    


            $page_data['page_name']="backennd/mp_pannel/missionary";
            $page_data['top_menu']="bk_cms/top_menu";
            $page_data['css_file']="bk_cms/list_form_css";
            $page_data['script_file']="bk_cms/script";
            $page_data['side_menu']="backennd/mp_pannel/side_menu";
             $page_data['footer']='bk_cms/footer';
          
             $bread_crum[0]=array("link"=>base_url()."MP_Panel/missionaries","name"=>"Missionary List","class"=>"active-trail active");
             $bread_crum[1]=array("link"=>base_url()."MP_Panel/add_missionary/first","name"=>"New Missionary","class"=>"current");
           
            $page_data['bread_crums']=$bread_crum;


     ///////////////////////  Data  //////////////////////
     
     $mp_id=$this->session->userdata("mp_id");

            $sql="select * from missionary_first mf,missionary_second as ms,missionary_six as mss where mp_id=$mp_id and ms.missionary_id=mf.missionary_id and mss.missionary_id=mf.missionary_id  order by fname";

      $page_data['missionaries_lists']=$this->Aedr_model->get_result_sql($sql);
    //  print_r(count($page_data['missionaries_lists']));exit;

      $page_data['state_by_id']=$this->Aedr_model->get_row_by_id('state','state_id');
      $page_data['district_by_id']=$this->Aedr_model->get_row_by_id('district','district_id');

      


    
        ///////////////// page details ////////////////////////
                $this->load->view($page_data['css_file']);
                $this->load->view($page_data['top_menu']);
                $this->load->view( $page_data['side_menu'],$page_data);
                $this->load->view($page_data['page_name'],$page_data);
                $this->load->view('bk_cms/footer');
                $this->load->view($page_data['script_file']); 
  //////////////////// page details end ///////////////////
            

    }
///////////////////////// Missionary list End ////////////////////*

///////////////// generate the application pdf starts///////////////////

 public function generate_fw_application($param1='')
    {
      $missionary_id=1;
        if($param1<=0)
        {
           redirect(base_url().'missionaries/','refresh');
        }
        else
        {
          $missionary_id=$param1;
        }

          /////////// option data start ////////////////////////

          $op_yes_no[1]="Yes";
              $op_yes_no[2]="No";

              $op_mf_type[1]="Village";
              $op_mf_type[2]="Town";
              $op_mf_type[3]="City";

              $op_hw_fund_help_fw[1]="It will enable the FW to do church planting work full time not part time";
              $op_hw_fund_help_fw[2]="It will enable the FW to begin ministry in a new locaiton";
              $op_hw_fund_help_fw[3]="It will enable the FW to live in his ministry location";
              $op_hw_fund_help_fw[4]="It will remove unnecessary financial burdens so the FW will be under less pressure and be able to focus more on the church planting work";
              $op_hw_fund_help_fw[5]="Support from another organisation removed";

              $op_BC_mains=$this->Aedr_model->get_row_by_id('bc_main','op_BC_main_id');

                $op_BC_main[""]="";

                foreach ($op_BC_mains as $id => $value) {
                  $op_BC_main[$id]=$value['name'];
                }


              


              $op_affiliated[1]="Affiliated";
              $op_affiliated[2]="Independent";


              $op_language[1]="Bengali";
              $op_language[2]="Marathi";
              $op_language[3]="Telugu";
              $op_language[4]="Tamil";
              $op_language[5]="Gujarati";
              $op_language[6]="Urdu";
              $op_language[7]="Kannada";
              $op_language[8]="Odia";
              $op_language[9]="Malayalam";
              $op_language[10]="Punjabi";
              $op_language[11]="Sanskrit";


              $op_DBC[1]="Pentecostal";
              $op_DBC[2]="Evangelical";
              $op_DBC[3]="Inter Denominational";
              $op_DBC[4]="NCM";
              $op_DBC[5]="Christ for India";
              $op_DBC[6]="Baptist";
              $op_DBC[7]="NA";
              $op_DBC[8]="IET";
              $op_DBC[9]="Assembly Of God";
              $op_DBC[10]="IPC";
              $op_DBC[11]="Pentecost";
              $op_DBC[12]="life center";
              $op_DBC[13]="Sharon Fellowship";
              $op_DBC[14]="Sathya Veda Seminary, Trivandrum";
              $op_DBC[15]="ICT, SEVABHARATh";
              $op_DBC[16]="Anglican";
              $op_DBC[17]="Southern Asia Bible College";
              $op_DBC[18]="No";
              $op_DBC[19]="IGM";
              $op_DBC[20]="Beleivers Church";
              $op_DBC[21]="CFI";
              $op_DBC[22]="Bretheren";
              $op_DBC[23]="Independent";
              $op_DBC[24]="Sharon";
              $op_DBC[25]="Church of God";
              $op_DBC[26]="NCM";
              $op_DBC[27]="NOT Applicable";


            //// options end /////

              $data['op_yes_no']=$op_yes_no;
              $data['op_mf_type']=$op_mf_type;
              $data['op_hw_fund_help_fw']=$op_hw_fund_help_fw;
              $data['op_BC_main']=$op_BC_main;
              $data['op_affiliated']=$op_affiliated;
              $data['op_language']=$op_language;
              $data['op_DBC']=$op_DBC;




          /////////// option data end ////////////////////////


              $data['state_by_id']=$this->Aedr_model->get_row_by_id('state','state_id');

              $sql="select * from missionary_first where missionary_id=$missionary_id";

              $data['missionary_details1']=$this->Aedr_model->get_row_sql($sql);

              $data['profile_data']=$page_data['missionary_details1'];


              $sql="select * from missionary_second where missionary_id=$missionary_id";

              $missionary_details2=$this->Aedr_model->get_row_sql($sql);

              if($missionary_details2['is_fw_active_in_mf']==2)
              {
                $missionary_details2['desc_mf']="Not Applicable";
                $missionary_details2['mf_starting_date']="Not Applicable";
                $missionary_details2['tbaptized']="Not Applicable";
              }
              else
              {
                  $missionary_details2['mf_starting_date']=date('d-m-Y',strtotime($missionary_details2['mf_starting_date']));
              }

              $data['missionary_details2']=$missionary_details2;

              $sql="select * from missionary_third where missionary_id=$missionary_id";

              $data['missionary_details3']=$this->Aedr_model->get_row_sql($sql);

              $sql="select * from missionary_four where missionary_id=$missionary_id";

              $data['missionary_details4']=$this->Aedr_model->get_row_sql($sql);

              $sql="select * from missionary_five where missionary_id=$missionary_id";

              $data['missionary_details5']=$this->Aedr_model->get_row_sql($sql);

              $sql="select * from missionary_six where missionary_id=$missionary_id";

              $data['missionary_details6']=$this->Aedr_model->get_row_sql($sql);
              
               $sql="select * from missionary_seven where missionary_id=$missionary_id";

              $data['missionary_details7']=$this->Aedr_model->get_row_sql($sql);


    //////// generate the pdf start /////

            //print_r($page_data['missionary_details7']);exit;

         $this->load->library('Pdf');
        $html = $this->load->view('fw_application', $data, true);
       $this->pdf->createPDF($html, $filename, false);


    //////////generate the pdf end ///////////


   }

///////////////// generate the application pdf ends///////////////////

   function fetch_district($param1='')
 {


  $state_id=$param1;

   //echo $topic_id;
 


   $sql="select * from district where state_id=$state_id";
    $rsts=$this->Aedr_model->get_result_sql($sql);
  $output ='<option value="0">Select District</option>';
  //  print_r($rst);

    foreach ($rsts as $rst) {
     $output .= '<option value="'.$rst['district_id'].'">'.$rst['name'].'</option>';
    }
  print_r($output);
 }

///////////////  Missionary Edit start  ///////////////////
function edit_missionary($param1='',$param2='')
    {

     
        //////////////// page setup /////////////        
          
              $page_data['page_title']="edit New Missionary";
              $page_data['form_heading']="Missionary Partners Details";
              $page_data['table_heading']="Report List";
               $page_data['page_heading']="New Missionary";
              $page_data['err']="display: none";    


            $page_data['page_name']="backennd/mp_pannel/edit_missionary_first";
            $page_data['top_menu']="bk_cms/top_menu";
            $page_data['css_file']="bk_cms/advance_form_css";
            $page_data['script_file']="bk_cms/advance_form_script";
            $page_data['side_menu']="backennd/mp_pannel/side_menu";
             $page_data['footer']='bk_cms/footer';
          
             $bread_crum[0]=array("link"=>base_url()."MP_Panel","name"=>"Missionary Partner","class"=>"active-trail active");
            $bread_crum[1]=array("link"=>base_url()."MP_Panel/edit_missionary","name"=>"New Missionary","class"=>"current");
            $page_data['bread_crums']=$bread_crum;


     ///////////////////////  Data  //////////////////////

            $sql="select * from state order by name";

      $page_data['states']=$this->Aedr_model->get_result_sql($sql);


        $sql="select * from district order by name";
      $page_data['districts']=$this->Aedr_model->get_result_sql($sql);



       

      // print_r($page_data['missionaries_lists']);exit;

      $page_data['state_by_id']=$this->Aedr_model->get_row_by_id('state','state_id');

      //$page_data['district_by_id']=$this->Aedr_model->get_row_by_id('district','district_id');

       
        /////// options starts //////////////////////

        
//$op_BC_main//////////////////
      $op_BC_mains=$this->Aedr_model->get_row_by_id('bc_main','op_BC_main_id');

      $op_BC_main[""]="";

      foreach ($op_BC_mains as $id => $value) {
        $op_BC_main[$id]=$value['name'];
      }
//op_DBC

$op_DBC[1]="Pentecostal";
$op_DBC[2]="Evangelical";
$op_DBC[3]="Inter Denominational";
$op_DBC[4]="NCM";
$op_DBC[5]="Christ for India";
$op_DBC[6]="Baptist";
$op_DBC[7]="NA";
$op_DBC[8]="IET";
$op_DBC[9]="Assembly Of God";
$op_DBC[10]="IPC";
$op_DBC[11]="Pentecost";
$op_DBC[12]="life center";
$op_DBC[13]="Sharon Fellowship";
$op_DBC[14]="Sathya Veda Seminary, Trivandrum";
$op_DBC[15]="ICT, SEVABHARATh";
$op_DBC[16]="Anglican";
$op_DBC[17]="Southern Asia Bible College";
$op_DBC[18]="No";
$op_DBC[19]="IGM";
$op_DBC[20]="Beleivers Church";
$op_DBC[21]="CFI";
$op_DBC[22]="Bretheren";
$op_DBC[23]="Independent";
$op_DBC[24]="Sharon";
$op_DBC[25]="Church of God";
$op_DBC[26]="NCM";

//op_board
$op_board[1]="NCM";
$op_board[2]="AG";
$op_board[3]="Harvest";
$op_board[4]="Other";

//$op_fstatus
$op_fstatus[2]="Married- no children";
$op_fstatus[3]="Widower / Widow";
$op_fstatus[4]="Married- with children";
$op_fstatus[5]="Widower / Widow - with children";

//op_mf_type
$op_mf_type[1]="Village";
$op_mf_type[2]="Town";
$op_mf_type[3]="City";

//op_pre_news
$op_pre_news[1]="Pre-existing";
$op_pre_news[2]="NewStarter";

//op_pio_inherits
$op_pio_inherits[1]="Pioneer";
$op_pio_inherits[2]="inheritor";

//op_living
$op_living[1]="Staying in his own village and commuting to the mission field";
$op_living[2]="Rented House in Mission field";
$op_living[3]="Beliver's House";
$op_living[4]="Pastor's Home";
$op_living[5]="Friend's Home";
$op_living[6]="Paraents Home";
$op_living[7]="Parents Home";
$op_living[8]="Supervisor's House";

/// op_rec_fund 

$op_rec_fund[1]="Part time to full time";
$op_rec_fund[2]="Newly starting ministry";
$op_rec_fund[3]="Struggling for daily bread";
$op_rec_fund[4]="Commuter to residential missionary";
$op_rec_fund[5]="Support from another mission withdrawn";
$op_rec_fund[6]="Part time to full time & commuter to residential";
$op_rec_fund[7]="He was working in an another organisation now God guided him to this new area.";
$op_rec_fund[8]="Missionary is going to start the ministry.";
$op_rec_fund[9]="Support stopped from other organization";
$op_rec_fund[10]="For his survival. room rent, and for his travel expences";

///op_influence_factor

$op_influence_factor[1]="0-20%";
$op_influence_factor[2]="20-40%";
$op_influence_factor[3]="40-60%";
$op_influence_factor[4]="60-80%";
$op_influence_factor[5]="80-100%";

//op_coordinator
$op_coordinator[1]="Aris Selvan";
$op_coordinator[2]="Pramanda Durga";
$op_coordinator[3]="Bikram Upadhay";
$op_coordinator[4]="Narendra Das";
$op_coordinator[5]="Joel Soloman";
$op_coordinator[6]="Binu Sekharan";
$op_coordinator[7]="Wilson";
$op_coordinator[8]="P C Mathew ";
$op_coordinator[9]="Suresh Kumar";
$op_coordinator[10]="Shaji Varghese";
$op_coordinator[11]="Santosh";
$op_coordinator[12]="Wilson Patole";
$op_coordinator[13]="M S Ramesh";
$op_coordinator[14]="Aneesh Mathew";
$op_coordinator[15]="Jobin Abraham";
$op_coordinator[16]="Babu Raj Thomson";
$op_coordinator[17]="Reji Samuel ";
$op_coordinator[18]="Gleetus Vincent";
$op_coordinator[19]="Ashok Sharma";
$op_coordinator[20]="David Wilson";
$op_coordinator[21]="Branton Philip";

//op_supervisor
$op_supervisor[1]="Aris Selvan";
$op_supervisor[2]="Ajith Kumar Pani";
$op_supervisor[3]="Bikram Upadhay";
$op_supervisor[4]="Sunil Kumar Jangde";
$op_supervisor[5]="Dinesh Nirala";
$op_supervisor[6]="Jagadesh Kumar";
$op_supervisor[7]="Narendra Das";
$op_supervisor[8]="Amarnath Sreekanth Bai";
$op_supervisor[9]="Vasanth Solanki";
$op_supervisor[10]="Preamodpargigleetus ";
$op_supervisor[11]="Ravison";
$op_supervisor[12]="Anu Soman";
$op_supervisor[13]="Manubendra Digal";
$op_supervisor[14]="Prakash GK Gamaliel Kanakam";
$op_supervisor[15]="Wilson";
$op_supervisor[16]="Naveen Kumar";
$op_supervisor[17]="Anji Nandihalli";
$op_supervisor[18]="Shajan A R";
$op_supervisor[19]="Christen Raj";
$op_supervisor[20]="Salim Raj";
$op_supervisor[21]="Suresh Kumar";
$op_supervisor[22]="Jose Lazer";
$op_supervisor[23]="Christopher C Thampi";
$op_supervisor[24]="Shiva Charan";
$op_supervisor[25]="Jagatheesh Bamne";
$op_supervisor[26]="Santosh ";
$op_supervisor[27]="Amol Satish Valvi";
$op_supervisor[28]="Vikram Vasava";
$op_supervisor[29]="Ayub Digal";
$op_supervisor[30]="Nanki Badaik Sing";
$op_supervisor[31]="Girish Chandra Marandi";
$op_supervisor[32]="Nilambar Pangi";
$op_supervisor[33]="Ashish Kumar";
$op_supervisor[34]="A.K. Binoy";
$op_supervisor[35]="Ramesh Khadia";
$op_supervisor[36]="Sandeep Singh";
$op_supervisor[37]="Binu Vijayan";
$op_supervisor[38]="Christudas ";
$op_supervisor[39]="Anto Mathew M";
$op_supervisor[40]="Pharget/Parget Massih";
$op_supervisor[41]="Premraj ";
$op_supervisor[42]="Shijo Samuel";
$op_supervisor[43]="Stephen Masih";
$op_supervisor[44]="Molay Roy";
$op_supervisor[45]="Karan John";
$op_supervisor[46]="Massih Issaiah";
$op_supervisor[47]="Umesh Kumar";
$op_supervisor[48]="Amrithpal Singh";
$op_supervisor[49]="Arokya Das";
$op_supervisor[50]="Pramanda ";
$op_supervisor[51]="Aneesh Mathew";
$op_supervisor[52]="Jobin Abraham";
$op_supervisor[53]="Joseph Sankeshwar";
$op_supervisor[54]="Johen Kumar";
$op_supervisor[55]="Brijesh Kumar Singh";
$op_supervisor[56]="Shaji Mathew";
$op_supervisor[57]="Sujit Kumar Nayak";
$op_supervisor[58]="Suresh Rajan";
$op_supervisor[59]="Kalyan Nanda";
$op_supervisor[60]="Joseph Khristi";
$op_supervisor[61]="Monu Rawat";
$op_supervisor[62]="Samuel Stephen";
$op_supervisor[63]="Samuel Raj";
$op_supervisor[64]="Jagadeesh Bellomkonda";
$op_supervisor[65]="Thumala Pawankumar";
$op_supervisor[66]="Johnson Stephen";
$op_supervisor[67]="Bifan Lohara";
$op_supervisor[68]="Ashok Sharma";
$op_supervisor[69]="Digambar Pathode";
$op_supervisor[70]="Vipeen Rodge";
$op_supervisor[71]="Frankline Jose";
$op_supervisor[72]="Om Panth";
$op_supervisor[73]="David Wilson";
$op_supervisor[74]="Pradeep Kamble";
$op_supervisor[75]="Jitendra Kumar Bagha";
$op_supervisor[76]="Robert Benard";
$op_supervisor[77]="Finny George";
$op_supervisor[78]="John Singh";
$op_supervisor[79]="Meera Patil";
$op_supervisor[80]="Binu Gabriel";
$op_supervisor[81]="Dileep Kumar";
$op_supervisor[82]="Harash Kumar Anand";
$op_supervisor[83]="Dandu Vijaya Raju";
$op_supervisor[84]="Judson Abraham";
$op_supervisor[85]="Ravish Ronald";
$op_supervisor[86]="Amruta Rao";
$op_supervisor[87]="Ransay Bhagat";
$op_supervisor[88]="Eswara Rao";
$op_supervisor[89]="Akash Deep Acharjee";
$op_supervisor[90]="Firoj Tigga";
$op_supervisor[91]="Samuel C H";
$op_supervisor[92]="Purushottam Kumar";
$op_supervisor[93]="Rajkumar Dodiba Chowhan";
$op_supervisor[94]="Ghanshyam Hirawani";
$op_supervisor[95]="Firesh limma";

//op_account_cluster

$op_account_cluster[1]="Andhra Pradesh 1";
$op_account_cluster[2]="Tripura 1";
$op_account_cluster[3]="Odisha 1";
$op_account_cluster[4]="Assam 1";
$op_account_cluster[5]="Chhattisgarh 1";
$op_account_cluster[6]="Gujurat 1";
$op_account_cluster[7]="Jammu & Kashmir 1";
$op_account_cluster[8]="Punjab 1";
$op_account_cluster[9]="Karnataka 1";
$op_account_cluster[10]="Kerala 1";
$op_account_cluster[11]="Rajasthan 1";
$op_account_cluster[12]="Uttar Pradesh 4";
$op_account_cluster[13]="Madhya Pradesh 1";
$op_account_cluster[14]="Maharashtra 1";
$op_account_cluster[15]="Odisha 2";
$op_account_cluster[16]="Uttarakhand 1";
$op_account_cluster[17]="Uttar Pradesh 3";
$op_account_cluster[18]="Himachal Pradesh 1";
$op_account_cluster[19]="Tamil Nadu 1";
$op_account_cluster[20]="Andaman Nicobar 1";
$op_account_cluster[21]="Uttar Pradesh 1";
$op_account_cluster[22]="West Bengal 1";
$op_account_cluster[23]="Uttar Pradesh 2";
$op_account_cluster[24]="Delhi 1";
$op_account_cluster[25]="Maharashtra 2";

//op_cost_type

$op_cost_type[1]="Community Development Programme";
$op_cost_type[2]="work support";
$op_cost_type[3]="Child welfare programme";
$op_cost_type[4]="Educational Assistance";
$op_cost_type[5]="Medical Assistance";
$op_cost_type[6]="Rehabilitation Programme";
$op_cost_type[7]="Economic Enhancement Project";
$op_cost_type[8]="Staff Honerarium";
$op_cost_type[9]="Social welfare program";
$op_cost_type[10]="Community Develp";
$op_cost_type[11]="Child welfare programe";
$op_cost_type[12]="Child welsfare Programme";
$op_cost_type[13]="Child Welfare Program";
$op_cost_type[14]="Community Development Program";
$op_cost_type[15]="Field Training";

//op_support_country
$op_support_country[1]="500k UK/Indiana/Arizona";
$op_support_country[2]="Costa Rica";
$op_support_country[3]="India (Cotton Hill Account)";
$op_support_country[4]="UAE";
$op_support_country[5]="Cash in hand";
$op_support_country[6]="Brazil";
$op_support_country[7]="Canada";
$op_support_country[8]="Panama (Pr Antonio church)";
$op_support_country[9]="Panama (Pr Mario church)";
$op_support_country[10]="USA (independent)";
$op_support_country[11]="Non-500k";

//op_lang

$op_lang[1]="Read";
$op_lang[2]="Write";
$op_lang[3]="Read and Write";
$op_lang[4]="Read and Write - Not Proficient";
$op_lang[5]="Read and Write - Proficient";

//op_score
$op_score[1]="Very Poor";
$op_score[2]="Poor";
$op_score[3]="Moderate";
$op_score[4]="Good";
$op_score[5]="Very Good";

$op_yes_no[1]="Yes";
$op_yes_no[2]="No";

$op_hw_fund_help_fw[1]="It will enable the FW to do church planting work full time not part time";
$op_hw_fund_help_fw[2]="It will enable the FW to begin ministry in a new locaiton";
$op_hw_fund_help_fw[3]="It will enable the FW to live in his ministry location";
$op_hw_fund_help_fw[4]="It will remove unnecessary financial burdens so the FW will be under less pressure and be able to focus more on the church planting work";
$op_hw_fund_help_fw[5]="Support from another organisation removed";


$op_affiliated[1]="Affiliated";
$op_affiliated[2]="Independent";


$op_language[1]="Bengali";
$op_language[2]="Marathi";
$op_language[3]="Telugu";
$op_language[4]="Tamil";
$op_language[5]="Gujarati";
$op_language[6]="Urdu";
$op_language[7]="Kannada";
$op_language[8]="Odia";
$op_language[9]="Malayalam";
$op_language[10]="Punjabi";
$op_language[11]="Sanskrit";








//print_r($op_BC_main);exit;


        /////// options ends //////////////////////

        $page_data['op_BC_main']=$op_BC_main;
        $page_data['op_DBC']=$op_DBC;
        $page_data['op_board']=$op_board;
        $page_data['op_fstatus']=$op_fstatus;
        $page_data['op_mf_type']=$op_mf_type;
        $page_data['op_pre_news']=$op_pre_news;
        $page_data['op_pio_inherits']=$op_pio_inherits;
        $page_data['op_living']=$op_living;
        $page_data['op_rec_fund']=$op_rec_fund;
        $page_data['op_influence_factor']=$op_influence_factor;
        $page_data['op_coordinator']=$op_coordinator;
        $page_data['op_supervisor']=$op_supervisor;
        $page_data['op_account_cluster']=$op_account_cluster;
        $page_data['op_cost_type']=$op_cost_type;
        $page_data['op_support_country']=$op_support_country;
        $page_data['op_lang']=$op_lang;
        $page_data['op_score']=$op_score;
        $page_data['op_yes_no']=$op_yes_no;
        $page_data['op_hw_fund_help_fw']=$op_hw_fund_help_fw;
        $page_data['op_affiliated']=$op_affiliated;
        $page_data['op_language']=$op_language;

        


        if($param1=="first")
        {

      $missionary_id=$param2;
      $sql="select * from missionary_first where missionary_id=".$missionary_id;
      $page_data['edit_data']=$this->Aedr_model->get_row_sql($sql);
      //print_r($page_data['edit_data']);exit;

        ///////////////// page details ////////////////////////
                $this->load->view($page_data['css_file']);
                $this->load->view($page_data['top_menu']);
                $this->load->view( $page_data['side_menu'],$page_data);
                $this->load->view($page_data['page_name'],$page_data);
                $this->load->view('bk_cms/footer');
                $this->load->view($page_data['script_file']); 
        //////////////////// page details end ///////////////////
          }

          /////////////////////  edit new second start  /////////////////////////

        else if($param1=="first1")
            {

                $missionary_id=$param2;
                $sql="select * from missionary_first where missionary_id=".$missionary_id;

      $page_data['edit_data']=$this->Aedr_model->get_row_sql($sql);
     //print_r($_POST);exit;
                //$missionary_id=$param2;
               // echo "hi second";exit;

             // echo $param2;exit;
              $page_data["missionary_id"]=$param2;

              $page_data['page_title']="edit New Missionary";
              $page_data['form_heading']="edit FW Demographic Information";
              $page_data['table_heading']="Report List";
              $page_data['page_heading']="New Missionary";
                  


            $page_data['page_name']="backennd/mp_pannel/edit_missionary_new";
            $page_data['top_menu']="bk_cms/top_menu";
            $page_data['css_file']="bk_cms/advance_form_css";
            $page_data['script_file']="bk_cms/advance_form_script";
            $page_data['side_menu']="backennd/mp_pannel/side_menu";
             $page_data['footer']='bk_cms/footer';

            ///////////////// page details ////////////////////////
                $this->load->view($page_data['css_file']);
                $this->load->view($page_data['top_menu']);
                $this->load->view( $page_data['side_menu'],$page_data);
                $this->load->view($page_data['page_name'],$page_data);
                $this->load->view('bk_cms/footer');
                $this->load->view($page_data['script_file']); 
            //////////////////// page details end ///////////////////

            }

      /////////////////////  edit new second start  /////////////////////////

        else if($param1=="second")
            {

              $missionary_id=$param2;
              $sql="select * from missionary_second where missionary_id=".$missionary_id;

              $page_data['edit_data']=$this->Aedr_model->get_row_sql($sql);

              //print_r($page_data['edit_data']);exit;
                
              $page_data["missionary_id"]=$param2;

              $page_data['page_title']="edit New Missionary";
              $page_data['form_heading']="edit Ministry location details";
              $page_data['table_heading']="Report List";
              $page_data['page_heading']="New Missionary";
                  


            $page_data['page_name']="backennd/mp_pannel/edit_missionary_second";
            $page_data['top_menu']="bk_cms/top_menu";
            $page_data['css_file']="bk_cms/advance_form_css";
            $page_data['script_file']="bk_cms/advance_form_script";
            $page_data['side_menu']="backennd/mp_pannel/side_menu";
             $page_data['footer']='bk_cms/footer';

            ///////////////// page details ////////////////////////
                $this->load->view($page_data['css_file']);
                $this->load->view($page_data['top_menu']);
                $this->load->view( $page_data['side_menu'],$page_data);
                $this->load->view($page_data['page_name'],$page_data);
                $this->load->view('bk_cms/footer');
                $this->load->view($page_data['script_file']); 
            //////////////////// page details end ///////////////////

            }




      /////////////////////  edit new second end  /////////////////////////

            /////////////////////  edit new third start  /////////////////////////

        else if($param1=="third")
            {

              $missionary_id=$param2;
              $sql="select * from missionary_third where missionary_id=".$missionary_id;

              $page_data['edit_data']=$this->Aedr_model->get_row_sql($sql);

             //print_r($page_data['edit_data']);exit;
                
              
              $page_data["missionary_id"]=$param2;
               // echo "hi second";exit;

              $page_data['page_title']="edit New Missionary";
              $page_data['form_heading']="edit FW skills and Experience Details";              
              $page_data['page_heading']="New Missionary";
                  


            $page_data['page_name']="backennd/mp_pannel/edit_missionary_third";
            $page_data['top_menu']="bk_cms/top_menu";
            $page_data['css_file']="bk_cms/advance_form_css";
            $page_data['script_file']="bk_cms/advance_form_script";
            $page_data['side_menu']="backennd/mp_pannel/side_menu";
             $page_data['footer']='bk_cms/footer';

            ///////////////// page details ////////////////////////
                $this->load->view($page_data['css_file']);
                $this->load->view($page_data['top_menu']);
                $this->load->view( $page_data['side_menu'],$page_data);
                $this->load->view($page_data['page_name'],$page_data);
                $this->load->view('bk_cms/footer');
                $this->load->view($page_data['script_file']); 
            //////////////////// page details end ///////////////////

            }

        else if($param1=="four")
            {
                $missionary_id=$param2;
                $sql="select * from missionary_four where missionary_id=".$missionary_id;

                $page_data['edit_data']=$this->Aedr_model->get_row_sql($sql);
                 $page_data["missionary_id"]=$param2;
               // echo "hi second";exit;

                // print_r($page_data['edit_data']);exit;

              $page_data['page_title']="edit New Missionary";
              $page_data['form_heading']="edit Supervision";              
              $page_data['page_heading']="New Missionary";
                  


            $page_data['page_name']="backennd/mp_pannel/edit_missionary_four";
            $page_data['top_menu']="bk_cms/top_menu";
            $page_data['css_file']="bk_cms/advance_form_css";
            $page_data['script_file']="bk_cms/advance_form_script";
            $page_data['side_menu']="backennd/mp_pannel/side_menu";
             $page_data['footer']='bk_cms/footer';

            ///////////////// page details ////////////////////////
                $this->load->view($page_data['css_file']);
                $this->load->view($page_data['top_menu']);
                $this->load->view( $page_data['side_menu'],$page_data);
                $this->load->view($page_data['page_name'],$page_data);
                $this->load->view('bk_cms/footer');
                $this->load->view($page_data['script_file']); 
            //////////////////// page details end ///////////////////

            }

          else if($param1=="five")
            {

                 $missionary_id=$param2;
                $sql="select * from missionary_five where missionary_id=".$missionary_id;

                $page_data['edit_data']=$this->Aedr_model->get_row_sql($sql);
                 $page_data["missionary_id"]=$param2;

              $page_data['page_title']="edit New Missionary";
              $page_data['form_heading']="edit Reference";              
              $page_data['page_heading']="New Missionary";
                  
              //print_r($page_data['edit_data']);exit;

            $page_data['page_name']="backennd/mp_pannel/edit_missionary_five";
            $page_data['top_menu']="bk_cms/top_menu";
            $page_data['css_file']="bk_cms/advance_form_css";
            $page_data['script_file']="bk_cms/advance_form_script";
            $page_data['side_menu']="backennd/mp_pannel/side_menu";
             $page_data['footer']='bk_cms/footer';

            ///////////////// page details ////////////////////////
                $this->load->view($page_data['css_file']);
                $this->load->view($page_data['top_menu']);
                $this->load->view( $page_data['side_menu'],$page_data);
                $this->load->view($page_data['page_name'],$page_data);
                $this->load->view('bk_cms/footer');
                $this->load->view($page_data['script_file']); 
            //////////////////// page details end ///////////////////

            }
            else if($param1=="six")
            {

                 $missionary_id=$param2;
                $sql="select * from missionary_six where missionary_id=".$missionary_id;

                $page_data['edit_data']=$this->Aedr_model->get_row_sql($sql);
                 $page_data["missionary_id"]=$param2;
               // echo "hi second";exit;

              $page_data['page_title']="edit New Missionary";
              $page_data['form_heading']="edit FW testimony";              
              $page_data['page_heading']="New Missionary";
                  
            //  print_r($page_data['edit_data']);exit;

            $page_data['page_name']="backennd/mp_pannel/edit_missionary_six";
            $page_data['top_menu']="bk_cms/top_menu";
            $page_data['css_file']="bk_cms/advance_form_css";
            $page_data['script_file']="bk_cms/advance_form_script";
            $page_data['side_menu']="backennd/mp_pannel/side_menu";
             $page_data['footer']='bk_cms/footer';

            ///////////////// page details ////////////////////////
                $this->load->view($page_data['css_file']);
                $this->load->view($page_data['top_menu']);
                $this->load->view( $page_data['side_menu'],$page_data);
                $this->load->view($page_data['page_name'],$page_data);
                $this->load->view('bk_cms/footer');
                $this->load->view($page_data['script_file']); 
            //////////////////// page details end ///////////////////

            }
            else if($param1=="seven")
            {

                 $missionary_id=$param2;
                $sql="select * from missionary_seven where missionary_id=".$missionary_id;

                $page_data['edit_data']=$this->Aedr_model->get_row_sql($sql);
                 $page_data["missionary_id"]=$param2;
               // echo "hi second";exit;

              $page_data['page_title']="edit New Missionary";
              $page_data['form_heading']="edit FW testimony";              
              $page_data['page_heading']="New Missionary";
                  

          //    print_r($page_data['edit_data']);exit;
            $page_data['page_name']="backennd/mp_pannel/edit_missionary_seven";
            $page_data['top_menu']="bk_cms/top_menu";
            $page_data['css_file']="bk_cms/advance_form_css";
            $page_data['script_file']="bk_cms/advance_form_script";
            $page_data['side_menu']="backennd/mp_pannel/side_menu";
             $page_data['footer']='bk_cms/footer';

            ///////////////// page details ////////////////////////
                $this->load->view($page_data['css_file']);
                $this->load->view($page_data['top_menu']);
                $this->load->view( $page_data['side_menu'],$page_data);
                $this->load->view($page_data['page_name'],$page_data);
                $this->load->view('bk_cms/footer');
                $this->load->view($page_data['script_file']); 
            //////////////////// page details end ///////////////////

            }




      /////////////////////  edit new third end  /////////////////////////


                
            

    }
///////////////////////// Missionary Edit End ////////////////


////////// update missionary details start  ///////////////////////

 function update_missionary($param1="")
    {
    //  print_r($_POST);exit;

      if($param1=="first")
      {
        //print_r($this->session->userdata());exit;
        $missionary_id=$_POST['missionary_id'];
        $update=$_POST;
        
        $where ="missionary_id=".$missionary_id;
        $this->Aedr_model->update('missionary_first',$where,$update);

        redirect(base_url().'MP_Panel/missionary_profile/'.$missionary_id,'refresh');
         
      }
      if($param1=="first1")
      {
        //print_r($_POST);exit;
        $missionary_id=$_POST['missionary_id'];
        $update_data=$_POST;
        $update_data['dob']=date("Y-m-d",strtotime($this->input->post('dob')));
        $upload_name=$missionary_id.'.jpg';
        $photo_name=$this->upload_image('mp_photo','missionary',$upload_name);
       // print_r($photo_name);exit;
        if($photo_name!=NULL)
        {
          $update_data['photo']=$photo_name;
        }
        
        $where ="missionary_id=".$missionary_id;

        $this->Aedr_model->update('missionary_first',$where,$update_data);
     
        

       redirect(base_url().'MP_Panel/missionary_profile/'.$missionary_id,'refresh');
         
      }
      elseif($param1=="second")
      {
       
        $missionary_id=$_POST['missionary_id'];
        $update=$_POST;

        if($_POST['is_fw_active_in_mf']==1)
        {
          $update['mf_starting_date']=date("Y-m-d",strtotime($this->input->post('mf_starting_date')));
        }
        else
        {
          $update['mf_starting_date']=NULL;
          $update['desc_mf']=NULL;
          $update['tbaptized']=NULL;

        }
                
        //print_r($update);exit;

        $where ="missionary_id=".$missionary_id;

        $this->Aedr_model->update('missionary_second',$where,$update);
        //echo $missionary_id;exit;
        redirect(base_url().'MP_Panel/missionary_profile/'.$missionary_id,'refresh');
      }
      elseif($param1=="third")
      {
        $missionary_id=$_POST['missionary_id'];
        $update=$_POST;

        $update['other_spk_language']=implode(',',$_POST['other_spk_language']);

        $where ="missionary_id=".$missionary_id;

        $this->Aedr_model->update('missionary_third',$where,$update);

        
        redirect(base_url().'MP_Panel/missionary_profile/'.$missionary_id,'refresh');
      }
      elseif($param1=="four")
      {
        $missionary_id=$_POST['missionary_id'];
        $update=$_POST;
        $where ="missionary_id=".$missionary_id;

        $this->Aedr_model->update('missionary_four',$where,$update);

        
        redirect(base_url().'MP_Panel/missionary_profile/'.$missionary_id,'refresh');
      }
      elseif($param1=="five")
      {
        $missionary_id=$_POST['missionary_id'];
       
        $update=$_POST;
        
        $where ="missionary_id=".$missionary_id;

        $this->Aedr_model->update('missionary_five',$where,$update);

        
        redirect(base_url().'MP_Panel/missionary_profile/'.$missionary_id,'refresh');
      }
      elseif($param1=="six")
      {
        $missionary_id=$_POST['missionary_id'];

        //print_r($_POST);exit;
        $upload_name=$missionary_id.'_fieldPhoto.jpg';
        $update['FW_testimony']=$_POST['FW_testimony']; 
        $update['FW_testimony1']=$_POST['FW_testimony1']; 
        $update['FW_testimony2']=$_POST['FW_testimony2'];    
        $fphoto_name=$this->upload_image('field_photo','missionary',$upload_name);
        //print_r($fphoto_name);exit;
        if($fphoto_name!=NULL)
        {
          $update['field_photo']=$fphoto_name;
          $update['is_photo_upload']=1;

        }    
        
        $where ="missionary_id=".$missionary_id;

        $this->Aedr_model->update('missionary_six',$where,$update);
        //print_r("Successfully upload file");
        
        redirect(base_url().'MP_Panel/missionary_profile/'.$missionary_id,'refresh');

      }

      elseif($param1=="seven")
      {
        $missionary_id=$_POST['missionary_id'];
        
           // print_r($_POST);exit;
       
            
        $update=$_POST;        
        
               
        if($_POST['installation_cost']=="")
               $update['installation_cost']=NULL;   
               
        if($_POST['salary_recommandation']=="")
               $update['salary_recommandation']=NULL;   
       $where ="missionary_id=".$missionary_id;

        $this->Aedr_model->update('missionary_seven',$where,$update);

       //$this->update_googlesheet($missionary_id);

        redirect(base_url().'MP_Panel/missionary_profile/'.$missionary_id,'refresh');
      }
      
      


          ////////////////// google api sheet /////////////

      /* $this->load->library('Gapi');
        

        
       $report_period=$data['report_year']." R".$data['report_period'];


       $val_to_sheet=array(date('d-m-Y',strtotime($report['report_date'])),$reporter['name'],$report_period,$mid,$data['missionary_name'],$data['report'],$report['village_details'],implode(',',$data['prayer_points']),$data['photo_link'],$data['doc_link']);
     // print_r($val_to_sheet);exit;

    $this->gapi->writeData_uploadCatcher("1Vcwj46Cl3bIUhUbw7sYVU7QzgzMkJZgT4wt_6XM3u9g", "reportcatcher!A:J",$val_to_sheet);

   //exit;
       //print_r($result);exit;*/

 ////////////////////// google api sheet //////////////////////
    }

////////update missionary details end /////////////////////////////


    ///update the missionary id in db and google sheet

    function update_mrid()
    {

                $sql="select * from missionary_first";

                $missionaryDetails=$this->Aedr_model->get_result_sql($sql);

           //   print_r($missionaryDetails);exit;

              foreach ($missionaryDetails as $md) {
                  $state_by_id=$this->Aedr_model->get_row_by_id('state','state_id');
              
              $statename=$state_by_id[$md['state_id']]['short_name'];

             
              $mrid=strtoupper(substr($this->session->userdata('name'),0,2)."".random_string('alnum', 2)."".$statename."".$md['missionary_id']);
           
          $update['mrid']=$mrid;

              $where ="missionary_id=".$md['missionary_id'];

        $this->Aedr_model->update('missionary_first',$where,$update);
        $this->update_googlesheet($md['missionary_id']);
              }
       echo "Good work";
      
    }

    function budget_export()
  { 
    
    ////// fetching data start //////

     $state_by_id=$this->Aedr_model->get_row_by_id('state','state_id');

     //print_r($state_by_id);

    $district_by_id=$this->Aedr_model->get_row_by_id('district','district_id');
    $sql="select distinct mf.* from missionary_first as mf,missionary_second as ms,missionary_six as mss where ms.missionary_id=mf.missionary_id and mf.mp_id=4 and mss.missionary_id=mf.missionary_id";


    $missionaryDetails=$this->Aedr_model->get_result_sql($sql);

   // print_r(count($missionaryDetails));exit;

   /* $sql="select * from missionary_four as mf,missionary_first as mfr where  mfr.mp_id=2 and mfr.missionary_id=mf.missionary_id";

    $missionaryDetails4=$this->Aedr_model->get_result_sql($sql);

    $sql="select * from supervisor where mp_id=2";

    $supervisor=$this->Aedr_model->get_result_sql($sql);*/

    //print_r($missionaryDetails);exit;

    $msum=0;
    $ssum=0;
    $insum=0;
    $irum=0;
    $i=0;

   foreach ($missionaryDetails as $Mdetails) {
     $missionary_id=$Mdetails['missionary_id'];

     /////////// other table data ////////////

     $sql="select * from missionary_second where missionary_id=$missionary_id";

    $missionary_second=$this->Aedr_model->get_row_sql($sql);

     $sql="select * from missionary_four where missionary_id=$missionary_id";

    $missionary_four=$this->Aedr_model->get_row_sql($sql);

   // print_r($sql);exit;

     $budget_export['year']=2021;
     $budget_export['month']=3;
     $budget_export['ID']=$Mdetails['mrid'];
     $budget_export['label']="MISSIONARY SALARY";
     $budget_export['type']="Field Workers";
     $budget_export['name']=$Mdetails['fname']." ".$Mdetails['surename'];
     $budget_export['state']=$state_by_id[$Mdetails['state_id']]['name'];
     $budget_export['district']=$district_by_id[$Mdetails['district_id']]['name'];
     $budget_export['cost']=5500;
     $budget_export['status']="Live";
     $budget_export['Supervisor']=$missionary_four['supervisor_name'];
     $budget_export['phone']=$Mdetails['phone_num'];
     $budget_export['pincode']=$missionary_second['pincode'];
     $budget_export['is_regular']="Regular";
     $budget_export['is_core']="Core";
     $budget_export['cost_type']="Community Development Programme";
     $budget_export['funding_country']="500k UK/Indiana/Arizona";

     $finance_export[$i++]=$budget_export;
    
      $msum+=$budget_export['cost'];

   }

   /*

    $sql="select distinct s.* from supervisor as s,missionary_four as mf where s.mp_id=2 and s.status=1 and mf.supervisor_id=s.mrid";

    $supervisors=$this->Aedr_model->get_result_sql($sql);

    //print_r(count($supervisors));exit;



   foreach ($supervisors as $supervisor) {
     $supervisors_id=$supervisor['supervisor_id'];

     /////////// other table data ////////////
     $supervisor_code=$supervisor['mrid'];

     $budget_export['year']=2021;
     $budget_export['month']=2;
     $budget_export['ID']=$supervisor['mrid'];
     $budget_export['label']="Supervisor TA";
     $budget_export['type']="Supervisor";
     $budget_export['name']=$supervisor['fname']." ".$supervisor['surename'];
     $budget_export['state']=$state_by_id[$supervisor['state_id']]['name'];
     $budget_export['district']=$district_by_id[$supervisor['district_id']]['name'];
     $budget_export['cost']=$supervisor['nom']*200;
     $budget_export['status']="Live";
     $budget_export['Supervisor']=$supervisor['fname'];
     $budget_export['phone']="Not updated";
     $budget_export['pincode']="NA";
     $budget_export['is_regular']="Regular";
     $budget_export['is_core']="Core";
     $budget_export['cost_type']="Community Development Programme";
     $budget_export['funding_country']="500k UK/Indiana/Arizona";

     $finance_export[$i++]=$budget_export;
    
      $ssum+=$budget_export['cost'];

   }
  
   $this->load->library('Gapi');
       
       $result=$this->gapi->readSheet("1_iVbphOeEapm2bP-EdY_uLSTdICuKxSA5QITqben1QE", "Irregulars!A5:W8");
     
        foreach ($result as $rst) {
   
        $budget_export['year']=2021;
     $budget_export['month']=2;
     $budget_export['ID']=$rst[0];
     $budget_export['label']=$rst[1];
     $budget_export['type']=$rst[2];
     $budget_export['name']=$rst[3];
     $budget_export['state']=$rst[4];
     $budget_export['district']=$rst[5];
     $budget_export['cost']=$rst[6];
     $budget_export['status']="NA";
     $budget_export['Supervisor']="NA";
     $budget_export['phone']="Not Applicable";
     $budget_export['pincode']="NA";
     $budget_export['is_regular']="Irregular";
     $budget_export['is_core']=$rst[18];
     $budget_export['cost_type']=$rst[20];
     $budget_export['funding_country']="500k UK/Indiana/Arizona";

     $finance_export[$i++]=$budget_export;
    
     $irregular+=$budget_export['cost'];
        }
      
     // print_r($finance_export);exit;
// irregular
 /*  $budget_export['year']=2020;
     $budget_export['month']=12;
     $budget_export['ID']="JLO9T314";
     $budget_export['label']="Reporting Team";
     $budget_export['type']="Reporting Team";
     $budget_export['name']="Moses Babu";
     $budget_export['state']="Andhra Pradesh";
     $budget_export['district']="Prakasam";
     $budget_export['cost']=5000;
     $budget_export['status']="NA";
     $budget_export['Supervisor']="NA";
     $budget_export['phone']="Not Applicable";
     $budget_export['pincode']="NA";
     $budget_export['is_regular']="Irregular";
     $budget_export['is_core']="Core";
     $budget_export['cost_type']="Christmas Gift";
     $budget_export['funding_country']="500k UK/Indiana/Arizona";

     $finance_export[$i++]=$budget_export;
    
      $irregular=$budget_export['cost'];

      $budget_export['year']=2021;
     $budget_export['month']=2;
     $budget_export['ID']="JLM2T31X";
     $budget_export['label']="Reporting Team SALARY";
     $budget_export['type']="Reporting Team ";
     $budget_export['name']="Moses Babu";
     $budget_export['state']="Andhra Pradesh";
     $budget_export['district']="Prakasam";
     $budget_export['cost']=7200;
     $budget_export['status']="NA";
     $budget_export['Supervisor']="NA";
     $budget_export['phone']="Not Applicable";
     $budget_export['pincode']="NA";
     $budget_export['is_regular']="regular";
     $budget_export['is_core']="Core";
     $budget_export['cost_type']="Staff Honerarium";
     $budget_export['funding_country']="500k UK/Indiana/Arizona";

     $finance_export[$i++]=$budget_export;
    
      $otherregular=$budget_export['cost'];
//  irregular end

*/
   $total_amount=$msum;//+$ssum+$irregular+$otherregular;

  //  print_r($finance_export);exit;


  
      ////////////////// google api sheet /////////////

      $this->load->library('Gapi');
       // print_r($finance_export);exit;
      foreach ($finance_export as $fe) {

       // print_r($fe);exit;
        $val_to_sheet=array($fe['year'],$fe['month'],$fe['ID'],$fe['label'],$fe['type'],$fe['name'],$fe['state'],$fe['district'],$fe['cost'],$fe['status'],$fe['Supervisor'],$fe['phone'],$fe['pincode'],$fe['is_regular'],$fe['is_core'],$fe['cost_type'],$fe['funding_country']);


       
//print_r($val_to_sheet);exit;



for($i=0;$i<count($val_to_sheet);$i++)
{
    if($val_to_sheet[$i]==NULL)
    {
        $val_to_sheet[$i]="Not updated";
    }

}

//print_r(count($val_to_sheet));exit;
    $this->gapi->writeData_finance_export("1gAOSF0Z5a_QXmZAVe9GL3_M6OBfVpgF3n7lN5SUMslI", "finance_actual!A:Z",$val_to_sheet);

    unset($val_to_sheet);
      }
       echo "Love you jesus";
    

          //print_r($this->session->userdata());exit;

      

   }

   function demo_db_connection()
   {
       $sql="select * from missionary_second where missionary_id=$missionary_id";

      $missionary_second=$this->Aedr_model->get_row_sql($sql);



   }

   ///////////////    Field Worker Report Starts ///////////////////////

   public function generate_fw_report($param1='')
    {
      $missionary_id=1;
        if($param1<=0)
        {
           redirect(base_url().'missionaries/','refresh');
        }
        else
        {
          $missionary_id=$param1;
        }

          /////////// option data start ////////////////////////

          $op_yes_no[1]="Yes";
              $op_yes_no[2]="No";

              $op_mf_type[1]="Village";
              $op_mf_type[2]="Town";
              $op_mf_type[3]="City";

              $op_hw_fund_help_fw[1]="It will enable the FW to do church planting work full time not part time";
              $op_hw_fund_help_fw[2]="It will enable the FW to begin ministry in a new locaiton";
              $op_hw_fund_help_fw[3]="It will enable the FW to live in his ministry location";
              $op_hw_fund_help_fw[4]="It will remove unnecessary financial burdens so the FW will be under less pressure and be able to focus more on the church planting work";
              $op_hw_fund_help_fw[5]="Support from another organisation removed";


              $op_BC_mains=$this->Aedr_model->get_row_by_id('bc_main','op_BC_main_id');

      $op_BC_main[""]="";

      foreach ($op_BC_mains as $id => $value) {
        $op_BC_main[$id]=$value['name'];
      }


              $op_affiliated[1]="Affiliated";
              $op_affiliated[2]="Independent";


              $op_language[1]="Bengali";
              $op_language[2]="Marathi";
              $op_language[3]="Telugu";
              $op_language[4]="Tamil";
              $op_language[5]="Gujarati";
              $op_language[6]="Urdu";
              $op_language[7]="Kannada";
              $op_language[8]="Odia";
              $op_language[9]="Malayalam";
              $op_language[10]="Punjabi";
              $op_language[11]="Sanskrit";


              $op_DBC[1]="Pentecostal";
              $op_DBC[2]="Evangelical";
              $op_DBC[3]="Inter Denominational";
              $op_DBC[4]="NCM";
              $op_DBC[5]="Christ for India";
              $op_DBC[6]="Baptist";
              $op_DBC[7]="NA";
              $op_DBC[8]="IET";
              $op_DBC[9]="Assembly Of God";
              $op_DBC[10]="IPC";
              $op_DBC[11]="Pentecost";
              $op_DBC[12]="life center";
              $op_DBC[13]="Sharon Fellowship";
              $op_DBC[14]="Sathya Veda Seminary, Trivandrum";
              $op_DBC[15]="ICT, SEVABHARATh";
              $op_DBC[16]="Anglican";
              $op_DBC[17]="Southern Asia Bible College";
              $op_DBC[18]="No";
              $op_DBC[19]="IGM";
              $op_DBC[20]="Beleivers Church";
              $op_DBC[21]="CFI";
              $op_DBC[22]="Bretheren";
              $op_DBC[23]="Independent";
              $op_DBC[24]="Sharon";
              $op_DBC[25]="Church of God";
              $op_DBC[26]="NCM";
              $op_DBC[27]="NOT Applicable";


            //// options end /////

              $data['op_yes_no']=$op_yes_no;
              $data['op_mf_type']=$op_mf_type;
              $data['op_hw_fund_help_fw']=$op_hw_fund_help_fw;
              $data['op_BC_main']=$op_BC_main;
              $data['op_affiliated']=$op_affiliated;
              $data['op_language']=$op_language;
              $data['op_DBC']=$op_DBC;




          /////////// option data end ////////////////////////


              $data['state_by_id']=$this->Aedr_model->get_row_by_id('state','state_id');

              $sql="select * from missionary_first where missionary_id=$missionary_id";

              $data['missionary_details1']=$this->Aedr_model->get_row_sql($sql);

              $data['profile_data']=$page_data['missionary_details1'];


              $sql="select * from missionary_second where missionary_id=$missionary_id";

              $missionary_details2=$this->Aedr_model->get_row_sql($sql);

              if($missionary_details2['is_fw_active_in_mf']==2)
              {
                $missionary_details2['desc_mf']="Not Applicable";
                $missionary_details2['mf_starting_date']="Not Applicable";
                $missionary_details2['tbaptized']="Not Applicable";
              }
              else
              {
                  $missionary_details2['mf_starting_date']=date('d-m-Y',strtotime($missionary_details2['mf_starting_date']));
              }

              $data['missionary_details2']=$missionary_details2;

              $sql="select * from missionary_third where missionary_id=$missionary_id";

              $data['missionary_details3']=$this->Aedr_model->get_row_sql($sql);

              $sql="select * from missionary_four where missionary_id=$missionary_id";

              $data['missionary_details4']=$this->Aedr_model->get_row_sql($sql);

              $sql="select * from missionary_five where missionary_id=$missionary_id";

              $data['missionary_details5']=$this->Aedr_model->get_row_sql($sql);

              $sql="select * from missionary_six where missionary_id=$missionary_id";

              $data['missionary_details6']=$this->Aedr_model->get_row_sql($sql);
              
               $sql="select * from missionary_seven where missionary_id=$missionary_id";

              $data['missionary_details7']=$this->Aedr_model->get_row_sql($sql);


    //////// generate the pdf start /////

            //print_r($page_data['missionary_details7']);exit;

         $this->load->library('Pdf');
        $html = $this->load->view('fw_report_pdf', $data, true);
       $this->pdf->createPDF($html, $filename, false);


    //////////generate the pdf end ///////////


   }



   ///////////////    Field Worker Report Ends ///////////////////////


  //////// file upload method start //////////

   function upload_image($filename,$folder_name,$upload_name)
    {

    ///////////// file upload ////////////////////
      // print_r($upload_name);exit;
     $config['upload_path'] = './uploads/'.$folder_name;
        $config['file_name']=$upload_name;
        $config['allowed_types'] = 'doc|docx|png|jpeg|jpg|gif|rtf';
        $config['max_size'] = '1000000';
        $config['overwrite'] = TRUE;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
       if (!$this->upload->do_upload($filename))
        {
              
        $error = array('error' => $this->upload->display_errors());

       // print_r($error);exit;

         return NULL;
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());  

            $file_name=$this->upload->data('file_name');

            return $file_name;
        }

  }



  //////// file upload method end //////////

  function submit_missionary_factfile($param1="")
    {
      // print_r($_POST);exit;missionaries

      
        $update=$_POST;
        $update['submission_date']=date("Y-m-d");
        $insert['mp_id']=$this->session->userdata("mp_id");
               $insert['status']=1;
        $missionary_id=$this->Aedr_model->insert_id("missionary_first",$insert);

        redirect(base_url().'MP_Panel/add_missionary/first1/'.$missionary_id,'refresh');
         
   
      
    }

function missionary_fact_file($param1 = '', $param2 = '' , $param3 = '')
    {

      

        //////////////// page setup /////////////        
          
              $page_data['page_title']="Missionary";
              $page_data['form_heading']="Upload Missionary details list";
              
               $page_data['page_heading']="fact file";
              $page_data['err']="display: none";    


            $page_data['page_name']="backennd/mp_pannel/upload_incomplete_missionary";
            $page_data['top_menu']="bk_cms/top_menu";
            $page_data['css_file']="bk_cms/list_form_css";
            $page_data['script_file']="bk_cms/script";
            $page_data['side_menu']="backennd/admin/side_menu";
             $page_data['footer']='bk_cms/footer';
          
           


     ///////////////////////  Data  //////////////////////

            

    
        ///////////////// page details ////////////////////////
                $this->load->view($page_data['css_file']);
                $this->load->view($page_data['top_menu']);
                $this->load->view( $page_data['side_menu'],$page_data);
                $this->load->view($page_data['page_name'],$page_data);
                $this->load->view('bk_cms/footer');
                $this->load->view($page_data['script_file']); 
        //////////////////// page details end ///////////////////
            

    }
////////////////////////////// Donar list End ////////////////

//////////  delete missionary start ///////////////

function delete_missionary($param1="")
    {
      $missionary_id=$param1;
    $where ="missionary_id=".$missionary_id;
    $this->Aedr_model->delete('missionary_first',$where);
    $this->Aedr_model->delete('missionary_five',$where);
    $this->Aedr_model->delete('missionary_four',$where);
    $this->Aedr_model->delete('missionary_second',$where);
    $this->Aedr_model->delete('missionary_six',$where);
    $this->Aedr_model->delete('missionary_seven',$where);
    $this->Aedr_model->delete('missionary_third',$where);
    redirect(base_url() . 'MP_Panel', 'refresh');
  }

//////////  delete missionary end ///////////////

/////////////////////  create msupport and R4R start ////////////
  function r4r_bulk_update()
  { 
    //print_r($this->session->userdata('mp_id'));exit;
    $mp_id=$this->session->userdata('mp_id');
    $sql="select distinct mf.* from missionary_first as mf,missionary_seven as ms where ms.missionary_id=mf.missionary_id and mf.mp_id=$mp_id";


    $missionaryDetails=$this->Aedr_model->get_result_sql($sql);

      foreach ($missionaryDetails as $m) {
        $missionary_id=$m['missionary_id'];
        $this->update_googlesheet($missionary_id);
      }
      echo "updated Successfully";
    //print_r($missionaryDetails);exit;

}


///////////////////// R4R end /////////////////

function reload_m_support($param1 = '', $param2 = '' , $param3 = '')
    {


     ///////////////////////  Data  //////////////////////
     
     $mp_id=$this->session->userdata("mp_id");

            $sql="select mf.missionary_id from missionary_first mf,missionary_second as ms,missionary_six as mss where mp_id=$mp_id and ms.missionary_id=mf.missionary_id and mss.missionary_id=mf.missionary_id  order by fname";

      $missionary_ids=$this->Aedr_model->get_result_sql($sql);
      
      foreach ($missionary_ids as $m) {
          $missionary_id=$m['missionary_id'];
          echo $missionary_id." is updating.....";
          $this->update_googlesheet($missionary_id);
          echo "added Successfully";

      }
   
            

    }
///////////////////////// Missionary list End ////////////////

////////////// Missionary Report start  ////////////////
     ///////////////  Missionary Report List  ///////////////////
function missionary_report($param1='',$param2='')
    {

     
        //////////////// page setup /////////////        
          
              $page_data['page_title']="Missionary Report";
              $page_data['form_heading']="Missionary Report";
              $page_data['table_heading']="Report List";
               $page_data['page_heading']="New Missionary";
              $page_data['err']="display: none";    


            $page_data['page_name']="backennd/mp_pannel/missionary_report";
            $page_data['top_menu']="bk_cms/top_menu";
            $page_data['css_file']="bk_cms/advance_form_css";
            $page_data['script_file']="bk_cms/advance_form_script";
            $page_data['side_menu']="backennd/mp_pannel/side_menu";
             $page_data['footer']='bk_cms/footer';
          
             $bread_crum[0]=array("link"=>base_url()."MP_Panel/missionary_reports","name"=>"Missionary Report List","class"=>"active-trail active");
            $bread_crum[1]=array("link"=>base_url()."MP_Panel/missionary_report","name"=>"Add Missionary Report","class"=>"current");
            $page_data['bread_crums']=$bread_crum;


     ///////////////////////  Data  //////////////////////
            $mp_id=$this->session->userdata("mp_id");

            //$sql="select * from missionary_first where mp_id=$mp_id  and mrid!='' order by mrid";

            $sql="select * from missionary_first mf,missionary_second as ms,missionary_six as mss where mp_id=$mp_id and ms.missionary_id=mf.missionary_id and mss.missionary_id=mf.missionary_id and mf.mrid!='' order by mf.mrid";

      $page_data['missisonaries']=$this->Aedr_model->get_result_sql($sql);
      
     
        
        ///////////////// page details ////////////////////////
                $this->load->view($page_data['css_file']);
                $this->load->view($page_data['top_menu']);
                $this->load->view( $page_data['side_menu'],$page_data);
                $this->load->view($page_data['page_name'],$page_data);
                $this->load->view('bk_cms/footer');
                $this->load->view($page_data['script_file']); 
        //////////////////// page details end ///////////////////
      }
  //////////////////  missionary report end /////////////

  function report_submission()
    {   

      
         $mp_id=$this->session->userdata("mp_id");
          
         $mp_name=$this->session->userdata('name');

        $reporter_name=$_POST['name'];
        $reporter_email=$_POST['email'];
        

        
        $sql ="select * from mp_reporter where email='$reporter_email' and mp_id=$mp_id";

        
        $reporter_details= $this->Aedr_model->get_row_sql($sql);
        
        if(empty($reporter_details))
        {
            redirect(base_url()."MP_Panel/missionary_report/err/1", 'refresh');
        }
        else
        {
        
        $year=$this->input->post('year');
          $period=$this->input->post('period');
         
       
        $missionary_id=$this->input->post('missionary_id');

         $sql ="select * from missionary_first where missionary_id=$missionary_id and mp_id=$mp_id";
       // print_r($sql);exit;
        $missionary_details= $this->Aedr_model->get_row_sql($sql);
        

         
        if(empty($missionary_details))
        {
            redirect(base_url()."Report/err/2", 'refresh');
        }
        else
        {

          $upload_name=$mp_name."_".$year."_R".$period."_".$missionary_details['fname'].'.jpg';
         //print_r($upload_name);exit;
        $PhotoFileName=$this->upload_image('photo','report_photo',$upload_name);
        
        $upload_name=$mp_name."_".$year."_R".$period."_".$missionary_details['fname'].'.docx';
       // print_r($upload_name);exit;
        $DocFileName=$this->upload_file("reprt_doc","./uploads/missionary_report/");

     //    print_r($_POST);exit;

        $fname=$this->input->post('fname');
        $surename=$this->input->post('surename'); 
        $state_id=$this->input->post('state_id');

        $insert['report_date']=date('Y-m-d');  
        $insert['missionary_id']=$missionary_details['missionary_id'];
         $insert['report']=$this->input->post('report');
         $insert['report1']=$this->input->post('report1');
         $insert['report2']=$this->input->post('report2');
         $insert['report3']=$this->input->post('report3');
         $insert['report4']=$this->input->post('report4');
         $insert['doc_link']=base_url()."uploads/missionary_report/".$DocFileName;
         
         if($PhotoFileName!=NULL)
          {
         $insert['photo_link']=$PhotoFileName;
         }

          
         $prayer_points=array();
        array_push($prayer_points,$this->input->post('pr1'));
        array_push($prayer_points,$this->input->post('pr2'));
        array_push($prayer_points,$this->input->post('pr3'));
            if($this->input->post('pr4')!='')
            {
                array_push($prayer_points,$this->input->post('pr4'));
            }
            if($this->input->post('pr5')!='')
            {
                array_push($prayer_points,$this->input->post('pr5'));
            }
            if($this->input->post('pr6')!='')
            {
                array_push($prayer_points,$this->input->post('pr6'));
            }
            if($this->input->post('pr7')!='')
            {
                array_push($prayer_points,$this->input->post('pr7'));
            }
            if($this->input->post('pr8')!='')
            {
                array_push($prayer_points,$this->input->post('pr8'));
            }
            if($this->input->post('pr9')!='')
            {
                array_push($prayer_points,$this->input->post('pr9'));
            }
            if($this->input->post('pr10')!='')
            {
                array_push($prayer_points,$this->input->post('pr10'));
            }

            $v=0;
            $village_details=array();           
            $v1=array();
            $v2=array();
            $v3=array();
            $v4=array();
            $v5=array();
            $v6=array();
            $v7=array();
            $v8=array();
            $v9=array();
            $v10=array();

            if($this->input->post('v1_name')!='' || $this->input->post('v1_cfprayer')!='' || $this->input->post('v1_baptisms')!='')
            {
                array_push($v1,'v1');
                array_push($v1,$this->input->post('v1_name'));
                array_push($v1,$this->input->post('v1_cfprayer'));
                array_push($v1,$this->input->post('v1_baptisms'));  

                $village_details[$v++]=$v1;                  
            }

            if($this->input->post('v2_name')!='' || $this->input->post('v2_cfprayer')!='' || $this->input->post('v2_baptisms')!='')
            {
                array_push($v2,'v2');
                array_push($v2,$this->input->post('v2_name'));
                array_push($v2,$this->input->post('v2_cfprayer'));
                array_push($v2,$this->input->post('v2_baptisms'));  

                $village_details[$v++]=$v2;                  
            }
            
            if($this->input->post('v3_name')!='' || $this->input->post('v3_cfprayer')!='' || $this->input->post('v3_baptisms')!='')
            {
                array_push($v3,'v3');
                array_push($v3,$this->input->post('v3_name'));
                array_push($v3,$this->input->post('v3_cfprayer'));
                array_push($v3,$this->input->post('v3_baptisms'));  

                $village_details[$v++]=$v3;                  
            }
            if($this->input->post('v4_name')!='' || $this->input->post('v4_cfprayer')!='' || $this->input->post('v4_baptisms')!='')
            {
                array_push($v4,'v4');
                array_push($v4,$this->input->post('v4_name'));
                array_push($v4,$this->input->post('v4_cfprayer'));
                array_push($v4,$this->input->post('v4_baptisms'));  

                $village_details[$v++]=$v4;                  
            }
            if($this->input->post('v5_name')!='' || $this->input->post('v5_cfprayer')!='' || $this->input->post('v5_baptisms')!='')
            {
                array_push($v5,'v5');
                array_push($v5,$this->input->post('v5_name'));
                array_push($v5,$this->input->post('v5_cfprayer'));
                array_push($v5,$this->input->post('v5_baptisms'));  

                $village_details[$v++]=$v5;                  
            }
            if($this->input->post('v6_name')!='' || $this->input->post('v6_cfprayer')!='' || $this->input->post('v6_baptisms')!='')
            {
                array_push($v6,'v6');
                array_push($v6,$this->input->post('v6_name'));
                array_push($v6,$this->input->post('v6_cfprayer'));
                array_push($v6,$this->input->post('v6_baptisms'));  

                $village_details[$v++]=$v6;                  
            }
            if($this->input->post('v7_name')!='' || $this->input->post('v7_cfprayer')!='' || $this->input->post('v7_baptisms')!='')
            {
                array_push($v7,'v7');
                array_push($v7,$this->input->post('v7_name'));
                array_push($v7,$this->input->post('v7_cfprayer'));
                array_push($v7,$this->input->post('v7_baptisms'));  

                $village_details[$v++]=$v7;                  
            }
            if($this->input->post('v8_name')!='' || $this->input->post('v8_cfprayer')!='' || $this->input->post('v8_baptisms')!='')
            {
                array_push($v8,'v8');
                array_push($v8,$this->input->post('v8_name'));
                array_push($v8,$this->input->post('v8_cfprayer'));
                array_push($v8,$this->input->post('v8_baptisms'));  

                $village_details[$v++]=$v8;                  
            }
            if($this->input->post('v9_name')!='' || $this->input->post('v9_cfprayer')!='' || $this->input->post('v9_baptisms')!='')
            {
                array_push($v9,'v9');
                array_push($v9,$this->input->post('v9_name'));
                array_push($v9,$this->input->post('v9_cfprayer'));
                array_push($v9,$this->input->post('v9_baptisms'));  

                $village_details[$v++]=$v9;                  
            }
            if($this->input->post('v10_name')!='' || $this->input->post('v10_cfprayer')!='' || $this->input->post('v10_baptisms')!='')
            {
                array_push($v10,'v10');
                array_push($v10,$this->input->post('v10_name'));
                array_push($v10,$this->input->post('v10_cfprayer'));
                array_push($v10,$this->input->post('v10_baptisms'));  

                $village_details[$v++]=$v10;                  
            }
            
          
     
            if($pr4!='')
            {
                array_push($prayer_points,$this->input->post('pr4'));
            }

           // print_r($reporter_details);exit;
          $insert['prayer_points']=json_encode($prayer_points);
          $insert['village_details']=json_encode($village_details);
          $insert['reporter_id']=$reporter_details['reporter_id'];
          $insert['report_year']=$this->input->post('year');
          $insert['report_period']=$this->input->post('period');
          $insert['status']=1;
          $insert['mp_id']=$this->session->userdata("mp_id");
          $insert['is_send']=0;

          //print_r($insert);exit;
          $report_id=$this->Aedr_model->insert_id("mp_missionary_report",$insert);
        //print_r($missionary_details);exit;

    
      }
    }
          redirect(base_url().'MP_Panel/generate_fw_termreport/'.$report_id,'refresh');
    }

      ///////////////  Missionary Report List  ///////////////////
function edit_missionary_report($param1='',$param2='')
    {

      $report_id=$param1;
        //////////////// page setup /////////////        
          
              $page_data['page_title']="Missionary Edit Report";
              $page_data['form_heading']="Missionary Edit Report";
              $page_data['table_heading']="Report List";
               $page_data['page_heading']="Edit Missionary";
              $page_data['err']="display: none";    


            $page_data['page_name']="backennd/mp_pannel/edit_missionary_report";
            $page_data['top_menu']="bk_cms/top_menu";
            $page_data['css_file']="bk_cms/advance_form_css";
            $page_data['script_file']="bk_cms/advance_form_script";
            $page_data['side_menu']="backennd/mp_pannel/side_menu";
             $page_data['footer']='bk_cms/footer';
          
             $bread_crum[0]=array("link"=>base_url()."MP_Panel","name"=>"Missionary Partner","class"=>"active-trail active");
            $bread_crum[1]=array("link"=>base_url()."MP_Panel/add_missionary","name"=>"New Missionary","class"=>"current");
            $page_data['bread_crums']=$bread_crum;


     ///////////////////////  Data  //////////////////////
            $mp_id=$this->session->userdata("mp_id");


            $sql="select * from mp_missionary_report where report_id=$report_id";

      $edit_data=$this->Aedr_model->get_row_sql($sql);



      $page_data['edit_data']=$edit_data;

      $reporter_id=$edit_data['reporter_id'];

      $sql="select * from mp_reporter where reporter_id=$reporter_id and mp_id=$mp_id";

      $page_data['reporter']=$this->Aedr_model->get_row_sql($sql);

      //print_r($edit_data);exit;

       $sql="select * from missionary_first where mp_id=$mp_id  and mrid!='' order by mrid";

      $page_data['missisonaries']=$this->Aedr_model->get_result_sql($sql);

      $page_data['prayer_points']=json_decode($edit_data['prayer_points'],true);
      $page_data['village_details']=json_decode($edit_data['village_details'],true);
     //  print_r($page_data['prayer_points']);exit;
      //print_r($page_data['village_details']);exit;
     
        
        ///////////////// page details ////////////////////////
                $this->load->view($page_data['css_file']);
                $this->load->view($page_data['top_menu']);
                $this->load->view( $page_data['side_menu'],$page_data);
                $this->load->view($page_data['page_name'],$page_data);
                $this->load->view('bk_cms/footer');
                $this->load->view($page_data['script_file']); 
        //////////////////// page details end ///////////////////
      }
  //////////////////  missionary report end /////////////

  function report_update()
    {   

        //print_r($_POST);exit;
      $report_id=$_POST['report_id'];
         $mp_id=$this->session->userdata("mp_id");
          
         $mp_name=$this->session->userdata('name');

        $reporter_name=$_POST['name'];
        $reporter_email=$_POST['email'];
        

        
        $sql ="select * from mp_reporter where email='$reporter_email' and mp_id=$mp_id";

        
        $reporter_details= $this->Aedr_model->get_row_sql($sql);

     //   print_r($report_id);exit;
        
        if(empty($reporter_details))
        {
            redirect(base_url()."MP_Panel/edit_missionary_report/".$report_id, 'refresh');
        }
        else
        {
        
        $year=$this->input->post('year');
          $period=$this->input->post('period');
         
       
        $missionary_id=$this->input->post('missionary_id');

         $sql ="select * from missionary_first where missionary_id=$missionary_id and mp_id=$mp_id";
       // print_r($sql);exit;
        $missionary_details= $this->Aedr_model->get_row_sql($sql);
        

         
        if(empty($missionary_details))
        {
            redirect(base_url()."Report/err/2", 'refresh');
        }
        else
        {

          $upload_name=$mp_name."_".$year."_R".$period."_".$missionary_details['fname'].'.jpg';
         
        $PhotoFileName=$this->upload_image('photo','report_photo',$upload_name);



        $upload_name=$mp_name."_".$year."_R".$period."_".$missionary_details['fname'].'.docx';
       // print_r($upload_name);exit;
        $DocFileName=$this->upload_file("reprt_doc","./uploads/missionary_report/");
        $update_data['report_date']=date('Y-m-d');  
        $update_data['missionary_id']=$missionary_details['missionary_id'];
         $update_data['report']=$this->input->post('report');
         $update_data['report1']=$this->input->post('report1');
         $update_data['report2']=$this->input->post('report2');
         $update_data['report3']=$this->input->post('report3');
         $update_data['report4']=$this->input->post('report4');

          if($DocFileName!=NULL){

         $update_data['doc_link']=base_url()."uploads/missionary_report/".$DocFileName;
       }
         
         if($PhotoFileName!=NULL)
          {
         $update_data['photo_link']=$PhotoFileName;
         }

          
         $prayer_points=array();
        array_push($prayer_points,$this->input->post('pr1'));
        array_push($prayer_points,$this->input->post('pr2'));
        array_push($prayer_points,$this->input->post('pr3'));
            if($this->input->post('pr4')!='')
            {
                array_push($prayer_points,$this->input->post('pr4'));
            }
            if($this->input->post('pr5')!='')
            {
                array_push($prayer_points,$this->input->post('pr5'));
            }
            if($this->input->post('pr6')!='')
            {
                array_push($prayer_points,$this->input->post('pr6'));
            }
            if($this->input->post('pr7')!='')
            {
                array_push($prayer_points,$this->input->post('pr7'));
            }
            if($this->input->post('pr8')!='')
            {
                array_push($prayer_points,$this->input->post('pr8'));
            }
            if($this->input->post('pr9')!='')
            {
                array_push($prayer_points,$this->input->post('pr9'));
            }
            if($this->input->post('pr10')!='')
            {
                array_push($prayer_points,$this->input->post('pr10'));
            }

            $v=0;
            $village_details=array();           
            $v1=array();
            $v2=array();
            $v3=array();
            $v4=array();
            $v5=array();
            $v6=array();
            $v7=array();
            $v8=array();
            $v9=array();
            $v10=array();

            if($this->input->post('v1_name')!='' || $this->input->post('v1_cfprayer')!='' || $this->input->post('v1_baptisms')!='')
            {
                array_push($v1,'v1');
                array_push($v1,$this->input->post('v1_name'));
                array_push($v1,$this->input->post('v1_cfprayer'));
                array_push($v1,$this->input->post('v1_baptisms'));  

                $village_details[$v++]=$v1;                  
            }

            if($this->input->post('v2_name')!='' || $this->input->post('v2_cfprayer')!='' || $this->input->post('v2_baptisms')!='')
            {
                array_push($v2,'v2');
                array_push($v2,$this->input->post('v2_name'));
                array_push($v2,$this->input->post('v2_cfprayer'));
                array_push($v2,$this->input->post('v2_baptisms'));  

                $village_details[$v++]=$v2;                  
            }
            
            if($this->input->post('v3_name')!='' || $this->input->post('v3_cfprayer')!='' || $this->input->post('v3_baptisms')!='')
            {
                array_push($v3,'v3');
                array_push($v3,$this->input->post('v3_name'));
                array_push($v3,$this->input->post('v3_cfprayer'));
                array_push($v3,$this->input->post('v3_baptisms'));  

                $village_details[$v++]=$v3;                  
            }
            if($this->input->post('v4_name')!='' || $this->input->post('v4_cfprayer')!='' || $this->input->post('v4_baptisms')!='')
            {
                array_push($v4,'v4');
                array_push($v4,$this->input->post('v4_name'));
                array_push($v4,$this->input->post('v4_cfprayer'));
                array_push($v4,$this->input->post('v4_baptisms'));  

                $village_details[$v++]=$v4;                  
            }
            if($this->input->post('v5_name')!='' || $this->input->post('v5_cfprayer')!='' || $this->input->post('v5_baptisms')!='')
            {
                array_push($v5,'v5');
                array_push($v5,$this->input->post('v5_name'));
                array_push($v5,$this->input->post('v5_cfprayer'));
                array_push($v5,$this->input->post('v5_baptisms'));  

                $village_details[$v++]=$v5;                  
            }
            if($this->input->post('v6_name')!='' || $this->input->post('v6_cfprayer')!='' || $this->input->post('v6_baptisms')!='')
            {
                array_push($v6,'v6');
                array_push($v6,$this->input->post('v6_name'));
                array_push($v6,$this->input->post('v6_cfprayer'));
                array_push($v6,$this->input->post('v6_baptisms'));  

                $village_details[$v++]=$v6;                  
            }
            if($this->input->post('v7_name')!='' || $this->input->post('v7_cfprayer')!='' || $this->input->post('v7_baptisms')!='')
            {
                array_push($v7,'v7');
                array_push($v7,$this->input->post('v7_name'));
                array_push($v7,$this->input->post('v7_cfprayer'));
                array_push($v7,$this->input->post('v7_baptisms'));  

                $village_details[$v++]=$v7;                  
            }
            if($this->input->post('v8_name')!='' || $this->input->post('v8_cfprayer')!='' || $this->input->post('v8_baptisms')!='')
            {
                array_push($v8,'v8');
                array_push($v8,$this->input->post('v8_name'));
                array_push($v8,$this->input->post('v8_cfprayer'));
                array_push($v8,$this->input->post('v8_baptisms'));  

                $village_details[$v++]=$v8;                  
            }
            if($this->input->post('v9_name')!='' || $this->input->post('v9_cfprayer')!='' || $this->input->post('v9_baptisms')!='')
            {
                array_push($v9,'v9');
                array_push($v9,$this->input->post('v9_name'));
                array_push($v9,$this->input->post('v9_cfprayer'));
                array_push($v9,$this->input->post('v9_baptisms'));  

                $village_details[$v++]=$v9;                  
            }
            if($this->input->post('v10_name')!='' || $this->input->post('v10_cfprayer')!='' || $this->input->post('v10_baptisms')!='')
            {
                array_push($v10,'v10');
                array_push($v10,$this->input->post('v10_name'));
                array_push($v10,$this->input->post('v10_cfprayer'));
                array_push($v10,$this->input->post('v10_baptisms'));  

                $village_details[$v++]=$v10;                  
            }
            
          
        array_push($prayer_points,$this->input->post('pr1'));
        array_push($prayer_points,$this->input->post('pr2'));
        array_push($prayer_points,$this->input->post('pr3'));
            if($pr4!='')
            {
                array_push($prayer_points,$this->input->post('pr4'));
            }

           // print_r($reporter_details);exit;
          $update_data['prayer_points']=json_encode($prayer_points);
          $update_data['village_details']=json_encode($village_details);
          $update_data['reporter_id']=$reporter_details['reporter_id'];
          $update_data['report_year']=$this->input->post('year');
          $update_data['report_period']=$this->input->post('period');
          
         $where ="report_id=".$report_id;

        $this->Aedr_model->update('mp_missionary_report',$where,$update_data);
          

         

    
      }
    }
          redirect(base_url().'MP_Panel/edit_missionary_report/'.$report_id,'refresh');
    }

function upload_file($name,$upload_path)
    {

        
                        $config['upload_path'] = $upload_path;
                        $config['overwrite']=true;
                         
                        $config['allowed_types'] = 'doc|docx|png|jpeg|jpg|gif|rtf';
                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);


                        if (!is_dir('uploads'))
                        {
                            mkdir('./uploads', 0777, true);
                        }
                        if ($this->upload->do_upload($name))
                        { 
                            $data = $this->upload->data();
                        //    print_r($data);exit;
                            return $data['file_name'];
                             
                        }
                        else
                        {
                          //print_r($upload_path);exit;
                          // echo $this->upload->display_errors();
                           //exit;
                            return NULL;
                        }

            
    }


///////////////    Field Worker Report Starts ///////////////////////

   public function generate_fw_termreport($param1='')
    {
      $report_id=1;
      
        if($param1<=0)
        {
           redirect(base_url().'mtermreports/','refresh');
        }
        else
        {
          $report_id=$param1;
        }

         
          /////////// option data end ////////////////////////


              $data['state_by_id']=$this->Aedr_model->get_row_by_id('state','state_id');

              $sql="select * from mp_missionary_report where report_id=$report_id";

              $report_data=$this->Aedr_model->get_row_sql($sql);
              $data['report_data']=$report_data;
              // print_r($report_data);exit;
              $missionary_id=$report_data['missionary_id'];
              $data['village_details']=json_decode($report_data['village_details'],true);
             
              $data['prayer_points']=json_decode($report_data['prayer_points'],true);
              $sql="select * from missionary_first where missionary_id=$missionary_id";

              $data['missionary_details1']=$this->Aedr_model->get_row_sql($sql);

          $data['profile_data']=$page_data['missionary_details1'];


        //////// generate the pdf start /////

            //print_r($page_data['missionary_details7']);exit;

         $this->load->library('Pdf');
        $html = $this->load->view('fw_termreport_pdf', $data, true);
       $this->pdf->createPDF($html, $filename, false);


    //////////generate the pdf end ///////////


   }

  ///////////////    Field Worker Report Starts ///////////////////////

   public function missionary_report_preview($param1='',$param2='')
    {
      $report_id=1;
      
        if($param1<=0)
        {
           redirect(base_url().'mtermreports/','refresh');
        }
        else
        {
          $report_id=$param1;
        }

        if($param2!='')
        {
           $page_data['flash_style']="display:block";
        }
        else
        {
          $page_data['flash_style']="display:none";
        }
        //  print_r($page_data['flash_style']);exit;
        ////////////////// page setup  ////////////////////
          $page_data['form_heading']="Upload Missionary list";
              $page_data['table_heading']="Missionaries List";
               $page_data['page_heading']="Missionarys";
              $page_data['err']="display: none";    

              $page_data['page_title']="Missionaries Profile";
              $page_data['css_file']="bk_cms/list_css";
              $page_data['page_name']="backennd/mp_pannel/report_preview";


           
            $page_data['top_menu']="bk_cms/top_menu";
            
            $page_data['script_file']="bk_cms/script";
             $page_data['side_menu']="backennd/mp_pannel/side_menu";
             $page_data['footer']='bk_cms/footer';
          
             $bread_crum[0]=array("link"=>base_url()."MP_Panel/missionary_reports","name"=>"Missionary Report List","class"=>"active-trail active");
            $bread_crum[1]=array("link"=>base_url()."MP_Panel/missionary_report","name"=>"Add Missionary Report","class"=>"current");
            $page_data['bread_crums']=$bread_crum;
          /////////// option data end ////////////////////////


              $page_data['state_by_id']=$this->Aedr_model->get_row_by_id('state','state_id');

              $sql="select * from mp_missionary_report where report_id=$report_id";

              $report_data=$this->Aedr_model->get_row_sql($sql);
              $page_data['report_data']=$report_data;
           //   print_r($report_data);exit;
              $missionary_id=$report_data['missionary_id'];
              $page_data['village_details']=json_decode($report_data['village_details'],true);
             
              $page_data['prayer_points']=json_decode($report_data['prayer_points'],true);
              $sql="select * from missionary_first where missionary_id=$missionary_id";

              $page_data['missionary_details1']=$this->Aedr_model->get_row_sql($sql);

          $page_data['profile_data']=$page_data['missionary_details1'];


        ///////////////// page details ////////////////////////
            $this->load->view($page_data['css_file']);
            $this->load->view($page_data['top_menu']);
            $this->load->view( $page_data['side_menu'],$page_data);
            $this->load->view($page_data['page_name'],$page_data);
            $this->load->view('bk_cms/footer');
            $this->load->view($page_data['script_file']); 
   }
function missionary_reports($param1 = '', $param2 = '' , $param3 = '')
    {
        $page_data['tiny_msg']="display:none";

        if($param1=='delete')
        {
          $page_data['tiny_msg']="display:block";
        }

        //////////////// page setup /////////////        
          
              $page_data['page_title']="Missionaries";
              $page_data['form_heading']="Upload Missionary report";
              $page_data['table_heading']="Missionaries Report List";
               $page_data['page_heading']="Missionary Report";
              $page_data['err']="display: none";    


            $page_data['page_name']="backennd/mp_pannel/missionary_reports";
            $page_data['top_menu']="bk_cms/top_menu";
            $page_data['css_file']="bk_cms/list_form_css";
            $page_data['script_file']="bk_cms/script";
            $page_data['side_menu']="backennd/mp_pannel/side_menu";
             $page_data['footer']='bk_cms/footer';
          
             $bread_crum[0]=array("link"=>base_url()."MP_Panel/missionary_reports","name"=>"Missionary Report List","class"=>"active-trail active");
            $bread_crum[1]=array("link"=>base_url()."MP_Panel/missionary_report","name"=>"Add Missionary Report","class"=>"current");
           
            $page_data['bread_crums']=$bread_crum;


     ///////////////////////  Data  //////////////////////
     
     $mp_id=$this->session->userdata("mp_id");

            $sql="select * from mp_missionary_report as mr,missionary_first as mf where mr.mp_id=$mp_id and mf.missionary_id=mr.missionary_id order by report_date desc";

      $page_data['missionaries_lists']=$this->Aedr_model->get_result_sql($sql);
    //print_r($page_data['missionaries_lists'][0]);exit;

      $page_data['state_by_id']=$this->Aedr_model->get_row_by_id('state','state_id');
      $page_data['missionary_by_id']=$this->Aedr_model->get_row_by_id('missionary_first','missionary_id');

      


    
        ///////////////// page details ////////////////////////
                $this->load->view($page_data['css_file']);
                $this->load->view($page_data['top_menu']);
                $this->load->view( $page_data['side_menu'],$page_data);
                $this->load->view($page_data['page_name'],$page_data);
                $this->load->view('bk_cms/footer');
                $this->load->view($page_data['script_file']); 
  //////////////////// page details end ///////////////////
            

    }
///////////////////////// Missionary list End ////////////////

  function submit_approval($param1="")
    {
      $report_id=$param1;
      $update_data['is_send_approval']=1;

      $where ="report_id=".$report_id;

      $this->Aedr_model->update('mp_missionary_report',$where,$update_data);
      redirect(base_url()."MP_Panel/missionary_report_preview/".$report_id."/1", 'refresh');


    }

    function delete_missionary_report($param1="")
    {
      $report_id=$param1;
    $where ="report_id=".$report_id;
    $this->Aedr_model->delete('mp_missionary_report',$where);
    redirect(base_url() . 'MP_Panel/missionary_reports/delete', 'refresh');
  }

//////////////////////////////////  Supervisor Start   ///////////////////////

function supervisor($param1 = '', $param2 = '' , $param3 = '')
    {
        $page_data['tiny_msg']="display:none";

        if($param1=='delete')
        {
          $page_data['tiny_msg']="display:block";
        }

        //////////////// page setup /////////////        
          
              $page_data['page_title']="Supervisor";
              $page_data['form_heading']="Upload Supervisor";
              $page_data['table_heading']="Supervisor List";
               $page_data['page_heading']="Supervisor";
              $page_data['err']="display: none";    


            $page_data['page_name']="backennd/mp_pannel/supervisor";
            $page_data['top_menu']="bk_cms/top_menu";
            $page_data['css_file']="bk_cms/list_form_css";
            $page_data['script_file']="bk_cms/script";
            $page_data['side_menu']="backennd/mp_pannel/side_menu";
             $page_data['footer']='bk_cms/footer';
          
             $bread_crum[0]=array("link"=>base_url()."MP_Panel/supervisor","name"=>"Supervisor List","class"=>"active-trail active");
            $bread_crum[1]=array("link"=>base_url()."MP_Panel/cud_supervisor/1","name"=>"Add Supervisor","class"=>"current");
           
            $page_data['bread_crums']=$bread_crum;


     ///////////////////////  Data  //////////////////////
     
     $mp_id=$this->session->userdata("mp_id");

     $sql="select * from mp_supervisor where mp_id=$mp_id order by name";

     $supervisor_lists=$this->Aedr_model->get_result_sql($sql);

     $page_data['supervisor_lists']=$supervisor_lists;

     $page_data['state_by_id']=$this->Aedr_model->get_row_by_id('state','state_id');
     $page_data['missionary_by_id']=$this->Aedr_model->get_row_by_id('missionary_first','missionary_id');

     //print_r($page_data['missionary_by_id']);exit;

    

     foreach ($supervisor_lists as $sl) {
       $supervisor_id=$sl["supervisor_id"];

     //  print_r($supervisor_id);exit;

        $sql="select mfrst.fname,mfrst.missionary_id from missionary_four mf,missionary_first mfrst where mf.supervisorid=$supervisor_id and mfrst.missionary_id=mf.missionary_id ";
        $rst_s=$this->Aedr_model->get_result_sql($sql);
       
        $supervisor_data[$supervisor_id]["supervisor_id"]=$supervisor_id;
        $supervisor_data[$supervisor_id]["name"]=$sl['name'];
        $supervisor_data[$supervisor_id]["no_of_missionary"]=count($rst_s);

        $smissionary_ids=array();
        $smissionary_names=array();

       // print_r($rst_s);exit;

        foreach ($rst_s as $rsu) {
         // print_r($rsu);exit;
          array_push($smissionary_ids,$rsu["missionary_id"]);
          array_push($smissionary_names,$rsu["fname"]);
        }
        $supervisor_data[$supervisor_id]["missionary_ids"]=$smissionary_ids;
        $supervisor_data[$supervisor_id]["missionary_names"]=$smissionary_names;


        


     }
     //print_r($supervisor_lists);exit;

      $page_data['supervisor_missionary_data']=$supervisor_data;

      
        ///////////////// page details ////////////////////////
                $this->load->view($page_data['css_file']);
                $this->load->view($page_data['top_menu']);
                $this->load->view( $page_data['side_menu'],$page_data);
                $this->load->view($page_data['page_name'],$page_data);
                $this->load->view('bk_cms/footer');
                $this->load->view($page_data['script_file']); 
  //////////////////// page details end ///////////////////
            

    }



/////////////////////////////////   Supervisor End    ///////////////////////




    ///////////////  supervisor Report List  ///////////////////
function supervisor_report($param1='',$param2='')
    {

     
        //////////////// page setup /////////////        

             $supervisor_id=$param1;
          
              $page_data['page_title']="supervisor Report";
              $page_data['form_heading']="supervisor Report";
              $page_data['table_heading']="Report List";
               $page_data['page_heading']="New supervisor";
              $page_data['err']="display: none";    


            $page_data['page_name']="backennd/mp_pannel/supervisor_report";
            $page_data['top_menu']="bk_cms/top_menu";
            $page_data['css_file']="bk_cms/advance_form_css";
            $page_data['script_file']="bk_cms/advance_form_script";
            $page_data['side_menu']="backennd/mp_pannel/side_menu";
             $page_data['footer']='bk_cms/footer';
          
             $bread_crum[0]=array("link"=>base_url()."MP_Panel/supervisor_reports","name"=>"supervisor Report List","class"=>"active-trail active");
            $bread_crum[1]=array("link"=>base_url()."MP_Panel/supervisor_report","name"=>"Add supervisor Report","class"=>"current");
            $page_data['bread_crums']=$bread_crum;


     ///////////////////////  Data  //////////////////////
            $mp_id=$this->session->userdata("mp_id");

            $sql="select * from mp_supervisor where mp_name='JLM' and mp_supervisor_id=$supervisor_id";

      $supervisor=$this->Aedr_model->get_row_sql($sql);
      $page_data['supervisor']=$supervisor;

      

        $page_data['missionary_details']=json_decode($supervisor['missionary_details'],true);

      //print_r($page_data['missionary_details']);exit;
      
     
        
        ///////////////// page details ////////////////////////
                $this->load->view($page_data['css_file']);
                $this->load->view($page_data['top_menu']);
                $this->load->view( $page_data['side_menu'],$page_data);
                $this->load->view($page_data['page_name'],$page_data);
                $this->load->view('bk_cms/footer');
                $this->load->view($page_data['script_file']); 
        //////////////////// page details end ///////////////////
      }
  //////////////////  supervisor report end /////////////


function supervisor_reports($param1 = '', $param2 = '' , $param3 = '')
    {
        $page_data['tiny_msg']="display:none";

        if($param1=='delete')
        {
          $page_data['tiny_msg']="display:block";
        }

        //////////////// page setup /////////////        
          
              $page_data['page_title']="Supervisor Report";
              $page_data['form_heading']="Upload supervisor report";
              $page_data['table_heading']="Missionaries Report List";
               $page_data['page_heading']="supervisor Report";
              $page_data['err']="display: none";    


            $page_data['page_name']="backennd/mp_pannel/supervisor_reports";
            $page_data['top_menu']="bk_cms/top_menu";
            $page_data['css_file']="bk_cms/list_form_css";
            $page_data['script_file']="bk_cms/script";
            $page_data['side_menu']="backennd/mp_pannel/side_menu";
             $page_data['footer']='bk_cms/footer';
          
             $bread_crum[0]=array("link"=>base_url()."MP_Panel/supervisor_reports","name"=>"supervisor Report List","class"=>"active-trail active");
            $bread_crum[1]=array("link"=>base_url()."MP_Panel/supervisor_report","name"=>"Add supervisor Report","class"=>"current");
           
            $page_data['bread_crums']=$bread_crum;


     ///////////////////////  Data  //////////////////////
     
      $mp_id=$this->session->userdata("mp_id");

      $sql="select * from mp_supervisor_report as msr,mp_supervisor as ms where msr.mp_id=$mp_id and ms.supervisor_id=msr.supervisor_id order by report_date desc";
      $page_data['supervisor_lists']=$this->Aedr_model->get_result_sql($sql);

      //print_r($page_data['supervisor_lists']);exit;


      $page_data['state_by_id']=$this->Aedr_model->get_row_by_id('state','state_id');
      $page_data['supervisor_by_id']=$this->Aedr_model->get_row_by_id('mp_supervisor','supervisor_id');

      


    
        ///////////////// page details ////////////////////////
                $this->load->view($page_data['css_file']);
                $this->load->view($page_data['top_menu']);
                $this->load->view( $page_data['side_menu'],$page_data);
                $this->load->view($page_data['page_name'],$page_data);
                $this->load->view('bk_cms/footer');
                $this->load->view($page_data['script_file']); 
  //////////////////// page details end ///////////////////
            

    }
///////////////////////// supervisor Report list End ////////////////


//////////////////  SUpervisor report Start /////////////

  function sreport_submission()
    {   

       //print_r($_POST);exit;

      
         $mp_id=$this->session->userdata("mp_id");
          
         $mp_name=$this->session->userdata('name');

        $reporter_name=$_POST['name'];
        $reporter_email=$_POST['email'];
        

        
        $sql ="select * from mp_reporter where email='$reporter_email' and mp_id=$mp_id";

        
        $reporter_details= $this->Aedr_model->get_row_sql($sql);
        
        if(empty($reporter_details))
        {
            redirect(base_url()."MP_Panel/missionary_report/err/1", 'refresh');
        }
        else
        {
        
        $year=$this->input->post('year');
          $period=$this->input->post('period');
         
       
        $missionary_id=$this->input->post('missionary_id');

         $sql ="select * from missionary_first where missionary_id=$missionary_id and mp_id=$mp_id";
       // print_r($sql);exit;
        $missionary_details= $this->Aedr_model->get_row_sql($sql);
        

         
        if(empty($missionary_details))
        {
            redirect(base_url()."Report/err/2", 'refresh');
        }
        else
        {

          $upload_name=$mp_name."_".$year."_R".$period."_".$missionary_details['fname'].'.jpg';
         //print_r($upload_name);exit;
        $PhotoFileName=$this->upload_image('photo','report_photo',$upload_name);
        
        $upload_name=$mp_name."_".$year."_R".$period."_".$missionary_details['fname'].'.docx';
       // print_r($upload_name);exit;
        $DocFileName=$this->upload_file("reprt_doc","./uploads/missionary_report/");

     //    print_r($_POST);exit;

        $fname=$this->input->post('fname');
        $surename=$this->input->post('surename'); 
        $state_id=$this->input->post('state_id');

        $insert['report_date']=date('Y-m-d');  
        $insert['missionary_id']=$missionary_details['missionary_id'];
         $insert['report']=$this->input->post('report');
         $insert['doc_link']=base_url()."uploads/missionary_report/".$DocFileName;
         
         if($PhotoFileName!=NULL)
          {
         $insert['photo_link']=$PhotoFileName;
         }

          
         $prayer_points=array();
        array_push($prayer_points,$this->input->post('pr1'));
        array_push($prayer_points,$this->input->post('pr2'));
        array_push($prayer_points,$this->input->post('pr3'));
            if($this->input->post('pr4')!='')
            {
                array_push($prayer_points,$this->input->post('pr4'));
            }
            if($this->input->post('pr5')!='')
            {
                array_push($prayer_points,$this->input->post('pr5'));
            }
            if($this->input->post('pr6')!='')
            {
                array_push($prayer_points,$this->input->post('pr6'));
            }
            if($this->input->post('pr7')!='')
            {
                array_push($prayer_points,$this->input->post('pr7'));
            }
            if($this->input->post('pr8')!='')
            {
                array_push($prayer_points,$this->input->post('pr8'));
            }
            if($this->input->post('pr9')!='')
            {
                array_push($prayer_points,$this->input->post('pr9'));
            }
            if($this->input->post('pr10')!='')
            {
                array_push($prayer_points,$this->input->post('pr10'));
            }

            $v=0;
            $village_details=array();           
            $v1=array();
            $v2=array();
            $v3=array();
            $v4=array();
            $v5=array();
            $v6=array();
            $v7=array();
            $v8=array();
            $v9=array();
            $v10=array();

            if($this->input->post('v1_name')!='' || $this->input->post('v1_cfprayer')!='' || $this->input->post('v1_baptisms')!='')
            {
                array_push($v1,'v1');
                array_push($v1,$this->input->post('v1_name'));
                array_push($v1,$this->input->post('v1_cfprayer'));
                array_push($v1,$this->input->post('v1_baptisms'));  

                $village_details[$v++]=$v1;                  
            }

            if($this->input->post('v2_name')!='' || $this->input->post('v2_cfprayer')!='' || $this->input->post('v2_baptisms')!='')
            {
                array_push($v2,'v2');
                array_push($v2,$this->input->post('v2_name'));
                array_push($v2,$this->input->post('v2_cfprayer'));
                array_push($v2,$this->input->post('v2_baptisms'));  

                $village_details[$v++]=$v2;                  
            }
            
            if($this->input->post('v3_name')!='' || $this->input->post('v3_cfprayer')!='' || $this->input->post('v3_baptisms')!='')
            {
                array_push($v3,'v3');
                array_push($v3,$this->input->post('v3_name'));
                array_push($v3,$this->input->post('v3_cfprayer'));
                array_push($v3,$this->input->post('v3_baptisms'));  

                $village_details[$v++]=$v3;                  
            }
            if($this->input->post('v4_name')!='' || $this->input->post('v4_cfprayer')!='' || $this->input->post('v4_baptisms')!='')
            {
                array_push($v4,'v4');
                array_push($v4,$this->input->post('v4_name'));
                array_push($v4,$this->input->post('v4_cfprayer'));
                array_push($v4,$this->input->post('v4_baptisms'));  

                $village_details[$v++]=$v4;                  
            }
            if($this->input->post('v5_name')!='' || $this->input->post('v5_cfprayer')!='' || $this->input->post('v5_baptisms')!='')
            {
                array_push($v5,'v5');
                array_push($v5,$this->input->post('v5_name'));
                array_push($v5,$this->input->post('v5_cfprayer'));
                array_push($v5,$this->input->post('v5_baptisms'));  

                $village_details[$v++]=$v5;                  
            }
            if($this->input->post('v6_name')!='' || $this->input->post('v6_cfprayer')!='' || $this->input->post('v6_baptisms')!='')
            {
                array_push($v6,'v6');
                array_push($v6,$this->input->post('v6_name'));
                array_push($v6,$this->input->post('v6_cfprayer'));
                array_push($v6,$this->input->post('v6_baptisms'));  

                $village_details[$v++]=$v6;                  
            }
            if($this->input->post('v7_name')!='' || $this->input->post('v7_cfprayer')!='' || $this->input->post('v7_baptisms')!='')
            {
                array_push($v7,'v7');
                array_push($v7,$this->input->post('v7_name'));
                array_push($v7,$this->input->post('v7_cfprayer'));
                array_push($v7,$this->input->post('v7_baptisms'));  

                $village_details[$v++]=$v7;                  
            }
            if($this->input->post('v8_name')!='' || $this->input->post('v8_cfprayer')!='' || $this->input->post('v8_baptisms')!='')
            {
                array_push($v8,'v8');
                array_push($v8,$this->input->post('v8_name'));
                array_push($v8,$this->input->post('v8_cfprayer'));
                array_push($v8,$this->input->post('v8_baptisms'));  

                $village_details[$v++]=$v8;                  
            }
            if($this->input->post('v9_name')!='' || $this->input->post('v9_cfprayer')!='' || $this->input->post('v9_baptisms')!='')
            {
                array_push($v9,'v9');
                array_push($v9,$this->input->post('v9_name'));
                array_push($v9,$this->input->post('v9_cfprayer'));
                array_push($v9,$this->input->post('v9_baptisms'));  

                $village_details[$v++]=$v9;                  
            }
            if($this->input->post('v10_name')!='' || $this->input->post('v10_cfprayer')!='' || $this->input->post('v10_baptisms')!='')
            {
                array_push($v10,'v10');
                array_push($v10,$this->input->post('v10_name'));
                array_push($v10,$this->input->post('v10_cfprayer'));
                array_push($v10,$this->input->post('v10_baptisms'));  

                $village_details[$v++]=$v10;                  
            }
            
          
     
            if($pr4!='')
            {
                array_push($prayer_points,$this->input->post('pr4'));
            }

           // print_r($reporter_details);exit;
          $insert['prayer_points']=json_encode($prayer_points);
          $insert['village_details']=json_encode($village_details);
          $insert['reporter_id']=$reporter_details['reporter_id'];
          $insert['report_year']=$this->input->post('year');
          $insert['report_period']=$this->input->post('period');
          $insert['status']=1;
          $insert['mp_id']=$this->session->userdata("mp_id");
          $insert['is_send']=0;

          //print_r($insert);exit;
          $report_id=$this->Aedr_model->insert_id("mp_missionary_report",$insert);
        //print_r($missionary_details);exit;

    
      }
    }
          redirect(base_url().'MP_Panel/generate_fw_termreport/'.$report_id,'refresh');
    }


//////////////////////////////  Supervisor Report Submission End   ///////////////////////////






}

?>