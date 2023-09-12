<!-- partial -->
<div class="main-panel">        
        <div class="content-wrapper">
          <div class="row">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title bg-primary p-3" style="border-radius:15px; color:whitesmoke;">Table</h4>
                    <p class="card-description">
 
 
                  <div class="table-responsive">
                    <div class="table table-hover">
                    <table id="total_table" class="table table-striped table-borderless">
                     
                    <thead>
                     
                    <tr>
                          <th>S.No.</th>
                          <th>Venue Name</th>
                          <th>Seating Capacity</th>
                          <th>Block Name</th>
                          <th>Floor</th>
                                         
                        </tr>  
                         
                      </thead>
                      <tbody>
                      <?php  
                foreach ($h->result() as $row)  
                      {  
                       ?>
 
                       <tr>
                        <td><?php echo $row->id;?></td>
                        <td><?php echo $row->Name;?></td>
                        <td><?php echo $row->Seating_Capacity;?></td>
                        <td><?php echo $row->Block_name;?></td>
                        <td><?php echo $row->Floor;?></td>
                       
                    </tr>
                      <?php }  
                          ?>                    
                     
                   
                      </tbody>
                    </table>
                    </div>
                  </div>
                </div>
      <!-- main-panel ends -->
            </div>
    <!-- page-body-wrapper ends -->
  </div>
 
                </div>
              </div>
            </div>            
          </div>
        </div>
 
 
 
 
 
<!-- Button trigger modal -->
 
 
 
 
 
<!--//////////////////////////////////////////////// Modal ///////////////////////////////////////////////////-->
<div id="show_modal" class="modal fade" role="dialog" style="background: #000;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
 
      <h5 class="modal-title" id="exampleModalLabel">Room Profile</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>      
      </div>
 
     
      <div class="modal-body" id="pop_up_table">
        <!--*********************************************************-->
 
            <!--Here pop_up_table.php is called using ajax-->
 
        <!--*********************************************************-->
 
      </div>
     
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
 
      </div>
    </div>
  </div>
</div>
<!--//////////////////////////////////////////////// Modal ///////////////////////////////////////////////////-->
