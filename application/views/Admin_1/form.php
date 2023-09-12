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








<!-- partial -->
<div class="main-panel">        
        <div class="content-wrapper">
          <div class="row">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title p-3 mb-2 bg-primary text-white rounded" >Venue Form</h4>
                  <form class="form-sample" method="post" action="<?php echo base_url(); ?>Dashboard/inserting_data">
                    <p class="card-description">
                    </p>
                    <!-- -------------------------------------------------- -->


                    <div class="row" id="form1" >
                  





                 


                    
                    <!-- ----------------------new---------------------------- -->


                      


                    <!-- -------------------------------------------------- -->



                    <div class="row" id="form2">
                    <div class="col-md-12">
                        <div class="form-group row">

                        <!--           ////////////////////////// -->
                        <div class="row">
                <div class="col-12 col-xl-12 mb-4 mb-xl-0">
              
                 <div class="justify-content-end d-flex bg-light p-2">

                 <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                  <div class="form-group row">
                        <label class="col-sm-9 col-form-label">From date</label>
                        <div class="col-sm-12 mt-2">
                            <input type="datetime-local" name="from_date" class="form-control" />
                        </div>
                    </div>
                  </div>

                  <div class="dropdown flex-md-grow-1 ml-4 flex-xl-grow-0">
                    <div class="form-group row">
                      <label class="col-sm-9 col-form-label">From date</label>
                        <div class="col-sm-12 mt-2">
                            <input type="datetime-local" name="to_date" class="form-control"  />
                        </div>
                    </div>
                  </div>

                  <div class="dropdown flex-md-grow-1 ml-2 flex-xl-grow-0">
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
                  



                  <div class="dropdown flex-md-grow-1 ml-2 flex-xl-grow-0">
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

                  

                    <div class="flex-md-grow-1 ml-2 flex-xl-grow-0">
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
          <!--       ////////////////////////////        -->
                          
                        </div>




                    <div class="div">
                    <div class="row">
                      <!-- /////////////////////// -->

            <div class="col-md-3" id="ib101" >    
                <div class="card shadow cls"  >
        <div class="card-body view_detail" id="IB101C"  >
          
          <p class="card-text" >IB101</p>
        </div>
    </div>
    <div class="card shadow cls" >
        <div class="card-body view_detail">
          
          <p class="card-text">IB102</p>
        </div>
    </div>  
    <div class="card shadow cls" style="border-color: rgb(230, 76, 76);background-color:#fcb2a9; ">
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
    <div class="card shadow cls" style="border-color: rgb(230, 76, 76);background-color:#fcb2a9; ">
        <div class="card-body">
          
          <p class="card-text">IB201</p>
        </div>
    </div>
    <div class="card shadow cls" >
        <div class="card-body">
          
          <p class="card-text">IB202</p>
        </div>
    </div>
    <div class="card shadow cls" >
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
<div class="col-md-3" id="ib206"  >    
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
    <div class="card shadow cls" style="border-color: rgb(230, 76, 76);background-color:#fcb2a9; ">
        <div class="card-body">
          
          <p class="card-text">IB208</p>
        </div>
    </div>
    <div class="card shadow cls" >
        <div class="card-body">
          
          <p class="card-text">IB209</p>
        </div>
    </div>
    <div class="card shadow cls" >
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
    <div class="card shadow cls" style="border-color: rgb(230, 76, 76);background-color:#fcb2a9; ">
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

<!--- ////////////////////  -->
                                  </div>
                                  </div>
                                  </div>
                    

                    <!-- -------------------------------------------------- -->


                      
                      <a onclick="page2()" id="switch_btn" class="btn btn-primary mr-2">NEXT</a>
                      <input type="submit" id="submit" class="btn btn-primary mr-2" style="display:none" value="SUBMIT"/> 
                   </div>
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

  <!--//////////////////////////////////////////////// Modal ///////////////////////////////////////////////////-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script type="text/javascript" >
  
    $(document).ready(function() {

      $('.view_detail').click(function(){
          
          var id = $(this).attr('id'); //get the attribute value
          console.log('select_room_type :',id );    

          $.ajax({
              url : "<?php echo base_url(); ?>Dashboard/form_pop_up",
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