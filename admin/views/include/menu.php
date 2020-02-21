<div class="menu-left men-hgh">
    <ul class="men-ul">
        <li><a href="<?php echo base_url() ?>dashboard" class="<?php echo($this->uri->segment(1) == 'dashboard') ? 'active' :'' ?>"><i class="material-icons"> dashboard </i>Dashboard</a></li>
        <li><a href="<?php echo base_url() ?>employee" class="<?php echo($this->uri->segment(1) == 'employee') ? 'active' :'' ?>"><i class="material-icons"> perm_identity </i>Employee Management</a></li>
        <li><a href="<?php echo base_url() ?>student" class="<?php echo($this->uri->segment(1) == 'student') ? 'active' :'' ?>"><i class="material-icons">supervisor_account</i>Student Management</a></li>

        <li><a href="<?php echo base_url() ?>fees/manage" class="<?php echo($this->uri->segment(1) == 'fees') ? 'active' :'' ?>"><i class="material-icons"> attach_money </i>Scholarship Amount</a></li>


        <ul class="collapsible men-lft">
            <li class="si-m">
              <div class="collapsible-header"><i class="material-icons">school</i>Institute Management</div>

              <div class="collapsible-body"><span><a href="<?php echo base_url() ?>institutes" class="<?php echo($this->uri->segment(1) == 'institutes') ? 'active' :'' ?>">All Institute</a></span></div>
              <div class="collapsible-body"><span><a href="<?php echo base_url() ?>institute" class="<?php echo($this->uri->segment(1) == 'institute') ? 'active' :'' ?>">Registered Institute</a></span></div>
              <div class="collapsible-body"><span><a href="<?php echo base_url() ?>institute-request" class="<?php echo (($this->uri->segment(1) == 'institute-request') ) ? 'active' :'' ?>">Institute Add Request</a></span></div>

              <div class="collapsible-body"><span><a href="<?php echo base_url() ?>institute-add" class="<?php echo (($this->uri->segment(1) == 'institute-add')) ? 'active' :'' ?>">Add New Institute</a></span></div>

            </li>
            <li class="sc-m">
              <div class="collapsible-header"><i class="material-icons">file_copy</i>Scholarship Management</div>
              <div class="collapsible-body"><span><a href="<?php echo base_url() ?>applications" class="<?php echo(($this->uri->segment(1) == 'applications') && (empty($this->input->get('item'))) ) ? 'active' :'' ?>">All Application</a></span></div>
              <div class="collapsible-body"><span><a href="<?php echo base_url() ?>applications?item=approved" class="<?php echo($this->input->get('item') == 'approved') ? 'active' :'' ?>">Approved Application</a></span></div>
              <div class="collapsible-body"><span><a href="<?php echo base_url() ?>applications?item=rejected" class="<?php echo($this->input->get('item') == 'rejected') ? 'active' :'' ?>">Rejected Application</a></span></div>
              <div class="collapsible-body"><span><a href="<?php echo base_url() ?>applications?item=pending" class="<?php echo($this->input->get('item') == 'pending') ? 'active' :'' ?>">Pending Application</a></span></div>

            </li>
            <li class="sid-m">
              <div class="collapsible-header"><i class="material-icons">location_city</i>Industry Management</div>

              <div class="collapsible-body"><span><a href="<?php echo base_url() ?>industries" class="<?php echo($this->uri->segment(1) == 'industries') ? 'active' :'' ?>">All Industry</a></span></div>
              <div class="collapsible-body"><span><a href="<?php echo base_url() ?>industry" class="<?php echo($this->uri->segment(1) == 'industry') ? 'active' :'' ?>">Registered Industry</a></span></div>
              <div class="collapsible-body"><span><a href="<?php echo base_url() ?>industry-request" class="<?php echo (($this->uri->segment(1) == 'industry-request')) ? 'active' :'' ?>">Industry Add Request</a></span></div>

              <div class="collapsible-body"><span><a href="<?php echo base_url() ?>industry-add" class="<?php echo (($this->uri->segment(1) == 'industry-add')) ? 'active' :'' ?>">Add New Industry</a></span></div>

            </li>


            <li class="rpt-m">
              <div class="collapsible-header"><i class="material-icons">report</i>Reports</div>

              <div class="collapsible-body"><span><a href="<?php echo base_url() ?>reports" class="<?php echo($this->uri->segment(1) == 'reports' && (empty($this->input->get('item'))) ) ? 'active' :'' ?>">Total Scholarship Request</a></span></div>
              <div class="collapsible-body"><span><a href="<?php echo base_url() ?>reports?item=pending" class="<?php echo($this->input->get('item') == 'pending') ? 'active' :'' ?>">Total Pending Scholarship</a></span></div>
              <div class="collapsible-body"><span><a href="<?php echo base_url() ?>reports?item=approved" class="<?php echo($this->input->get('item') == 'approved') ? 'active' :'' ?>">Total Approved Scholarship</a></span></div>
              <div class="collapsible-body"><span><a href="<?php echo base_url() ?>reports?item=rejected" class="<?php echo($this->input->get('item') == 'rejected') ? 'active' :'' ?>">Total Rejected Scholarship</a></span></div>
            </li>

        </ul>

    </ul>
</div>