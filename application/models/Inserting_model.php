
<?php
class Inserting_model extends CI_Model{

  public function admin_login($email, $password){
    $this->load->database();
    echo "<script>console.log('Debug Objects: " . $password. "' );</script>";

    $query = $this->db->get_where('login_account', array('email'=>$email, 'password'=>$password));
    return $query->row_array();
  }
  public function user_login($email, $password){
    $this->load->database();
    echo "<script>console.log('Debug Objects: " . $password. "' );</script>";

    $query = $this->db->get_where('user_account', array('email'=>$email, 'password'=>$password));
    return $query->row_array();
  }
    function form_info($data){


        $this->load->database();
        echo "<script>console.log('Debu222222222222222222g Objects:' );</script>";

        $this->db->insert('form',$data);
        echo "<script>console.log('Debu222222222222222222g Objects:' );</script>";

        
    }
    public function select()  
      {  
        $this->load->database();
        
        $query = $this->db->get('form');  
        return $query;  
      }

    // ************************** Insert the data to Room Info **************************

    
    function room_info($id,$room_data){
      
        $this->load->database();

        $this->db->select('block_name.*, room_type.*,floor.*,seating_capacity.*');
        $this->db->from('block_name');
        $this->db->join('room_type', 'room_type.room_type_id = block_name.block_name_id','left');
        $this->db->join('floor', 'floor.floor_id = block_name.block_name_id','left');
        $this->db->join('seating_capacity', 'seating_capacity.seating_capacity_id = block_name.block_name_id','right');

        $query = $this->db->get();

        foreach ($query->result() as $row){

          if ($room_data['block_name'] == $row->block_name){
              $room_data['block_name']= $row->block_name_id;
          };

          if ($room_data['room_type'] == $row->room_type_name){
              $room_data['room_type']= $row->room_type_id;
          };

          if ($room_data['floor'] == $row->floor_name){
              $room_data['floor']= $row->floor_id;
          };

          if ($room_data['seating_capacity'] == $row->capacity){
              $room_data['seating_capacity']= $row->seating_capacity_id;
          };
        };
        //echo "<script>console.log('Debug Objects1: " . $id. "' );</script>";

        if ($id==""){
          $this->db->insert('room_info',$room_data);
        }
        else{
          $this->db->where('id',$id);
          $this->db->update('room_info',$room_data);
        }
    }

      // ************************** Get the Room info data from DB **************************
    public function get_room_info()  
      {  
        $this->load->database();


        
        $this->db->select('block_name.*, room_type.*,floor.*,seating_capacity.*');
        $this->db->from('block_name');
        $this->db->join('room_type', 'room_type.room_type_id = block_name.block_name_id','left');
        $this->db->join('floor', 'floor.floor_id = block_name.block_name_id','left');
        $this->db->join('seating_capacity', 'seating_capacity.seating_capacity_id = block_name.block_name_id','right');

        $query1 = $this->db->get();
        $query = $this->db->get('room_info'); 

        foreach ($query1->result() as $row){  
          
          foreach ($query->result() as $col){

            if ($col->block_name == $row->block_name_id){
                $col->block_name = $row->block_name;
            };

            if ($col->room_type == $row->room_type_id){
                $col->room_type = $row->room_type_name;
            };

            if ($col->floor == $row->floor_id){
                $col->floor = $row->floor_name;
            };

            if ($col->seating_capacity == $row->seating_capacity_id){
                $col->seating_capacity = $row->capacity;
            };
          }
        };
         return $query;  
      }

    public function room_type_name()  
      {  


         $query = $this->db->get('room_info');  

        
         return $query;  
      }
    
    public function block_name()
      {  
         $query = $this->db->get('block_name');  
         return $query;  
      }
    public function floor_name()
      {  
         $query = $this->db->get('floor');  
         return $query;  
      }
    public function year_name(){
      $query = $this->db->get('year');
      return $query;
    }
    public function dept_name(){
      $query = $this->db->get('department');
      return $query;
    }
    public function seating_capacity()
    {  
      $query = $this->db->get('seating_capacity');  
        return $query;  
    }
    public function room_type()
    {
      $query = $this->db->get('room_type');
      return $query;
    }




