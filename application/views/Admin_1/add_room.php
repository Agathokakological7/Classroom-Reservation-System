
      <!-- partial -->
      <div class="main-panel">        
        <div class="content-wrapper">
          <div class="row">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title bg-primary p-3" style="border-radius:15px; color:whitesmoke;">Insert Room Info</h4>
                  <form class="form-sample" method="post" action="<?php echo base_url(); ?>Dashboard/room_type_data/<?php echo $room_data->id; ?>">
                    <p class="card-description">
      
                    </p>

                       <!-- End of Name -->

                       
                      <!-- Starting of Name -->
                    <div class="row">
                      <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Room Name</label>
                            <div class="col-sm-8">
                                <input class="form-control" value="<?php echo $room_data->room_name; ?>" name="room_name" id="room_name" placeholder="EX : Seminar Hall" required >
                             
                            </div>
                          </div>
                        </div>

                      <!-- End of Name -->

                      <!-- Starting of Name -->

                      <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Room Type</label>
                            <div class="col-sm-8">
                                <input class="form-control" value="<?php echo $room_data->room_type; ?>" name="room_type" list="datalistOptions3" id="room_type" placeholder="EX : Seminar Hall" required >
                              <datalist id="datalistOptions3">
                              <?php  
                                  foreach ($room_type->result() as $row)  
                                  {  
                                      ?>
                                <option><?php echo $row->name ?></option>
                                <?php } ?>
                              </select>
                            </div>
                          </div>
                        </div>

                        </div>
                      <!-- End of Name -->
                    <!-- Starting of floor -->
                    <div class="row"> 
                    <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label">Floor</label>
                          <div class="col-sm-8">
                          <input class="form-control" value="<?php echo $room_data->floor; ?>" name="floor" list="datalistOptions2" id="floor" placeholder="EX : First floor" required>
                            <datalist id="datalistOptions2">
                            <?php  
                                foreach ($floor_name->result() as $row)  
                                {  
                                    ?>
                              <option><?php echo $row->name ?></option>
                              <?php } ?>
                            </select>
                            </div>
                        </div>
                      </div>

                   
                      <!-- End of floor --> 
                      <!-- Starting of Seating Capacity -->
                    

                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label">Seating Capacity</label>
                          <div class="col-sm-8">
                            <input type="number" value="<?php echo $room_data->seating_capacity; ?>" name="seating_capacity" list="datalistOptions0" class="form-control" placeholder="EX : 60" required />
                            <datalist id="datalistOptions0">
                            <?php  
                                foreach ($seating_capacity->result() as $row)  
                                {  
                                    ?>
                              <option><?php echo $row->capacity ?></option>
                              <?php } ?>
                            </select>
                          </div>
                        </div>
                      </div>

                      </div>
                      <!-- End of Seating Capacity -->


                      <!-- Starting of Block name -->
                      <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label">Block Name</label>
                          <div class="col-sm-8">
                          <input class="form-control" value="<?php echo $room_data->block_name; ?>" name="block_name" list="datalistOptions1" id="room_type" placeholder="EX : Main Auditorium" required>
                            <datalist id="datalistOptions1">
                            <?php  
                                foreach ($block_name->result() as $row)  
                                {  
                                    ?>
                              <option><?php echo $row->name ?></option>
                              <?php } ?>
                            </select>
                          </div>
                        </div>
                      </div>
                      
                      </div>
                     

                    <!-- End of block name -->

                    <!-- Starting of Projector -->
                    <div class="row">
                    

                    <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label">Projector</label>

                          <?php 
                                  $proj = $room_data->projector;
                                  if($proj == "YES"){
                                ?>
                          <div class="col-sm-4">
                            <div class="form-check">
                              <label class="form-check-label">
                                
                                <input type="radio" checked="checked" name="projector" class="form-check-input" name="projector" id="projector" value="YES"  >
                                Yes
                              </label>
                            </div>
                          </div>
                          <div class="col-sm-4">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="projector" id="projector" value="NO" >
                                No
                              </label>
                            </div>
                          </div>
                          <?php }
                          else{
                            ?>

                          <div class="col-sm-4">
                            <div class="form-check">
                              <label class="form-check-label">
                                
                                <input type="radio" name="projector" class="form-check-input" name="projector" id="projector" value="YES"  >
                                Yes
                              </label>
                            </div>
                          </div>
                          <div class="col-sm-4">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" checked="checked" class="form-check-input" name="projector" id="projector" value="NO" >
                                No
                              </label>
                            </div>
                          </div>
                          <?php } ?>
                        </div>
                        </div>
                      <!-- End of Projector -->

                      <!-- Starting of WIFI -->
                    <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label">WIFI</label>

                          <?php 
                                  $proj = $room_data->wifi;
                                  if($proj == "YES"){
                                ?>

                          <div class="col-sm-4">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" checked="checked" name="wifi" class="form-check-input" name="wifi" id="wifi" value="YES" >
                                Yes
                              </label>
                            </div>
                          </div>
                          <div class="col-sm-4">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="wifi" id="wifi" value="NO" >
                                No
                              </label>
                            </div>
                          </div>

                          <?php }
                          else{
                            ?>
                          <div class="col-sm-4">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" name="wifi" class="form-check-input" name="wifi" id="wifi" value="YES" >
                                Yes
                              </label>
                            </div>
                          </div>
                          <div class="col-sm-4">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" checked="checked" class="form-check-input" name="wifi" id="wifi" value="NO" >
                                No
                              </label>
                            </div>
                          </div>
                          <?php }; ?>

                        </div>
                      </div>

                          </div>

                          <!-- End of WIFI -->


                          <!-- Starting of Speaker -->
                          <div class="row">

                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label">Speaker</label>

                          <?php 
                                  $proj = $room_data->speaker;
                                  if($proj != "NO" and $proj != ""){
                                ?>
                          <div class="col-sm-4">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" checked="checked" name="speaker" class="form-check-input" id="speaker" value="YES"  onclick="select_speaker()">
                                Yes
                              </label>
                            </div>
                          </div>
                          <div class="col-sm-4">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="speaker" id="speaker" value="NO" onclick="select_speaker()">
                                No
                              </label>
                            </div>
                          </div>
                          </div>
                      </div>

                        <div class="col-md-6" id="no_of_speaker" >
                        <div class="form-group row"  >

                          <label class="col-sm-3 col-form-label" >No.of Speakers</label>
                          <div class="col-sm-9" >
                            <input type="number" value="<?php echo $room_data->speaker; ?>" name="no_of_speaker" class="form-control" placeholder="60"   />
                          </div>
                        </div>
                      </div> 
                          <?php }
                          else{
                            ?>

                          <div class="col-sm-4">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio"  name="speaker" class="form-check-input" id="speaker" value="YES"  onclick="select_speaker()">
                                Yes
                              </label>
                            </div>
                          </div>
                          <div class="col-sm-4">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" checked="checked" class="form-check-input" name="speaker" id="speaker" value="NO" onclick="select_speaker()">
                                No
                              </label>
                            </div>
                          </div>
                          </div>
                      </div>
                          <div class="col-md-6" id="no_of_speaker" style="display:none" >
                        <div class="form-group row"  >
                          <label class="col-sm-3 col-form-label" >No.of Speaker</label>
                          <div class="col-sm-9" >
                            <input type="number" name="no_of_speaker" class="form-control" placeholder="60"   />
                          </div>
                        </div>
                      </div>
                          </div>
                          <?php } ?>

                      <!-- End of Speaker -->

                          <!-- Starting of Systems -->
                          <div class="row">

                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label">Systems</label>

                          <?php 
                                  $proj = $room_data->systems;
                                  if($proj != "NO" and $proj != ""){
                                ?>
                          <div class="col-sm-4">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" checked="checked" name="systems" class="form-check-input" id="sysRadio1" value="YES"  onclick="text()">
                                Yes
                              </label>
                            </div>
                          </div>
                          <div class="col-sm-4">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="systems" id="sysRadio2" value="NO" onclick="text()">
                                No
                              </label>
                            </div>
                          </div>
                          </div>
                      </div>

                        <div class="col-md-6" id="sri" >
                        <div class="form-group row"  >

                          <label class="col-sm-3 col-form-label" >No.of systems</label>
                          <div class="col-sm-9" >
                            <input type="number" value="<?php echo $room_data->systems; ?>" name="no_of_system" class="form-control" placeholder="60"   />
                          </div>
                        </div>
                      </div> 
                          <?php }
                          else{
                            ?>

                          <div class="col-sm-4">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio"  name="systems" class="form-check-input" id="sysRadio1" value="YES"  onclick="text()">
                                Yes
                              </label>
                            </div>
                          </div>
                          <div class="col-sm-4">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" checked="checked" class="form-check-input" name="systems" id="sysRadio2" value="NO" onclick="text()">
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
                            <input type="number" name="no_of_system" class="form-control" placeholder="60"   />
                          </div>
                        </div>
                      </div>
                          
                          <?php } ?>
                        
                          <!-- End of Systems -->
                          

                      <?php 
                      $btn = $room_data->id;
                      
                      if ($btn == ""){
                        echo $btn;
                      ?>

                      <button type="submit" class="btn btn-primary ml-auto" >ADD</button>
                        <?php } 
                        
                        else{?>
                        <div class="col-md-4">
                        <div class="form-group row">
                          <div class="col-sm-6">
                          <button type="submit" class="btn btn-primary ml-auto" href="<?php echo base_url()?>Dashboard/edit_room_type/<?php echo $room_data->id ?>" >SAVE</button>
                          </div>
                          <div class="col-sm-6">
                          <button type="submit" class="btn btn-primary ml-auto" >CANCEL</button>
                          </div>
                        </div>
                      </div>
                          <?php } ?>
                    </div>
                  </form>
                </div>
              </div>
            </div>            
          </div>
       
        <!-- content-wrapper ends -->
  <div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <p class="card-title mb-0">Recent Added</p>
          <div class="table-responsive">
            <div class="table table-hover">
              <table class="table table-striped table-borderless" id="recent_added">
                <thead>
                  <tr>
                    <th>Room Name</th>
                    <th>Room type</th>
                    <th>Block Name</th>
                    <th>seating_capacity</th>
                    <th>Block Name</th>
                    <th>Projector</th>
                    <th>WIFI</th>
                    <th>Speaker</th>
                    <th>Systems</th>
                    <th hidden></th>
                    <th hidden></th>
                  </tr>  
                </thead>
                <tbody>
                  <?php foreach ($info->result() as $row) {  
                    echo "<script>console.log('Debug Objects: " .$row->room_name. "' );</script>";
                  ?>
                  <tr>
                    <td><?php echo $row->room_name;?></td>
                    <td><?php echo $row->room_type;?></td>
                    <td><?php echo $row->floor;?></td>
                    <td><?php echo $row->seating_capacity;?></td>
                    <td><?php echo $row->block_name;?></td>
                    <td><?php echo $row->projector;?></td>
                    <td><?php echo $row->wifi;?></td>
                    <td><?php echo $row->speaker;?></td>
                    <td><?php echo $row->systems;?></td>
                    <td id="id" style="display:none;"><?php echo $row->id;?></td>
                    <td class="font-weight-medium">
                      <a class="badge badge-success edit_btn" href="<?php echo base_url(); ?>Dashboard/add_room/<?php echo $row->id;?>">Edit</a>
                      <a class="badge badge-danger" href="<?php echo base_url(); ?>Dashboard/room_type_deletes/<?php echo $row->id;?>">Delete</a>       
                    </td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>