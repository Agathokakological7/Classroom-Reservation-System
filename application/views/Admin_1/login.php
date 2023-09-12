<style>
.login_page_container{
  border-radius:12px;
  box-shadow:0 2px 4px rgb(0 0 0 / 10%), 0 8px 16px rgb(0 0 0 / 10%)
}
.border_page{
  background: transparent;
    border-radius: 0;
    font-size: .9375rem;
}
.sign_up{
  background-color:#3181e8;
  border:none;
}
.sign_up:hover{
  background-color:#106ee8;
}
</style>
<body>
  <div class="container-scroller ">
    <div class="container-fluid">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5 border login_page_container">
              <div class="brand-logo">
             <center><img src="<?php echo base_url() ?>images/logo/login_logo.jpeg" alt="logo" style="width:30% ;"></center>
              <center><img src="<?php echo base_url()?>images/logo/login_name_img.jpg" alt="logo" style="width:100% ;"></center>
              </div>
              <center><h3>Venue Booking</h3></center>
              <center><h6 class="font-weight-light">Sign in to continue.</h6></center>
              <form class="pt-3" method="post" action="<?php echo base_url()?>Login/login">
                <div class="form-group ">
                  <input type="email" name="email" class="form-control form-control-lg rounded-3" id="exampleInputEmail1" placeholder="Username">
                </div>
                <div class="form-group">
                  <input type="password" name="password" class="form-control  form-control-lg rounded-3" id="exampleInputPassword1" placeholder="Password">
                </div>
                <div class="mt-3">
                  <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn sign_up">SIGN IN</button>
                </div>
                <div class="my-2 d-flex justify-content-between align-items-center">
                  <div class="form-check">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input">
                      Keep me signed in
                    </label>
                  </div>
                  <a href="#" class="auth-link text-black">Forgot password?</a>
                </div>
                <div class="mb-2">
                  <!-- <button type="button" class="btn btn-block btn-facebook auth-form-btn">
                    <i class="ti-google mr-2"></i>Connect using google
                  </button> -->
                </div>
                
              </form>
            </div>
          </div>
          <?php
        if($this->session->flashdata('error')){
          ?>
          <div class="alert alert-danger text-center" style="margin-top:20px;">
            <?php echo $this->session->flashdata('error'); ?>
          </div>
          <?php
        }
      ?>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->


