<div class="menu-left">
    <ul>
        <li><a href="<?php echo base_url() ?>student" class="<?php echo($this->uri->segment(1) == 'student') ? 'active' :'' ?>">Student Management</a></li>
        <li><a href=" " class="<?php echo($this->uri->segment(1) == 'institute') ? 'active' :'' ?>">Institute Management</a></li>
        <li><a href=" " class="<?php echo($this->uri->segment(1) == 'industry') ? 'active' :'' ?>">Company Management</a></li>
        <li><a href="<?php echo base_url() ?>employee" class="<?php echo($this->uri->segment(1) == 'employee') ? 'active' :'' ?>">Employee Management</a></li>
        <li><a href="<?php echo base_url() ?>">Account Settings</a></li>
        <li><a href=" ">Change Password</a></li>
    </ul>
</div>