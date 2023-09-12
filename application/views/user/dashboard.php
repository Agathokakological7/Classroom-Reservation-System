     
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

<style>
	.date_{
  background-color: #a2cbf5;
  border: none;
  border-radius: 20px;
  color:black;
  padding: 2px;
}
#from_date{
  margin-left: 17px;
  font-size: 17px;
}
#select_from_date{
  font-size: 18px;
  margin-top: 20px;
  border: none;
  margin-left: 20px;
  border-radius: 30px;
  padding: 7px;

}
#to_date{
  margin-left: 100px;
  font-size: 17px;
}
#select_to_date{
  margin-left: 20px;
  border-radius: 30px;
  padding: 7px;
  border: none;
}

#search_button{
  margin-left: 100px;
  border: none;
  border-radius: 15px;
  padding: 8;
  background-color: #0f1896;
  color: white;
  width: 80px;
}
#search_button:hover{
  transition: 1s;
  background-color: #1877f2;
}
.cls{
    width: 90%;
    height: 50px;
    border-radius: 7px; 
    border-color: rgb(100, 240, 123); 
    background-color: aliceblue;
    border-width: 2px;
    margin: 10px;
    text-align:center;
    padding-bottom:50px;
    font-family: "Lucida Console", "Courier New", monospace;
}
.combo_box{
    height:25%;
    font-size:16px;
  }
  .date_search{
    border-radius:4px;
  }



  .multiselect {
  width: 200px;
}

.selectBox {
  position: relative;
}

.selectBox select {
  width: 100%;
  font-weight: bold;
}

.overSelect {
  position: absolute;
  left: 0;
  right: 0;
  top: 0;
  bottom: 0;
}

#checkboxes, #Block_checkboxes {
  display: none;
  border: 1px #dadada solid;
  position:absolute;
  z-index: 99;
  width: 100%;
  background-color:white;
}

#checkboxes label , #Block_checkboxes label{
  display: block;
  padding:4px;
}
#checkboxes label input , #Block_checkboxes label input{
  padding:5px;
}


#checkboxes label:hover , #Block_checkboxes label:hover {
  background-color: #1e90ff;
}

</style>

<script>


	var roomtype_expanded = false;
var block_expanded = false;

function showCheckboxes() {
  var checkboxes = document.getElementById("checkboxes");
  if (!roomtype_expanded) {
    checkboxes.style.display = "block";
    roomtype_expanded = true;
  } else {
    checkboxes.style.display = "none";
    roomtype_expanded = false;
  }}

  function show_block_Checkboxes() {
  var checkboxes = document.getElementById("Block_checkboxes");
  if (!block_expanded) {
    checkboxes.style.display = "block";
    block_expanded = true;
  } else {
    checkboxes.style.display = "none";
    block_expanded = false;
  }
}
</script>


