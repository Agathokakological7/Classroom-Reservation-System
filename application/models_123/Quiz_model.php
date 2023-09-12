<?php
Class Quiz_model extends CI_Model
{
 
  function quiz_list($limit){
	  
	  $logged_in=$this->session->userdata('logged_in');
			if($logged_in['su']=='0'){
			$gid=$logged_in['gid'];
			$where="FIND_IN_SET('".$gid."', gids)";  
			 $this->db->where($where);
			}
			
			
	 if($this->input->post('search') && $logged_in['su']=='1'){
		 $search=$this->input->post('search');
		 $this->db->or_where('exam_id',$search);
		 $this->db->or_like('quiz_name',$search);
		 $this->db->or_like('description',$search);

	 }
		$this->db->limit($this->config->item('number_of_rows'),$limit);
		$this->db->order_by('exam_id','desc');
		$query=$this->db->get('online_exam');
		return $query->result_array();
		
	 
 }
 
 function num_quiz(){
	 
	 $query=$this->db->get('online_exam');
		return $query->num_rows();
 }
 
 function insert_quiz(){
	 
	 $userdata=array(
	 'quiz_name'=>$this->input->post('quiz_name'),
	 'description'=>$this->input->post('description'),
	 'start_date'=>strtotime($this->input->post('start_date')),
	 'end_date'=>strtotime($this->input->post('end_date')),
	 'duration'=>$this->input->post('duration'),
	 'maximum_attempts'=>$this->input->post('maximum_attempts'),
	 'pass_percentage'=>$this->input->post('pass_percentage'),
	 'correct_score'=>$this->input->post('correct_score'),
	 'incorrect_score'=>$this->input->post('incorrect_score'),
	 'ip_address'=>$this->input->post('ip_address'),
	 'view_answer'=>$this->input->post('view_answer'),
	 'camera_req'=>$this->input->post('camera_req'),
	 'gids'=>implode(',',$this->input->post('gids')),
	 'question_selection'=>$this->input->post('question_selection')
	 );
	 if($this->input->post('gen_certificate')){
		$userdata['gen_certificate']=$this->input->post('gen_certificate'); 
	 }
	 if($this->input->post('certificate_text')){
		$userdata['certificate_text']=$this->input->post('certificate_text'); 
	 }
	  $this->db->insert('online_exam',$userdata);
	 $exam_id=$this->db->insert_id();
	return $exam_id;
	 
 }
 
 
 function update_quiz($exam_id){
	 
	 $userdata=array(
	 'quiz_name'=>$this->input->post('quiz_name'),
	 'description'=>$this->input->post('description'),
	 'start_date'=>strtotime($this->input->post('start_date')),
	 'end_date'=>strtotime($this->input->post('end_date')),
	 'duration'=>$this->input->post('duration'),
	 'maximum_attempts'=>$this->input->post('maximum_attempts'),
	 'pass_percentage'=>$this->input->post('pass_percentage'),
	 'correct_score'=>$this->input->post('correct_score'),
	 'incorrect_score'=>$this->input->post('incorrect_score'),
	 'ip_address'=>$this->input->post('ip_address'),
	 'view_answer'=>$this->input->post('view_answer'),
	 'camera_req'=>$this->input->post('camera_req'),
	 'gids'=>implode(',',$this->input->post('gids'))
	 );
	 	 if($this->input->post('gen_certificate')){
		$userdata['gen_certificate']=$this->input->post('gen_certificate'); 
	 }
	 if($this->input->post('certificate_text')){
		$userdata['certificate_text']=$this->input->post('certificate_text'); 
	 }

	  $this->db->where('exam_id',$exam_id);
	  $this->db->update('online_exam',$userdata);
	  
	  $this->db->where('exam_id',$exam_id);
	  $query=$this->db->get('online_exam',$userdata);
	 $quiz=$query->row_array();
	 if($quiz['question_selection']=='1'){
		 
	  $this->db->where('exam_id',$exam_id);
	  $this->db->delete('savsoft_qcl');
	 
	 foreach($_POST['cid'] as $ck => $val){
		 if(isset($_POST['noq'][$ck])){
			 if($_POST['noq'][$ck] >= '1'){
		 $userdata=array(
		 'exam_id'=>$exam_id,
		 'cid'=>$val,
		 'lid'=>$_POST['lid'][$ck],
		 'noq'=>$_POST['noq'][$ck]
		 );
		 $this->db->insert('savsoft_qcl',$userdata);
		 }
		 }
	 }
		 $userdata=array(
		 'noq'=>array_sum($_POST['noq'])
	);
	 $this->db->where('exam_id',$exam_id);
	  $this->db->update('online_exam',$userdata);
	 }
	return $exam_id;
	 
 }
 
 function get_questions($qids){


	 if($qids == ''){
		$qids=0; 
	 }else{
		 $qids=$qids;
	 }
/*
	 if($cid!='0'){
		 $this->db->where('savsoft_qbank.cid',$cid);
	 }
	 if($lid!='0'){
		 $this->db->where('savsoft_qbank.lid',$lid);
	 }
*/
	  
	 $query=$this->db->query("select * from questions
	 where questions.question_id in ($qids) order by FIELD(questions.question_id,$qids) 
	 ");
	 return $query->result_array();
	 
	 
 }
 
 function get_options($qids){
	 
	 
	 $query=$this->db->query("select * from savsoft_options where qid in ($qids) order by FIELD(savsoft_options.qid,$qids)");
	 return $query->result_array();
	 
 }
 
 
 
 function up_question($exam_id,$qid){
  	$this->db->where('exam_id',$exam_id);
 	$query=$this->db->get('online_exam');
 	$result=$query->row_array();
 	$qids=$result['qids'];
 	if($qids==""){
 	$qids=array();
 	}else{
 	$qids=explode(",",$qids);
 	}
 	$qids_new=array();
 	foreach($qids as $k => $qval){
 	if($qval == $qid){

 	$qids_new[$k-1]=$qval;
	$qids_new[$k]=$qids[$k-1];
	
 	}else{
	$qids_new[$k]=$qval;
 	
	}
 	}
 	
 	$qids=array_filter(array_unique($qids_new));
 	$qids=implode(",",$qids);
 	$userdata=array(
 	'qids'=>$qids
 	);
 		$this->db->where('exam_id',$exam_id);
	$this->db->update('online_exam',$userdata);

}



function down_question($exam_id,$qid){
  	$this->db->where('exam_id',$exam_id);
 	$query=$this->db->get('online_exam');
 	$result=$query->row_array();
 	$qids=$result['qids'];
 	if($qids==""){
 	$qids=array();
 	}else{
 	$qids=explode(",",$qids);
 	}
 	$qids_new=array();
 	foreach($qids as $k => $qval){
 	if($qval == $qid){

 	$qids_new[$k]=$qids[$k+1];
$kk=$k+1;
	$kv=$qval;
 	}else{
	$qids_new[$k]=$qval;
 	
	}

 	}
 	$qids_new[$kk]=$kv;
	
 	$qids=array_filter(array_unique($qids_new));
 	$qids=implode(",",$qids);
 	$userdata=array(
 	'qids'=>$qids
 	);
 		$this->db->where('exam_id',$exam_id);
	$this->db->update('online_exam',$userdata);

}




function get_qcl($exam_id){
	
	 $this->db->where('exam_id',$exam_id);
	 $query=$this->db->get('savsoft_qcl');
	 return $query->result_array();
	
}

 function remove_qid($exam_id,$qid){
	 
	 $this->db->where('exam_id',$exam_id);
	 $query=$this->db->get('online_exam');
	 $quiz=$query->row_array();
	 $new_qid=array();
	 foreach(explode(',',$quiz['qids']) as $key => $oqid){
		 
		 if($oqid != $qid){
			$new_qid[]=$oqid; 
			 
		 }
		 
	 }
	 $noq=count($new_qid);
	 $userdata=array(
	 'qids'=>implode(',',$new_qid),
	 'noq'=>$noq
	 
	 );
	 $this->db->where('exam_id',$exam_id);
	 $this->db->update('online_exam',$userdata);
	 return true;
 }
 
  function add_qid($exam_id,$qid){
	 
	 $this->db->where('exam_id',$exam_id);
	 $query=$this->db->get('online_exam');
	 $quiz=$query->row_array();
	 $new_qid=array();
	 $new_qid[]=$qid;
	 foreach(explode(',',$quiz['qids']) as $key => $oqid){
		 
		 if($oqid != $qid){
			$new_qid[]=$oqid; 
			 
		 }
		 
	 }
	 $new_qid=array_filter(array_unique($new_qid));
	 $noq=count($new_qid);
	 $userdata=array(
	 'qids'=>implode(',',$new_qid),
	 'noq'=>$noq
	 
	 );
	 $this->db->where('exam_id',$exam_id);
	 $this->db->update('online_exam',$userdata);
	 return true;
 }
 

 
 function get_quiz($exam_id){
	 $this->db->where('exam_id',$exam_id);
	 $query=$this->db->get('online_exam');
	 return $query->row_array();
	 
	 
 } 
 
 function remove_quiz($exam_id){
	 
	 $this->db->where('exam_id',$exam_id);
	 if($this->db->delete('online_exam')){
		 
		 return true;
	 }else{
		 
		 return false;
	 }
	 
	 
 }
 
  
 
 function count_result($exam_id,$uid){
	 
	 $this->db->where('exam_id',$exam_id);
	 $this->db->where('student_id',$uid);
	$query=$this->db->get('result');
	return $query->num_rows();
	 
 }
 
 
 function insert_result($exam_id,$uid){

	 // get quiz info
	$this->db->where('exam_id',$exam_id);
	$query=$this->db->get('online_exam');
	$quiz=$query->row_array();

	
	 

		 
	// get questions	
	$noq=$quiz['noq'];	
	$qids=explode(',',$quiz['qids']);

	
	$categories=array();
	$category_range=array();

	$i=1;
	$wqids=implode(',',$qids);

	$subject_ids=array();


	//print_r($wqids);exit;

	
	$query=$this->db->query("select ques.*,sb.* from questions as ques,sub_topic as stp,question_bank as qb,topic as tp,subject as sb where qb.qb_id=ques.qb_id and qb.sub_topic_id=stp.sub_topic_id and stp.topic_id=tp.topic_id and tp.subject_id=sb.subject_id and question_id in ($wqids) ORDER BY FIELD(question_id,$wqids)");	

		
	$questions=$query->result_array();

	
	//print_r();exit;

$noq_subject=array();

	foreach($questions as $qk => $question){
		if(!in_array($question['name'],$categories)){
		 $categories[]=$question['name'];
		 $subject_ids=$question['subject_id'];
		$noq_subject[$question['subject_id']]=1;
			}
			else
			{
				$noq_subject[$question['subject_id']]+=1;
			}
			

	}



	
	//print_r($noq_subject);exit;
	
	$zeros=array();
	 foreach($qids as $qidval){
	 $zeros[]=0;
	 }
	 $userdata=array(
	 'exam_id'=>$exam_id,
	 'student_id'=>$uid,
	 'r_qids'=>implode(',',$qids),
	 'categories'=>implode(',',$categories),
	 'category_range'=>implode(',',$noq_subject),
	 'start_time'=>time(),
	 'individual_time'=>implode(',',$zeros),
	 'score_individual'=>implode(',',$zeros),
	 'attempted_ip'=>$_SERVER['REMOTE_ADDR'] 
	 );

	//print_r($userdata);exit;
	 
	
	 $this->db->insert('result',$userdata);
	  $rid=$this->db->insert_id();
	return $rid;
 }
 
 
 
 function open_result($exam_id,$uid){
	 $result_open='open';
		$query=$this->db->query("select * from result  where result_status='$result_open' "); 

		//print_r($query);exit;
	if($query->num_rows() >= '1'){
		$result=$query->row_array();
return $result['rid'];		
	}else{
		return '0';
	}
	
	 
 }
 
 function quiz_result1($rid){
	 
	 
	$query=$this->db->query("select result.* from result join online_exam on result.exam_id=online_exam.exam_id where result.rid='$rid' "); 
	return $query->row_array(); 
	 
 }

 function quiz_result($rid){
	 
	 
	$query=$this->db->query("select * from result join online_exam on result.exam_id=online_exam.exam_id where result.rid='$rid' "); 
	return $query->row_array(); 
	 
 }
 
function saved_answers($rid){
	 
	 
	$query=$this->db->query("select * from answers  where answers.rid='$rid' "); 
	return $query->result_array(); 
	 
 }
 
 
 function assign_score($rid,$qno,$score){
	 $qp_score=$score;
	 $query=$this->db->query("select * from result join online_exam on result.exam_id=online_exam.exam_id where result.rid='$rid' "); 
	$quiz=$query->row_array(); 
	$score_ind=explode(',',$quiz['score_individual']);
	$score_ind[$qno]=$score;
	$r_qids=explode(',',$quiz['r_qids']);
	$correct_score=$quiz['correct_score'];
	$incorrect_score=$quiz['incorrect_score'];
		$manual_valuation=0;
	foreach($score_ind as $mk => $score){
		
		if($score == 1){
			
			$marks+=$correct_score;
		}
		if($score == 2){
			
			$marks+=$incorrect_score;
		}
		if($score == 3){
			
			$manual_valuation=1;
		}
		
	}
	$percentage_obtained=($marks/$quiz['noq'])*100;
	if($percentage_obtained >= $quiz['pass_percentage']){
		$qr=$this->lang->line('pass');
	}else{
		$qr=$this->lang->line('fail');
		
	}
	 $userdata=array(
	  'score_individual'=>implode(',',$score_ind),
	  'score_obtained'=>$marks,
	 'percentage_obtained'=>$percentage_obtained,
	 'manual_valuation'=>$manual_valuation
	 );
	 if($manual_valuation == 1){
		 $userdata['result_status']=$this->lang->line('pending');
	}else{
		$userdata['result_status']=$qr;
	}
	 $this->db->where('rid',$rid);
	 $this->db->update('result',$userdata);
	 
	 // question performance
	 $qp=$r_qids[$qno];
	 		 $crin="";
		if($$qp_score=='1'){
			$crin=", no_time_corrected=(no_time_corrected +1)"; 	 
		 }else if($$qp_score=='2'){
			$crin=", no_time_incorrected=(no_time_incorrected +1)"; 	 
		 }
		  $query_qp="update savsoft_qbank set  $crin  where qid='$qp'  ";
	 $this->db->query($query_qp);
 }
 
 
 
 function submit_result(){
	 $logged_in=$this->session->userdata('logged_in');
	 $email=$logged_in['email'];
	 $rid=$this->session->userdata('rid');
	$query=$this->db->query("select * from result join online_exam on result.exam_id=online_exam.exam_id where result.rid='$rid' "); 
	$quiz=$query->row_array(); 


	$score_ind=explode(',',$quiz['score_individual']);
	$r_qids=explode(',',$quiz['r_qids']);
	$qids_perf=array();
	$marks=0;
	$correct_score=$quiz['correct_score'];
	$incorrect_score=-($quiz['incorrect_score']);
	$total_time=array_sum(explode(',',$quiz['individual_time']));
	$manual_valuation=0;

	//print_r($score_ind);exit;

	foreach($score_ind as $mk => $score){
		$qids_perf[$r_qids[$mk]]=$score;
		
		if($score == 1){
			
			$marks+=$correct_score;
			
		}
		if($score == 2){
			
			$marks+=$incorrect_score;
		}
		if($score == 3){
			
			$manual_valuation=1;
		}
		

	}
	
	$percentage_obtained=($marks/$quiz['noq'])*100;
	if($percentage_obtained >= $quiz['pass_percentage']){
		$qr="Pass";
	}else{
		$qr="fail";
		
	}


	 $userdata=array(
	  'total_time'=>$total_time,
	   'end_time'=>time(),
	  'score_obtained'=>$marks,
	 'percentage_obtained'=>$percentage_obtained,
	 'manual_valuation'=>$manual_valuation
	 );

	 

	 if($manual_valuation == 1){
		 $userdata['result_status']="Pending";
	}else{
		$userdata['result_status']=$qr;
	}

	
	 $this->db->where('rid',$rid);
	 $this->db->update('result',$userdata);
	 
	return true;
 }
 
 
 function insert_answer(){
	 $rid=$_POST['rid'];
	
	$uid=$_POST['uid'];
	
	$query=$this->db->query("select * from result join online_exam on result.exam_id=online_exam.exam_id where result.rid='$rid' "); 
	$quiz=$query->row_array();
	$correct_score=$quiz['correct_score'];
	$incorrect_score=$quiz['incorrect_score'];
	$qids=explode(',',$quiz['r_qids']);
	$vqids=$quiz['r_qids'];
	$correct_incorrect=explode(',',$quiz['score_individual']);
	
	
	// remove existing answers
	$this->db->where('rid',$rid);
	$this->db->delete('answers');
	//return $_POST['answer'];exit;
	 foreach($_POST['answer'] as $ak => $answer){	 
		 // multiple choice single answer	 
			 // print_r($answer);//exit;
			 $qid=$qids[$ak];
			 //$user_ans=$answer[];
			 $query=$this->db->query(" select * from questions where question_id='$qid' ");
			 $options_data=$query->row_array();

			// return print_r($user_ans);exit;
			 $options=array();
			 for($id=1;$id<=4;$id++)
			 	{
			 		if($id==$options_data['correctanswer'])
			 	 		$options[$id]=$correct_score;
			 	 	else
			 	 		$options[$id]=-($incorrect_score);
			 	}

			 	
			 
			 $attempted=0;
			 $marks=0;

			// return print_r($answer);exit;
			foreach($answer as $sk => $ansval){
					//return print_r($ansval);exit;
					if($options[$ansval] <= 0 ){
					$marks+=-1;	
					}else{
					$marks+=$options[$ansval];
					}
					$userdata=array(
					'rid'=>$rid,
					'qid'=>$qid,
					'uid'=>$uid,
					'q_option'=>$ansval,
					'score_u'=>$options[$ansval]
					);

			//	return	print_r($userdata);exit;
					$this->db->insert('answers',$userdata);
					 //return $this->db->insert_id();exit;
	
				$attempted=1;	
				}
				if($attempted==1){
					if($marks==1){
					$correct_incorrect[$ak]=1;	
					}else{
					$correct_incorrect[$ak]=2;							
					}
				}else{
					$correct_incorrect[$ak]=0;
				}
		
	}	
	$userdata=array(
	 'score_individual'=>implode(',',$correct_incorrect),
	 'individual_time'=>$_POST['individual_time'],
	 
	 );
	 $this->db->where('rid',$rid);
	 $this->db->update('result',$userdata);
	
 }
 
 function set_ind_time(){
	 	$rid=$this->session->userdata('rid');

	 $userdata=array(
	 'individual_time'=>$_POST['individual_time'],
	 
	 );
	 $this->db->where('rid',$rid);
	 $this->db->update('result',$userdata);
	 
	 return true;
 }
 
 
}
?>