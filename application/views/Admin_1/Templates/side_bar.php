 <!-- partial:partials/_sidebar.html -->
 <nav class="sidebar sidebar-offcanvas"  id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url()?>Dashboard/index">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
         
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
              <i class="icon-columns menu-icon"></i>
              <span class="menu-title">ClassRoom Allotment</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="form-elements">
              
            <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="<?php echo base_url()?>Dashboard/import_room">Import Class Room</a></li>
              </ul>
            <ul class="nav flex-column sub-menu">
              
                <li class="nav-item"> <a class="nav-link" href="<?php echo base_url()?>Dashboard/add_room">Add ClassRoom</a></li>
              </ul>
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="<?php echo base_url()?>Dashboard/class_room_booking">Add ClassRoom Schedule</a></li>
              </ul>
              
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="<?php echo base_url()?>Dashboard/bulk_booking">Extent Booking</a></li>
              </ul>
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="<?php echo base_url()?>Dashboard/open_form">Schedule Faculty Request</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#charts" aria-expanded="false" aria-controls="charts">
              <i class="icon-grid-2 menu-icon"></i>
              <span class="menu-title">Venue/Booked Details</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="charts">
            <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="<?php echo base_url()?>Dashboard/open_table">Total info</a></li>
              </ul>
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="<?php echo base_url()?>Dashboard/admin_allocation">Admin Allocation</a></li>
              </ul>
            </div>
          </li>
         
         
           
          </li>
         
        </ul>
      </nav>