<!-- partial -->
<div class="main-panel">
<div class="content-wrapper">
  <div class="row">
	<div class="col-md-12 grid-margin">
	
  <div class="row">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  

                       <!-- End of Name -->

                       
                      <!-- Starting of Name -->
                    <div class="row">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <?php
                      echo form_open_multipart(base_url() . 'Dashboard_user/index/1' , array('data-toggle' => 'validator', 'role' => 'form','class'=>'form-sample'));
                    ?>

                  
                    <p class="card-description">
                    </p>


                    <div class="div" id="faculty_user">
                  

                    
                 
                 
                      <div class="row">
                      <div class="col-md-4">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label" for="room_type">Room Type</label>
                          <div class="col-sm-9">
                            <select id="room_type" name="room_type" required>
                                  <?php  
                                  foreach ($room_typess->result() as $rtype)  
                                  {  
                                      ?>
                                <option value="<?php echo $rtype->room_type_id; ?>"><?php echo $rtype->room_type_name; ?></option>

                              <?php } ?>
                            </select>
                          </div>
                        </div>
                      </div>

                     
                      <div class="col-md-4">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">From Date</label>
                          <div class="col-sm-9">
                            <input type="datetime-local" id="from_date_time" name="from_date_time" class="form-control" required>
                          </div>
                        </div>
                      </div>


                      <div class="col-md-4">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">To Date</label>
                          <div class="col-sm-9">
                            <input type="datetime-local" id="to_date_time" name="to_date_time" class="form-control" required>
                          </div>
                        </div>
                      </div>


                
                    
                       </div>

                     <center> <input type="submit" id="submit" class="btn  mr-2" value="Search" style="background-color:#4B49AC ;color:whitesmoke"/></center>
                    
                    </div>
                  </form>
                </div>
              </div>
            </div>            
          </div>
                   
               
                </div>
              </div>
            </div>            
          </div>
          
  
  
  <div class="row">
    <div class="col-md-6 grid-margin stretch-card">
      <div class="card tale-bg">
        <div class="card-people mt-auto">
          <img src="<?php echo base_url()?>images/Dashboard/people.svg" alt="people">
          <div class="weather-info">
            <div class="d-flex">
              <div>
                <h2 class="mb-0 font-weight-normal"><i class="icon-sun mr-2"></i>31<sup>C</sup></h2>
              </div>
              <div class="ml-2">
                <h4 class="location font-weight-normal">sathyamangalam</h4>
                <h6 class="font-weight-normal">tamilnadu</h6>
            
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
	<!-- ./////////////////////////////////// -->

	<div class="col-md-6 grid-margin transparent">
              <div class="row">
                <div class="col-md-12 mb-4 stretch-card transparent">
                  <div class="card card-tale">
				  <div class="card-body">
					<p class="mb-4">Total Request</p>
					<p class="fs-30 mb-2">

					<?php
						echo $tot_rm;
					?>

			  		</p>
			 
				  </div>
                  </div>
                </div>
                
              </div>
              <div class="row">
                <div class="col-md-12 mb-4 mb-lg-0 stretch-card transparent">
                  <div class="card card-light-blue">
				  <div class="card-body">
					<p class="mb-4">Pending Request</p>
					<p class="fs-30 mb-2">
						<?php echo $total_booked ?>
			  		</p>
					</div>
                  </div>
                </div>
                
              </div>
            </div>
          </div>


	<!-- ///////////////////////////////////// -->
	
  </div>

  <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
			<div class="card">
                <div class="card-body">
                  <h4 class="card-title">Total Request</h4>
                  
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>Name</th>
                          <th>From Date</th>
                          <th>To Date</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>Jacob</td>
                          <td>01-01-2023</td>
                          <td>05-01-2023</td>
                          <td><label class="badge badge-danger">Rejected</label></td>
                        </tr>
                        <tr>
                          <td>Jacob</td>
                          <td>24-12-2022</td>
                          <td>27-12-2022</td>
                          <td><label class="badge badge-success">Success</label></td>
                        </tr>
                        <tr>
                          <td>Jacob</td>
                          <td>10-12-2022</td>
                          <td>20-12-2022</td>
                          <td><label class="badge badge-success">Success</label></td>
                        </tr>
                        
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-6 grid-margin stretch-card">
			<div class="card">
                <div class="card-body">
                  <h4 class="card-title">Pending Request</h4>
                 
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>Name</th>
                          <th>From Date</th>
                          <th>To Date</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>Jacob</td>
                          <td>10-01-2023</td>
                          <td>15-01-2023</td>
                          <td><label class="badge badge-warning">Pending</label></td>
                        </tr>
                        
                        <tr>
                          <td>Jacob</td>
                          <td>18-01-2023</td>
                          <td>19-01-2023</td>
                          <td><label class="badge badge-warning">Pending</label></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

            
            
          </div>



		  <div class="col-md-12 grid-margin stretch-card">
			<div class="card">
                <div class="card-body">


                <div class="row">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title  p-3" style="border-radius:15px; color:whitesmoke;background-color:#4B49AC ;">Class Room details</h4>


                 
                            <div class="row">
                              <?php

                                    if(!empty($class_room_details))
                                    {

                                      foreach ($class_room_details->result() as $class_room) {

                                        
                                            
                                            if(in_array($class_room->class_room_id,$search_result))
                                            {
                                              $style="background-color: #FCBCA0;";
                                              $is_model_style="";
                                            }
                                            else
                                            {
                                              $style="background-color: #D2FFFF;";
                                              $is_model_style="card-text view_detail";

                                            }



                                        ?>
                                           <div class="col-md-3" id="ib101" disabled>    
                                            <div class="card shadow cls"  style="<?php echo $style; ?>">
                                              <a class="<?php echo $is_model_style; ?>" id="<?php echo $class_room->class_room_id; ?>" style="text-decoration: none;color: #050404;">
                                    <div class="card-body" id="IB101C"  >
                                   <!--   <button class="btn btn-primary view_detail" id="<?php echo $row->id;  ?>">View</button>-->
                                      
                                      <p class="card-text" ><?php echo $class_room->name; ?></p>
                                    </div>
                                    </a>
                                </div>
                              </div>

                                        <?php
                                      }
                                    }
      
                              ?>
                                       
                                 

                          </div>
                         
                </div>
              </div>
            </div>
      </div>

      <div class="row">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title  p-3" style="border-radius:15px; color:whitesmoke; background-color:#4B49AC ;">Hall Details</h4>



                            <div class="row">
                              <?php
                                    if(!empty($hall_details))
                                    {

                                      foreach ($hall_details->result() as $hall) {
                                        ?>
                                           <div class="col-md-4" id="ib101">    
                                            <div class="card shadow cls"  style="background-color: #FCEDA0;">
                                              <a class="card-text view_detail" id="<?php echo $hall->id;  ?>" style="text-decoration: none;color: #050404;">
                                    <div class="card-body" id="IB101C"  >
                                   <!--   <button class="btn btn-primary view_detail" id="<?php echo $row->id;  ?>">View</button>-->
                                      
                                      <p class="card-text" ><?php echo $hall->room_name; ?></p>
                                    </div>
                                    </a>
                                </div>
                              </div>

                                        <?php
                                      }
                                    }
      
                              ?>
                                                                  

                          </div>
                        
                          
                </div>
              </div>
            </div>
      </div>




<!--//////////////////////////////////////////////// Modal ///////////////////////////////////////////////////-->
<div id="show_modal" class="modal fade" role="dialog" style="background: #000;">
  <div class="modal-dialog modal-lg">
      

      
      <div class="modal-body" id="pop_up_table">
        <!--*********************************************************-->

            <!--Here pop_up_table.php is called using ajax-->

        <!--*********************************************************-->

      </div>
    </div>
  </div>
</div>
<!--//////////////////////////////////////////////// Modal ///////////////////////////////////////////////////-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script type="text/javascript" >
  
    $(document).ready(function() {

      $('.view_detail').click(function(){
          
          var id = $(this).attr('id'); //get the attribute value
          const fdate = document.getElementById("from_date_time").innerHTML;

          console.log('select_room_type hhh:',id );    

          $.ajax({
              url : "<?php echo base_url(); ?>Dashboard/form_pop_up",
              type:"POST",  
              data:{id:id,date1:fdate,date2:"dshfgdfh"},  
              success:function(data){
                //alert(data);
                $('#pop_up_table').html(data);  

                $('#show_modal').modal("show");  

              }

          });
      });
    });
</script>



</div>
</div>
</div>