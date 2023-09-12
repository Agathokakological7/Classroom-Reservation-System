       
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

.searchbar{
  border-bottom:2px solid #bfbfbd;
}

.search_title{
  font-size:20px;
  font-weight:bold;
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
<html>
  <head>



    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawStuff);

      function drawStuff() {
        var data = new google.visualization.arrayToDataTable([
          ['', 'Hours'],
          ["Seminar Hall", 22],
          ["Conference Hall", 18],
          ["Computer Labs", 30],
          ["Class Room", 28],
          
        ]);

        var options = {
          width: 450,
          legend: { position: 'none' },
          chart: {
            },
          axes: {
            x: {
              0: { side: 'top'} // Top x-axis.
            }
          },
          bar: { groupWidth: "40%" }
        };

        var chart = new google.charts.Bar(document.getElementById('top_x_div'));
        // Convert the Classic options to Material options.
        chart.draw(data, google.charts.Bar.convertOptions(options));
      };
    </script>
  </head>


</head>
<body>
<div class="main-panel">
        <div class="content-wrapper">
          
      
          <div class="content-wrapper">
          
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
                  <h4 class="card-title p-3 mb-2  text-white rounded" style="background-color:#4B49AC ;">Venue Form</h4>
                  <?php
                      echo form_open_multipart(base_url() . 'Dashboard/open_form/1' , array('data-toggle' => 'validator', 'role' => 'form','class'=>'form-sample'));
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
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title  p-3" style="border-radius:15px; color:whitesmoke;background-color:#4B49AC ;">Class Room details</h4>


                 
                      




            
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-3 mb-4 stretch-card transparent">
                <a href="<?php echo base_url()?>Dashboard/import_room"   style="text-decoration:none;color:white;">
                  <div class="card card-tale">
                    <div class="card-body">
                    <p class="mb-4">Total Rooms</p>
                      <p class="fs-30 mb-2">
 
                      <?php
                        echo $tot_rm;
                      ?>
 
                      </p>
                    </div>
                                  </a>
                  </div>
                </div>
                <div class="col-md-3 mb-4 stretch-card transparent">
                <a href="<?php echo base_url()?>Dashboard/open_table"   style="text-decoration:none;color:white;">
                  <div class="card card-dark-blue">
                    <div class="card-body">
                    <p class="mb-4">Total Booked</p>
                      <p class="fs-30 mb-2">
                        <?php echo $total_booked ?>
                      </p>
                    </div>
                                  </a>
                  </div>
                </div>
                <div class="col-md-3 mb-4 stretch-card transparent">
                <a href="<?php echo base_url()?>Dashboard/admin_allocation"   style="text-decoration:none;color:white;">
                  <div class="card card-light-blue">
                    <div class="card-body">
                    <p class="mb-4">Total Unbooked</p>
                      <p class="fs-30 mb-2">
                      <?php
                          echo $un_booked;
                       ?>
                      </p>
                    </div>
                                  </a>
                  </div>
                </div>
                <div class="col-md-3 mb-4 stretch-card transparent">
                <a href="<?php echo base_url()?>Dashboard/admin_allocation"   style="text-decoration:none;color:white;">
                  <div class="card card-light-danger">
                    <div class="card-body">
                    <p class="mb-4">Pending request</p>
                      <p class="fs-30 mb-2">
                        <?php
                          echo "<script>console.log('booked room  : " .$no_of_req. "' );</script>";

                        echo $no_of_req;
                        ?>
                      </p>
                    </div>
                                  </a>
                  </div>
                  </div>
                  </div>

                </div>
              </div>
            </div>
         

          <div class="row">
          <div class="col-6">

            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                <p>Below Visualization shows utility of last 30 days</p>
                  <p class="card-title">SF DETAILS</p>
                  
                  <div id="top_x_div" style="width: 250px; height: 250px;" ></div>
                </div>
              </div>
            </div>
                                  </div>
                                  <div class="col-6">

            <div class="col-md-12 ">
              <div class="card">
                <div class="card-body">
                   <p>Below Visualization shows utility of last 30 days</p>
                  <p class="card-title">AUDITORIUM DETAILS</p>
                  <div class="charts-data">
                        <div class="mt-3">
                          <p class="mb-0">Main Auditorium</p>
                          <div class="d-flex justify-content-between align-items-center">
                            <div class="progress progress-md flex-grow-1 mr-4">
                              <div class="progress-bar bg-inf0" role="progressbar" style="width: 95%" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p class="mb-0">8hr</p>
                          </div>
                        </div>
                        <div class="mt-3">
                          <p class="mb-0">Vedanayagam Auditorium</p>
                          <div class="d-flex justify-content-between align-items-center">
                            <div class="progress progress-md flex-grow-1 mr-4">
                              <div class="progress-bar bg-info" role="progressbar" style="width: 35%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p class="mb-0">3hr</p>
                          </div>
                        </div>
                        <div class="mt-3">
                          <p class="mb-0">SF-1 Auditorium</p>
                          <div class="d-flex justify-content-between align-items-center">
                            <div class="progress progress-md flex-grow-1 mr-4">
                              <div class="progress-bar bg-info" role="progressbar" style="width: 48%" aria-valuenow="48" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p class="mb-0">4.5hr</p>
                          </div>
                        </div>
                        <div class="mt-3">
                          <p class="mb-0">SF-2 Auditorium</p>
                          <div class="d-flex justify-content-between align-items-center">
                            <div class="progress progress-md flex-grow-1 mr-4">
                              <div class="progress-bar bg-info" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p class="mb-0">2hr</p>
                          </div>
                        </div>
                      </div>
                </div>
              </div>
            </div>

            
            
          </div>



</div>
</div>
</div>