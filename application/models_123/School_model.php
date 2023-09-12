<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class School_model extends CI_Model 
{

    

    function school_details()
    {
        $id=$this->session->userdata('login_user_id')

        $qry1=$this->db->query("select distinct sch.* from schools as sch,principal as cm where sch.school_id=cm.school_id and cm.principal_id=$id");
        return $qry1->row_array(); 
      
      
    }
    



}


?>