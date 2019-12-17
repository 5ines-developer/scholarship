<div class="menu-left z-depth-2">
    <ul>
        <li>
            <a href="<?php echo base_url() ?>dashboard" class="<?php echo($this->uri->segment(1) == 'dashboard') ? 'active' :'' ?>">
                Scholarship  Request 
                <!-- <span class="badges right"> {{tableRow.length}} </span> -->
            </a>
        </li>
        <li><a href="<?php echo base_url() ?>approve-list" class="<?php echo($this->uri->segment(1) == 'approve-list') ? 'active' :'' ?>">Scholarship  Approved</a></li>
        <li ><a href="<?php echo base_url() ?>reject-list" class="<?php echo($this->uri->segment(1) == 'reject-list') ? 'active' :'' ?>">Scholarship  Rejected</a></li>
        <?php if(empty($this->session->userdata('type'))){ ?>
            <li ><a href="<?php echo base_url() ?>staffs" class="<?php echo($this->uri->segment(1) == 'staffs') ? 'active' :'' ?>">Manage Verification Staffs</a></li>
            <li><a href="<?php echo base_url() ?>account"  class="<?php echo($this->uri->segment(1) == 'account') ? 'active' :'' ?>">Account Settings</a></li>
        <?php }?>
    </ul>
</div>