    public function room_edit($id)  
      {  
         $query = $this->db->get('room_info',$id);  
         return $query;  
      }
    public function Total_room()  
      {  
        $this->load->database();
       
        $query = $this->db->get('room_details');  
        return $query;  
      }


      
    // ************************** Update the Room info **************************

    public function edit_room_info($id,$room_data){
      
      
      $this->load->database();
      $this->db->where('id',$id);
      $this->db->update('room_info',$room_data);

      
    }

    public function allocated_room_insert($alloted_room_data,$para){
      $this->load->database();
     

      $this->db->select('department.*, year.*');
      $this->db->from('department');
      $this->db->join('year', 'year.year_id = department.dept_id ');

      $query1 = $this->db->get();
      
      $query = $this->db->get('academic_classroom_booking');
      

      $fdate = $alloted_room_data['from_date'];
      $tdate = $alloted_room_data['to_date'];

      $count = 0;
      $unique = 0;
      $alert_msg = 0;
      $is_name_in_form = false;
      foreach ($query->result() as $date){

      if((($fdate > $date->to_date) or ($fdate < $date->from_date)) and (($tdate < $date->from_date) or ($tdate >$date->to_date)) and ($count<1) and ($alloted_room_data['room_name']== $date->room_name) and $para=="") {     
        //echo "<script>console.log('from date: " .$alloted_room_data['room_name']. "' );</script>";
        //echo "<script>console.log('to date: " . $date->room_name. "' );</script>";
        //echo "<script>console.log('from date: " . $fdate. "' );</script>";
        //echo "<script>console.log('to date: " . $tdate. "' );</script>";
        //echo "<script>console.log('ofd: " . $date->from_date. "' );</script>";
        //echo "<script>console.log('otd: " . $date->to_date. "' );</script>";

        foreach ($query1->result() as $row){ 
            
              if ($alloted_room_data['dept'] == $row->dept_name){
                  $alloted_room_data['dept']= $row->dept_id;
              }

              if ($alloted_room_data['year'] == $row->year_name){
                  $alloted_room_data['year']= $row->year_id;
              }
            };
            $this->db->insert('academic_classroom_booking',$alloted_room_data);
            $
            $count = $count + 1;
            $unique = 1;
            $alert_msg = 1;
          }
          elseif($alloted_room_data['room_name']== $date->room_name){
            $is_name_in_form = true;
          }
    };

        if ($unique==0 and $para=="" and $is_name_in_form == false){

          foreach ($query1->result() as $row){ 

            if ($alloted_room_data['dept'] == $row->dept_name){
                $alloted_room_data['dept']= $row->dept_id;
            }

            if ($alloted_room_data['year'] == $row->year_name){
                $alloted_room_data['year']= $row->year_id;
            }
          };

          $this->db->insert('academic_classroom_booking',$alloted_room_data);
          $alert_msg = 1;
        }
        if($para != ""){

                  
          $this->db->where('alloted_room_id', $para);
          $this->db->delete('academic_classroom_booking');
        
            };
      
        return $alert_msg;

    }


