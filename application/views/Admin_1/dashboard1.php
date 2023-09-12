
   

        
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
            <div class="col-md-12 grid-margin">
              <div class="row">
                <div class="col-12 col-xl-12 mb-4 mb-xl-0">
              
                 <div class="justify-content-end d-flex bg-light p-2">

                 <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                  <div class="form-group row">
                        <label class="col-sm-9 col-form-label">From date</label>
                        <div class="col-sm-12 mt-2">
                            <input type="date" name="from_date" class="form-control" />
                        </div>
                    </div>
                  </div>

                  <div class="dropdown flex-md-grow-1 ml-4 flex-xl-grow-0">
                    <div class="form-group row">
                      <label class="col-sm-9 col-form-label">From date</label>
                        <div class="col-sm-12 mt-2">
                            <input type="date" name="to_date" class="form-control"  />
                        </div>
                    </div>
                  </div>

                  <div class="dropdown flex-md-grow-1 ml-4 flex-xl-grow-0">
                  <div class="form-group row">
                  <label class="col-sm-9 col-form-label">Room Type</label>
                    <div class="col-sm-12 multiselect">
                      <div class="selectBox" onclick="showCheckboxes()">
                        <select>
                          <option>Select</option>
                        </select>
                        <div class="overSelect"></div>
                      </div>
                      <div id="checkboxes">
                      <label for="r_all">
                          <input type="checkbox" id="r_all" />ALL</label>
                        <label for="r_auditorium">
                          <input type="checkbox" id="r_auditorium" />Auditorium</label>
                        <label for="r_academic">
                          <input type="checkbox" id="r_academic" />Academic</label>
                        <label for="r_seminar">
                          <input type="checkbox" id="r_seminar" />Seminar Hall</label>
                      </div>
                    </div>
                  </div>
                  </div>
                  



                  <div class="dropdown flex-md-grow-1 ml-4 flex-xl-grow-0">
                  <div class="form-group row">

                  <label class="col-sm-9 col-form-label">Block</label>

                    <div class="multiselect">
                      <div class="selectBox" onclick="show_block_Checkboxes()">
                        <select>
                          <option>Select</option>
                        </select>
                        <div class="overSelect"></div>
                      </div>
                      <div id="Block_checkboxes">
                        <label for="b_all">
                          <input type="checkbox" id="b_all" />ALL </label>
                        <label for="as">
                          <input type="checkbox" id="as" />AS BLOCK</label>
                        <label for="ip">
                          <input type="checkbox" id="ip" />IB BLOCK</label>
                        <label for="sf">
                          <input type="checkbox" id="sf" />SF BLOCK</label>
                        <label for="mech">
                          <input type="checkbox" id="mech" />Mech BLOCK</label>
                      </div>
                    </div>
                  </div>
</div>

                  

                  <div class="flex-md-grow-1 ml-4 flex-xl-grow-0">

                  <div class="form-group row">
                        <label class="col-sm-9 col-form-label" > .</label>
                        <div class="col-sm-12 mt-2">
                        <button type="button" class="btn btn-outline-info btn-fw">Search</button>
                        </div>
                    </div>

                 </div>
                </div>
              </div>
            </div>
          </div>
      
          
            
            <div class="col-md-12 grid-margin transparent">
              <div class="row">
                <div class="col-md-3 mb-4 stretch-card transparent">
                  <div class="card card-tale">
                    <div class="card-body">
                    <p class="mb-4">Total Rooms</p>
                      <p class="fs-30 mb-2">
 
                      <?php
                        echo $tot_rm;
                      ?>
 
                      </p>
                    </div>
                  </div>
                </div>
                <div class="col-md-3 mb-4 stretch-card transparent">
                  <div class="card card-dark-blue">
                    <div class="card-body">
                    <p class="mb-4">Total Booked</p>
                      <p class="fs-30 mb-2">
                        <?php echo $total_booked ?>
                      </p>
                    </div>
                  </div>
                </div>
                <div class="col-md-3 mb-4 stretch-card transparent">
                  <div class="card card-light-blue">
                    <div class="card-body">
                    <p class="mb-4">Total Unbooked</p>
                      <p class="fs-30 mb-2">
                      <?php
                          echo $un_booked;
                       ?>
                      </p>
                    </div>
                  </div>
                </div>
                <div class="col-md-3 mb-4 stretch-card transparent">
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
                  </div>
                </div>
              </div>
            </div>
         

          <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">SF DETAILS</p>
                  
                  <canvas id="sales-chart"></canvas>
                </div>
              </div>
            </div>

            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
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




