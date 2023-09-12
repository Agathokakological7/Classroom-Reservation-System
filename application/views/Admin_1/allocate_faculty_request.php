<style>
input[type=text],select{
  width:100%;
  padding:12px 20px;
  margin:8px 0;
  display:inline-block;
  border:1px solid #ccc;
  border-radius:4px;
  box-sizing:border-box;
  
}
select:required:invalid {
  color: gray;
}
option[value=""][disabled] {
  display: none;
}
option {
  color: black;
}
</style>


<!-- partial -->
<div class="main-panel">        
  <div class="content-wrapper">
    <div class="row">
      <div class="col-12 grid-margin">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title p-3 mb-2 bg-primary text-white rounded" >Venue Form</h4>

            <form class="form-sample" method="post" action="<?php echo base_url(); ?>Dashboard/allocate_faculty_request/<?php echo $allocate_detail->id; ?>">
              <p class="card-description"></p>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">NAME</label>
                    <div class="col-sm-9">
                      <input type="text" name="name" class="form-control" value="<?php echo $allocate_detail->name; ?>" disabled/>
                    </div>
                  </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group row">
                      <label for="event_id" class="col-sm-3 form-label">Proposal</label>
                      <div class="col-sm-9">
                        <input class="form-control" name="proposal" id="event_id" value="<?php echo $allocate_detail->proposal; ?>" disabled>
                    </div>
                  </div>
                </div>
              </div>
              <!-- ////////////////////// Second row to be displayed ////////////////////// -->
              <div id="disabled_text">  
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Room Type</label>
                      <div class="col-sm-9">
                        <input type="textarea" name="room_type" class="form-control" value="<?php echo $allocate_detail->room_type; ?>" disabled />
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group row">
                      <label for="dept" class="col-sm-3 form-label">Capacity</label>                          
                      <div class="col-sm-9">
                        <input class="form-control" name="capacity" value="<?php echo $allocate_detail->capacity; ?>" disabled >
                      </div>
                    </div>
                  </div>
                      
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Date</label>
                      <div class="col-sm-9">
                        <input type="text" id="date" name="date" class="form-control" value="<?php echo $allocate_detail->f_date," TO ",$allocate_detail->t_date; ?>" disabled>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Date</label>
                      <div class="col-sm-9">
                        <input type="text" id="time" name="time" class="form-control" value="<?php echo $allocate_detail->f_time," TO ",$allocate_detail->t_time; ?>" disabled>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Room name</label>
                      <div class="col-sm-9">
                        <select id="datalistOptions"   name="allocated_room_name" id="allocated_room_name"  > 
                          <?php
                              if($avail_room_name != 'no_room'){
                                foreach($avail_room_name->result() as $row){ ?>
                                  <option><?php echo $row->room_name ;?></option>   
                          <?php }; 
                              }
                              else{?>
                                <option><?php echo $avail_room_name ;?></option>
                          <?php  }?>                             
                        </select>                    
                      </div>
                    </div>
                  </div>
                </div>
                <input type="submit" name="allocate" class="btn btn-primary mr-2" value="Allocate"/>
                <a class="btn btn-primary mr-2" onclick="edit_request()">Edit</a>
                <button class="btn btn-light" href="<?php echo base_url()?>Dashboard/open_form">Cancel</button>
              </div>
            </form>
                <!-- ////////////////////// END  Second row to be displayed //////////////////////-->



                <!-- ////////////////////// Edit BUTTON ////////////////////// -->
            <form class="form-sample" method="post" action="<?php echo base_url(); ?>Dashboard/edit_faculty_req/<?php echo $allocate_detail->id;?>">

              <div id="edit_content" style="display:none;">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Room Type</label>
                      <div class="col-sm-9">
                      <select name="edit_rm_type" id="edit_rm_type"  >
                        <option hidden selected ><?php echo $allocate_detail->room_type; ?></option>
                          <?php foreach($room_type->result() as $row){ ?>
                            <option><?php echo $row->room_type_name ?></option>
                          <?php } ?>                               
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group row">
                      <label for="dept" class="col-sm-3 form-label">Capacity</label>                          
                      <div class="col-sm-9">
                      <select name="req_capacity" id="req_capacity"  >
                        <option hidden selected ><?php echo $allocate_detail->capacity; ?></option>
                          <?php foreach($seating_capacity->result() as $row){ ?>
                            <option><?php echo $row->capacity ?></option>
                          <?php } ?>                               
                        </select>
                      </div>
                    </div>
                  </div>
                      
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">From Date</label>
                      <div class="col-sm-9">
                        <input type="date" id="f_date" name="f_date" class="form-control" value="<?php echo $allocate_detail->f_date ?>" >
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">To Date</label>
                      <div class="col-sm-9">
                        <input type="date" id="t_date" name="t_date" class="form-control" value="<?php echo $allocate_detail->t_date ?>" >
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">From Time</label>
                      <div class="col-sm-9">
                        <input type="time" id="f_time" name="f_time" class="form-control" value="<?php echo $allocate_detail->f_time?>">
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">To Time</label>
                      <div class="col-sm-9">
                        <input type="time" id="t_time" name="t_time" class="form-control" value="<?php echo $allocate_detail->t_time?>">
                      </div>
                    </div>
                  </div>
                </div>
                <button class="btn btn-primary mr-2" href="">SAVE</button>
              </div>
              <!-- ////////////////////// END  Edit BUTTON //////////////////////-->

                  </form>
                </div>
              </div>
            </div>            
          </div>
        </div>
        <!-- content-wrapper ends -->

      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>

<script>
  function edit_request(){
  const disabled_content = document.getElementById("disabled_text");
  const edit_content = document.getElementById("edit_content");

  disabled_content.style.display='none';
  edit_content.style.display='block';

  }

</script>