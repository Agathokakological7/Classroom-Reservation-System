<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

<!-- Font Awesome -->
<link
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
  rel="stylesheet"
/>

<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">




<style>
  .location{
display:flex;
  }
  .location b{
    flex:25%;
  }
  .title{
    color:red;
  }
  .facility_title{
    font-size:12px;
  }
  .facility_icon{
    text-align:center;
  }
  .facility_img img{
    width: 100px;
  }
  
</style>
<script>
 var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl)
})
</script>

        <!--*********************************************************-->
        <div class="modal-content">

        <div class="modal-header">

<h5 class="modal-title" id="exampleModalLabel">

<div class="d-flex flex-row bd-highlight mb-3">
  <div class="p-2 bd-highlight">
    <h3 class="btn btn-secondary btn-fw">CT102 - IB BLOCK,II FLOOR</h3>
  </div>

</div>

</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>      
</div>


<div class="modal-body">


<section style="background-color: #eee;">
    <div class="container py-5">
      <div class="row" style="margin-top:-35px">
      <img src="<?php echo base_url(); ?>images\pop_up_img\class_rooms.jpg" alt="avatar"
                class="img-fluid" style="width: 100%; height:60%;">
      </div>
  
      <div class="row">
        
        <div class="col-lg-12">
          <div class="card mb-4">
          <h5 style="padding:5px;">Room Facilities</h5>
          <span class="bi bi-projector"></span>
              <div class="card-body">

<!--       /////////////////////////////////////////////////////////  -->

<div class="row icons-list">
                    <div class="col-sm-12 facility_icon">
                      
                    <div class="col-md-2">
                          
                          <!-- <img src="<?php echo base_url()?>images\pop_up_img\moniter.jpg" alt="people" style="width:70px"> -->

                          <img src="<?php echo base_url()?>images\pop_up_img\3.png" alt="people" style="width:80px"> 
                          
                          <p><?php echo $room_profiles->system;?></p>
                      </div>
                    <div class="col-md-2">
                         
                           
                         <img src="<?php echo base_url()?>images\pop_up_img\1.png" alt="people" style="width:80px">
                         <p><?php echo $room_profiles->projector_screen;?></p>
 
                         </div>
                       
                     
                         <div class="col-md-2">
                         
                         <img src="<?php echo base_url()?>images\pop_up_img\2.png" alt="people" style="width:80px">
                         <p><?php echo $room_profiles->projector;?></p>
  
                         </div>
                       
                   
                       
                         <div class="col-md-2">
                         
                             <img src="<?php echo base_url()?>images\pop_up_img\6.png" alt="people" style="width:80px">
                             <p><?php echo $room_profiles->amplifier;?></p>
                         </div>
                         
                      
                    
                       
                         <div class="col-md-2">
                           
                             <img src="<?php echo base_url()?>images\pop_up_img\4.png" alt="people" style="width:80px">
                             <p><?php echo $room_profiles->amplifier;?></p>
                         </div>
                         
                      
                    
                       
                         <div class="col-md-2 ">
                          
                         <img src="<?php echo base_url()?>images\pop_up_img\5.png" alt="people" style="width:80px">  
                         <p><?php echo $room_profiles->amplifier;?></p>
                         </div>
                         
                     </div>
 
                       
                    </div>

                  

</div>

<!--           /////////////////////////////////////////////////////  -->
       
            </div>
          </div>
           


<!-- //////////////////////////user details //////////////////////////////  -->

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
                  




                    <div class="div" id="faculty_user">
                    <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Faculty Name</label>
                            <div class="col-sm-9">
                              <!--<input type="text" name="faculty_name" class="form-control" placeholder="NAME" required/>-->
                              <input type="text" name="faculty_name" value="<?php echo $faculty_data->faculty_name ?> " class="form-control" placeholder="NAME" disabled/>

                            </div>
                          </div>
                        </div>
                        
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Faculty Id</label>
                            <div class="col-sm-9">

                              <!--<input type="text" name="faculty_id" class="form-control" placeholder="ID" required/>-->
                              <input type="text" name="faculty_id" value="<?php echo $faculty_data->faculty_id ?>" class="form-control" placeholder="ID" disabled/>

                            </div>
                          </div>
                        </div>

                 


                    
                    <!-- ----------------------new---------------------------- -->



                        <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">E-mail</label>
                          <div class="col-sm-9">
                          <input type="email" name="email" class="form-control" value="<?php echo $faculty_data->email ?>" placeholder="EX : abc@bitsathy.ac.in" disabled/>
                          </div>
                        </div>
                      </div>
                      

                       <div class="col-md-6">
                         <div class="form-group row">
                           <label for="event_id" class="col-sm-3 form-label">Purpose</label>
                           <div class="col-sm-9">
                              <input class="form-control" name="proposal" list="datalistOptions1" id="event_id" onchange="change(this.value)" placeholder="Events" required>
                             <datalist id="datalistOptions1">
                              <option>Academics</option>
                              <option>Interview</option>
                              <option>Mentor Meeting</option>
                              <option>Club Event</option>
                              <option>Seminar</option>
                              <option>Workshop</option> 
                              <option>School Training</option>
                              <option>Conference</option>
                              <option id="others">Others</option>
                            </datalist>
                            </select>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-6" id="new_other" style="display:none" >
                        <div class="form-group row"  >
                          <label class="col-sm-3 col-form-label" >Event Name</label>
                          <div class="col-sm-9" >
                            <input type="text" name="others_option" class="form-control bod" placeholder="Event Name" />
                          </div>
                        </div>
                    </div>
                    

                    <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">From Date</label>
                          <div class="col-sm-9">
                            <input type="datetime-local" id="from_date_time" name="from_date_time" class="form-control" required>
                          </div>
                        </div>
                      </div>


                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">To Date</label>
                          <div class="col-sm-9">
                            <input type="datetime-local" id="to_date_time" name="to_date_time" class="form-control" required>
                          </div>
                        </div>
                      </div>

                      
                      

                    
</div>
</div>
                    <!-- -------------------------------------------------- -->



                    <div class="form-group">
            <button type="submit" class="btn btn-primary ml-auto" >SUBMIT</button>
          </div>
                   
          <!--       ////////////////////////////        -->
                          
                        </div>


<!-- //////////////////////// end user details ///////////////////////////////// 


      
          </div>
        </div>
      </div>
    </div>
  </section>