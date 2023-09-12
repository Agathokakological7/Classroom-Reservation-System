
      <!-- partial -->
      <div class="main-panel">        
        <div class="content-wrapper">
          <div class="row">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title bg-primary p-3" style="border-radius:15px; color:whitesmoke;">Available Slot</h4>
                  <form class="form-sample" method="post" action="">
                    <p class="card-description">


                  <div class="table-responsive">
                    <div class="table table-hover">
                    <table class="table table-striped table-borderless">
                      
                    <thead>
                        <tr>
                          <th>Room Name</th>
                          <th>Block Name</th>
                          <th>Floor</th>
                          <th>Seat Capacity</th>
                        </tr>  
                      </thead>
                      <tbody>
                      
                      <?php  
        foreach ($available_slots->result() as $row)  
        {  
         // echo "<script>console.log('Debug Objects123: " . $row->room_name. "' );</script>";
          if ($row->room_name != ""){
            ?>

            <tr>
                        <td><?php echo $row->room_name;?></td>
                        <td><?php echo $row->block_name;?></td>
                        <td><?php echo $row->floor;?></td>
                        <td><?php echo $row->seating_capacity;?></td>
                        <td class="font-weight-medium">
                        <a class="badge badge-success edit_btn" href="<?php echo base_url()?>Dashboard/class_room_booking/<?php echo $row->id?>">Allocate</a> 
                        </td>
                    </tr>
                  <?php }
                  } ?>       
                      </tbody>
                    </table>
                    </div>
                  </div>
                </div>
      <!-- main-panel ends -->
              </div>
    <!-- page-body-wrapper ends -->
            </div>
          </form>
        </div>
      </div>
    </div>            
  </div>
</div>