<div class="row">
            <div class="col-md-3" id="ib101" >    
                <div class="card shadow cls"  >
        <div class="card-body" id="IB101C"  >
          
          <p class="card-text" >IB101</p>
        </div>
    </div>
    <div class="card shadow cls" >
        <div class="card-body">
          
          <p class="card-text">IB102</p>
        </div>
    </div>  
    <div class="card shadow cls" style="border-color: rgb(230, 76, 76); ">
        <div class="card-body">
          
          <p class="card-text">IB103</p>
        </div>
    </div>
    <div class="card shadow cls" >
        <div class="card-body">
          
          <p class="card-text">IB104</p>
        </div>
    </div>
    <div class="card shadow cls" >
        <div class="card-body">
          
          <p class="card-text">IB105</p>
        </div>
    </div>
    <div class="card shadow cls" >
        <div class="card-body">
          
          <p class="card-text">IB106</p>
        </div>
    </div>
    <div class="card shadow cls" >
        <div class="card-body">
          
          <p class="card-text">IB107</p>
        </div>
    </div>
</div>
<div class="col-md-3" id="ib108" >    
    <div class="card shadow cls" >
        <div class="card-body">
          
          <p class="card-text">IB108</p>
        </div>
    </div>
    <div class="card shadow cls" >
        <div class="card-body">
          
          <p class="card-text">IB109</p>
        </div>
    </div>  
    <div class="card shadow cls" style="border-color: rgb(230, 76, 76); ">
        <div class="card-body">
          
          <p class="card-text">IB201</p>
        </div>
    </div>
    <div class="card shadow cls" >
        <div class="card-body">
          
          <p class="card-text">IB202</p>
        </div>
    </div>
    <div class="card shadow cls" style="border-color: rgb(230, 76, 76); " >
        <div class="card-body">
          
          <p class="card-text">IB203</p>
        </div>
    </div>
    <div class="card shadow cls" >
        <div class="card-body">
          
          <p class="card-text">IB204</p>
        </div>
    </div>
    <div class="card shadow cls" >
        <div class="card-body">
          
          <p class="card-text">IB205</p>
        </div>
    </div>
</div>
<div class="col-md-3" id="ib207"  >    
    <div class="card shadow cls" >
        <div class="card-body">
          
          <p class="card-text">IB206</p>
        </div>
    </div>
    <div class="card shadow cls" >
        <div class="card-body">
          
          <p class="card-text">IB207</p>
        </div>
    </div>  
    <div class="card shadow cls" style="border-color: rgb(230, 76, 76); ">
        <div class="card-body">
          
          <p class="card-text">IB208</p>
        </div>
    </div>
    <div class="card shadow cls" style="border-color: rgb(230, 76, 76); ">
        <div class="card-body">
          
          <p class="card-text">IB209</p>
        </div>
    </div>
    <div class="card shadow cls" style="border-color: rgb(230, 76, 76); " >
        <div class="card-body">
          
          <p class="card-text">CT21</p>
        </div>
    </div>
    <div class="card shadow cls" >
        <div class="card-body">
          
          <p class="card-text">CT22</p>
        </div>
    </div>
    <div class="card shadow cls" >
        <div class="card-body">
          
          <p class="card-text">CT23</p>
        </div>
    </div>
</div>

<div class="col-md-3" id="ib206"  >    
    <div class="card shadow cls" >
        <div class="card-body">
          
          <p class="card-text">CT24</p>
        </div>
    </div>
    <div class="card shadow cls" >
        <div class="card-body">
          
          <p class="card-text">CT25</p>
        </div>
    </div>  
    <div class="card shadow cls" style="border-color: rgb(230, 76, 76); ">
        <div class="card-body">
          
          <p class="card-text">CT26</p>
        </div>
    </div>
    <div class="card shadow cls" >
        <div class="card-body">
          
          <p class="card-text">CT27</p>
        </div>
    </div>
    <div class="card shadow cls" >
        <div class="card-body">
          
          <p class="card-text">CT28</p>
        </div>
    </div>
    <div class="card shadow cls" >
        <div class="card-body">
          
          <p class="card-text">CT29</p>
        </div>
    </div>
    <div class="card shadow cls" >
        <div class="card-body">
          
          <p class="card-text">CT30</p>
        </div>
    </div>
</div>