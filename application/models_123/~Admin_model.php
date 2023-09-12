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
    



}


?>