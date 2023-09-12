
  
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
                    <table id="myTable" class="table table-striped table-borderless">
                      
                    <thead>
                      
                    <tr>
                          <th>Name</th>
                          <th>Id</th>
                          <th>Capacity</th>
                          <th>Room Type</th>
                          <th>Proposal</th>
                          <th>From Date</th>
                          <th>To Date</th>
                          <th>Approval</th>
                          <th>View</th>
                
                        </tr>  
                         
                      </thead>
                      <tbody>
                         <?php  
        foreach ($h->result() as $row)  
        {  
            ?>

            <tr>
                        <td><?php echo $row->name;?></td>
                        <td><?php echo $row->person_id;?></td>
                        <td><?php echo $row->capacity;?></td>
                        <td><?php echo $row->room_type;?></td>
                        <td><?php echo $row->proposal;?></td>
                        <td><?php echo $row->f_date;?></td>
                        <td><?php echo $row->t_date;?></td>
                        <td><?php echo $row->approval;?></td>
                        <td class="font-weight-medium">
                        <button class="btn btn-primary view_detail" id="<?php echo $row->id;  ?>">View</button>
                        </td>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script type="text/javascript" >
  
    $(document).ready(function() {

      $('.view_detail').click(function(){
          
          var id = $(this).attr('id'); //get the attribute value
          console.log('select_room_type	:',id );		

          $.ajax({
              url : "<?php echo base_url(); ?>Dashboard/get_popup_data",
              type:"POST",  
              data:{id:id},  
              success:function(data){
                //alert(data);
                $('#pop_up_table').html(data);  

                $('#show_modal').modal("show");  

              }

          });
      });
    });
</script>


