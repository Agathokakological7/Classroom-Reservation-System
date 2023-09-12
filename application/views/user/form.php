<!-- partial -->
<div class="main-panel">        
        <div class="content-wrapper">
          <div class="row">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title p-3 mb-2 bg-primary text-white rounded" >Venue Form</h4>
                  <form class="form-sample" method="post" action="<?php echo base_url(); ?>Dashboard_user/inserting_data">
                    <p class="card-description">
                    </p>

                    <div class="row">
                    <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-6 col-form-label">Are you a Faculty/Student: </label>
                          <div class="col-sm-3">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" name="user" class="form-check-input" id="Faculty" value="faculty"  onclick="faculty_or_student()" checked>
                                Faculty
                              </label>
                            </div>
                          </div>
                          <div class="col-sm-3">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="user" id="Student" value="Student" onclick="faculty_or_student()">
                                Student
                              </label>
                            </div>
                          </div>
                        </div>
                      </div>


                    </div>


                    <div class="div" id="faculty_user">
                    <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Faculty Name</label>
                            <div class="col-sm-9">
                              <input type="text" name="faculty_name" value="<?php echo $faculty_data->faculty_name ?> " class="form-control" placeholder="NAME" disabled/>
                            </div>
                          </div>
                        </div>
                        
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Faculty Id</label>
                            <div class="col-sm-9">
                              <input type="text" name="faculty_id" value="<?php echo $faculty_data->faculty_id ?>" class="form-control" placeholder="ID" disabled/>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                  <div class="div" id="student_user" style="display:none">
                    <div class="row">
                      <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Student Name</label>
                            <div class="col-sm-9">
                              <input type="text" name="Student_name" class="form-control" placeholder="NAME" />
                            </div>
                          </div>
                        </div>
                        
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Student Id</label>
                            <div class="col-sm-9">
                              <input type="text" name="Student_id" class="form-control" placeholder="ID" />
                            </div>
                          </div>
                        </div>
                      </div>


                    </div>


                    <div class="row">
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
                          <label for="dept" class="col-sm-3 form-label" for="capacity">Capacity</label>                          
                          <div class="col-sm-9">
                            <select id="capacity" name="capacity" required>
                            <option selected hidden></option>
                              <?php  
                                  foreach ($capacity->result() as $row)  
                                  {  
                                      ?>
                                <option><?php echo $row->capacity ?></option>
                              <?php } ?>
                            </select>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">

                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label" for="room_type">Room Type</label>
                          <div class="col-sm-9">
                            <select id="room_type" name="room_type" required>
                            <option selected hidden></option>
                              <?php  
                                  foreach ($room_type->result() as $row)  
                                  {  
                                      ?>
                                <option><?php echo $row->room_type_name ?></option>
                              <?php } ?>
                            </select>
                          </div>
                        </div>
                      </div>

                       <div class="col-md-6">
                         <div class="form-group row">
                           <label for="event_id" class="col-sm-3 form-label">Proposal</label>
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


                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Projecter</label>
                          <div class="col-sm-4">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" name="projector" class="form-check-input" name="projector" id="projector" value="YES"  >
                                Yes
                              </label>
                            </div>
                          </div>
                          <div class="col-sm-5">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="projector" id="projector" value="NO" checked>
                                No
                              </label>
                            </div>
                          </div>
                        </div>
                      </div>


                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">WIFI</label>
                          <div class="col-sm-4">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" name="wifi" class="form-check-input" name="wifi" id="wifi" value="YES" >
                                Yes
                              </label>
                            </div>
                          </div>
                          <div class="col-sm-5">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="wifi" id="wifi" value="NO" checked>
                                No
                              </label>
                            </div>
                          </div>
                        </div>
                      </div>
                    

                      
                    <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Speaker</label>
                          <div class="col-sm-4">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" name="speaker" class="form-check-input" id="speaker" value="YES"  onclick="select_speaker()">
                                Yes
                              </label>
                            </div>
                          </div>
                          <div class="col-sm-5">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="speaker" id="speaker" value="NO" onclick="select_speaker()" checked>
                                No
                              </label>
                            </div>
                          </div>
                          </div>
                      </div>

                      <div class="col-md-6" id="no_of_speaker" style="display:none;">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label" >No.of Speakers</label>
                          <div class="col-sm-9" >
                            <input type="number" value="" name="no_of_speaker" class="form-control" placeholder="60" checked  />
                          </div>
                        </div>
                      </div> 
                    
</div>
<div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Systems</label>
                          <div class="col-sm-4">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" name="systems" class="form-check-input" id="sysRadio1" value="YES"  onclick="text()">
                                Yes
                              </label>
                            </div>
                          </div>
                          <div class="col-sm-5">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="systems" id="sysRadio2" value="NO" onclick="text()"checked>
                                No
                              </label>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6" id="sri" style="display:none" >
                        <div class="form-group row"  >
                          <label class="col-sm-3 col-form-label" >No.of systems</label>
                          <div class="col-sm-9" >
                            <input type="number" name="no_of_system" class="form-control" placeholder="60"  checked />
                          </div>
                        </div>
                      </div>  
                      
                      
                    </div>
</div>

                      
                    

                    


                      <input type="submit" id="submit" class="btn btn-primary mr-2" value="Register"/>
                    <button class="btn btn-light" href="<?php echo base_url()?>Dashboard_user/open_form">Cancel</button>
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