    public function get_academic_schedule(){

      $this->load->database();

      $this->db->select('department.*, year.*');
      $this->db->from('department');
      $this->db->join('year', 'year.year_id = department.dept_id ');

      $query1 = $this->db->get();
      $query = $this->db->get('academic_classroom_booking');  

      foreach ($query1->result() as $row){ 
          foreach ($query->result() as $col){

            if ($col->dept == $row->dept_id){
                $col->dept = $row->dept_name;
            };

            if ($col->year == $row->year_id){
                $col->year = $row->year_name;
            };

          }
        };


      return $query; 
    }
    public function get_available_slots($date){
      
        $this->load->database();
        $query = $this->db->get('room_info');
        $alloted = $this->db->get('academic_classroom_booking');

        foreach ($query->result() as $col){
        foreach ($alloted->result() as $row){  
          
            
          //echo "<script>console.log('star: " . $col->room_name. "' );</script>";

          if(($date >= $row->from_date) and ($date <= $row->to_date) and ($row->room_name == $col->room_name)){
            $col->room_name = null;
            }
          else{
            if(($row->room_name == $col->room_name)){
            }
            }
          };

          }

        $this->db->select('block_name.*, room_type.*,floor.*,seating_capacity.*');
        $this->db->from('block_name');
        $this->db->join('room_type', 'room_type.room_type_id = block_name.block_name_id','left');
        $this->db->join('floor', 'floor.floor_id = block_name.block_name_id','left');
        $this->db->join('seating_capacity', 'seating_capacity.seating_capacity_id = block_name.block_name_id','right');

        $query1 = $this->db->get(); 

        foreach ($query1->result() as $row){  
          foreach ($query->result() as $col){

            if (( $col->block_name == $row->block_name_id )){
                $col->block_name = $row->block_name;
            };

            if ($col->room_type == $row->room_type_id){
                $col->room_type = $row->room_type_name;
            };

            if ($col->floor == $row->floor_id){
                $col->floor = $row->floor_name;
            };

            if ($col->seating_capacity == $row->seating_capacity_id){
                $col->seating_capacity = $row->capacity;
            };
          }
        };
        return $query;
      

    }




    ////////////////////////////////under work /////////////////////////////////
    public function get_available_admin_allocation(){
      $this->load->database();
      
      $current_day = date('Y-m-d');
    
      $this->db->select('room_name');
      $this->db->from('academic_classroom_booking');
      $this->db->where('"'.$current_day.'" BETWEEN from_date AND to_date');
      $query1 = $this->db->get(); 

      $this->db->select('allocated_room_name');
      $this->db->from('form');
      $this->db->where('("'.$current_day.'" BETWEEN f_date AND t_date) AND (approval="approved")');
      $query2 = $this->db->get();

      $not_avail_room = (array) null;
      $is_date_available = 0;

      foreach ($query2->result() as $row){
        array_push($not_avail_room,$row->allocated_room_name);
        $is_date_available = 1;
        echo "<script>console.log('qq2: " . $row->allocated_room_name. "' );</script>";
      }
  
      foreach ($query1->result() as $row){
        array_push($not_avail_room,$row->room_name);
        $is_date_available = 1;
        echo "<script>console.log('qq1: " . $row->room_name. "' );</script>";
      }

      
    if ($is_date_available == 1){

  
      $this->db->select('*');
      $this->db->from('room_info');
      $this->db->join('floor', 'floor.floor_id = room_info.floor');
      $this->db->join('block_name', 'block_name.block_name_id = room_info.block_name');
      $this->db->join('seating_capacity', 'seating_capacity.seating_capacity_id = room_info.seating_capacity');
      $this->db->join('room_type', 'room_type.room_type_id = room_info.room_type');
      $this->db->where_in('room_name NOT',$not_avail_room);


      
      $avail_room_name = $this->db->get();
    }
    else{
      $this->db->select('*');
      $this->db->from('room_info');
      $this->db->join('floor', 'floor.floor_id = room_info.floor');
      $this->db->join('block_name', 'block_name.block_name_id = room_info.block_name');
      $this->db->join('seating_capacity', 'seating_capacity.seating_capacity_id = room_info.seating_capacity');
      $this->db->join('room_type', 'room_type.room_type_id = room_info.room_type');
      $avail_room_name = $this->db->get();
    };

    return $avail_room_name; 
  }
  //////////////////////////////////////////////////////////////////////
  public function avail_request_room_name($para){
    $this->load->database();

    $data = $this->db->get_where('form', array('id' => $para))->row();

    $fd = $data->f_date;
    $td = $data->t_date;
    $ft = $data->f_time;
    $tt = $data->t_time;
    echo "<script>console.log('ggg: " . $ft. "' );</script>";
    echo "<script>console.log('ggg: " . $td. "' );</script>";


    $is_date_available = 0;
    $query1 = $this->db->get('academic_classroom_booking');

    foreach ($query1->result() as $row){

      if(($fd>=$row->from_date and $fd <= $row->to_date) or ($td>=$row->from_date and $td <= $row->to_date)){
      
        if(($ft>=$row->from_time and $ft <= $row->to_time) or ($tt>=$row->from_time and $tt <= $row->to_time)){
          $row->room_name = $row->room_name;
        }
        else{
          $row->room_name = null;
        }
      }
      else{ $row->room_name = null; }

    }


    $query2 = $this->db->get('form');

    foreach ($query2->result() as $row){


      if(($fd>=$row->f_date and $fd <= $row->t_date) or ($td>=$row->f_date and $td <= $row->t_date)){
      
        if(($ft>=$row->f_time and $ft <= $row->t_time) or ($tt>=$row->f_time and $tt <= $row->t_time)){
          
          if($row->approval == 'approved'){
            $row->room_name = $row->room_name;
          }
          else{
            $row->room_name = null;
          }
        }
        else{
          $row->room_name = null;
        }
      }
      else{ $row->room_name = null; }
      
    }

    $not_avail_room = (array) null;

    foreach ($query2->result() as $row){
      if ($row->room_name != ''){
        array_push($not_avail_room,$row->room_name);
        $is_date_available = 1;
        echo "<script>console.log('query222: " . $row->room_name. "' );</script>";
      }
    }

    foreach ($query1->result() as $row){
      if ($row->room_name != ''){
        array_push($not_avail_room,$row->room_name);
        $is_date_available = 1;
        echo "<script>console.log('query111: " . $row->room_name. "' );</script>";

      }
    }

    if ($is_date_available == 1){
      $this->db->select('room_name');
      $this->db->from('room_info');
      $this->db->where_in('room_name NOT',$not_avail_room);
      $avail_room_name = $this->db->get();


    }
    else{
      $this->db->select('room_name');
      $this->db->from('room_info');
      $avail_room_name = $this->db->get();
    };

    

    return $avail_room_name; 
  }

