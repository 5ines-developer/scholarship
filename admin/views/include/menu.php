<div class="menu-left men-hgh">
    <ul class="men-ul">
        <li><a href="<?php echo base_url() ?>dashboard" class="<?php echo($this->uri->segment(1) == 'dashboard') ? 'active' :'' ?>"><i class="material-icons"> dashboard </i>Dashboard</a></li>
        <li><a href="<?php echo base_url() ?>student" class="<?php echo($this->uri->segment(1) == 'student') ? 'active' :'' ?>"><i class="material-icons">supervisor_account</i>Student Management</a></li>
        <ul class="collapsible men-lft">
            <!-- <li class="st-m">
              <div class="collapsible-header"><i class="material-icons">supervisor_account</i>Student Management</div>
              <div class="collapsible-body"><span><a href="<?php echo base_url() ?>student" class="<?php echo($this->uri->segment(1) == 'student') ? 'active' :'' ?>">All students</a></span></div>
              <div class="collapsible-body"><span><a href="<?php echo base_url() ?>student" class="<?php echo($this->uri->segment(1) == 'student') ? 'active' :'' ?>">Active students</a></span></div>
              <div class="collapsible-body"><span><a href="<?php echo base_url() ?>student" class="<?php echo($this->uri->segment(1) == 'student') ? 'active' :'' ?>">Inactive students</a></span></div>
            </li> -->
            <li class="si-m">
              <div class="collapsible-header"><i class="material-icons">school</i>Institute Management</div>

              <div class="collapsible-body"><span><a href="<?php echo base_url() ?>institutes" class="<?php echo($this->uri->segment(1) == 'institutes') ? 'active' :'' ?>">All Institute</a></span></div>
              <div class="collapsible-body"><span><a href="<?php echo base_url() ?>institute" class="<?php echo($this->uri->segment(1) == 'institute') ? 'active' :'' ?>">Registered Institute</a></span></div>
              <div class="collapsible-body"><span><a href="<?php echo base_url() ?>institute-request" class="<?php echo (($this->uri->segment(1) == 'institute-request') || ($this->uri->segment(1) == 'institute-add')) ? 'active' :'' ?>">Institute Add Request</a></span></div>



            </li>
            <li class="sc-m">
              <div class="collapsible-header"><i class="material-icons">file_copy</i>Scholarship Management</div>
              <div class="collapsible-body"><span><a href="<?php echo base_url() ?>applications" class="<?php echo(($this->uri->segment(1) == 'applications') && (empty($this->input->get('item'))) ) ? 'active' :'' ?>">All Application</a></span></div>
              <div class="collapsible-body"><span><a href="<?php echo base_url() ?>applications?item=approved" class="<?php echo($this->input->get('item') == 'approved') ? 'active' :'' ?>">Approved Application</a></span></div>
              <div class="collapsible-body"><span><a href="<?php echo base_url() ?>applications?item=rejected" class="<?php echo($this->input->get('item') == 'rejected') ? 'active' :'' ?>">Rejected Application</a></span></div>
              <div class="collapsible-body"><span><a href="<?php echo base_url() ?>applications?item=pending" class="<?php echo($this->input->get('item') == 'pending') ? 'active' :'' ?>">Pending Application</a></span></div>

            </li>
        </ul>
         <!-- <li><a href=" " class="<?php echo($this->uri->segment(1) == 'industry') ? 'active' :'' ?>">Company Management</a></li> -->
        <li><a href="<?php echo base_url() ?>employee" class="<?php echo($this->uri->segment(1) == 'employee') ? 'active' :'' ?>"><i class="material-icons">
perm_identity
</i>Employee Management</a></li>
        <!--<li><a href="<?php echo base_url() ?>">Account Settings</a></li>
        <li><a href=" ">Change Password</a></li> -->
    </ul>
</div>