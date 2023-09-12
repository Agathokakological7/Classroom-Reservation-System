<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_model extends CI_Model 
{
    function __construct() 
    {
        parent::__construct();
    }

    function clear_cache() {
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

     function get_course($course_id) {
       $query = $this->db->get_where('course', array('course_id' => $course_id));
        return $query->row_array();
    }

   function get_teachers_subject_id($subject_id,$coaching_type)
	{
		$qry=$this->db->query("select * from teacher where subject_id=$subject_id and coaching_type=$coaching_type");
		return $qry->result_array();
		 
	}

    function get_teachers_id_coursemapping($course_id)
    {
        $qry=$this->db->query("select * from course_mapping where course_id=$course_id");
        return $qry->row_array();
         
    }
     function get_top_courses()
    {
        $qry=$this->db->query("select * from course as cs,course_mapping as cm where cs.course_id=cm.course_id and flag=2 LIMIT 3");
        return $qry->result_array();
         
    }

    function get_all_courses()
    {
        $qry=$this->db->query("select * from course as cs,course_mapping as cm where cs.course_id=cm.course_id and flag=2");
        return $qry->result_array();
         
    }

    function get_courses($course_id)
    {
        $qry=$this->db->query("select * from course where course_id=$course_id");
        return $qry->row_array();
         
    }

   // SELECT ctm_id FROM `course_mapping` WHERE FIND_IN_SET(5,teacher_ids)
     function get_courses_mapping_details($course_id)
    {

        $qry=$this->db->query("select * from course_mapping where course_id=$course_id");
        return $qry->row_array();     
    }

    function get_teachers_by_coursemapping()
    {

        $qry=$this->db->query("select distinct ts.* from teacher as ts,course_mapping as cm where FIND_IN_SET(ts.teacher_id,cm.teacher_ids)");
        return $qry->result_array();     
    }
    function get_teachers_by_subject($subject_id)
    {

        $qry=$this->db->query("select distinct ts.* from teacher as ts,course_mapping as cm where FIND_IN_SET(ts.teacher_id,cm.teacher_ids) and ts.subject_id=$subject_id");
        return $qry->result_array();     
    }

        function get_teacher_coursemapping_details($teacher_id)
    {

        $qry=$this->db->query("select distinct cs.* from course as cs,course_mapping as cm where FIND_IN_SET($teacher_id,cm.teacher_ids) and cs.course_id=cm.course_id");
        return $qry->result_array();     
    }

function get_teacher_coursemapping_details($teacher_id)
    {

        $qry=$this->db->query("select distinct cs.* from course as cs,course_mapping as cm where FIND_IN_SET($teacher_id,cm.teacher_ids) and cs.course_id=cm.course_id");
        return $qry->result_array();     
    }

  /*  function school_details()
    {
        $id=$this->session->userdata('login_user_id')

        $qry1=$this->db->query("select distinct sch.* from schools as sch,principal as cm where sch.school_id=cm.school_id and cm.principal_id=$id");
        return $qry1->row_array(); 
      
      
    }
    */



}


?>