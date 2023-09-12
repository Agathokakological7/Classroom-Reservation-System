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
        <form class="form-sample" method="post" action="<?php echo base_url(); ?>Dashboard/admin_allocation">
          <div class="row">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title p-3 mb-2 bg-primary text-white rounded" >Allocate the Room</h4>
               
                    <p class="card-description">
      
                    </p>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label  class="col-sm-3 form-label">Room Type</label>                          
                          <div class="col-sm-9">
                            <select name="select_room_type" id="select_room_type"  >
                            <option selected hidden ><?php echo $select_rm_type ?></option>
                            <option>All</option>
                              <?php foreach($room_type->result() as $row){ ?>
                                 <option><?php echo $row->room_type_name ?></option>
                                 <?php } ?>                               
                              </select>
                          </div>
                        </div>
                        
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label for="availability"  class="col-sm-3 form-label">Availability</label>
                          <div class="col-sm-9">
                              
                          <select name="availability" id="availability" required >
                                <option selected hidden><?php echo $rm_availability ?></option>
                                <option >Availabile</option>
                                <option>Allotement</option>
                          </select>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                      <button class="btn btn-primary mr-2">Search</button>
                      </div>
                  
                  
                    </div>
                  </div>
                </div>

                
                <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">

              <!--***************************************************************-->
                <div class="card-body" >
                  <h4 class="card-title"><?php echo $rm_availability ?> Table</h4>
<!--***************************************************************-->
<?php if($rm_availability == "Allotement"){ ?>
  <div class="table-responsive"  id="alloted">
    <table class="table table-striped" id="alloted_search">
      <thead>
        <tr>
          <th>Name</th>
          <th>Id</th>
          <th>Capacity</th>
          <th>Room Type</th>
          <th>Proposal</th>
          <th>From Date</th>
          <th>To Date</th>
          <th>View</th>
    
        </tr>  
      </thead>
      <tbody>
        <?php foreach ($allotment->result() as $row) {  ?>
          <tr>
              <td><?php echo $row->name;?></td>
              <td><?php echo $row->person_id;?></td>
              <td><?php echo $row->capacity;?></td>
              <td><?php echo $row->room_type;?></td>
              <td><?php echo $row->proposal;?></td>
              <td><?php echo $row->f_date;?></td>
              <td><?php echo $row->t_date;?></td>
              <td class="font-weight-medium">
              <a class="badge badge-success edit_btn" href="<?php echo base_url()?>Dashboard/faculty_request_allocate_form/<?php echo $row->id?>">Approve</a>
              </td>
            </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
<?php } 
else{?>
<!--***************************************************************-->
  <div class="table-responsive" id="available_room_list">
    <table class="table table-striped" id="available_search" >
      <thead>
        <tr>
          <th>Room Name</th>
          <th>Room Type</th>
          <th>Block Name</th>
          <th>Seat Capacity</th>
          <th>Projector</th>
          <th>WIFI</th>
          <th>Systems</th>
          <th>Speaker</th>
          <th>Allotment</th>
        </tr> 
      </thead>
      <tbody>
        <?php foreach ($available_venue->result() as $row) {  
          if($row->room_type_name == $select_rm_type or $select_rm_type == 'All'){ ?>
            <tr>
              <td><?php echo $row->	room_name;?></td>
              <td><?php echo $row->	room_type_name;?></td>
              <td><?php echo $row->block_name;?></td>
              <td><?php echo $row->capacity;?></td>
              <td><?php echo $row->projector;?></td>
              <td><?php echo $row->wifi;?></td>
              <td><?php echo $row->systems;?></td>
              <td><?php echo $row->speaker;?></td>
              <td class="font-weight-medium">
                <a class="badge badge-success edit_btn" href="<?php echo base_url()?>Dashboard/class_room_booking/<?php echo $row->id?>">Allocate</a> 
              </td>
            </tr>
          <?php }  
        }?>
      </tbody>
    </table>
  </div>
<?php } ?>
    <!--***************************************************************-->


                  
                </div>
              </div>
            </div>
              </div>

    <!--***************************************************************-->

              
          </div>
      </div>

      
        <!-- content-wrapper ends -->

      <!-- main-panel ends -->
    
    <!-- page-body-wrapper ends -->
