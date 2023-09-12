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
        <div class="modal-header">

<h5 class="modal-title" id="exampleModalLabel">

<div class="d-flex flex-row bd-highlight mb-3">
  <div class="p-2 bd-highlight">AG21</div>
  <div class="p-2 bd-highlight">First Floor</div>
  <div class="p-2 bd-highlight">IB Block</div>
  <div class="p-2 bd-highlight">
    <button type="button" class="btn btn-success btn-fw" data-bs-toggle="tooltip" data-bs-placement="bottom" title="EDIT"><i class='fas fa-edit'></i></button>
    <button type="button" class="btn btn-secondary btn-fw" data-bs-toggle="tooltip" data-bs-placement="bottom" title="DE-ACTIVATE"><i class='fas fa-wrench'></i></button>
    <button type="button" class="btn btn-danger btn-fw" data-bs-toggle="tooltip" data-bs-placement="bottom" title="DELETE"><i class='fas fa-trash-alt'></i></button>
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
                class="img-fluid" style="width: 100%; height:70%;">
      </div>
  
      <div class="row">
        
        <div class="col-lg-12">
          <div class="card mb-4">
          <h5 style="padding:5px;">ROOM FACILITY</h5>
          <span class="bi bi-projector"></span>
              <div class="card-body">

<!--       /////////////////////////////////////////////////////////  -->

<div class="row icons-list">
                    <div class="col-sm-6 col-md-4 col-lg-4 facility_icon">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="card-people mt-auto facility_img">
                            <img src="<?php echo base_url()?>images\pop_up_img\3.png" alt="people">
                            
                          </div>
                        </div>
                        <div class="col-md-12">
                          <p class="facility_title">PROJECTOR</p>
                        </div>
                      </div>
                    </div>

                    <div class="col-sm-6 col-md-4 col-lg-4 facility_icon">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="card-people mt-auto facility_img">
                            <img src="<?php echo base_url()?>images\pop_up_img\4.png" alt="people">
                          </div>
                        </div>
                        <div class="col-md-12">
                          
                        <p class="facility_title">PROJECTOR SCREEN</p>
                        </div>
                      </div>
                    </div>
                    
                    <div class="col-sm-6 col-md-4 col-lg-4 facility_icon">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="card-people mt-auto facility_img">
                            <img src="<?php echo base_url()?>images\pop_up_img\2.png" alt="people">
                          </div>
                        </div>
                        <div class="col-md-12">
                        <p class="facility_title">SPEAKER</p>
                        </div>
                      </div>
                    </div>
                    
                    <div class="col-sm-6 col-md-4 col-lg-4 facility_icon">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="card-people mt-auto facility_img">
                            <img src="<?php echo base_url()?>images\pop_up_img\6.png" alt="people">
                          </div>
                        </div>
                        <div class="col-md-12">
                        <p class="facility_title">AMPLIFIER</p>
                        </div>
                      </div>
                    </div>

                    <div class="col-sm-6 col-md-4 col-lg-4 facility_icon">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="card-people mt-auto facility_img">
                            <img src="<?php echo base_url()?>images\pop_up_img\1.png" alt="people">
                          </div>
                        </div>
                        <div class="col-md-12">
                        <p class="facility_title">SYSTEM</p>
                        </div>
                      </div>
                    </div>

                    <div class="col-sm-6 col-md-4 col-lg-4 facility_icon">
                      <div class="row">
                        <div class="col-md-12 ">
                          <div class="card-people mt-auto facility_img">
                            <img src="<?php echo base_url()?>images\pop_up_img\5.png" alt="people">
                          </div>
                        </div>
                        <div class="col-md-12">
                        <p class="facility_title">CLOCK</p>
                        </div>
                      </div>
                    </div>

                  

</div>

<!--           /////////////////////////////////////////////////////  -->
       
            </div>
          </div>
          
          </div>
        </div>
      </div>
    </div>
  </section>
