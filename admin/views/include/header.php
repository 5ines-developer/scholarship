<header class="">
        <div class="top-header">
            <div class="container ">
                <div class="row m0">
                    <div class="col s4 m4 push-m4">
                        <div class="center">
                        <a href="<?php echo base_url()?>">    <img class="responsive-img" src="<?php echo $this->config->item('web_url') ?>assets/image/logo.png" alt="Karnataka Labour Welfare Board"></a>
                        </div>
                    </div>
                    <div class="col s8 m4 pull-m4">
                        <div class="center-align p17 frt">
                            <p class="top-header-title1">ಕರ್ನಾಟಕ ಸರ್ಕಾರ</p>
                            <p class="top-header-title2">ಕರ್ನಾಟಕ ಕಾರ್ಮಿಕ ಕಲ್ಯಾಣ ಮಂಡಳಿ</p>
                        </div>
                    </div>
                    <div class="col s4 hide-on-small-only">
                        <div class="center p17">
                            <p class="top-header-title1">Government of Karnataka</p>
                            <p class="top-header-title2">Karnataka Labour Welfare Board</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <nav class="nav-block">
            <div class="nav-wrapper container-wrap1">
                <!-- <a href="#" class="brand-logo">Logo</a> -->
                <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                <ul id="nav-mobile1" class="left hide-on-med-and-down">
                    <li><a href="<?php echo base_url() ?>">Home</a></li>
                </ul>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                    <?php if($this->session->userdata('said') == ''){ ?>
                        <li><a href="<?php echo base_url('login') ?>">Login</a></li>
                   <?php }else{ ?>
                    <li><a href="#!" class="dropdown-trigger" data-target='dropdown1'> <i class="material-icons user-nav-btn">account_circle</i> </a></li>

                   <?php } ?>
                    
                </ul>
            </div>
        </nav>
        <ul class="sidenav" id="mobile-demo">
                <li><a href="<?php echo $this->config->item('web_url') ?>">Home</a></li>
                <li><a href="<?php echo base_url() ?>dashboard">Dashboard</a></li>
                <li><a href="<?php echo base_url() ?>employee">Employee Management</a></li>
                <li><a href="<?php echo base_url() ?>student">Student Management</a></li>
                <li><a href="<?php echo base_url() ?>fees/manage">Scholarship Amount</a></li>
                <ul class="collapsible ">
                <li class=""><a class="collapsible-header head-h black-text" tabindex="0">Institute Management<i class="material-icons drop-ar right">arrow_drop_down</i></a>
                    <div class="collapsible-body" style="">
                        <ul>
                            <li><a href="mobile-apps-development-company-bangalore.php">App Development</a></li>
                            <li><a href="digital-marketing-agency-bangalore.php">Digital Marketing</a></li>
                            <li><a href="web-designing-company-bangalore.php">Web Design</a></li>
                            <li><a href="web-development-company-bangalore.php">Web Development</a></li>
                        </ul>
                    </div>
                </li>
                </ul>
                <li><a href="<?php echo base_url() ?>employee">Scholarship Management</a></li>
                <li><a href="<?php echo base_url() ?>employee">Industry Management</a></li>
                <li><a href="<?php echo base_url('logout')?>">Logout</a></li>
        </ul>

        <ul id='dropdown1' class='dropdown-content'>
              <li><a href="<?php echo base_url('profile')?>">Account Settings</a></li>
              <li><a href="<?php echo base_url('change-password') ?>">Change Password</a></li>
              <li><a href="<?php echo base_url('logout')?>">Logout</a></li>
            </ul>
    </header>
