<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class aedr_model extends CI_Model 
{
    function __construct() 
    {
        parent::__construct();
    }

    function clear_cache() {
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    function insert($db_name,$insert_data)
    {
        
    	return $this->db->insert($db_name, $insert_data);
    }

    function insert_id($db_name,$insert_data)
    {
         $this->db->insert($db_name, $insert_data);
         return $this->db->insert_id();
    }

    function update($db_name,$where_string,$up_data)
    {
     // print_r($up_data);exit;
    	$this->db->where($where_string);
        $this->db->update($db_name,$up_data);

    }
    function delete($db_name,$where_string)
    {
    	$this->db->where($where_string);
        $this->db->delete($db_name);
    }

	function get_list($db_name) {
        $query = $this->db->get($db_name);
        return $query->result_array();
    }

    function get_1D_list($db_name,$filed_name,$id) {

          //  print_r($db_name);exit;

        $query = $this->db->get($db_name);
         $rst=$query->result_array();
            
            $values=array();
            $ids=array();
         foreach ($rst as $r) {
            array_push($values,$r[$filed_name]);
            array_push($ids,$r[$id]);
         }
         $actual_result['values']=$values;
         $actual_result['ids']=$ids;

         return $actual_result;
    }



    function get_row($db_name,$where_string) {
        		
        		//echo $where_string;
         $query=$this->db->get_where($db_name,$where_string);

        return $query->row_array();
    }

    function get_results_array($db_name,$where_string) {
                
            //  echo $where_string;exit;
         $query=$this->db->get_where($db_name,$where_string );

        return $query->result_array();
    }

     function get_row_by_id($db_name,$id_name) {
          
         $qry=$this->db->get_where($db_name)->result_array();
         foreach ($qry as $rst) {

            $data[$rst[$id_name]]=$rst;
         }
    

       return $data;
    }

    public function get_row_sql($sql)
    {   
        $query=$this->db->query($sql);
        return $query->row_array();
    }

    public function get_result_sql($sql)
    {   
        $query=$this->db->query($sql);
        return $query->result_array();
    }
    public function get_result_sql_form($room_type,$date1,$date2)
    {   

        $this->db->select('*');
        $this->db->from('booking');
        $this->db->where('(room_type="'.$room_type.'") AND (from_date >="'.$date1.'") AND (to_date <="'.$date2.'" )');
        $query = $this->db->get();

        return $query;
    }
    public function get_result_sql_search_class_room()
    {   
        echo "<script>console.log('Anuj 3333' );</script>";		

        $this->db->select('*');
        $this->db->from('class_room');
        $query = $this->db->get();
        echo "<script>console.log('Anuj 3333' );</script>";		

        return $query;
    }
    public function get_result_sql_search_room_info()
    {   

        $this->db->select('*');
        $this->db->from('room_info');
        $query = $this->db->get();

        return $query;
    }

    public function get_single_field($sql,$field_name)
    {   
        $query=$this->db->query($sql);
        $rst=$query->row_array();
       // print_r($rst);
        return $rst[$field_name];
    }
    




 }

 ?>