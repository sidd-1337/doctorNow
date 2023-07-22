<aside id="menubar" class="menubar light">
  <div class="app-user">
    <div class="media">
      <div class="media-left">
        <div class="avatar avatar-md avatar-circle">
          <a href="javascript:void(0)"><img class="img-responsive" src="assets/images/images.png" alt="avatar" /></a>
        </div><!-- .avatar -->
      </div>
      <div class="media-body">
        <div class="foldable">
          <?php

          require_once('../includes/database.php');
          require_once('../controller/doctorAppointmentController.php');
          $email = $_SESSION['email'];

          ?>
          <h5><a href="javascript:void(0)" class="username">
              <?php echo $_SESSION['first_name'] . ' ' . $_SESSION['last_name']; ?>
            </a></h5>
          <ul>
            <li class="dropdown">
              <a href="javascript:void(0)" class="dropdown-toggle usertitle" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                <small>
                  <?php //echo $email; ?>
                </small>
                <span class="caret"></span>
              </a>
              <ul class="dropdown-menu animated flipInY">
                <li>
                <?php if ($_SESSION["type"]=="doctor") {?>
                  <a class="text-color" href="dashboard.php">
                    <span class="m-r-xs"><i class="fa fa-home"></i></span>
                    <span>Home</span>
                  </a>
                  <?php }else if ($_SESSION["type"]=="patient") { ?>
                    <a class="text-color" href="patient-dashboard.php">
                    <span class="m-r-xs"><i class="fa fa-home"></i></span>
                    <span>Home</span>
                  </a>
                  <?php } else {?>
                    <a class="text-color" href="admin-dashboard.php">
                    <span class="m-r-xs"><i class="fa fa-home"></i></span>
                    <span>Home</span>
                  </a>
                  <?php } ?>

                </li>
              
                <li>
                <?php if ($_SESSION["type"]=="doctor") {?>
                  <a class="text-color" href="profile.php">
                    <span class="m-r-xs"><i class="fa fa-user"></i></span>
                    <span>Profile</span>
                  </a>

                  <?php }else if ($_SESSION["type"]=="patient") { ?>
                    <a class="text-color" href="patient-profile.php">
                    <span class="m-r-xs"><i class="fa fa-user"></i></span>
                    <span>Profile</span>
                  </a>
                  <!-- <?php //} else {?>
                    <a class="text-color" href="profile.php">
                    <span class="m-r-xs"><i class="fa fa-user"></i></span>
                    <span>Profile</span>
                  </a> -->
                   
                <?php } ?>

                </li>
               


                </li>
                <li role="separator" class="divider"></li>
                <li>
                  <a class="text-color" href="logout.php">
                    <span class="m-r-xs"><i class="fa fa-power-off"></i></span>
                    <span>logout</span>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </div><!-- .media-body -->
    </div><!-- .media -->
  </div><!-- .app-user -->

  

  <div class="menubar-scroll">
    <div class="menubar-scroll-inner">
      <ul class="app-menu">
      
        <li class="has-submenu">
        <?php if ($_SESSION["type"]=="doctor") {?>
          <a href="dashboard.php">
            <i class="menu-icon zmdi zmdi-view-dashboard zmdi-hc-lg"></i>
            <span class="menu-text">Dashboard</span>

          </a>
          <?php }else if ($_SESSION["type"]=="patient") { ?>
            <a href="patient-dashboard.php">
            <i class="menu-icon zmdi zmdi-view-dashboard zmdi-hc-lg"></i>
            <span class="menu-text">Dashboard</span>

          </a>
          <?php } else {?>
            <a href="admin-dashboard.php">
            <i class="menu-icon zmdi zmdi-view-dashboard zmdi-hc-lg"></i>
            <span class="menu-text">Dashboard</span>

          </a>
          <?php } ?>

        </li>

        <li class="has-submenu">
          <a href="javascript:void(0)" class="submenu-toggle">
            <i class="menu-icon zmdi zmdi-pages zmdi-hc-lg"></i>
            <?php if ($_SESSION["type"]=="admin") {?>
            <span class="menu-text">Users</span>
            <?php } else {?>
              <span class="menu-text">Appointment</span>
              <?php } ?>
            <i class="menu-caret zmdi zmdi-hc-sm zmdi-chevron-right"></i>
          </a>
          <?php if ($_SESSION["type"]=="doctor") {?>
            <ul class="submenu">
            <li><a href="new-appointment.php"><span class="menu-text">New Appointment</span></a></li>
            <li><a href="approved-appointment.php"><span class="menu-text">Approved Appointment</span></a></li>
            <li><a href="cancelled-appointment.php"><span class="menu-text">Cancelled Appointment</span></a></li>
            <li><a href="all-appointment.php"><span class="menu-text">All Appointment</span></a></li>

          </ul>
          <?php }else if ($_SESSION["type"]=="patient") { ?>
            <ul class="submenu">
            <li><a href="patient-pending-appointment.php"><span class="menu-text">Pending Appointment</span></a></li>
            <li><a href="patient-approved-appointment.php"><span class="menu-text">Approved Appointments</span></a></li>
            <li><a href="patient-history-appointment.php"><span class="menu-text">History Appointments</span></a></li>
            
          </ul>
          <?php } else {?>
            <ul class="submenu">
            <li><a href="all-patients.php"><span class="menu-text">Patients</span></a></li>
            <li><a href="all-doctors.php"><span class="menu-text">Doctors</span></a></li>
            
          </ul>
           
          <?php }?>
        
        </li>

        <li class="has-submenu">
        <?php if ($_SESSION["type"]=="doctor") {?>
          <a href="../../index_en.php">
            <i class="menu-icon zmdi zmdi-home zmdi-hc-lg"></i>
            <span class="menu-text">Go to home page</span>
          </a>
          <?php }else if ($_SESSION["type"]=="patient") { ?>
            <a href="../../index_en.php">
            <i class="menu-icon zmdi zmdi-home zmdi-hc-lg"></i>
            <span class="menu-text">Go to home page</span>
          </a>
          <?php } else {?>
            <a href="../../index_en.php">
            <i class="menu-icon zmdi zmdi-home zmdi-hc-lg"></i>
            <span class="menu-text">Go to home page</span>
          </a>
          <?php } ?>
        </li>

        <?php if ($_SESSION["type"]=="patient") {?>
<!-- 
          <li>
          <a href="patient-booking-appointment.php">
            <i class="menu-icon zmdi zmdi-layers zmdi-hc-lg"></i>
            <span class="menu-text">Booking</span>
          </a>
        </li> -->
        <!-- <li>
        <a href="patient-booking-appointment.php" class="submenu-toggle">
            <i class="menu-icon zmdi zmdi-layers zmdi-hc-lg"></i>
            <span class="menu-text">Booking</span>
          </a>

        </li> -->
        <?php }?>


        <?php if ($_SESSION["type"]=="admin") {?>
        <li>
        <a href="javascript:void(0)" class="submenu-toggle">
            <i class="menu-icon zmdi zmdi-layers zmdi-hc-lg"></i>
            <span class="menu-text">Requests</span>
            <i class="menu-caret zmdi zmdi-hc-sm zmdi-chevron-right"></i>
          </a>
          <ul class="submenu">
            <li><a href="doctor-registration-requests.php"><span class="menu-text">Doctors' Reg Requests</span></a></li>
            <li><a href="doctor-registration-deny.php"><span class="menu-text">Doctors' Deny Requests</span></a></li>
            
          </ul>
        </li>
        <?php }?>

    

      </ul><!-- .app-menu -->
    </div><!-- .menubar-scroll-inner -->
  </div><!-- .menubar-scroll -->
</aside>