  public function allocate_faculty_request($id){
    $this->load->database();
    $data = $this->db->get_where('form', array('id' => $id))->row();

    $data->approval = 'approved';
    $data->allocated_room_name = $this->input->post('allocated_room_name');
    $this->db->where('id',$id);
    $this->db->update('form',$data);
  }
  public function edit_faculty_request($id){
    $this->load->database();
    $data = $this->db->get_where('form', array('id' => $id))->row();

    $data->capacity = $this->input->post('req_capacity');
    $data->room_type = $this->input->post('edit_rm_type');
    $data->f_date = $this->input->post('f_date');
    $data->t_date = $this->input->post('t_date'); 
    $data->f_time = $this->input->post('f_time');
    $data->t_time = $this->input->post('t_time');
    $this->db->where('id',$id);
    $this->db->update('form',$data);
  }


  public function time_percent($select_date){
    $fd = $this->input->post("select_from_date");
    $td = $this->input->post("select_to_date");

    $this->load->database();  
		$time_per=$this->db->get('academic_classroom_booking');
		$room_type=$this->db->get('room_type');
		$room_info=$this->db->get('room_info');

    foreach($room_type->result() as $row){
			foreach($room_info->result() as $coloum){
				if($row->room_type_id == $coloum->room_type){
          
					$coloum->room_type = $row->room_type_name;

				}
			}
		}
    echo "<script>console.log('//////////////////////////////////' );</script>";
    if ($fd != NULL){
      foreach($time_per->result() as $row){
        echo "<script>console.log('booked123345 room	: " .$fd. "' );</script>";
        foreach($room_info->result() as $coloum){
          if($row->room_name == $coloum->room_name){
            echo "<script>console.log('kumar room	: " .$fd. "' );</script>";

            if(($fd<=$row->from_date) and ($td >= $row->to_date)){
              echo "<script>console.log('anuj room	: " .$fd. "' );</script>";
              $row->room_type = $coloum->room_type;
            }
            else{
              $row->room_type = NULL;
            }
          }
        }
      }
      echo "<script>console.log('//////////////////////////////////' );</script>";

    }
    else{
      foreach($time_per->result() as $row){
        foreach($room_info->result() as $coloum){
          if($row->room_name == $coloum->room_name){
            $row->room_type = $coloum->room_type;
          }
        }
      }
    }

    return $time_per;
}



}
?>