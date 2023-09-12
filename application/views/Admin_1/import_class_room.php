
   

        
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

<style>
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

.popup_window{
  top:-90px;
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

</head>
<body>
<div class="main-panel">
        <div class="content-wrapper">
          
      <div class="row">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title p-3" style="border-radius:15px; color:whitesmoke;background-color:#4B49AC;">Import Room details</h4>

                   <?php
                      echo form_open_multipart(base_url() . 'Import_class/import_room_details/' , array('data-toggle' => 'validator', 'role' => 'form','class'=>'form-sample'));
                    ?>
                    
              
                    <p class="card-description">
      
                    </p>

                       <!-- End of Name -->

                       
                      <!-- Starting of Name -->
                    <div class="row">
                      <div class="col-md-8">
                          <div class="form-group">
                            <label class="col-form-label"><h3>Select Room Major</h3></label>                            
                              <select class="form-control" name="room_major">
                                <option value="1">Class Room</option>
                                <option value="2">Hall</option>
                              </select>                              
                             
                           
                            <hr>
                            <div class="form-group">
                            <label class="col-form-label"><h3>Upload Excel File</h3><span style="color:#EE2C03">Please upload the excel sheet in xls format with correct template</span></label>  
                                                       
                            
                            <br>
                                    <input type="file" name="room_details">
                             
                           
                            <hr>

                            <div class="form-group">                            
                            
                                <button type="submit" class="btn ml-auto" style="background-color:#4B49AC; color:whitesmoke;" >Import</button>
                              
                            
                          </div>

                          </div>

                        </div>

                      <!-- End of Name -->

                      <!-- Starting of Name -->

                      
                          
                        

                        </div>
                      </form>
                      <!-- End of Name -->
                   
               
                </div>
              </div>
            </div>            
          </div>
          

         

         
      <div class="row">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title  p-3" style="border-radius:15px; color:whitesmoke;background-color:#4B49AC;">Class Room details</h4>



                            <div class="row">
                              <?php
                                    if(!empty($class_room_details))
                                    {

                                      foreach ($class_room_details as $class_room) {
                                        ?>
                                           <div class="col-md-2" id="ib101">    
                                            <div class="card shadow cls"  style="background-color: #D2FFC0;">
                                              <a class="card-text view_detail" id="<?php echo $class_room['id']; ?>" style="text-decoration: none;color: #050404;">
                                    <div class="card-body" id="IB101C"  >
                                   <!--   <button class="btn btn-primary view_detail" id="<?php echo $row->id;  ?>">View</button>-->
                                      
                                      <p class="card-text" ><?php echo $class_room['name']; ?></p>
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
                  <h4 class="card-title  p-3" style="border-radius:15px; color:whitesmoke;background-color:#4B49AC;">Hall Details</h4>



                            <div class="row">
                              <?php
                                    if(!empty($hall_details))
                                    {

                                      foreach ($hall_details as $hall) {
                                        ?>
                                           <div class="col-md-4" id="ib101">    
                                            <div class="card shadow cls"  style="background-color: #D2FFC0;">
                                              <a class="card-text view_detail" id="11" style="text-decoration: none;color: #050404;">
                                    <div class="card-body" id="IB101C"  >
                                   <!--   <button class="btn btn-primary view_detail" id="<?php echo $row->id;  ?>">View</button>-->
                                      
                                      <p class="card-text" ><?php echo $hall['room_name']; ?></p>
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
  <div class="modal-dialog modal-lg popup_window">
    <div class="modal-content">
      
      
      <div id="pop_up_table">
        <!--*********************************************************-->

            <!--Here pop_up_table.php is called using ajax-->

        <!--*********************************************************-->

      </div>
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
          console.log('select_room_type :',id );    

          $.ajax({
              url : "<?php echo base_url(); ?>Dashboard/room_pop_up",
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